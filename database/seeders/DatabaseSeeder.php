<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
        $this->call(CategorySeeder::class);

        $admin = new User();
        $admin->name = "admin";
        $admin->email = 'admin@gmail.com';
        $admin->email_verified_at = now();
        $admin->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        $admin->remember_token = Str::random(10);
        $admin->save();
        $admin->assignRole('admin');

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
