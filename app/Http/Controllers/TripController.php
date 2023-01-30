<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusDestinationRequest;
use App\Http\Requests\ClearTripRequest;
use App\Http\Requests\ClosestBusRequest;
use App\Http\Requests\CurrentDestinationRequest;
use App\Http\Requests\SetBusLoadRequest;
use App\Interfaces\TripRepositoryInterface;
use App\Models\BusDestination;
use Illuminate\Http\Request;

class TripController extends Controller
{
    private $tripRepo;
    public function __construct(TripRepositoryInterface $tripRepo)
    {
        $this->tripRepo = $tripRepo;
    }
    public function set_bus_load(SetBusLoadRequest $request){
        $validated = $request->validated();
        return $this->tripRepo->set_bus_load($validated);
    }
    public function get_current_destination(CurrentDestinationRequest $request){
        $validated = $request->validated();
        return $this->tripRepo->get_current_destination($validated);

    }

    public function clear_trip_controller(ClearTripRequest $request){
        $validated = $request->validated();
        if($validated){
           $destination = BusDestination::where('bus_id', $request['bus_id'])->first();
           if($destination){
                $destination->delete();
                return res_completed('cleared');
           }
           return res_completed('not found');
        }
    }

    public function set_bus_destination(BusDestinationRequest $request){
        $validated = $request->validated();
        return $this->tripRepo->set_bus_destination($validated);
    }

    public function get_closest_bus(ClosestBusRequest $request){
        $validated = $request->validated();
        return $this->tripRepo->get_closest_bus($validated);
    }


    public function get_estimated_fare(ClosestBusRequest $request){
        $validated = $request->validated();
        return $this->tripRepo->get_estimated_fare($validated);
    }
}
