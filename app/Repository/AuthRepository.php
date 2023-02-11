<?php

namespace App\Repository;

use App\Interfaces\AuthRepositoryInterface;
use App\Mail\PasswordResetEmail;
use App\Models\Bus;
use App\Models\Log;
use App\Models\OtpVerfication;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\PersonalAccessToken;

class AuthRepository implements AuthRepositoryInterface{
    public function login($request){
        $user = User::where('phone', $request['phone'])->first();
        if(! $user || ! Hash::check($request['password'], $user->password)){
            return res_completed('The provided credentials are incorrect');
        }else{
            // log
            $log = new Log();
            $log->type = 'auth';
            $log->user_id = $user->id;
            $log->action = 'login';
            $log->acted_by = $user->id;
            $log->save();
            $token = $user->createToken('auth_token')->plainTextToken;
            return res_success("token", [
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        }
    }
    public function login_scanner($request){
        $bus = Bus::where('loginid', $request['loginid'])->first();
        if(! $bus || ! Hash::check($request['password'], $bus->password)){
            return res_completed('The provided credentials are incorrect');
        }else{
            // log
            $log = new Log();
            $log->type = 'bus';
            $log->user_id = $bus->id;
            $log->action = 'login';
            $log->acted_by = $bus->id;
            $log->save();
            $token = $bus->createToken('auth_token')->plainTextToken;
            return res_success("token", [
                'access_token' => $token,
                'token_type' => 'Bearer',
                'bus'=>$bus->id,
                'id' => $request['loginid']
            ]);
        }
    }
    public function logout_scanner($request){
        $bus = $request['busid'];
        $log = new Log();
        $log->type = 'bus';
        $log->user_id = $bus;
        $log->action = 'logout';
        $log->acted_by = $bus;
        $log->save();
        $token = PersonalAccessToken::where('tokenable_id', $request['busid'])
                ->where('tokenable_type',"App\Models\Bus")->first();
        $token_delete = $token->delete();
        if ($token_delete) {
            return res_completed('User logged out successfully.');
        } else {
            return res_unauthorized('Something went wrong.');
        }
    }

    public function logout(){
        $user = Auth::user()->id;
        $log = new Log();
        $log->type = 'auth';
        $log->user_id = $user;
        $log->action = 'logout';
        $log->acted_by = $user;
        $log->save();
        $user = Auth::user()->tokens()->delete();
        if ($user) {
            return res_completed('User logged out successfully.');
        } else {
            return res_unauthorized('Something went wrong.');
        }
    }
    public function reset_password($request){}

    public function sendSmsAction($message, $phone){
        $email = "cityfareng@gmail.com";
        $password = "letusgrindAB12@@";
        $sender_name = "Cityfare";
        $forcednd = 1;

        $data = array("email" => $email, "password" => $password,"message"=>$message, "sender_name"=>$sender_name,"recipients"=>$phone,"forcednd"=>$forcednd);
        $data_string = json_encode($data);
        $ch = curl_init('https://app.multitexter.com/v2/app/sms');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_string)));
        $result = curl_exec($ch);
        $res_array = json_decode($result);

        return $res_array;

