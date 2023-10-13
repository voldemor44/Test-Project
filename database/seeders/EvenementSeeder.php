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
            $nm = rand(40, 300);
            DB::table('evenements')->insert([
                [
                    'genre_id' => $i,
                    'nom' => fake()->streetSuffix(),
                    'description' => fake()->text(),
                    'adresse' => fake()->address,
                    'date_heure' => fake()->date(),
                    'nbr_places_prevu' => $nm,
                    'nbr_tickets_restant' => $nm,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]);
        }
    }
}
