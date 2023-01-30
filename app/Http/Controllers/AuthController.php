<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\LogoutScannerRequest;
use App\Http\Requests\ResendOtpRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\ScannerLoginRequest;
use App\Http\Requests\SendOtpRequest;
use App\Http\Requests\SendPasswordResetOtpRequest;
use App\Http\Requests\VerifyOtpRequest;
use App\Http\Requests\VerifyResetPasswordOtpRequest;
use App\Interfaces\AuthRepositoryInterface;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $authRepo;
    public function __construct(AuthRepositoryInterface $authRepo)
    {
        $this->authRepo = $authRepo;
    }
    public function login(LoginRequest $request){
        $validated = $request->validated();
        return $this->authRepo->login($validated);
    }
    public function login_scanner(ScannerLoginRequest $request){
        $validated = $request->validated();
        return $this->authRepo->login_scanner($validated);
    }
    public function logout(){
        return $this->authRepo->logout();
    }
    public function logout_scanner(LogoutScannerRequest $request){
        $validated = $request->validated();
        return $this->authRepo->logout_scanner($validated);
    }
    public function sendOTP(SendOtpRequest $request){
        $validated = $request->validated();
        return $this->authRepo->sendOTP($validated);
    }
    public function verifyOTP(VerifyOtpRequest $request){
        $validated = $request->validated();
        return $this->authRepo->verifyOTP($validated);
    }
    public function resendOTP(ResendOtpRequest $request){
        $validated = $request->validated();
        return $this->authRepo->resendOTP($validated);
    }
    public function sendPasswordResetOTP(SendPasswordResetOtpRequest $request){
        $validated = $request->validated();
        return $this->authRepo->sendPasswordResetOTP($validated);
    }
    public function verifyPasswordResetOTP(VerifyResetPasswordOtpRequest $request){
        $validated = $request->validated();
        return $this->authRepo->verifyPasswordResetOTP($validated);
    }
    public function ResetPassword(ResetPasswordRequest $request){
        $validated = $request->validated();
        return $this->authRepo->ResetPassword($validated);
    }
    public function generateEmailOTP($request){

    }

}
