<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->integer('bus_id');
            $table->string('start_longitude');
            $table->string('start_latitude');
            $table->string('finish_longitude')->nullable();
            $table->string('finish_latitude')->nullable();
            $table->enum('type', ['single_user', 'payg','orgc','orgwc']);
            $table->integer('user_id')->nullable();
            $table->integer('payg_id')->nullable();
            $table->float('units')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips');
    }
}
