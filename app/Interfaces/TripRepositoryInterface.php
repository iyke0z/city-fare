<?php
namespace App\Interfaces;

interface TripRepositoryInterface{
    public function set_bus_load($request);
    public function set_bus_destination($request); //use auth id, get
    public function get_closest_bus($request);
    public function notify_bus($request);
    public function get_current_destination($request);
    public function get_estimated_fare($request);

}
