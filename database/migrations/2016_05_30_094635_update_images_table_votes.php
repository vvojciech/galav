<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateImagesTableVotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function ($table) {
            $table->increments('id');
            $table->integer('image_id')->unsigned();
            $table->tinyinteger('vote');
            $table->string('ip');
            $table->date('day');

            $table->foreign('image_id')->references('id')->on('images');
        });

        Schema::table('images', function ($table) {
            $table->integer('rating')->unsigned()->default(0);
            $table->integer('votes_total')->unsigned()->default(0);
            $table->integer('votes_up')->unsigned()->default(0);
            $table->integer('votes_down')->unsigned()->default(0);
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('votes');
    }
}
