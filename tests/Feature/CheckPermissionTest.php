<?php

namespace Tests\Unit\Http\Middleware;
use App\Http\Middleware\CheckPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CheckPermissionTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Auth::spy();
    }

    public function testHandleAllowsAccessWithValidPermission()
    {
        $user = (object) ['permission' => (object) ['nom' => 'view-dashboard']];
        Auth::shouldReceive('user')->andReturn($user);

        $middleware = new CheckPermission();
        $request = Request::create('/');

        $response = $middleware->handle($request, function ($req) {
            return new Response('next');
        }, 'view-dashboard');

        $this->assertEquals('next', $response->getContent());
    }
    public function testHandleDeniesAccessWithoutPermission()
    {
        $user = (object) ['permission' => (object) ['nom' => 'edit-posts']];
        Auth::shouldReceive('user')->andReturn($user);

        $middleware = new CheckPermission();
        $request = Request::create('/');

        $response = null;
        try {
            $middleware->handle($request, function ($req) {
                return new Response('next');
            }, 'view-dashboard');
        } catch (\Symfony\Component\HttpKernel\Exception\HttpException $e) {
            $response = $e->getStatusCode();
        }

        $this->assertEquals(403, $response);
    }
    public function testHandleDeniesAccessWhenUserIsNull()
        {
            Auth::shouldReceive('user')->andReturn(null);

            $middleware = new CheckPermission();
            $request = Request::create('/');

            $response = null;
            try {
                $middleware->handle($request, function ($req) {
                    return new Response('next');
                }, 'view-dashboard');
            } catch (\Symfony\Component\HttpKernel\Exception\HttpException $e) {
                $response = $e->getStatusCode();
            }

            $this->assertEquals(403, $response);
        }

}
