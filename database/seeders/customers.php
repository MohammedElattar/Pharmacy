<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class customers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'name' => 'Guest',
        ]);
        for ($i = 0; $i < 50; ++$i) {
            DB::table('customers')->insert([
                'name' => fake()->name(),
            ]);
        }
    }
}
