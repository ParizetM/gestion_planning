<?php

namespace Tests\Feature;

use App\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testPermissionBelongsToManyUsers()
    {
        $permission = Permission::factory()->create();
        $users = \App\Models\User::factory()->count(3)->create();

        $permission->users()->saveMany($users);

        $this->assertCount(3, $permission->users);
        $this->assertTrue($permission->users->contains($users[0]));
        $this->assertTrue($permission->users->contains($users[1]));
        $this->assertTrue($permission->users->contains($users[2]));
    }
}
