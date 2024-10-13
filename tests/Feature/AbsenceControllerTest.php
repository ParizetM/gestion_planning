<?php

namespace Tests\Feature;

use App\Models\Absence;
use App\Models\Motif;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class AbsenceControllerTest extends TestCase
{
    use RefreshDatabase;



    public function testIndex()
    {
        $response = $this->get(route('absences.index'));

        $response->assertStatus(200);
        $response->assertViewIs('absences.index');
        $response->assertViewHas('absences');
    }

    public function testCreate()
    {
        $user = User::factory()->create(['permission_id' => '1']);
        $this->actingAs($user);

        $response = $this->get(route('absences.create'));

        $response->assertStatus(200);
        $response->assertViewIs('absences.create');
        $response->assertViewHasAll(['motifs', 'users']);
    }

    public function testStore()
    {
        $user = User::factory()->create(['permission_id' => '1']);
        $this->actingAs($user);
        $motif = Motif::factory()->create();

        $response = $this->post(route('absences.store'), [
            'user_id' => $user->id,
            'motif_id' => $motif->id,
            'date_debut' => now()->toDateString(),
            'date_fin' => now()->addDays(1)->toDateString(),
        ]);

        $response->assertRedirect(route('absences.index'));
        $this->assertDatabaseHas('absences', [
            'user_id' => $user->id,
            'motif_id' => $motif->id,
        ]);
    }

    public function testShow()
    {
        $absence = Absence::factory()->create();

        $response = $this->get(route('absences.show', $absence->id));

        $response->assertStatus(200);
        $response->assertViewIs('absences.show');
        $response->assertViewHas('absence', $absence);
    }

    public function testEdit()
    {
        $user = User::factory()->create(['permission_id' => '1']);
        $this->actingAs($user);
        $absence = Absence::factory()->create();

        $response = $this->get(route('absences.edit', $absence->id));

        $response->assertStatus(200);
        $response->assertViewIs('absences.edit');
        $response->assertViewHasAll(['absence', 'users', 'motifs']);
    }

    public function testUpdate()
    {
        $user = User::factory()->create(['permission_id' => '1']);
        $this->actingAs($user);
        $absence = Absence::factory()->create();
        $motif = Motif::factory()->create();

        $response = $this->put(route('absences.update', $absence->id), [
            'user_id' => $user->id,
            'motif_id' => $motif->id,
            'date_debut' => now()->toDateString(),
            'date_fin' => now()->addDays(1)->toDateString(),
        ]);

        $response->assertRedirect(route('absences.index'));
        $this->assertDatabaseHas('absences', [
            'id' => $absence->id,
            'user_id' => $user->id,
            'motif_id' => $motif->id,
        ]);
    }

    public function testDestroy()
    {
        $user = User::factory()->create(['permission_id' => '1']);
        $this->actingAs($user);
        $absence = Absence::factory()->create();

        $response = $this->delete(route('absences.destroy', $absence->id));

        $response->assertRedirect(route('absences.index'));
        $this->assertSoftDeleted('absences', ['id' => $absence->id]);
    }
}
