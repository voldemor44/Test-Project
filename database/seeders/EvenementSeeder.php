<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EvenementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 4; $i++) {
            DB::table('evenements')->insert([
                [
                    'genre_id' => $i,
                    'nom' => fake()->streetSuffix(),
                    'description' => fake()->text(),
                    'adresse' => fake()->address,
                    'date_heure' => fake()->date(),
                    'nbr_places_prevu' => rand(40, 300),
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]);
        }
    }
}
