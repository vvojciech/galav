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

        DB::table('users')->truncate();

        User::create(array(
            'name' => 'tester',
            'email' => 'tester@test.com',
            'password' => bcrypt('Test#@!1235'),
        ));

        User::create(array(
            'name' => str_random(10),
            'email' => str_random(6) . '@test.com',
            'password' => bcrypt('secret'),
        ));

        User::create(array(
            'name' => str_random(10),
            'email' => str_random(6) . '@test.com',
            'password' => bcrypt('secret'),
        ));

        User::create(array(
            'name' => str_random(10),
            'email' => str_random(6) . '@test.com',
            'password' => bcrypt('secret'),
        ));


    }
}
