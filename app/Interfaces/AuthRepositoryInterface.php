<?php
namespace App\Interfaces;

interface AuthRepositoryInterface{
    public function login($request);
    public function logout();
    public function reset_password($request);
    public function sendOTP($request);
    public function verifyOTP($request);
    public function resendOTP($request);
    public function generateOTP();
    public function sendPasswordResetOTP($request);
    public function verifyPasswordResetOTP($request);
    public function ResetPassword($request);
    public function generateEmailOTP($request);
    public function login_scanner($request);
    public function logout_scanner($id);
}
