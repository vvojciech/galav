<?php

use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->insert([
            'filename' => str_random(6),
            'title' => str_random(10),
            'user_id' => 1,
        ]);

    }
}
