<?php
namespace App\Interfaces;

interface AdminRepositoryInterface{
    public function create_guarantor($request, $user_id);
    public function update_details($request, $id);
    public function delete_guarantor($id);
    public function update_guarantor($request, $id);
    public function create_discount($request);
    public function update_discount($request, $id);
    public function delete_discount($id);
    public function create_bonus($request);
    public function update_bonus($request, $id);
    public function delete_bonus($id);
    public function accredit_bus($id); //bus id
    public function ban_user($request, $id); //user id
    public function unban_user($id); //user id
    public function create_trip_package($request);
    public function update_trip_package($request, $id);
    public function delete_trip_package($id);
    public function assign_driver_bus($user, $bus);
    public function assign_conductor_bus($user, $bus);
    public function create_organization_category($request);
    public function update_organization_category($request);
    public function delete_organization_category($request);
    public function create_organization($request);
    public function update_organization($request);
    public function delete_organization($request);
    public function create_organization_settings($request);
    public function update_organization_settings($request);
    public function delete_organization_settings($request);
    public function create_cityfare_settings($request);
    public function update_cityfare_settings($request);
    public function delete_cityfare_settings($request);
    public function create_info_settings($request);
    public function update_info_settings($request);
    public function delete_info_settings($request);
    public function create_faqs($request);
    public function update_faqs($request);
    public function delete_faqs($request);
    public function create_busstop($request);
    public function update_busstop($request);
    public function delete_busstop($request);

}
