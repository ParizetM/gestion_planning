<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\motif;
use Illuminate\Database\Seeder;

class motifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        motif::factory()->count(10)->create();
    }
}
