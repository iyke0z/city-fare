<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->enum('account_type', ['admin', 'partner', 'passenger', 'driver', 'conductor']);
            $table->float('wallet_balance')->default(0);
            $table->enum('identity', ['male', 'female', 'bus']);
            $table->string('dob');
            $table->string('nin')->nullable();
            $table->integer('is_banned')->default(0);
            $table->float('trip_count')->default(0);
            $table->date('ban_start_date')->nullable();
            $table->date('ban_end_date')->nullable();
            $table->softDeletes();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
