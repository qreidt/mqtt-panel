<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        if (Team::count() === 0) {
            $team = Team::create([
                'name' => 'Admin Team'
            ]);
        }

        if (User::count() === 0) {
            $user = User::factory()->create([
                'name' => env('SEED_USER_NAME', 'Test User'),
                'email' => env('SEED_USER_EMAIL', 'user@mqtt-panel.test'),
                'password' => bcrypt(env('SEED_USER_PASSWORD', 'password')),
            ]);

            if (isset($team)) {
                $team->users()->attach($user);
            }
        }
    }
}
