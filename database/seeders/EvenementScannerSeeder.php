<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use App\Models\Evenement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EvenementScannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $evenements = Evenement::all();
        $scanners = [];
        $users = User::all();

        foreach ($users as $user) {
            $roles = $user->roles;
            if ($roles->contains('nom', 'Scanner')) {
                array_push($scanners, $user);
            }
        }
        foreach ($scanners as $scanner) {
            foreach ($evenements as $evenement) {
                DB::table('evenement_scanners')->insert([
                    'evenement_id' => $evenement->id,
                    'user_id' => $scanner->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}
