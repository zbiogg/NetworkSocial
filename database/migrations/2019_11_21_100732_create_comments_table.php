<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('postID')->unsigned();
            $table->bigInteger('userID')->unsigned();
            $table->string('content_cmt');
            $table->timestamps();
        });
        Schema::table('comments', function(Blueprint $table){
            $table->foreign('userID')->references('id')->on('users');
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
        Schema::dropIfExists('comments');
    }
}
