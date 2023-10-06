<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 1; $i <= 10; $i++) {
            DB::table('user_roles')->insert([
                [
                    'user_id' => $i, // ID de l'utilisateur
                    'role_id' => rand(1, 3), // ID du rôle
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
        }
    }
}
