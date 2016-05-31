<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('report_reasons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reason')->unsigned();
            $table->integer('description')->unsigned();
        });


        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('image_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('report_reason_id')->unsigned();
            $table->timestamps();

            $table->foreign('image_id')->references('id')->on('images');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('report_reason_id')->references('id')->on('report_reasons');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reports');
        Schema::drop('report_reasons');
    }
}
