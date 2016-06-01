<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local as Adapter;

class CreateImagesTable extends Migration
{

    private $filesystem;

    public function __construct()
    {
        $this->filesystem = new Filesystem(new Adapter( public_path() ));
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filename')->unique();
            $table->string('title');
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');

        });

        $this->filesystem->createDir('images');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('images');

        // @todo smarter deletion of images
        // $this->filesystem->deleteDir('images');

    }
}
