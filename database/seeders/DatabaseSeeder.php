<?php

namespace Database\Seeders;

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
        $this->call(RoleSeeder::class);

        for($counter = 0 ; $counter < 2 ; $counter++){
            $user = \App\Models\User::factory()->create();
            $user->assignRole('admin');
        }

        for($counter = 0 ; $counter < 10 ; $counter++){
            $user = \App\Models\User::factory()->create();
            $user->assignRole('client');
        }

    }
}
