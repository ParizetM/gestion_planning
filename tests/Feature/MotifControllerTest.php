<?php

namespace Tests\Feature;

use App\Models\Absence;
use App\Models\Motif;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MotifControllerTest extends TestCase
{
    use RefreshDatabase;

    public function create_user_admin(): User
    {
        $user = User::factory()->create();
        $user->permission_id = '1';
        $user->save();

        return $user;
    }

    /** @test */
    public function it_displays_the_motifs_index_page()
    {
        $motif = Motif::factory()->create();
        $response = $this->get(route('motifs.index'));

        $response->assertStatus(200);
        $response->assertViewIs('motifs.index');
        $response->assertViewHas('motifs', function ($motifs) use ($motif) {
            return $motifs->contains($motif);
        });
    }

    /** @test */
    public function it_displays_the_create_motif_page()
    {
        $this->actingAs($this->create_user_admin());
        $response = $this->get(route('motifs.create'));

        $response->assertStatus(200);
        $response->assertViewIs('motifs.create');
    }

    /** @test */
    public function it_stores_a_new_motif()
    {
        $this->actingAs($this->create_user_admin());
        $data = [
            'nom' => 'Test Motif',
            'description' => 'Test Description',
            'is_accessible_salarie' => 1,
        ];

        $response = $this->post(route('motifs.store'), $data);

        $response->assertRedirect(route('motifs.index'));
        $this->assertDatabaseHas('motifs', $data);
    }

    /** @test */
    public function it_displays_a_specific_motif()
    {

        $motif = Motif::factory()->create();

        $response = $this->get(route('motifs.show', $motif->id));

        $response->assertStatus(200);
        $response->assertViewIs('motifs.show');
        $response->assertViewHas('motif', $motif);
    }

    /** @test */
    public function it_displays_the_edit_motif_page()
    {
        $this->actingAs($this->create_user_admin());
        $motif = Motif::factory()->create();

        $response = $this->get(route('motifs.edit', $motif->id));

        $response->assertStatus(200);
        $response->assertViewIs('motifs.edit');
        $response->assertViewHas('motif', $motif);
    }

    /** @test */
    public function it_updates_a_motif()
    {
        $this->actingAs($this->create_user_admin());
        $motif = Motif::factory()->create();

        $data = [
            'nom' => 'Updated Motif',
            'description' => 'Updated Description',
            'is_accessible_salarie' => 0,
        ];

        $response = $this->put(route('motifs.update', $motif->id), $data);

        $response->assertRedirect(route('motifs.show', $motif->id));

        $updatedMotif = $motif->fresh();
        $this->assertEquals($data['nom'], $updatedMotif->nom);
        $this->assertEquals($data['description'], $updatedMotif->description);
    }

    /** @test */
    public function it_deletes_a_motif()
    {
        $this->actingAs($this->create_user_admin());
        $motif = Motif::factory()->create();

        $response = $this->delete(route('motifs.destroy', $motif->id));

        $response->assertRedirect(route('motifs.index'));
        $this->assertSoftDeleted('motifs', ['id' => $motif->id]);
    }

    /** @test */
    public function it_restores_a_soft_deleted_motif()
    {
        $this->actingAs($this->create_user_admin());
        $motif = Motif::factory()->create(['deleted_at' => now()]);

        $response = $this->patch(route('motifs.restore', $motif->id));

        $response->assertRedirect(route('motifs.index'));
        $this->assertDatabaseHas('motifs', ['id' => $motif->id, 'deleted_at' => null]);
    }

    /** @test */
    public function it_does_not_delete_a_motif_with_related_absences()
    {
        $this->actingAs($this->create_user_admin());
        $motif = Motif::factory()->create();
        Absence::factory()->create();

        $response = $this->delete(route('motifs.destroy', $motif->id));

        $response->assertRedirect(route('motifs.show', $motif->id));
        $response->assertSessionHas('message_erreur', 'Ce motif est utilisé dans des absences');
        $this->assertDatabaseHas('motifs', ['id' => $motif->id, 'deleted_at' => null]);
    }
}
