<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UsersTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
        $this->call(ReportReasonsTableSeeder::class);
        $this->call(CommentTableSeeder::class);

        Model::reguard();

    }
}
