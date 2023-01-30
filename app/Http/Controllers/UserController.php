<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusDetailsRequest;
use App\Http\Requests\CreateBusRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\DeleteUserRequest;
use App\Http\Requests\ScannerAccountRequest;
use App\Http\Requests\SendOtpRequest;
use App\Http\Requests\UpdateBusRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserDetailsRequest;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepo;
    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    public function all_users($id){
        $users = User::where('institution_id', $id)->with('institution')->get();

        return res_success('user', $users);
    }
    public function create_user_account(CreateUserRequest $request){
        $validated = $request->validated();
        return $this->userRepo->create_user_account($validated);
    }
    public function get_user(UserDetailsRequest $request){
        $validated = $request->validated();
        return $this->userRepo->get_user($validated);
    }
    public function update_user(UpdateUserRequest $request){
        $validated = $request->validated();
        return $this->userRepo->update_user($validated);
    }
    public function delete_user(DeleteUserRequest $request){
        $validated = $request->validated();
        return $this->userRepo->delete_user($validated);
    }
    public function create_guarantor($request){

    }
    public function update_guarantor($request){

    }
    public function delete_guarantor($request){

    }
    public function add_bus(CreateBusRequest $request){
        $validated = $request->validated();
        return $this->userRepo->add_bus($validated);
    }
    public function update_bus(UpdateBusRequest $request, $id){
        $validated = $request->validated();
        return $this->userRepo->update_bus($validated, $id);
    }
    public function delete_bus($id){
        return $this->userRepo->delete_bus($id);
    }

    public function bus_details(BusDetailsRequest $request){
        $validated = $request->validated();
        return $this->userRepo->bus_details($validated);
    }

    public function scanner_account(ScannerAccountRequest $request, $id){
        $validated = $request->validated();
        return $this->userRepo->scanner_account($validated, $id);
    }

}
