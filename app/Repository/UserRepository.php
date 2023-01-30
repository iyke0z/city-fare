<?php

namespace App\Repository;

use App\Interfaces\UserRepositoryInterface;
use App\Models\Bus;
use App\Models\ContactDetail;
use App\Models\DriverDetail;
use App\Models\Log;
use App\Models\OtpVerfication;
use App\Models\User;
use App\Models\UserBus;
use App\Traits\UserTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface{
    use UserTrait;

    public function create_user_account($request){
        // create user account
        $data = [
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'phone' => $request['phone'],
            'email'	=> $request['email'],
            'password' => Hash::make($request['password']),
            'account_type' => $request['account_type'],
            'identity'	=> $request['identity'],
            'dob' => $request['dob'],
            'nin' => $request['nin'],
        ];
        $verifyOtp = OtpVerfication::where(['phone' => $request['phone']], ['request_type' => 'registration'])->first();

        if ($verifyOtp && $verifyOtp->is_verified == 1) {
            $user = User::create($data);
            $user;

            $contact = new ContactDetail();
            $contact->user_id = $user['id'];
            $contact->address = $request['address'];
            $contact->country_id =  $request['country_id'];
            $contact->state_id = $request['state_id'];
            $contact->save();
            $verifyOtp->is_registered = 1;
            $verifyOtp->save();
            $token = $user->createToken('auth_token')->plainTextToken;
            // log
            UserTrait::log_action('user', $user->id, 'create', $user->id);

            if ($request['account_type'] == 'driver') {
                $driver_details = [
                    "user_id" => $user['id'],
                    "lisence_no" => $request['lisence_no'],
                    "issue_date" => $request['issue_date'],
                    "expiry_date" => $request['expiry_date'],
                    "is_verified" => $request['is_verified'],
                    "years_of_experience" => $request['years_of_experience'],
                ];

                DriverDetail::create($driver_details);
            }

            return res_success(
                'account created',
                [
                    'details'=> $user,
                    'token' => [
                        'access_token' => $token,
                        'token_type' => 'Bearer',
                    ]
                ]
            );
        }else{
            return res_unauthorized('Please verify your phone number to continue!');
        }

    } //passenger and partners
    public function get_user($request){
        $id = $request['id'];
        $user = User::find($id);
        if($user->exists()){
            if($user->account_type == 'admin'){
                $user = User::with('contact')
                            // ->with('otp')
                            ->with('logs')
                            ->with('log_action')
                            ->find($id);
                            return res_success('details', $user);
            }
            if($user->account_type == 'driver'){
                $user = User::with('transaction')
                            ->with('driver_datail')
                            ->with('guarantor')
                            ->with(['bus' => function($q){
                                $q->with(['bus' => function ($n) {
                                    $n->with('model')->with('manufacturer')->with('trip');
                                }]);
                            }])
                            ->with('contact')
                            ->with('logs')
                            ->with('package')
                            ->with('bank_details')
                            ->with('institution')
                            ->find($id);

                return res_success('details', $user);
            }
            if($user->account_type == 'conductor'){
                $user = User::with('transaction')
                ->with('guarantor')
                ->with(['bus' => function($q){
                    $q->with(['bus' => function ($n) {
                        $n->with('model')->with('manufacturer')->with('trip');
                    }]);
                }])
                ->with('contact')
                ->with('logs')
                ->with('bank_details')
                ->with('institution')
                ->find($id);
                return res_success('details', $user);
            }
            if($user->account_type == 'passenger'){
                $user = User::with('transaction')
                ->with('trip')
                ->with('contact')
                ->with('logs')
                ->with('package')
                ->with('bank_details')
                ->with('bonus')
                ->with('discount')
                ->with('cards')
                ->with('institution')
                ->find($id);
                return res_success('details', $user);
            }
            // if($user->account_type == 'bus'){
            //     $user = User::with('logs')
            //             ->with('trip')
            //             ->get();
            //     return res_success('details', $user);
            // }
            if($user->account_type == 'partner'){
                $res = User::with('logs')
                            ->with('contact')
                            ->with(['bus' => function($q){
                                $q->with(['bus' => function ($n) {
                                    $n->with('model')->with('manufacturer')->with('trip');
                                }]);
                            }])
                            ->find($id);
                return res_success('details', $res);
            }
        }
    }
    public function update_user($request){
        // create user account
        $id = $request['id'];
        $data = [
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'phone' => $request['phone'],
            'email'	=> $request['email'],
            'password' => Hash::make($request['password']),
            'account_type' => $request['account_type'],
            'identity'	=> $request['identity'],
            'dob' => $request['dob'],
            'nin' => $request['nin'],
        ];

        $user = User::find($id);

        if($user->exists()){
            $user = $user->update($data);
            $user;

            $contact = ContactDetail::where('user_id', $id)->first();
            $contact->user_id = $id;
            $contact->address = $request['address'];
            $contact->country_id =  $request['country_id'];
            $contact->state_id = $request['state_id'];

            UserTrait::log_action('user', $id, 'update', Auth::user()->id);
            return res_completed('account updated');
        }
        return res_not_found('user not found');

    }
    public function delete_user($request){
        $id = $request['id'];
        UserTrait::log_action('user', $id, 'delete', Auth::user()->id);
        $contact = ContactDetail::where('user_id', $id)->get();
        foreach ($contact as $contact) {
            $contact->delete();
        }
        User::find($id)->delete();

        return res_completed('user account deleted');
    }
    //GUARANTOR
    public function create_guarantor($request){
    }
    public function update_guarantor($request){

    }
    public function delete_guarantor($request){

    }
    // BUS
    public function add_bus($request){
        // Bus Creation
        if(Auth::user()->account_type == 'partner' || Auth::user()->account_type == 'admin'){
            $data = [
                "color" => $request['color'],
                "manufacturer_id" => $request['manufacturer_id'],
                "model_id" => $request['model_id'],
                "plate_number" => $request['plate_number'],
                "vin_number" => $request['vin_number'],
                "chasis_number" => $request['chasis_number'],
                "seats" => $request["seats"]
            ];
            $new_bus = Bus::create($data);
            $new_bus;
            // Assign bus to user
            if(Auth::user()->account_type == 'admin'){
                $user_bus = new UserBus();
                $user_bus->user_id	= $request['id']; //Company
                $user_bus->bus_id = $new_bus->id;
                $user_bus->save();
            }else{
                $user_bus = new UserBus();
                $user_bus->user_id	= Auth::user()->id;
                $user_bus->bus_id = $new_bus->id;
                $user_bus->save();
            }
            UserTrait::log_action('bus', $new_bus->id, 'create', Auth::user()->id);
            return res_completed("Bus Created");
        }else{
            return res_unauthorized("You're not authorized to perform this action");
        }
    } //partner id
    public function update_bus($request, $id){
        if(Auth::user()->account_type == 'partner' || Auth::user()->account_type == 'admin'){
            $data = [
                "color" => $request['color'],
                "manufacturer_id" => $request['manufacturer_id'],
                "model_id" => $request['model_id'],
                "plate_number" => $request['plate_number'],
                "vin_number" => $request['vin_number'],
                "chasis_number" => $request['chasis_number'],
                "seats" => $request["seats"]
            ];
            $bus = Bus::find($id);
            if ($bus->exists()) {
                $bus->update($data);
                UserTrait::log_action('bus', $bus->id, 'update', Auth::user()->id);
                return res_completed("Bus Updated");
            }else{
                return res_not_found('bus does not exist');
            }
        }else{
            return res_unauthorized("You're not authorized to perform this action");
        }
    } //bus id
    public function delete_bus($id){
        $user_bus = UserBus::where('bus_id', $id)->get();
        foreach ($user_bus as $user_bus) {
            $user_bus->delete();
        }
        Bus::find($id)->delete();

        return res_completed('Bus Deleted');
    } //bus id
    public function bus_details($request){
        $id = $request['id'];
        $bus = Bus::with('manufacturer')
                    ->with('model')
                    ->with('trip')
                    ->with(['user' => function ($q){
                        $q->select('user_buses.*', 'users.firstname', 'users.lastname', 'users.account_type')
                        ->join('users', 'user_buses.user_id', 'users.id');
                    }])
                    ->with('destination')
                    ->with('bus_load')
                    ->find($id);

        return res_success('details', $bus);
    }
    public function scanner_account($request, $id){
        $bus = Bus::find($id);

        if($bus->exists()){
            $bus->loginid = str_pad($id, 3, 0, STR_PAD_LEFT)."CTF";
            $bus->password = Hash::make($request['password']);
            $bus->save();
            return res_completed('account created');
        }
    }


}
