<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class products extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // * for testing

        // $faker = \Faker\Factory::create();
        // for ($i = 0; $i < 20; $i++) {
        //     DB::table("products")->insert([
        //         "name" => $faker->name(),
        //         "description" => $faker->name(),
        //         "concentration" => $faker->randomNumber(),
        //         "require_reciepnt" => '1',
        //         'category_id' => $faker->numberBetween(1, 10),
        //         'med_type' => $faker->numberBetween(1, 10)
        //     ]);
        // }
    }
}
