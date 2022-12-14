<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class categories extends Seeder
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
        for ($i = 0; $i < 20; ++$i) {
            DB::table('medicine_categories')->insert([
                'name' => $faker->name(),
            ]);
        }
    }
}
