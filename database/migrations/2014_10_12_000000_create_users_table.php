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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role')->default('emp');
            $table->string('empId')->default("0")->unique();
            $table->string('address')->default('nil');
            $table->string('bloodGroup')->default('nil');
            $table->string('phone')->default('nil');
            $table->date('doj')->nullable();
            $table->date('dob')->nullable();
            $table->integer('experience')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->string('designation')->default('GET');
            $table->int('team_id')->nullable();
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
