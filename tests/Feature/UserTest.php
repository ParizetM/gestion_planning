<?php

namespace Tests\Unit;

use App\Models\Motif;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class UserTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function testUserHasManyAbsences()
    {
        $user = User::factory()->create();
        Motif::factory()->create();
        $absences = \App\Models\Absence::factory()->count(3)->create(['user_id' => $user->id]);

        $this->assertCount(3, $user->absences);
        $this->assertTrue($user->absences->contains($absences[0]));
        $this->assertTrue($user->absences->contains($absences[1]));
        $this->assertTrue($user->absences->contains($absences[2]));
    }
}
