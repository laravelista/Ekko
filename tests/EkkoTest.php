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
        $router->shouldReceive('currentRouteName')->times(4)->andReturn('users.index');

        $url = m::mock(\Illuminate\Routing\UrlGenerator::class);

        $ekko = new Ekko($router, $url);

        $this->assertEquals("active", $ekko->isActiveRoute('users.index'));
        $this->assertEquals("hello", $ekko->isActiveRoute('users.index', 'hello'));
        $this->assertEquals(null, $ekko->isActiveRoute('home'));
        $this->assertEquals(null, $ekko->isActiveRoute('home', 'hello'));
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

}
