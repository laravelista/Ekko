<?php

use \Mockery as m;
use Laravelista\Ekko\Url\LaravelUrlProvider;
use PHPUnit\Framework\TestCase;
use Laravelista\Ekko\Frameworks\Laravel\Ekko;

class EkkoLaravelTest extends TestCase
{
    protected $router;
    protected $ekko;
    protected $request;

    public function tearDown(): void
    {
        m::close();
    }

    public function setUp(): void
    {
        $this->router = m::mock(\Illuminate\Routing\Router::class);

        $this->request = m::mock(\Illuminate\Http\Request::class);

        $this->ekko = new Ekko($this->router);
        $this->ekko->setUrlProvider(new LaravelUrlProvider($this->request));
    }

    /** @test */
    public function it_detects_active_route_by_name()
    {
        $this->router->shouldReceive('currentRouteName')->times(8)->andReturn('users.index');

        $this->assertEquals("active", $this->ekko->isActiveRoute('users.index'));
        $this->assertEquals("hello", $this->ekko->isActiveRoute('users.index', 'hello'));
        $this->assertEquals(null, $this->ekko->isActiveRoute('clients.index'));
        $this->assertEquals(null, $this->ekko->isActiveRoute('clients.index', 'hello'));

        // Wildcard support
        $this->assertEquals("active", $this->ekko->isActiveRoute('users.*'));
        $this->assertEquals("hello", $this->ekko->isActiveRoute('users.*', 'hello'));
        $this->assertEquals(null, $this->ekko->isActiveRoute('clients.*'));
        $this->assertEquals(null, $this->ekko->isActiveRoute('clients.*', 'hello'));
    }

    /** @test */
    public function it_detects_active_url()
    {
        $this->request->shouldReceive('getBasePath')->times(4)->andReturn('/users');

        $this->assertEquals("active", $this->ekko->isActiveURL('/users'));
        $this->assertEquals("hello", $this->ekko->isActiveURL('/users', 'hello'));
        $this->assertEquals(null, $this->ekko->isActiveURL('users'));
        $this->assertEquals(null, $this->ekko->isActiveURL('/users/preview', 'hello'));
    }

    /** @test */
    public function it_detects_active_match_in_url()
    {
        $this->request->shouldReceive('getBasePath')->times(4)
            ->andReturn('/somewhere-over-the-rainbow');

        $this->assertEquals("active", $this->ekko->isActiveMatch('over-the-rainbow'));
        $this->assertEquals("hello", $this->ekko->isActiveMatch('over-the-rainbow', "hello"));
        $this->assertEquals(null, $this->ekko->isActiveMatch('under-the-rainbow'));
        $this->assertEquals(null, $this->ekko->isActiveMatch('under-the-rainbow', 'hello'));
    }

    /** @test */
    public function it_detects_active_routes_by_name()
    {
        $this->router->shouldReceive('currentRouteName')->times(8)->andReturn('users.index');

        $this->assertEquals("active", $this->ekko->areActiveRoutes(['users.index']));
        $this->assertEquals("hello", $this->ekko->areActiveRoutes(['users.index'], 'hello'));
        $this->assertEquals(null, $this->ekko->areActiveRoutes(['clients.index']));
        $this->assertEquals(null, $this->ekko->areActiveRoutes(['clients.index'], 'hello'));

        // Wildcard support
        $this->assertEquals("active", $this->ekko->areActiveRoutes(['users.*']));
        $this->assertEquals("hello", $this->ekko->areActiveRoutes(['users.*'], 'hello'));
        $this->assertEquals(null, $this->ekko->areActiveRoutes(['clients.*']));
        $this->assertEquals(null, $this->ekko->areActiveRoutes(['clients.*'], 'hello'));
    }

    /** @test */
    public function it_detects_deep_active_routes_by_name()
    {
        $this->router->shouldReceive('currentRouteName')->times(4)
            ->andReturn('frontend.users.show.stats');

        // Wildcard support
        $this->assertEquals("active", $this->ekko->areActiveRoutes(['frontend.users.*']));
        $this->assertEquals("hello", $this->ekko->areActiveRoutes(['frontend.users.*'], 'hello'));
        $this->assertEquals(null, $this->ekko->areActiveRoutes(['clients.*']));
        $this->assertEquals(null, $this->ekko->areActiveRoutes(['clients.*'], 'hello'));
    }

    /** @test */
    public function it_detects_active_routes_by_url()
    {
        $this->request->shouldReceive('getBasePath')->times(4)->andReturn('/users');

        $this->assertEquals("active", $this->ekko->areActiveURLs(['/users']));
        $this->assertEquals("hello", $this->ekko->areActiveURLs(['/users'], 'hello'));
        $this->assertEquals(null, $this->ekko->areActiveURLs(['users']));
        $this->assertEquals(null, $this->ekko->areActiveURLs(['/users/preview'], 'hello'));
    }

}
