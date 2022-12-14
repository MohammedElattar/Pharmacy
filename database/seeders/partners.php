<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class partners extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // * for testing

        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 100; $i++) {
            DB::table("partners")->insert([
                "name" => $faker->name(),
            ]);
        }
    }
}
