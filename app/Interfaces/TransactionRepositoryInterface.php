<?php
namespace App\Interfaces;

interface TransactionRepositoryInterface{
    public function activate_trip_package($request);
    public function scan_user($request);
    public function scan_out($request);
}
