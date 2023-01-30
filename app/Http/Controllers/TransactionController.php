<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuyPakageRequest;
use App\Http\Requests\PurchaseTripPackageRequest;
use App\Http\Requests\ScanoutRequest;
use App\Http\Requests\ScanRequest;
use App\Interfaces\TransactionRepositoryInterface;
use Illuminate\Support\Facades\Log;
use App\Models\PackageCodes;
use App\Models\PayAsYouGoCodes;
use App\Models\TransactionLog;
use App\Models\TripPackage;
use App\Models\TripPackageLog;
use App\Models\User;
use App\Models\UserTrip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TransactionController extends Controller
{
    private $transRepo;

    public function __construct(TransactionRepositoryInterface $transRepo)
    {
        $this->transRepo = $transRepo;
    }
    public function activate_trip_package(PurchaseTripPackageRequest $request){
        $validated = $request->validated();
        return $this->transRepo->activate_trip_package($validated);
    }
    public function buy_package(BuyPakageRequest $details){
        $url = "https://api.paystack.co/transaction/initialize";
        $email = User::where('id', $details['userid'])->first()->email;
        $package = TripPackage::where('id', $details['packageid'])->first();
        $secret = config('services.webhooks.paystack.secret');
        $fields = [
            'email' => $email,
            'amount' => $package->price * 100,
            'metadata' => [
                "custom_fields" =>[
                    [
                        "recurring" => true,
                        "display_name" => "Buy Package",
                        "variable_name" => $package->id,
                        "value" => "buy package"//209
                    ]
                ]
            ]
        ];

        $fields_string = http_build_query($fields);

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer $secret",
            "Cache-Control: no-cache",
        ));

        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

        //execute post
        $result = curl_exec($ch);
        return $result;
    }
    public function scan_user(ScanRequest $request ){
        $validated = $request->validated();
        return $this->transRepo->scan_user($validated);
    }
    public function scan_out (ScanoutRequest $request ){
        $validated = $request->validated();
        return $this->transRepo->scan_out($validated);
    }

    public function log_transaction($amount, $reference, $type, $completed, $user, $logtype,  $description){
        TransactionLog::create(
            [
                "amount" => $amount,
                "reference" => $reference,
                "type" => $type,
                "is_completed" => $completed,
                "loggable_id" => $user,
                "loggable_type" => $logtype,
                "description" => $description
            ]
        );
    }

    public function inst_add_units_value($request){
        // on purchase, give user value
        $packageid = $request['packageid'];
        $id = $request['userid'];
        $package = TripPackage::find($packageid);
        if($package->exists()){
            // log_transaction
            $res = 'transaction successfull';
            $this->log_transaction($package->price, time(), 1, 1, $id, "inst", $res);
            $trip_pkg_log = new TripPackageLog();
            $trip_pkg_log->package_id = $packageid;
            $trip_pkg_log->user_id = $id;
            $trip_pkg_log->save();

            // add value to user
            $user = User::where('id', $id)->first();
            $user->trip_count += $package->count;
            $user->save();
            // email user trip units
            // assign user card
            $cards = PackageCodes::where('package_id', $packageid)->where('is_used', '!=', 1)->first();
            if($cards){
                PayAsYouGoCodes::create(
                    [
                        'code' => $cards['code'],
                        'user_id' => $id
                    ]
                );
            }else{
                return res_not_found('No codes');
            }
        }
    }

    public function add_units_value($request){
        // on purchase, give user value
        $packageid = $request['packageid'];
        $id = $request['userid'];
        $package = TripPackage::find($packageid);
        if($package->exists()){
            // log_transaction
            $res = 'transaction successfull';
            $this->log_transaction($package->price, $request['ref'], 1, 1, $id, "card", $res);
            $trip_pkg_log = new TripPackageLog();
            $trip_pkg_log->package_id = $packageid;
            $trip_pkg_log->user_id = $id;
            $trip_pkg_log->save();

            // add value to user..... get packageCode and assign to user
            $user = User::where('id', $id)->first();
            $user->trip_count += $package->count;
            $user->save();
            // GENERATE USER CODE
            $code = generate_user_code();
            $oldCode = UserTrip::where('user_id', $id)->first()->delete();
            $oldCode;
            $newUserTripCode = new UserTrip();
            // delete existing code
            $newUserTripCode::create([
                'user_id' => $id,
                'trip_no' => $code,
            ]);


            // email user trip units
        }
    }

    public function verifyTransaction($reference){
        $secret = config('services.webhooks.paystack.secret');
        $response = Http::retry(3, 100)->asForm()->withHeaders([
            'Authorization' => "Bearer $secret",
        ])->get('https://api.paystack.co/transaction/verify/'.$reference);

        return $response->json();
    }

    public function webHookHandlerPaystack(Request $request){
        // get server origin information
        $secret = config('services.webhooks.paystack.secret');
        $header = $request->header();
        $input = @file_get_contents("php://input");
        if($header['x-paystack-signature'][0] !== hash_hmac('sha512', $input, $secret)){
           exit();
        }else{
            $verify = $this->verifyTransaction($request['data']['reference']);
            if($verify['data']['status'] == 'success' && $request['event'] == "charge.success"){
                $userid = User::where('email', $request['data']['customer']['email'])->first()->id;
                $details = [
                    "packageid" => $request['data']['metadata']['custom_fields'][0]['variable_name'],
                    "userid" => $userid,
                    'ref' => $request['data']['reference']
                ];
                // Log::info($request);
                $this->add_units_value($details);
            }else{
                return res_bad_request('This transaction is unverifiable');
            }
        }
    }



   public function pay(Request $request){
        $url = "https://api.paystack.co/transaction/initialize";
        $secret = config('services.webhooks.paystack.secret');

        $fields = [
            'email' => $request['email'],
            'amount' => $request['amount'],
            'metadata' => [
                "custom_fields" =>[
                  [
                    "variable_name" => $request['package'],
                  ]
                ]
            ]
        ];

        $fields_string = http_build_query($fields);

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer $secret",
            "Cache-Control: no-cache",
        ));

        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

        //execute post
        $result = curl_exec($ch);
        echo $result;
   }



}
