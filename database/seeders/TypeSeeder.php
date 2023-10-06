<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 4; $i++) {
            DB::table('types')->insert(

                [
                    'evenement_id' => $i,
                    'nom' => 'simple',
                    'privileges' => fake()->text(),
                    'prix' => rand(5000, 100000),
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
            DB::table('types')->insert(

                [
                    'evenement_id' => $i,
                    'nom' => 'vip',
                    'privileges' => fake()->text(),
                    'prix' => rand(5000, 100000),
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }
    }
}
