<?php

namespace Tests\Unit\Http\Requests;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;





class ProfileUpdateRequestTest extends TestCase
{
    use RefreshDatabase;
    public function testRulesWithAuthenticatedUser()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $request = new ProfileUpdateRequest();
        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        $rules = $request->rules();

        $this->assertArrayHasKey('nom', $rules);
        $this->assertArrayHasKey('prenom', $rules);
        $this->assertArrayHasKey('email', $rules);
    }

    public function testRulesWithoutAuthenticatedUser()
    {
        $request = new ProfileUpdateRequest();
        $request->setUserResolver(function () {
            return null;
        });

        $response = $request->rules();

        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        $this->assertEquals(route('login'), $response->getTargetUrl());
    }

    public function testValidationPassesWithValidData()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $request = new ProfileUpdateRequest();
        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        $validator = Validator::make([
            'nom' => 'John',
            'prenom' => 'Doe',
            'email' => 'john.doe@example.com',
        ], $request->rules());

        $this->assertTrue($validator->passes());
    }

    public function testValidationFailsWithInvalidData()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $request = new ProfileUpdateRequest();
        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        $validator = Validator::make([
            'nom' => '',
            'prenom' => '',
            'email' => 'invalid-email',
        ], $request->rules());

        $this->assertFalse($validator->passes());
    }
}
