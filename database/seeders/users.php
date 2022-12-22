<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("users")->insert([
            "name" => "admin",
            "email" => "admin@admin.com",
            "password" => sha1("admin"),
            "role" => '2',

        ]);

        // for testing

        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 100; $i++) {
            DB::table("users")->insert([
                "name" => $faker->name(),
                "email" => $faker->email(),
                "password" => sha1($faker->password(8, 20)),
                "role" => "" . $faker->numberBetween(0, 2)
            ]);
        }
    }
}
