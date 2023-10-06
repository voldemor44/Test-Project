<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\UserRole;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(RolesSeeder::class);

        \App\Models\User::factory(10)->create();

        $this->call(UserRoleSeeder::class);

        $this->call(GenreSeeder::class);

        $this->call(EvenementSeeder::class);

        $this->call(TypeSeeder::class);

        $this->call(TicketSeeder::class);
        
    }
}
