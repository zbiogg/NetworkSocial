<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('senderID')->unsigned();
            $table->bigInteger('receiverID')->unsigned();
            $table->string('url');
            $table->string('message');
            $table->integer('status');
            $table->timestamps();
        });
        Schema::table('notifications', function(Blueprint $table){
            $table->foreign('senderID')->references('id')->on('users');
            $table->foreign('receiverID')->references('id')->on('users');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
