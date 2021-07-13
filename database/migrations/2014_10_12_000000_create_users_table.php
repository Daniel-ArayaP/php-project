<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->int('role_id')->unsigned();
            $table->timestamps('last_login_date');
            $table->int('fail_attempt_count');
            $table->boolean('is_active');
            $table->boolean('is_locked_out');
            $table->timestamps('lock_start_time');
            $table->timestamps();
            $table->foreign('role_id')->refences('id')->on('roles');
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
