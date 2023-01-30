<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtpVerficationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otp_verfications', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->integer('otp');
            $table->enum('request_type', ['registration', 'password_reset']);
            $table->integer('is_verified')->default(0);
            $table->integer('is_registered')->default(0);
            $table->string('expiry');
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
        Schema::dropIfExists('otp_verfications');
    }
}
