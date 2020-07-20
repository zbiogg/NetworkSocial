<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('fromID')->unsigned();
            $table->bigInteger('toID')->unsigned();
            $table->string('message')->nullable();
            $table->string('message_Image')->nullable();
            $table->timestamps();
        });
        Schema::table('messages', function(Blueprint $table){
            $table->foreign('fromID')->references('id')->on('users');
            $table->foreign('toID')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
