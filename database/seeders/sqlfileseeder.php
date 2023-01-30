<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class sqlfileseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('------------------------------------------------------------');
        $this->command->info('Country, State and City tables Dropped!');
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('countries');
        Schema::dropIfExists('states');
        //Schema::dropIfExists('cities');
        Schema::dropIfExists('banks');
        Schema::enableForeignKeyConstraints();

        $countries = public_path('sqls/countries.sql');
        $states = public_path('sqls/states.sql');
        $all_nigeria_banks = public_path('sqls/all_nigeria_banks.sql');
        // $cities = public_path('sqls/cities.sql');

        $countries_sql = file_get_contents($countries);
        $states_sql = file_get_contents($states);
        $all_nigeria_banks_sql = file_get_contents($all_nigeria_banks);
        // $cities_sql = file_get_contents($cities);
        $vehiclemanufacturers = public_path('sqls/vehiclemanufacturers.sql');
        $vehiclemodels = public_path('sqls/vehiclemodels.sql');
        $vehiclemanufacturers_sql = file_get_contents($vehiclemanufacturers);
        $vehiclemodels_sql = file_get_contents($vehiclemodels);

        $this->command->info('------------------------------------------------------------');
        $this->command->info('Seeding Country, State and City tables');
        DB::unprepared($countries_sql);
        DB::unprepared($states_sql);
        DB::unprepared($all_nigeria_banks_sql);
        $this->command->info('------------------------------------------------------------');
        $this->command->info('Seeding Vehicle Manufacturers and Models tables');
        DB::unprepared($vehiclemanufacturers_sql);
        DB::unprepared($vehiclemodels_sql);







    }
}
