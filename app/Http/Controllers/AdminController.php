<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBusStop;
use App\Http\Requests\createCityFareSettingsRequest;
use App\Http\Requests\CreateGuarantorRequest;
use App\Http\Requests\CreateTripPackageRequest;
use App\Http\Requests\DeleteBusStop;
use App\Http\Requests\deleteCityFareSettingsRequest;
use App\Http\Requests\SetBusLoadRequest;
use App\Http\Requests\UpdateBusRequest;
use App\Http\Requests\UpdateBusStop;
use App\Http\Requests\updateCityFareSettingsRequest;
use App\Http\Requests\UpdateDriverDetailsRequest;
use App\Http\Requests\UpdateGuarantorRequest;
use App\Http\Requests\UpdateTripPackageRequest;
use App\Interfaces\AdminRepositoryInterface;
use App\Models\BusStop;
use App\Models\CityfareSettings;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    private $adminRepo;

    public function __construct(AdminRepositoryInterface $adminRepo)
    {
        $this->adminRepo = $adminRepo;
    }
    public function create_trip_package(CreateTripPackageRequest $request){
        $validated = $request->validated();
        return $this->adminRepo->create_trip_package($validated);
    }
    public function update_trip_package(UpdateTripPackageRequest $request, $id){
        $validated = $request->validated();
        return $this->adminRepo->update_trip_package($validated, $id);
    }
    public function delete_trip_package($id){
        return $this->adminRepo->delete_trip_package($id);
    }
    public function accredit_bus($id){
        return $this->adminRepo->accredit_bus($id);
    }
    public function create_guarantor(CreateGuarantorRequest $request, $userid){
        $validated = $request->validated();
        return $this->adminRepo->create_guarantor($validated, $userid);
    }
    public function update_guarantor(UpdateGuarantorRequest $request, $id){
        $validated = $request->validated();
        return $this->adminRepo->update_guarantor($validated, $id);
    }

    public function delete_guarantor($id){
        return $this->adminRepo->delete_guarantor($id);
    }

    public function update_details(UpdateDriverDetailsRequest $request, $id){
        $validated = $request->validated();
        return $this->adminRepo->update_details($validated, $id);
    }

    public function assign_driver_bus($user, $bus){
        return $this->adminRepo->assign_driver_bus($user, $bus);
    }
    public function assign_conductor_bus($user, $bus){
        return $this->adminRepo->assign_conductor_bus($user, $bus);
    }

    public function create_cityfare_settings(createCityFareSettingsRequest $request){
        $validated = $request->validated();
        return $this->adminRepo->create_cityfare_settings($validated);
    }
    public function update_cityfare_settings(updateCityFareSettingsRequest $request){
        $validated = $request->validated();
        return $this->adminRepo->update_cityfare_settings($validated);
    }
    public function delete_cityfare_settings(deleteCityFareSettingsRequest $request){
        $validated = $request->validated();
        return $this->adminRepo->delete_cityfare_settings($validated);
    }
    public function all_settings(){
        return res_success('setings', CityfareSettings::all());
    }
    public function create_busstop(CreateBusStop $request){
        $validated = $request->validated();
        return $this->adminRepo->create_busstop($validated);
    }
    public function update_busstop(UpdateBusStop $request  ){
        $validated = $request->validated();
        return $this->adminRepo->update_busstop($validated);
    }
    public function delete_busstop(DeleteBusStop $request){
        $validated = $request->validated();
        return $this->adminRepo->delete_busstop($validated);
    }
    public function all_bus_stops(){
        return res_success('bus-stops', BusStop::with('state')->get());
    }
}
