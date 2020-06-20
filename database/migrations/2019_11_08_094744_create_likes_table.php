<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->bigIncrements('like_ID');
            $table->bigInteger('like_userID')->unsigned();
            $table->bigInteger('postID')->unsigned();
            $table->timestamps();
        });
        Schema::table('likes', function(Blueprint $table){
            $table->foreign('like_userID')->references('id')->on('users');
            $table->foreign('postID')->references('postID')->on('posts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
    }
}
