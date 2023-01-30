<?php
namespace App\Interfaces;

interface UserRepositoryInterface{
    public function create_user_account($request); //passenger and partners
    public function get_user($id);
    public function update_user($request);
    public function delete_user($id);
    public function create_guarantor($request);
    public function update_guarantor($request);
    public function delete_guarantor($request);
    public function add_bus($request); //partner id
    public function update_bus($request, $id); //bus id
    public function delete_bus($id); //bus id
    public function bus_details($id);
    public function scanner_account($request, $id);
}
