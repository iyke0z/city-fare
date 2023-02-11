<?php

namespace App\Repository;

use App\Interfaces\TransactionRepositoryInterface;
use App\Models\Bus;
use App\Models\BusDestination;
use App\Models\CityfareSettings;
use App\Models\PackageCodes;
use App\Models\PayAsYouGoCodes;
use App\Models\TransactionLog;
use App\Models\Trip;
use App\Models\TripPackage;
use App\Models\TripPackageLog;
use App\Models\User;
use App\Models\UserBus;
use App\Models\UserTrip;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TransactionRepository implements TransactionRepositoryInterface{
    public function activate_trip_package($request){
        $id = $request['id'];
        $pkgCode = PackageCodes::where('code', $request['code'])->first();
        if($pkgCode->exists()){
            if($pkgCode->is_used == 0){
                $pkg = TripPackage::find($pkgCode->package_id);
                $trip_num = generate_trip_num();
                $user = UserTrip::where('user_id', $id)->first();
                if($user){
                    $user->delete();
                    $trip_unit = new UserTrip();
                    $trip_unit->trip_no = $trip_num;
                    $trip_unit->user_id = $id;
                    $trip_unit->save();

                    // increment trip_count
                    $trip_count = User::find($id);
                    $trip_count->trip_count = $trip_count->trip_count + $pkg->count;
                    $trip_count->save();

                    $pkgCode->is_used = 1;
                    $pkgCode->save();

                    return res_completed('successful');
                }else{
                    $trip_unit = new UserTrip();
                    $trip_unit->trip_no = $trip_num;
                    $trip_unit->user_id = $id;
                    $trip_unit->save();

                    // increment trip_count
                    $trip_count = User::find($id);
                    $trip_count->trip_count = $trip_count->trip_count + $pkg->count;
                    $trip_count->save();

                    $pkgCode->is_used = 1;
                    $pkgCode->save();

                    return res_completed('successful');
                }
            }else{
                return res_not_found('code does not exist');
            }

        }else{
            res_not_found('code does not exist');
        }
    }

    private function getTripCharge($startLat,$startLng, $bus_id){
        $rad = M_PI / 180;
        $bus_destination = BusDestination::with('busStop')->where('bus_id', $bus_id)->first();
        if (!$bus_destination) {
            return res_bad_request('bus destination is not set');
        }
        $destLng = $bus_destination['busStop']['longitude'];
        $destLat = $bus_destination['busStop']['latitude'];
        $thetaA = $startLng - $destLng ;
        $distA = sin($startLat * $rad)
            * sin($destLat * $rad) +  cos($startLat * $rad)
            * cos($destLat * $rad) * cos($thetaA * $rad);
        // distance between bus destination and scan in location
        $distanceA =  acos($distA) / $rad * 60 *  1.853;

        $bus = UserBus::with('bus')->with(['user'=> function($q) {
            $q->where('account_type')->first();
        }])->where('bus_id', $bus_id)->first();
        $settings = CityfareSettings::where('user_id', $bus['user_id'])->first();
        $charge = round($distanceA,2) * $settings->org_charge;
        return [$charge, $settings->org_charge];
    }

    public function charge_trip($startLat,$startLng,$finLat, $finLng, $bus_id, $type=null){
        $rad = M_PI / 180;
        $bus_destination = BusDestination::with('busStop')->where('bus_id', $bus_id)->first();
        if (!$bus_destination) {
            return res_bad_request('bus destination is not set');
        }
        $destLng = $bus_destination['busStop']['longitude'];
        $destLat = $bus_destination['busStop']['latitude'];
        $thetaA = $startLng - $destLng ;
        $distA = sin($startLat * $rad)
            * sin($destLat * $rad) +  cos($startLat * $rad)
            * cos($destLat * $rad) * cos($thetaA * $rad);
        // distance between bus destination and scan in location
        $distanceA =  acos($distA) / $rad * 60 *  1.853;

        //Calculate distance from latitude and longitude i.e. overall tirp distance from start to finish
        $theta = $startLng - $finLng;
        $dist = sin($startLat * $rad)
            * sin($finLat * $rad) +  cos($startLat * $rad)
            * cos($finLat * $rad) * cos($theta * $rad);

        $distance =  acos($dist) / $rad * 60 *  1.853;

        $bus = UserBus::with('bus')->with(['user'=> function($q) {
            $q->where('account_type')->first();
        }])->where('bus_id', $bus_id)->first();
        $settings = CityfareSettings::where('user_id', $bus['user_id'])->first();

        // $distanceA - $distance = distance between bus destination and scanout
        if (($distanceA - $distance) < 5) {
            if($type == 'orgc'){
                $charge = round($distance,2) * $settings->org_charge * $bus->bus->seats;
                return $charge;
            }else if($type == 'worc'){
                // get date of current trip
                $date = date('Y-m-d');
                $getDate = Trip::where(DB::raw('DATE(`updated_at`)'), $date)->latest()->get();
                if(count($getDate->toArray()) > 0){
                    // get diff between scanout time of previously completed trip if and current scannout time
                    $prevTrip = date_format($getDate[0]['updated_at'], 'U');
                    $currTrip = date('U');
                    $diffMins = $currTrip - $prevTrip;
                    $diffMins = $diffMins/60;
                    if($diffMins >= 60){
                        // for every 1hr increase trip charge *3
                        $charge = round($distance,2) * ($settings->unit_per_km * 3) ;
                        return $charge;
                    }else{
                        $charge = round($distance,2) *  ($settings->unit_per_km * 0.35) ;
                        return $charge;
                    }

                }else{
                    $charge = round($distance,2) *  $settings->unit_per_km;
                    return $charge;
                }
            }else{
                $charge = round($distance,2) * $settings->unit_per_km ;
                return $charge;
            }
        }else{
            // deduct 10% of total price
            $charge = round($distance,2) * $settings->unit_per_km;
            $percharge = 0.01 * $charge;
            $fincharge = $charge - $percharge ;
            return $fincharge;
        }
    }

    public function scan_user($request){
        $bus = Bus::find($request['bus_id']);

        if ($bus->status == 'active') {
            $getTripCharge = $this->getTripCharge( $request['latitude'],$request['longitude'],$request['bus_id']);
            if($request['type'] == 'user'){
                /*
                    this is for registerd users
                    gets cardo from UserTrip table using trip_no
                    if trip exists get the units of the user
                    if units is greater than 0 and greater than the expected charge for the drip based of bus destination
                    create new trip
                    else create new trip stating the bustop the units can take the user to
                 */
                $trip_id = UserTrip::where('trip_no', $request['trip_no'])->first();
                if($trip_id){
                    $trip_count = User::find($trip_id->user_id);
                    $unitPrice = CityfareSettings::first();
                    if($trip_count->trip_count == 0){
                        return res_bad_request('No trip units!');
                    }
                    if($trip_count->trip_count >= $getTripCharge[0]){
                        $trip = new Trip;
                        $trip->type = $request['type'];
                        $trip->start_longitude = $request['longitude'];
                        $trip->start_latitude	= $request['latitude'];
                        $trip->user_id = $trip_id->user_id;
                        $trip->bus_id = $request['bus_id'];
                        $trip->save();

                        return res_completed('PASS');
                    }else{
                        $trip = new Trip;
                        $trip->type = $request['type'];
                        $trip->start_longitude = $request['longitude'];
                        $trip->start_latitude	= $request['latitude'];
                        $trip->user_id = $trip_id->user_id;
                        $trip->bus_id = $request['bus_id'];
                        $trip->save();
                        return res_completed('Units cannot get user to last bus stop user can only travel '.$trip_count->trip_count/$getTripCharge[1].' km');
                    }
                }else{
                    return res_not_found('Not found');
                }
            }
            elseif($request['type'] == 'inst'){
                /*
                    this is for institutions
                    gets cardo from PayAsYouGoCodes table using trip_no
                    code is assigned by school
                    if card exists get the institution that card belongs to
                    confirm that the bus is assigned to that institution
                    if true get the units of user_making the request
                 */
                $checkCode = PayAsYouGoCodes::where('code', $request['trip_no'])->first();
                if($checkCode){
                    $user = User::find($checkCode->user_id);

                    // check if bus belongs to inst
                    $userBus = UserBus::where('user_id', $user->institution_id)->where('bus_id', $request['bus_id'])->first();
                    if($userBus) {
                        $trip_id = PayAsYouGoCodes::where('code', $request['trip_no'])->first();
                        if($trip_id){
                            $trip_count = User::find($trip_id->user_id);
                            if($trip_count->trip_count == 0){
                                return res_bad_request('No trip units!');
                            }
                            elseif($trip_count->trip_count >= $getTripCharge[0]){
                                $trip = new Trip;
                                $trip->type = $request['type'];
                                $trip->start_longitude = $request['longitude'];
                                $trip->start_latitude	= $request['latitude'];
                                $trip->user_id = $trip_id->user_id;
                                $trip->bus_id = $request['bus_id'];
                                $trip->save();

                                return res_completed('PASS');
                            }else{
                                $trip = new Trip;
                                $trip->type = $request['type'];
                                $trip->start_longitude = $request['longitude'];
                                $trip->start_latitude	= $request['latitude'];
                                $trip->user_id = $trip_id->user_id;
                                $trip->bus_id = $request['bus_id'];
                                $trip->save();
                                return res_completed('Units cannot get user to last bus stop user can only travel '.round($trip_count->trip_count/$getTripCharge[1],2).' km');
                            }
                        }else{
                            return res_not_found('Not found');
                        }
                    }else{
                        return res_bad_request('Card not for this bus');
                    }
                }else{
                    return res_bad_request('invalid card');
                }
                // scan in user
            }else{
                /*
                    this is for everyother card type asides user and institution
                    gets cardo from PayAsYouGoCodes table using trip_no
                    if card exists get the units left on card
                    if units is greater than 0 and greater than the expected charge for the drip based of bus destination
                    create new trip
                    else create new trip stating the bustop the units can take the user to
                 */
                    $checkCode = PayAsYouGoCodes::where('code', $request['trip_no'])->first();
                    if($checkCode){
                        if($checkCode->count == 0){
                            return res_bad_request('No trip units!');
                        }
                        elseif($checkCode->count >= $getTripCharge[0]){
                            $trip = new Trip;
                            $trip->type = $request['type'];
                            $trip->start_longitude = $request['longitude'];
                            $trip->start_latitude = $request['latitude'];
                            $trip->payg_id = $checkCode->id;
                            $trip->bus_id = $request['bus_id'];
                            $trip->save();

                            return res_completed('PASS');
                        }else{
                            $trip = new Trip;
                            $trip->type = $request['type'];
                            $trip->start_longitude = $request['longitude'];
                            $trip->start_latitude	= $request['latitude'];
                            $trip->payg_id = $checkCode->id;
                            $trip->bus_id = $request['bus_id'];
                            $trip->save();
                            return res_completed('Units cannot get user to last bus stop user can only travel '.round($checkCode->count/$getTripCharge[1],2).' km');
                        }
                    }else{
                        return res_not_found('code not found!');
                    }
            }
        }
    }

    public function scan_out($request){

        $bus = Bus::find($request['bus_id']);
        if ($bus->status == 'active') {

            if($request['type'] == 'user'){
                 /*
                    this is for user card type
                    get trip information from trip table
                    if trip exists, reduce user units based on charge for trip
                 */
                $trip_id = UserTrip::where('trip_no', $request['trip_no'])->first();
                if($trip_id){
                    $trip_count = User::find($trip_id->user_id);

                    $trip = Trip::where('user_id', $trip_id->user_id)
                                ->where('bus_id', $request['bus_id'])
                                ->whereNull('finish_longitude')
                                ->whereNull('finish_latitude')
                                ->first();

                    if($trip){
                        $reduce = $trip_count->trip_count - $this->charge_trip(
                            $trip['start_latitude'],
                            $trip['start_longitude'],
                            $request['latitude'],
                            $request['longitude'],
                            $request['bus_id']
                        );

                        $trip_count->trip_count = $reduce;
                        $trip_count->save();

                        // UPDATE TRIP
                        $trip->finish_longitude = $request['longitude'];
                        $trip->finish_latitude	= $request['latitude'];
                        $trip->units = $this->charge_trip(
                            $trip['start_latitude'],
                            $trip['start_longitude'],
                            $request['latitude'],
                            $request['longitude'],
                            $request['bus_id']
                        );
                        $trip->save();
                        return res_completed('CHARGED');
                    }else{
                        return res_not_found('No trip information found for this bus');
                    }
                }else{
                    return res_not_found('Trip number not found');
                }
            }else if($request['type'] == 'inst'){
                /*
                    this is for inst card type
                    validate code
                    get trip information from trip table
                    if trip exists, reduce user units based on charge for trip
                 */
                $checkCode = PayAsYouGoCodes::where('code', $request['trip_no'])->first();
                if($checkCode){
                    $user = User::find($checkCode->user_id);

                    // check if bus is assigned to inst
                    $userBus = UserBus::where('user_id', $user->institution_id)->where('bus_id', $request['bus_id'])->first();
                    if($userBus) {
                        $trip_count = User::find($user->id);
                        $trip = Trip::where('user_id', $user->id)
                                    ->where('bus_id', $request['bus_id'])
                                    ->whereNull('finish_longitude')
                                    ->whereNull('finish_latitude')
                                    ->first();

                        if($trip){
                            // CHARGE INSTITUTION CARD
                            $reduce = $trip_count->trip_count - $this->charge_trip(
                                $trip['start_latitude'],
                                $trip['start_longitude'],
                                $request['latitude'],
                                $request['longitude'],
                                $request['bus_id']
                            );

                            $trip_count->trip_count = $reduce;
                            $trip_count->save();

                            // UPDATE TRIP TABLE
                            $trip->finish_longitude = $request['longitude'];
                            $trip->finish_latitude	= $request['latitude'];
                            $trip->units = $this->charge_trip(
                                $trip['start_latitude'],
                                $trip['start_longitude'],
                                $request['latitude'],
                                $request['longitude'],
                                $request['bus_id']
                            );
                            $trip->save();
                            return res_completed('CHARGED');
                        }else{
                            return res_not_found('Trip number not found');
                        }
                    }else{
                        return res_bad_request('Card not for this bus');
                    }
                }
            }else if($request['type'] == 'orgc'){
                /*
                    this is for organization card type
                    validate code
                    get trip information from trip table
                    if trip exists, reduce user units based on charge for trip
                 */
                $checkCode = PayAsYouGoCodes::where('code', $request['trip_no'])->first();
                if($checkCode){
                    $trip = Trip::where('payg_id', $checkCode->id)
                            ->where('bus_id', $request['bus_id'])
                            ->whereNull('finish_longitude')
                            ->whereNull('finish_latitude')
                            ->first();

                    if($trip){
                        // CHARGE CARD
                        $reduce = $checkCode->count - $this->charge_trip(
                            $trip['start_latitude'],
                            $trip['start_longitude'],
                            $request['latitude'],
                            $request['longitude'],
                            $request['bus_id'],
                            'orgc'
                        );
                        $checkCode->count = $reduce;
                        $checkCode->save();

                        // UPDATE TRIP
                        $trip->finish_longitude = $request['longitude'];
                        $trip->finish_latitude	= $request['latitude'];
                        $trip->units = $this->charge_trip(
                            $trip['start_latitude'],
                            $trip['start_longitude'],
                            $request['latitude'],
                            $request['longitude'],
                            $request['bus_id'],
                            'orgc'
                        );
                        $trip->save();
                        return res_completed('CHARGED');
                    }else{
                        return res_not_found('No trip information found for this bus');
                    }
                }else{
                    return res_not_found('code not found!');
                }
            }else if($request['type'] == 'worc'){
                 /*
                    this is for organization WAITING card type
                    validate code
                    get trip information from trip table
                    if trip exists, reduce user units based on charge for trip
                 */
                $checkCode = PayAsYouGoCodes::where('code', $request['trip_no'])->first();
                if($checkCode){
                    $trip = Trip::where('payg_id', $checkCode->id)
                            ->where('bus_id', $request['bus_id'])
                            ->whereNull('finish_longitude')
                            ->whereNull('finish_latitude')
                            ->latest()->first();

                    if($trip){
                        // CHARGE CARD
                        $reduce = $checkCode->count - $this->charge_trip(
                            $trip['start_latitude'],
                            $trip['start_longitude'],
                            $request['latitude'],
                            $request['longitude'],
                            $request['bus_id'],
                            'worc'
                        );
                        $checkCode->count = $reduce;
                        $checkCode->save();
                        // UPDATE TRIP
                        $trip->finish_longitude = $request['longitude'];
                        $trip->finish_latitude	= $request['latitude'];
                        $trip->units = $this->charge_trip(
                            $trip['start_latitude'],
                            $trip['start_longitude'],
                            $request['latitude'],
                            $request['longitude'],
                            $request['bus_id'],
                            'worc'
                        );
                        $trip->save();
                        return res_completed('CHARGED');
                    }else{
                        return res_not_found('No trip information found for this bus');
                    }
                }else{
                    return res_not_found('code not found!');
                }
            }else{
                /*
                    this is for PAYG card type
                    validate code
                    get trip information from trip table
                    if trip exists, reduce user units based on charge for trip
                 */
                $checkCode = PayAsYouGoCodes::where('code', $request['trip_no'])->first();
                if($checkCode){
                    $trip = Trip::where('payg_id', $checkCode->id)
                    ->where('bus_id', $request['bus_id'])
                    ->whereNull('finish_longitude')
                    ->whereNull('finish_latitude')
                    ->first();

                    if($trip){
                        // CHARGE CARD
                        $reduce = $checkCode->count - $this->charge_trip(
                            $trip['start_latitude'],
                            $trip['start_longitude'],
                            $request['latitude'],
                            $request['longitude'],
                            $request['bus_id']
                        );
                        $checkCode->count = $reduce;
                        $checkCode->save();

                        // UPDATE TRIP
                        $trip->finish_longitude = $request['longitude'];
                        $trip->finish_latitude	= $request['latitude'];
                        $trip->units = $this->charge_trip(
                            $trip['start_latitude'],
                            $trip['start_longitude'],
                            $request['latitude'],
                            $request['longitude'],
                            $request['bus_id']);
                        $trip->save();
                        return res_completed('CHARGED');
                    }else{
                        return res_not_found('No trip information found for this bus');
                    }
                }else{
                    return res_not_found('code not found!');
                }
            }
        }else{
            return res_unauthorized('Unauthorized');
        }
    }



}


