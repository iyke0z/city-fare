<?php

namespace App\Repository;

use App\Interfaces\TripRepositoryInterface;
use App\Models\BusDestination;
use App\Models\BusLoad;
use App\Models\BusStop;
use App\Models\CityfareSettings;
use App\Models\Trip;
use App\Models\UserBus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class TripRepository implements TripRepositoryInterface{
    public function update_bus_load($request){
        $isFull = new BusLoad();
        $isFull->bus_id = $request['bus_id'];
        $isFull->is_full = $request['isFull'];
        $isFull->save();

        return res_completed('Bus load updated');
    }

    public function set_bus_load($request){
        $check = BusLoad::where('bus_id', $request['bus_id'])->first();
        if($request['isFull'] == true){
            if ($check) {
                $check->delete();
                return $this->update_bus_load($request);
            }else{
                return $this->update_bus_load($request);
            }
        }else{
            $check->delete();
        }

    }

    public function update_destination($request){
        $destination = new BusDestination();
        $destination->bus_id = $request['bus_id'];
        $destination->bus_stop = $request['bus_stop'];
        $destination->save();

        return res_completed('Bus destination updated');
    }

    public function set_bus_destination($request)
    {
        $check = BusDestination::where('bus_id', $request['bus_id'])
                ->first();
        if ($check) {
            $check->delete();
            return $this->update_destination($request);
        }else{
            return $this->update_destination($request);
        }
    }

    public function get_current_destination($request){
        $destination = BusDestination::with('busStop:id,common_name')->where('bus_id', $request['bus_id'])->first();

        if($destination){
            return  res_completed($destination['busStop']['common_name']);
            // res_success('current destinatoin', $destination);
        }

        return res_completed('no destination set');

    }

    public function get_distance($lat1,$lng1,  $lat2, $lng2){
        $rad = M_PI / 180;
        //Calculate distance from latitude and longitude
        $theta = $lng1 - $lng2;
        $dist = sin($lat1 * $rad)
            * sin($lat2 * $rad) +  cos($lat1 * $rad)
            * cos($lat2 * $rad) * cos($theta * $rad);

        $distance =  acos($dist) / $rad * 60 *  1.853;

        return ceil($distance);

    }

    private function getTripCharge($startLat,$startLng,$destLat, $destLng){
        $rad = M_PI / 180;
        $thetaA = $startLng - $destLng;
        $distA = sin($startLat * $rad)
            * sin($destLat * $rad) +  cos($startLat * $rad)
            * cos($destLat * $rad) * cos($thetaA * $rad);
        // distance between bus destination and scan in location
        $distanceA =  acos($distA) / $rad * 60 *  1.853;

        $settings = CityfareSettings::where('user_id', 3)->first();
        $charge = round($distanceA,2) * $settings->org_charge;
        return [$charge, $distanceA];
    }

    private function collection_to_array($arg){
        $New_start_index = 0;
        $new_arr = array_combine(range($New_start_index,
                            count($arg) + ($New_start_index-1)),
                            array_values($arg));
        return $new_arr;
    }

    public function get_closest_bus($request){
        $urgent = $request['urgent'];
        $startLat = $request['latitude_from'];
        $startLng = $request['longitude_from'];
        $finLat = $request['latitude_to'];
        $finLng = $request['longitude_to'];
        $bus_stops = BusStop::all();
        $closest_stops = [];

        for ($i=0; $i < count($bus_stops) ; $i++) {
            // get distance
            $bustopLat = $bus_stops[$i]['latitude'];
            $bustopLng = $bus_stops[$i]['longitude'];

            $distance  = $this->get_distance($finLat, $finLng, $bustopLat, $bustopLng );
            if ($distance <= 3) {
                array_push($closest_stops, $bus_stops[$i]);
            }
        }

        // firebase part
        // check online drivers
        $response = Http::retry(3, 100)->asForm()
        ->get('https://city-fare-cf9a6-default-rtdb.firebaseio.com/live_location.json', []);
        $response = $response->json();

        $buses = [];

        if(count($response) > 0){
            $id = 0;
            $pos = null;
            $res = null;
            foreach($response as $bus => $key){
                //
                    // get buses headed for that bustop
                    $res = $this->collection_to_array($response);
                    $pos = strpos($bus,'_');
                    $id = substr($bus,$pos+1,strlen($bus) - $pos);
            }

            for ($i=0; $i < count($res); $i++) {
                $bus_destination = BusDestination::where('bus_id', $id)->first();

                if($bus_destination['bus_stop'] == $closest_stops[0]['id']){
                        $isFull = $res[$i]['isFull'];
                        $busLat = $res[$i]['latitude'];
                        $busLng = $res[$i]['longitude'];

                        $distance  = $this->get_distance($startLat, $startLng, $busLat, $busLng );
                        $load = BusLoad::where('bus_id', $closest_stops[0]['id'])->first();
                        $res[$i]['bus_id'] = $id;
                        $res[$i]['distance'] = $distance;
                        $distParm = 0;
                        if($urgent){
                            $distParm = 3;
                        }else{
                            $distParam = 5;
                        }

                        if ($distance <= $distParam) {
                            if (!$load || $load['is_full'] == 'false') {
                                array_push($buses, $res[$i]);
                            }
                        }
                    }else{
                        return res_not_found('no buses available in your route!');
                    }
            }

            // }

            return res_success('buses', $buses);
        }else{
            return res_not_found('no buses available in your route!');
        }



        //return all buses within that coordinate distance headed for that longitude to and latitude to
    }

    public function notify_bus($request){
        $startLat = $request['latitude_from'];
        $startLng = $request['longitude_from'];
        $finLat = $request['latitude_to'];
        $finLng = $request['longitude_to'];
        $busid = $request['bus_id'];

        $distance  = $this->get_distance($startLat, $startLng, $finLat, $finLng );
            if ($distance <= 0.02) {
                // notify bus with push notification
            }else{

                return res_unprocess_entity('You are too far from this bus');
            }
    }

    public function get_estimated_fare($request){
        $startLat = $request['latitude_from'];
        $startLng = $request['longitude_from'];
        $finLat = $request['latitude_to'];
        $finLng = $request['longitude_to'];
        $estimate = $this->getTripCharge($startLat,$startLng,$finLat,$finLng);

        return res_completed(number_format(round($estimate[0], 2), "2", '.', ''));
    }

}
