<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'nom' => 'Participant',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Administrateur',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Scanner',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
