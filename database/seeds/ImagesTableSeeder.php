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
        $faker = Faker\Factory::create();

        Eloquent::unguard();

        DB::table('images')->truncate();

        for($i = 0; $i < 10; $i++){

            $file = file_get_contents('http://lorempixel.com/800/600/');

            $filename = $faker->lexify($string = '??????');
            $this->filesystem->write($filename, $file);

            DB::table('images')->insert([
                'filename' => $filename,
                'user_id' => (int) rand(1, 4),
                'title' => $faker->sentence(5),
            ]);
        }

    }
}
