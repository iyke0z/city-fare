<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CodeController;
use App\Http\Controllers\FlutterWaveController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|---------------------------------------------------
-----------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function(){
    Route::post('paystack/webhook', [TransactionController::class, 'webHookHandlerPaystack']);
    Route::post('/pay',[TransactionController::class, 'pay'] );
        // Authentication Routes
        Route::post('login', [AuthController::class, 'login']);
        Route::post('scanner-login', [AuthController::class, 'login_scanner']);
        Route::post('verify-phone-number', [AuthController::class, 'sendOTP'])->name('verify.user.phone');
        Route::post('verify-otp', [AuthController::class, 'verifyOtp'])->name('verify.otp.token');
        Route::post('resend-otp', [AuthController::class, 'resendOTP']);
        Route::post('reset-password-otp', [AuthController::class, 'sendPasswordResetOTP']);
        Route::post('verify-reset-password-otp', [AuthController::class, 'verifyPasswordResetOTP']);
        Route::post('reset-password', [AuthController::class, 'ResetPassword']);
        Route::post('register', [UserController::class, 'create_user_account']);

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('logout', [AuthController::class, 'logout']);
            Route::post('logout-scanner', [AuthController::class, 'logout_scanner']);
            Route::prefix('user')->group(function (){
                Route::get('/{id}', [UserController::class, 'all_users']);
                Route::post('update', [UserController::class, 'update_user']);
                Route::post('details', [UserController::class, 'get_user']);
                Route::post('delete', [UserController::class, 'delete_user']);
            });
            Route::prefix('bus')->group(function (){
                Route::post('create', [UserController::class, 'add_bus']);
                Route::post('update/{id}', [UserController::class, 'update_bus']);
                Route::post('delete/{id}', [UserController::class, 'delete_bus']);
                Route::post('details', [UserController::class, 'bus_details']);
                Route::post('scan', [TransactionController::class, 'scan_user']);
                Route::post('scanout', [TransactionController::class, 'scan_out']);
                Route::post('load', [TripController::class, 'set_bus_load']);
                Route::post('destination', [TripController::class, 'set_bus_destination']);
                Route::post('nearest', [TripController::class, 'get_closest_bus']);
                Route::post('estimate', [TripController::class, 'get_estimated_fare']);
                Route::post('current-destination',  [TripController::class, 'get_current_destination']);
                Route::post('clear-destination',  [TripController::class, 'clear_trip_controller']);

            });
            Route::prefix('package')->group(function (){
                Route::post('activate', [TransactionController::class, 'activate_trip_package']);
                Route::post('buy', [TransactionController::class, 'buy_package']);
            });
            Route::prefix('codes')->group(function (){
                Route::post('all', [CodeController::class, 'all_codes']);
                Route::post('generate', [CodeController::class, 'generate_codes']);
                Route::post('assign/{userid}/{codeid}', [CodeController::class, 'assign_user_codes']);
                Route::post('deactivate/{userid}/{codeid}', [CodeController::class, 'deactivate_code']);
                Route::post('/{instid}', [CodeController::class, 'get_codes']);

            });
            Route::prefix('admin')->group(function (){
                Route::post('scanner-account/{id}', [UserController::class, 'scanner_account']);
                Route::post('new-package', [AdminController::class, 'create_trip_package']);
                Route::post('update-package/{id}', [AdminController::class, 'update_trip_package']);
                Route::post('delete-package/{id}', [AdminController::class, 'delete_trip_package']);
                Route::post('accredit/{id}', [AdminController::class, 'accredit_bus']);
                Route::post('guarantor/create/{userid}', [AdminController::class, 'create_guarantor']);
                Route::post('guarantor/update/{id}', [AdminController::class, 'update_guarantor']);
                Route::post('guarantor/delete/{id}', [AdminController::class, 'delete_guarantor']);
                Route::post('driver-details/update/{id}', [AdminController::class, 'update_details']);
                Route::post('driver/assign/{user}/{id}', [AdminController::class, 'assign_driver_bus']);
                Route::post('conductor/assign/{user}/{id}', [AdminController::class, 'assign_conductor_bus']);
                Route::post('cityfare/settings/create', [AdminController::class, 'create_cityfare_settings']);
                Route::post('cityfare/settings/update', [AdminController::class, 'update_cityfare_settings']);
                Route::post('cityfare/settings/delete', [AdminController::class, 'delete_cityfare_settings']);
                Route::get('cityfare/settings/all', [AdminController::class, 'all_settings']);
                Route::post('bus-stop/create', [AdminController::class, 'create_busstop']);
                Route::post('bus-stop/update', [AdminController::class, 'update_busstop']);
                Route::post('bus-stop/delete', [AdminController::class, 'delete_busstop']);
                Route::get('bus-stop/all', [AdminController::class, 'all_bus_stops']);
            });
        });
});
