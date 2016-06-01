<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('image_id')->unsigned();
            $table->integer('parent_id')->unsigned();
            $table->string('comment');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('image_id')->references('id')->on('images');
            $table->foreign('parent_id')->references('id')->on('comments');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comments');
    }
}
