<?php

namespace Database\Seeders;

use App\Models\Evenement;
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

            $event = Evenement::findOrFail($i);
            $nbr_tt_ticket_prevus = $event->nbr_places_prevu;

            DB::table('types')->insert(

                [
                    'evenement_id' => $i,
                    'nom' => 'simple',
                    'privileges' => fake()->text(),
                    'prix' => rand(5000, 100000),
                    'nbr_dispo' => rand(1, $nbr_tt_ticket_prevus),
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
                    'nbr_dispo' => rand(1, $nbr_tt_ticket_prevus),
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }
    }
}
