<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReplycommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replycomments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('comment_ID')->unsigned();
            $table->bigInteger('userID')->unsigned();
            $table->string('content_repcmt');
            $table->timestamps();
        });
        Schema::table('replycomments', function(Blueprint $table){
            $table->foreign('userID')->references('id')->on('users');
            $table->foreign('comment_ID')->references('id')->on('comments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replycomments');
    }
}
