<?php
namespace App\Interfaces;

interface ReportRepositoryInterface{
    public function buses_passengers($id); //partner user id
    public function partner_transaction($id); // partner user id
    public function user_transaction($id); //userid
    public function general_report();
}
