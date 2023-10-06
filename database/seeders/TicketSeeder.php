<?php

namespace Database\Seeders;

use App\Models\Type;
use App\Models\User;
use App\Models\UserRole;
use Nette\Utils\Random;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_participants = UserRole::where('role_id', 1)->get();
        $participants = [];

        foreach ($user_participants as $user_participant) {
            $p = User::where('id', $user_participant->user_id)->first();
            array_push($participants, $p);
        }

        for ($i = 0; $i < count($participants); $i++) {
            DB::table('tickets')->insert([
                [
                    'type_id' => $i+1,
                    'user_id' => $participants[$i]->id,
                    'code' => Random::generate(),
                    'isUsed' => false,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]);
        }
    }
}
