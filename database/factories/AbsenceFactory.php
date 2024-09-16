<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Absence;
use App\Models\User;
use App\Models\Motif;
use DateTime;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Absence>
 */
class AbsenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date_debut' => Carbon::parse(Carbon::now()->addDays(random_int(1, 3))),
            'date_fin' => Carbon::parse(Carbon::now()->addDays(random_int(1, 60))),
            'user_id' => User::all()->random()->id,
            'motif_id' => Motif::all()->random()->id,
        ];
    }
}
