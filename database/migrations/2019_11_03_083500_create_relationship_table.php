<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relationship', function (Blueprint $table) {
            $table->bigIncrements('relaID');
            $table->bigInteger('userID_1')->unsigned();
            $table->bigInteger('userID_2')->unsigned();
            $table->integer('status')->unsigned();
            $table->bigInteger('action_userID')->unsigned();
            $table->unique(['userID_1','userID_2']);
            $table->timestamps();
        });
        Schema::table('relationship', function(Blueprint $table){
            $table->foreign('userID_1')->references('id')->on('users');
            $table->foreign('userID_2')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relationship');
    }
}