        // $response = Http::retry(3, 100)->withHeaders([
        //     'Content-type' => 'application/json',
        // ])->withOptions(['verify' => false])->get('https://api.ng.termii.com/api/sms/send', [
        //     'to' => $phone,
        //     'from' => 'SLC',
        //     'type' => 'plain',
        //     'channel' => 'dnd',
        //     'sms' => $message,
        //     'api_key' => 'FCP65WJ15RsmlMRWIIinJCgTKjO7ZsQNrG28IqZalSfTcA20XvgOn8kNaCiR',
        // ]);

    }
    public function sendOTP($request)
    {
        $checkOTP = OtpVerfication::where(['phone' => $request['phone']],['request_type' => $request['request_type']]);

        if ($checkOTP->exists()) {
            $checkOTP = $checkOTP->first();

                if ($checkOTP->is_verified == 0) {
                    $checkOTP->otp = $this->generateOTP();
                    $checkOTP->expiry = Carbon::now()->addMinutes(config('services.settings.otp_validity'));
                    $checkOTP->save();
                    $theMessage = "Your Cityfare Verification Code is " . $checkOTP->otp . " .This code is valid for the next " . config('services.settings.otp_validity') . " minutes.";
                    $otpSent = $this->sendSmsAction($theMessage, $checkOTP->phone);
                    $otpSent;

                    // return res_success('otp sent', $theMessage);
                    return res_completed('A new otp has been sent to the number!');

                }
                elseif ($checkOTP->is_verified == 1 && $checkOTP->is_registered == 1){
                        return res_user_registered('Account exists!');

                }else{
                    return res_phone_number_verified('Your phone number has already been verified!');
                }
        }
        $checkOTP = new OtpVerfication();
        $checkOTP->otp = $this->generateOTP();
        $checkOTP->phone = $request['phone'];
        $checkOTP->expiry = Carbon::now()->addMinutes(config('services.settings.otp_validity'));
        $checkOTP->request_type = $request['request_type'];
        $checkOTP->save();
        $theMessage = "Hello! Your New Citfare Verification Code is " . $checkOTP->otp . " .This code is valid for the next " . config('services.settings.otp_validity') . "minutes.";
        $otpSent =  $this->sendSmsAction($theMessage, $checkOTP->phone);
        return res_completed('otp sent', $otpSent);
    }

    public function verifyOTP($request)
    {
        $verifyOtp = OtpVerfication::where(['otp' => $request['otp'], 'phone' => $request['phone']])->first();

        if (!empty($verifyOtp)) {
            if (Carbon::now() >= $verifyOtp->expiry) {
                return res_general_error('OTP is no longer valid', 403);
            }
            if ($verifyOtp->is_verified == 1) {
                return res_completed('Your phone number has already been verified!');
            }else{
                $verifyOtp->is_verified = 1;
                $verifyOtp->save();
                return res_completed('Your Account has been verified successfully!');
            }
        } else {
            return res_not_found('OTP does not exist');
        }
    }

    public function resendOTP($request)
    {
        $verifyOtp = OtpVerfication::where(['phone' => $request['phone']])->first();

        if (!empty($verifyOtp)) {
            if ($verifyOtp->status == 1) {
                return res_completed('Your phone number has already been verified!');
            }
            $verifyOtp->otp = $this->generateOTP();
            $verifyOtp->expiry = Carbon::now()->addMinutes(config('services.settings.otp_validity'));
            $verifyOtp->save();
            $theMessage = "Hello! Your New Citfare Verification Code is " . $verifyOtp->otp . " .This code is valid for the next " . config('services.settings.otp_validity') . "minutes.";
            $otpSent = $this->sendSmsAction($theMessage, $verifyOtp->phone);
            $otpSent;
            return res_success('otp resent', $verifyOtp->otp);
            // return res_new_otp_sent('A new otp has been sent to the phone number!');
        } else {
            return res_not_found("You don't have any process in progress");
        }
    }

    public function generateOTP()
    {
        $otp = mt_rand(10000, 99999);
        $otpCheck = OtpVerfication::where('otp', $otp)->first();

        if (!$otpCheck) {
            return $otp;
        }
        return $this->generateOTP();
    }

    public function sendPasswordResetOTP($request)
    {
        $user = User::wherePhone($request['phone']);

        if ($user->exists()) {
            $user = $user->first();
            $checkOTP = OtpVerfication::where(['phone' => $request['phone']])->first();
            if ($checkOTP) {
                $checkOTP->delete();
            }

            $generatedOTP = OtpVerfication::create([
                // 'email' => $user->email,
                'otp' => $this->generateOTP(),
                'request_type' => 'password_reset',
                'phone' => $request['phone'],
                'expiry' => Carbon::now()->addMinutes(config('services.settings.otp_validity'))
            ]);

            try {
                Mail::to($generatedOTP->email)->send(new PasswordResetEmail($generatedOTP->otp));
                // $theMessage = "Hello! Your CityFare Password Reset Verification Code is " . $generatedOTP->otp . " .This code is valid for the next " . config('services.settings.otp_validity') . "minutes.";
                // $otpSent =  $this->sendSmsAction::run($theMessage, $user->phone);
                return res_completed('otp sent');

                // return res_completed('An OTP has been sent to your phone, check your inbox!');
            } catch (\Throwable $th) {
                return res_bad_request('Something went wronggg!');
            }
        }

        return res_not_found('This user does not exist!');

        // $user = User::whereEmail($request['email'])->first();

        // // return $user;
        // if ($user) {
        //     $checkOTP = OtpVerfication::where(['email' => $request['email']])->first();
        //     // return $checkOTP;
        //     $checkOTP->delete();

        //     $generatedOTP = OtpVerfication::create([
        //         'email' => $request['email'],
        //         'otp' => $this->generateOTP(),
        //         'request_type' => 'password_reset',
        //         'expiry' => Carbon::now()->addMinutes(config('services.settings.otp_validity'))
        //     ]);

        //     try {
        //         Mail::to($generatedOTP->email)->send(new PasswordResetEmail('Your CityFare password recovery code', $generatedOTP->otp));
        //         return res_completed('An OTP has been sent to your email, check your inbox!');
        //     } catch (\Throwable $th) {
        //         return res_bad_request($th->getMessage());
        //     }
        // }

        // return res_not_found('This user does not exist!');
    }

    public function verifyPasswordResetOTP($request)
    {
        $verifyOtp = OtpVerfication::where(['otp' => $request['otp'], 'phone' => $request['phone']])->first();

        if (!empty($verifyOtp)) {
            if (Carbon::now() >= $verifyOtp->expiry) {
                return res_general_error('This OTP is no longer valid!', 403);
            }
            if ($verifyOtp->is_verified == 1) {
                return res_completed('This OTP has already been verified!');
            }
            $verifyOtp->is_verified = 1;
            $verifyOtp->save();

            return res_completed('OTP has been verified successfully!');
        } else {
            return res_not_found('OTP does not exist');
        }
    }

    public function ResetPassword($request)
    {
        $verifyOtp = OtpVerfication::where('phone', $request['phone'])->latest()->first();
        $user = User::wherePhone($request['phone'])->first();

        if ($user) {
            if ($verifyOtp && $verifyOtp->status) {
                $user->password = Hash::make($request['password']);

                if ($user->save()) {
                    return res_success('Password changed successfully!', $user);
                }
                else {
                    return res_unprocess_entity('Something went wrong!');
                }
            }
            return res_bad_request('Please verify with your OTP to continue!');
        }
        return res_not_found("You currently don't have an account with us, contact support for assistance!");
    }

    public function generateEmailOTP($request)
    {
        $otp = mt_rand(10000, 99999);
        $otpCheck = OtpVerfication::where('otp', $otp)->first();

        if (!$otpCheck) {
            return $otp;
        }
        // return $this->generateEmailOTP();
    }

}
