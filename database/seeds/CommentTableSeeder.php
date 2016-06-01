<?php

use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('comments')->truncate();

        $faker = Faker\Factory::create();

        for($i = 0; $i < 100; $i++){
            DB::table('comments')->insert([
                'user_id' => (int) rand(1, 4),
                'image_id' => (int) rand(1, 4),
                'parent_id' => 0,
                'comment' => $faker->sentence(rand(5, 50)),
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime()
            ]);
        }

        for($i = 0; $i < 100; $i++){
            DB::table('comments')->insert([
                'user_id' => (int) rand(1, 4),
                'image_id' => (int) rand(1, 4),
                'parent_id' => (int) rand(1,100),
                'comment' => $faker->sentence(rand(5, 50)),
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime()
            ]);
        }

        for($i = 0; $i < 100; $i++){
            DB::table('comments')->insert([
                'user_id' => (int) rand(1, 4),
                'image_id' => (int) rand(1, 4),
                'parent_id' => (int) rand(101,200),
                'comment' => $faker->sentence(rand(5, 50)),
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime()
            ]);
        }

    }
}
