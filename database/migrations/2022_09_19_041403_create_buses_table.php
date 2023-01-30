<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->string('color');
            $table->integer('manufacturer_id');
            $table->integer('model_id');
            $table->string('plate_number')->unique();
            $table->string('vin_number')->nullable();
            $table->string('chasis_number')->nullable();
            $table->integer('is_verified')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->string('loginid')->nullable()->unique();
            $table->string('password')->nullable();
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
        Schema::dropIfExists('buses');
    }
}
