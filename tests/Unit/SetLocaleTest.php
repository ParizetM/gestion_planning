<?php

namespace Tests\Unit\Http\Middleware;

use App\Http\Middleware\SetLocale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class SetLocaleTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Session::spy();
        App::spy();
    }
    public function testHandleSetsLocaleToEnglish()
    {
        Session::shouldReceive('has')->with('locale')->andReturn(true);
        Session::shouldReceive('get')->with('locale')->andReturn('en');
        App::shouldReceive('setLocale')->with('en');

        $middleware = new SetLocale();
        $request = Request::create('/');

        $response = $middleware->handle($request, function () {
            return 'next';
        });

        $this->assertEquals('next', $response);
    }

    public function testHandleSetsLocaleToFrench()
    {
        Session::shouldReceive('has')->with('locale')->andReturn(true);
        Session::shouldReceive('get')->with('locale')->andReturn('fr');
        App::shouldReceive('setLocale')->with('fr');

        $middleware = new SetLocale();
        $request = Request::create('/');

        $response = $middleware->handle($request, function ($req) {
            return 'next';
        });

        $this->assertEquals('next', $response);
    }

    public function testHandleDoesNotSetLocaleIfNotInSession()
    {
        Session::shouldReceive('has')->with('locale')->andReturn(false);
        App::shouldReceive('setLocale')->never();

        $middleware = new SetLocale();
        $request = Request::create('/');

        $response = $middleware->handle($request, function ($req) {
            return 'next';
        });

        $this->assertEquals('next', $response);
    }

    public function testHandleDoesNotSetLocaleIfInvalid()
    {
        Session::shouldReceive('has')->with('locale')->andReturn(true);
        Session::shouldReceive('get')->with('locale')->andReturn('invalid');
        App::shouldReceive('setLocale')->never();

        $middleware = new SetLocale();
        $request = Request::create('/');

        $response = $middleware->handle($request, function ($req) {
            return 'next';
        });

        $this->assertEquals('next', $response);
    }
}
