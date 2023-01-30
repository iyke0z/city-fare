<?php

namespace App\Repository;

use App\Interfaces\AdminRepositoryInterface;
use App\Models\Bus;
use App\Models\BusLoad;
use App\Models\BusStop;
use App\Models\CityfareSettings;
use App\Models\DriverDetail;
use App\Models\Guarantor;
use App\Models\TripPackage;
use App\Models\User;
use App\Models\UserBus;
use App\Models\UserGuarantor;
use Illuminate\Support\Facades\Auth;

class AdminRepository implements AdminRepositoryInterface{
    public function create_guarantor($request, $user_id){
        $data = [
            "fullname" => $request['fullname'],
            "nin" => $request['nin'],
            "email_address" => $request['email_address'],
            "phone" => $request['phone'],
            "address" => $request['address'],
        ];

        $guarantor = Guarantor::create($data);
        $guarantor;
        $user_guarantor = new UserGuarantor;
        $user_guarantor->user_id = $user_id;
        $user_guarantor->guarantor_id = $guarantor->id;
        $user_guarantor->save();
        return res_completed('Created Succesfully');
    }
    public function update_guarantor($request, $id){
        $data = [
            "fullname" => $request['fullname'],
            "nin" => $request['nin'],
            "email_address" => $request['email_address'],
            "phone" => $request['phone'],
            "address" => $request['address'],
        ];
        $guarantor = Guarantor::find($id);
        if($guarantor->exists()){
            $guarantor->update($data);
            return res_completed('Updated Succesfully');
        }else{
            return res_not_found('Guarantor does not exist');
        }
    }
    public function delete_guarantor($id){
        Guarantor::find($id)->delete();
        return res_completed('deleted');
    }
    public function update_details($request, $id){
        $driver_details = DriverDetail::find($id);
        if($driver_details->exist()){
            $details = [
                "lisence_no" => $request['lisence_no'],
                "issue_date" => $request['issue_date'],
                "expiry_date" => $request['expiry_date'],
                "is_verified" => $request['is_verified'],
                "years_of_experience" => $request['years_of_experience'],
            ];

            $driver_details->update($details);
            return res_completed("Details Updated");
        }
    }
    public function create_discount($request){

    }
    public function update_discount($request, $id){

    }
    public function delete_discount($id){

    }
    public function create_bonus($request){

    }
    public function update_bonus($request, $id){

    }
    public function delete_bonus($id){

    }
    public function accredit_bus($id){
        if(Auth::user()->account_type == 'admin'){
            $bus = Bus::find($id);
            if ($bus->exists()) {
                $bus->is_verified = 1;
                $bus->status = 'active';
                $bus->save();

                return res_completed('Bus has been accredited');
            }else{
                return res_not_found('Bus does not exist');
            }
        }else{
            return res_unauthorized('Unathorized');
        }
    } //bus id
    public function ban_user($request, $id){

    } //user id
    public function unban_user($id){

    } //user id

    public function create_trip_package($request){
        $data = [
            "name"	=> $request['name'],
            "price"	=> $request['price'],
            "count"	=> $request['count'],
            "interval" => $request['interval']
        ];

        TripPackage::create($data);

        return res_completed('package created');
    }
    public function update_trip_package($request, $id){
        $pkg = TripPackage::find($id);
        $data = [
            "name"	=> $request['name'],
            "price"	=> $request['price'],
            "count"	=> $request['count'],
        ];

        if($pkg->exists()){
            $pkg->update($data);
            return res_completed('package updated');
        }
    }
    public function delete_trip_package($id){
        TripPackage::find($id)->delete();
        return res_completed('deleted');
    }
    public function assign_driver_bus($user, $bus){
        $check = User::find($user);
        if ($check->account_type == 'driver') {
            $find_driver = UserBus::join('users', 'user_buses.user_id', 'users.id')
                                    ->where('users.account_type', 'driver')
                                    ->where('user_buses.bus_id', $bus)
                                    ->first();
            if(!$find_driver){
                $driver_bus = new UserBus();
                $driver_bus->user_id = $user;
                $driver_bus->bus_id = $bus;
                $driver_bus->save();

                return res_completed('assigned');

            }else{
                return res_bad_request('Bus has driver');
            }
        }else{
            return res_unauthorized('unauthorized');
        }
    }
    public function assign_conductor_bus($user, $bus){
        $check = User::find($user);
        if ($check->account_type == 'conductor') {
            $find_driver = UserBus::join('users', 'user_buses.user_id', 'users.id')
                                    ->where('users.account_type', 'conductor')
                                    ->where('user_buses.bus_id', $bus)
                                    ->first();
            if(!$find_driver){
                $driver_bus = new UserBus();
                $driver_bus->user_id = $user;
                $driver_bus->bus_id = $bus;
                $driver_bus->save();

                return res_completed('assigned');

            }else{
                return res_bad_request('Bus has driver');
            }
        }else{
            return res_unauthorized('unauthorized');
        }
    }

    public function create_organization_category($request){
        //
    }
    public function update_organization_category($request){
        //
    }
    public function delete_organization_category($request){
        //
    }
    public function create_organization($request){
        //
    }
    public function update_organization($request){
        //
    }
    public function delete_organization($request){
        //
    }
    public function create_organization_settings($request){
        //
    }
    public function update_organization_settings($request){
        //
    }
    public function delete_organization_settings($request){
        //
    }
    public function create_cityfare_settings($request){
        $data = [
            'user_id' => auth()->user()->id,
            'unit_per_km' => $request['unit_per_km'],
            'currency_name' => $request['currency_name'],
            'org_charge' => $request['org_charge']
        ];

        $settings = CityfareSettings::where('user_id', auth()->user()->id)->first();

        if($settings){
            $settings->delete();

            CityfareSettings::create($data);

            return res_completed('created');
        }else{
            CityfareSettings::create($data);
            return res_bad_request('bad request, something went wrong');
        }
    }
    public function update_cityfare_settings($request){
        $data = [
            'unit_per_km' => $request['unit_per_km'],
            'currency_name' => $request['currency_name'],
        ];

        $setting = CityfareSettings::find($request['id']);
        if($setting->exists()){
            $setting->update($data);
            return res_completed('updated');
        }else{
            return res_not_found('not found');
        }
    }
    public function delete_cityfare_settings($request){
        CityfareSettings::findOrFail($request['id'])->delete();
        return res_completed('deleted');
    }
    public function create_info_settings($request){
        //
    }
    public function update_info_settings($request){
        //
    }
    public function delete_info_settings($request){
        //
    }
    public function create_faqs($request){
        //
    }
    public function update_faqs($request){
        //
    }
    public function delete_faqs($request){
        //
    }
    public function create_busstop($request){
        $data = [
            'state_id' => $request['state_id'],
            'longitude' => $request['longitude'],
            'latitude'=> $request['latitude'],
            'common_name'=> $request['common_name'],
        ];

        $bustop = BusStop::create($data);
        $bustop;
        if($bustop){
            return res_completed('bus-stop added');
        }else{
            return res_bad_request('something went wrong!!');
        }
    }
    public function update_busstop($request){
        $data = [
            'state_id' => $request['state_id'],
            'longitude' => $request['longitude'],
            'latitude'=> $request['latitude'],
            'common_name'=> $request['common_name'],
        ];

        $bustop = BusStop::find($request['id']);
        if($bustop->exists()){
            $bustop->update($data);
            return res_completed('bus-stop updated');
        }else{
            return res_not_found('not found');
        }
    }
    public function delete_busstop($request){
        BusStop::findOrFail($request['id'])->delete();
        return res_completed('bus-stop removed');
    }

}
