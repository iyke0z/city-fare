<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'firstname' => 'City Fare',
            'lastname' => 'City Fare',
            'phone ' => 'City Fare',
            'email ' => 'hesoyam',
            'account_type' => 'partner',
            'firstname' => 'City Fare',
            'identity' => 'female'

        ];

        User::create($user);
    }
}
