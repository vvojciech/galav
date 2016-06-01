<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Eloquent::unguard();

        $faker = Faker\Factory::create();
        DB::table('users')->truncate();

        User::create(array(
            'username' => 'tester',
            'email' => 'tester@test.com',
            'password' => bcrypt('Test#@!1235'),
            'created_at' => $faker->dateTime(),
            'updated_at' => $faker->dateTime()
        ));

        User::create(array(
            'username' => str_random(10),
            'email' => str_random(6) . '@test.com',
            'password' => bcrypt('secret'),
            'created_at' => $faker->dateTime(),
            'updated_at' => $faker->dateTime()
        ));

        User::create(array(
            'username' => str_random(10),
            'email' => str_random(6) . '@test.com',
            'password' => bcrypt('secret'),
            'created_at' => $faker->dateTime(),
            'updated_at' => $faker->dateTime()
        ));

        User::create(array(
            'username' => str_random(10),
            'email' => str_random(6) . '@test.com',
            'password' => bcrypt('secret'),
            'created_at' => $faker->dateTime(),
            'updated_at' => $faker->dateTime()
        ));


    }
}
