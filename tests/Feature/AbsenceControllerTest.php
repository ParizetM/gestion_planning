<?php

namespace Tests\Feature;

use App\Models\Absence;
use App\Models\Motif;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AbsenceControllerTest extends TestCase
{
    use RefreshDatabase;

    public function create_user_admin()
    {
        $user = User::factory()->create();
        $user->permission_id = '1';
        $user->save();

        return $user;
    }

    public function test_index()
    {
        $response = $this->get(route('absences.index'));

        $response->assertStatus(200);
        $response->assertViewIs('absences.index');
    }

    public function test_create_displays_form()
    {
        $user = $this->create_user_admin();
        $this->actingAs($user);
        $response = $this->get(route('absences.create'));

        $response->assertStatus(200);
        $response->assertViewIs('absences.create');
        $response->assertViewHasAll(['users', 'motifs']);
    }

    public function test_store_saves_and_redirects()
    {
        $motif = Motif::factory()->create();
        $user = $this->create_user_admin();
        $this->actingAs($user);

        $response = $this->post(route('absences.store'), [
            'date_debut' => now()->toDateString(),
            'date_fin' => now()->addDays(1)->toDateString(),
            'motif_id' => $motif->id,
            'user_id' => $user->id,
        ]);

        $response->assertRedirect(route('absences.index'));
        $this->assertDatabaseHas('absences', [
            'date_debut' => now()->toDateString(),
            'date_fin' => now()->addDays(1)->toDateString(),
            'motif_id' => $motif->id,
            'user_id' => $user->id,
        ]);
    }

    public function test_show_displays_absence()
    {
        User::factory()->create();
        Motif::factory()->create();
        $absence = Absence::factory()->create();
        $response = $this->get(route('absences.show', $absence));

        $response->assertStatus(200);
        $response->assertViewIs('absences.show');
        $response->assertViewHas('absence', $absence);
    }

    public function test_edit_displays_form()
    {
        User::factory()->create();
        Motif::factory()->create();
        $absence = Absence::factory()->create();
        $user = $this->create_user_admin();
        $this->actingAs($user);
        $response = $this->get(route('absences.edit', $absence));

        $response->assertStatus(200);
        $response->assertViewIs('absences.edit');
        $response->assertViewHasAll(['absence', 'users', 'motifs']);
    }

    public function test_update_saves_and_redirects()
    {
        User::factory()->create();
        Motif::factory()->create();
        $absence = Absence::factory()->create();
        $motif = Motif::factory()->create();
        $user = User::factory()->create();
        $user = $this->create_user_admin();
        $this->actingAs($user);

        $response = $this->put(route('absences.update', $absence), [
            'date_debut' => now()->toDateString(),
            'date_fin' => now()->addDays(1)->toDateString(),
            'motif_id' => $motif->id,
            'user_id' => $user->id,
        ]);

        $response->assertRedirect(route('absences.index'));
        $this->assertDatabaseHas('absences', [
            'id' => $absence->id,
            'date_debut' => now()->toDateString(),
            'date_fin' => now()->addDays(1)->toDateString(),
            'motif_id' => $motif->id,
            'user_id' => $user->id,
        ]);
    }

    public function test_destroy_deletes_and_redirects()
    {
        User::factory()->create();
        Motif::factory()->create();
        $absence = Absence::factory()->create();
        $user = $this->create_user_admin();
        $this->actingAs($user);
        $response = $this->delete(route('absences.destroy', $absence));

        $response->assertRedirect(route('absences.index'));
        $this->assertSoftDeleted($absence);
    }
}
