<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert([
            [
                'nom' => "Art",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => "Musique",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => "Sport",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => "Culture",
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
