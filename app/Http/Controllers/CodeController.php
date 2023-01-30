<?php

namespace App\Http\Controllers;

use App\Models\PackageCodes;
use App\Models\PayAsYouGoCodes;
use App\Models\TripPackage;
use App\Models\User;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    // payg and single_user

    /*
        payg have units attached to them

        single_user have units attached to the userid, so deduction is made form the user_id
        user purchases package and has a paygu code assigned to them
     */
    public function all_codes(Request $request){
        $package = PackageCodes::where('package_id', $request['package_id'])->get();
        return res_success('codes',  $package);
    }

    public function generate_codes(Request $request){
        $package = $request['package'];
        $count = $request['count'];
        $inst = $request['inst'];

        for ($i=0; $i < $count ; $i++) {
            $code = generate_trip_num();

                PackageCodes::create([
                    'package_id' => $package,
                    'code' => $code
                ]);
                PayAsYouGoCodes::create([
                    'code' => $code,
                    'count' => TripPackage::find($package)->count,
                    'institution' => $inst != null ? $inst : null
                ]);
        }

        return res_completed('codes generated');
    }

    public function assign_user_codes($userid, $codeid){
        $code = PackageCodes::find($codeid);
        $user = User::find($userid);

        if($code){
            if($code->is_used == 0){
                $payg = PayAsYouGoCodes::where('code', $code['code'])->first();
                $payg->user_id = $userid;
                $payg->save();

                $code->update(
                    [
                        'count' => 0,
                        'is_used' => 1
                    ]
                );

                $count = TripPackage::find($code['package_id'])->count;
                $user->trip_count = $user->trip_count + $count;
                $user->save();


                return res_completed('code assigned');
            }else {
                return res_bad_request('code has already been used');
            }
        }else{
            return res_not_found('code does not exist');
        }

    }

    public function deactivate_code($codeid, $userid){
        $code = PayAsYouGoCodes::where('id', $codeid)->where('user_id', $userid)->first();
        if($code){
            $code->delete();
            return res_completed('code deactivated');
        }
        return res_not_found('code not found');
    }

    public function get_codes($instid){
        return res_success('codes',
        PayAsYouGoCodes::with('institution')
        ->join('package_codes', 'pay_as_you_go_codes.code', 'package_codes.code')
        ->join('trip_packages', 'package_codes.package_id', 'trip_packages.id')
        ->where('institution', $instid)
        ->where('is_used', 0)
        ->get());
    }

    public function generate_qr_code($codeid){
        //
    }
}
