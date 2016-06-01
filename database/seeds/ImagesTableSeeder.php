<?php

use App\Image;
use Illuminate\Database\Seeder;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local as Adapter;

class ImagesTableSeeder extends Seeder
{

    private $filesystem;

    public function __construct()
    {
        $this->filesystem = new Filesystem(new Adapter( public_path() . '/images/' ));
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // @todo remove lorempixel with something more stable
//        return;
//        Eloquent::unguard();
//        DB::table('images')->truncate();

        $faker = Faker\Factory::create();

        for($i = 0; $i < 10; $i++){

            $file = file_get_contents('http://lorempixel.com/800/600/');

            $filename = $faker->lexify($string = '??????');
            $this->filesystem->write($filename, $file);

            DB::table('images')->insert([
                'filename' => $filename,
                'user_id' => (int) rand(1, 4),
                'title' => $faker->sentence(5),
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime()
            ]);
        }

        // extra image with known url for test
        /* @todo deal with file overwrite
        $file = file_get_contents('http://lorempixel.com/800/600/');

        $this->filesystem->write($filename, $file);
        */

        $filename = 'qbvsoa';

        $exemplary = DB::table('images')->where('filename', $filename)->first();

        if (!$exemplary) {
            DB::table('images')->insert([
                'filename' => $filename,
                'user_id' => (int) rand(1, 4),
                'title' => 'funny cat',
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime()
            ]);
        }

    }
}
