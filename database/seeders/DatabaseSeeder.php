<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            UserSeeder::class,
            MotifSeeder::class,
            AbsenceSeeder::class,
        ]);
        User::factory()->create([
            'nom' => 'Admin',
            'prenom' => 'User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('Not24get'),
            'permission_id' => 1,
        ]);
    }
}
