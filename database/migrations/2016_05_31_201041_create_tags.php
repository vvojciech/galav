<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyinteger('active')->default(1)->unsigned();
            $table->string('tag')->unique();
            $table->timestamps();
        });

        Schema::create('image_tag', function (Blueprint $table) {
            $table->integer('image_id')->unsigned();
            $table->integer('tag_id')->unsigned();

            $table->foreign('image_id')->references('id')->on('images');
            $table->foreign('tag_id')->references('id')->on('tags');

            $table->primary(array('image_id', 'tag_id'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tags');
        Schema::drop('image_tag');
    }
}
