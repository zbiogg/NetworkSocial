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
            $table->bigIncrements('id');
            $table->string('username')->unique();
            $table->string('password',100);
            $table->string('email',100);
            $table->string('firstName');
            $table->string('lastName');
            $table->string('gender',10);
            $table->date('doB');
            $table->string('phone',11)->nullable();
            $table->string('city',100)->nullable();
             $table->string('about')->nullable();
            $table->string('img_avt')->nullable();
            $table->string('img_cover')->nullable();
            $table->bigInteger('fbID')->unique()->nullable();
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
