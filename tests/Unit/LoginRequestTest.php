<?php

namespace Tests\Unit\Http\Requests\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;




class LoginRequestTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        RateLimiter::clear('test@example.com|127.0.0.1');
    }

    public function testAuthorizeReturnsTrue()
    {
        $request = new LoginRequest();
        $this->assertTrue($request->authorize());
    }

    public function testRules()
    {
        $request = new LoginRequest();
        $rules = $request->rules();

        $this->assertArrayHasKey('email', $rules);
        $this->assertArrayHasKey('password', $rules);
    }

    public function testAuthenticateSuccess()
    {
        Auth::shouldReceive('attempt')->once()->andReturn(true);
        RateLimiter::shouldReceive('clear')->once();
        RateLimiter::shouldReceive('tooManyAttempts')->once()->andReturn(false);

        $request = new LoginRequest();
        $request->merge(['email' => 'test@example.com', 'password' => 'password']);

        $request->authenticate();

        $this->assertTrue(true); // If no exception is thrown, the test passes
    }

    public function testAuthenticateFails()
    {
        Auth::shouldReceive('attempt')->once()->andReturn(false);
        RateLimiter::shouldReceive('hit')->once();
        RateLimiter::shouldReceive('tooManyAttempts')->once()->andReturn(false);

        $this->expectException(ValidationException::class);

        $request = new LoginRequest();
        $request->merge(['email' => 'test@example.com', 'password' => 'password']);

        $request->authenticate();
    }

    public function testEnsureIsNotRateLimited()
    {
        RateLimiter::shouldReceive('tooManyAttempts')->once()->andReturn(false);

        $request = new LoginRequest();
        $request->merge(['email' => 'test@example.com']);

        $request->ensureIsNotRateLimited();

        $this->assertTrue(true); // If no exception is thrown, the test passes
    }

    public function testEnsureIsRateLimited()
    {
        RateLimiter::shouldReceive('tooManyAttempts')->once()->andReturn(true);
        RateLimiter::shouldReceive('availableIn')->once()->andReturn(60);
        Event::fake();

        $this->expectException(ValidationException::class);

        $request = new LoginRequest();
        $request->merge(['email' => 'test@example.com']);

        $request->ensureIsNotRateLimited();

        Event::assertDispatched(Lockout::class);
    }

    public function testThrottleKey()
    {
        $request = new LoginRequest();
        $request->merge(['email' => 'test@example.com']);
        $request->server->set('REMOTE_ADDR', '127.0.0.1');

        $this->assertEquals('test@example.com|127.0.0.1', $request->throttleKey());
    }
}
