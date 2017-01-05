<?php

use Laravelista\Ekko\Ekko;
use \Mockery as m;

class EkkoTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }

    /** @test */
    public function it_detects_active_route_by_name()
    {
        $router = m::mock(\Illuminate\Routing\Router::class);
        $router->shouldReceive('currentRouteName')->times(8)->andReturn('users.index');

        $url = m::mock(\Illuminate\Routing\UrlGenerator::class);

        $ekko = new Ekko($router, $url);

        $this->assertEquals("active", $ekko->isActiveRoute('users.index'));
        $this->assertEquals("hello", $ekko->isActiveRoute('users.index', 'hello'));
        $this->assertEquals(null, $ekko->isActiveRoute('clients.index'));
        $this->assertEquals(null, $ekko->isActiveRoute('clients.index', 'hello'));

        // Wildcard support
        $this->assertEquals("active", $ekko->isActiveRoute('users.*'));
        $this->assertEquals("hello", $ekko->isActiveRoute('users.*', 'hello'));
        $this->assertEquals(null, $ekko->isActiveRoute('clients.*'));
        $this->assertEquals(null, $ekko->isActiveRoute('clients.*', 'hello'));
    }

    /** @test */
    public function it_detects_active_url()
    {
        $router = m::mock(\Illuminate\Routing\Router::class);

        $url = m::mock(\Illuminate\Routing\UrlGenerator::class);
        $url->shouldReceive('current')->times(4)->andReturn('/users');
        $url->shouldReceive('to')->times(4)->andReturn('/users', '/users', 'users', '/users/preview');

        $ekko = new Ekko($router, $url);

        $this->assertEquals("active", $ekko->isActiveURL('/users'));
        $this->assertEquals("hello", $ekko->isActiveURL('/users', 'hello'));
        $this->assertEquals(null, $ekko->isActiveURL('users'));
        $this->assertEquals(null, $ekko->isActiveURL('/users/preview', 'hello'));
    }

    /** @test */
    public function it_detects_active_match_in_url()
    {
        $router = m::mock(\Illuminate\Routing\Router::class);

        $url = m::mock(\Illuminate\Routing\UrlGenerator::class);
        $url->shouldReceive('current')->times(4)
            ->andReturn('/somewhere-over-the-rainbow');

        $ekko = new Ekko($router, $url);

        $this->assertEquals("active", $ekko->isActiveMatch('over-the-rainbow'));
        $this->assertEquals("hello", $ekko->isActiveMatch('over-the-rainbow', "hello"));
        $this->assertEquals(null, $ekko->isActiveMatch('under-the-rainbow'));
        $this->assertEquals(null, $ekko->isActiveMatch('under-the-rainbow', 'hello'));
    }

    /** @test */
    public function it_detects_active_routes_by_name()
    {
        $router = m::mock(\Illuminate\Routing\Router::class);
        $router->shouldReceive('currentRouteName')->times(8)->andReturn('users.index');

        $url = m::mock(\Illuminate\Routing\UrlGenerator::class);

        $ekko = new Ekko($router, $url);

        $this->assertEquals("active", $ekko->areActiveRoutes(['users.index']));
        $this->assertEquals("hello", $ekko->areActiveRoutes(['users.index'], 'hello'));
        $this->assertEquals(null, $ekko->areActiveRoutes(['clients.index']));
        $this->assertEquals(null, $ekko->areActiveRoutes(['clients.index'], 'hello'));

        // Wildcard support
        $this->assertEquals("active", $ekko->areActiveRoutes(['users.*']));
        $this->assertEquals("hello", $ekko->areActiveRoutes(['users.*'], 'hello'));
        $this->assertEquals(null, $ekko->areActiveRoutes(['clients.*']));
        $this->assertEquals(null, $ekko->areActiveRoutes(['clients.*'], 'hello'));
    }
    
    /** @test */
    public function it_detects_deep_active_routes_by_name()
    {
        $router = m::mock(\Illuminate\Routing\Router::class);
        $router->shouldReceive('currentRouteName')->times(4)->andReturn('frontend.users.show.stats');

        $url = m::mock(\Illuminate\Routing\UrlGenerator::class);

        $ekko = new Ekko($router, $url);

        // Wildcard support
        $this->assertEquals("active", $ekko->areActiveRoutes(['frontend.users.*']));
        $this->assertEquals("hello", $ekko->areActiveRoutes(['frontend.users.*'], 'hello'));
        $this->assertEquals(null, $ekko->areActiveRoutes(['clients.*']));
        $this->assertEquals(null, $ekko->areActiveRoutes(['clients.*'], 'hello'));
    }

    /** @test */
    public function it_detects_active_routes_by_url()
    {
        $router = m::mock(\Illuminate\Routing\Router::class);

        $url = m::mock(\Illuminate\Routing\UrlGenerator::class);
        $url->shouldReceive('current')->times(4)->andReturn('/users');
        $url->shouldReceive('to')->times(4)->andReturn('/users', '/users', 'users', '/users/preview');

        $ekko = new Ekko($router, $url);

        $this->assertEquals("active", $ekko->areActiveURLs(['/users']));
        $this->assertEquals("hello", $ekko->areActiveURLs(['/users'], 'hello'));
        $this->assertEquals(null, $ekko->areActiveURLs(['users']));
        $this->assertEquals(null, $ekko->areActiveURLs(['/users/preview'], 'hello'));
    }

}
