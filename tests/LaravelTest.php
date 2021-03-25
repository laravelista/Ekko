<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Laravelista\Ekko\Frameworks\Laravel\Ekko;
use Laravelista\Ekko\Url\LaravelUrlProvider;
use Mockery as m;
use PHPUnit\Framework\TestCase;

class LaravelTest extends TestCase
{
    protected Router $router;
    protected Ekko $ekko;
    protected Request $request;

    public function tearDown(): void
    {
        m::close();
    }

    public function setUp(): void
    {
        $this->router = m::mock(Router::class);
        $this->request = m::mock(Request::class);

        $this->ekko = new Ekko($this->router);
        $this->ekko->setUrlProvider(new LaravelUrlProvider($this->request));
    }

    /**
     * @psalm-return array{0: array{0: string, 1: string, 2: string}, 1: array{0: string, 1: string, 2: string, 3: string}, 2: array{0: string, 1: string, 2: null}, 3: array{0: string, 1: string, 2: null, 3: string}, 4: array{0: string, 1: string, 2: string}, 5: array{0: string, 1: string, 2: string, 3: string}, 6: array{0: string, 1: string, 2: null}, 7: array{0: string, 1: string, 2: null, 3: string}}
     */
    public function isActiveRouteDataProvider(): array
    {
        $route_name = 'users.index';

        // routeName, input, result, output (optional) (null)
        return [
            [$route_name, 'users.index', 'active'],
            [$route_name, 'users.index', 'hello', 'hello'],
            [$route_name, 'clients.index', null],
            [$route_name, 'clients.index', null, 'hello'],

            [$route_name, 'users.*', 'active'],
            [$route_name, 'users.*', 'hello', 'hello'],
            [$route_name, 'clients.*', null],
            [$route_name, 'clients.*', null, 'hello'],
        ];
    }

    /**
     * @dataProvider isActiveRouteDataProvider
     *
     * @test
     */
    public function isActiveRoute($routeName, $input, $result, $output = null): void
    {
        $this->router->shouldReceive('currentRouteName')->times(1)->andReturn($routeName);

        $this->assertEquals(
            expected: $result,
            actual: $this->ekko->isActiveRoute($input, $output)
        );
    }

    /**
     * @return (null|string|string[])[][]
     *
     * @psalm-return array{0: array{0: string, 1: array{0: string}, 2: string}, 1: array{0: string, 1: array{0: string}, 2: string, 3: string}, 2: array{0: string, 1: array{0: string}, 2: null}, 3: array{0: string, 1: array{0: string}, 2: null, 3: string}, 4: array{0: string, 1: array{0: string}, 2: string}, 5: array{0: string, 1: array{0: string}, 2: string, 3: string}, 6: array{0: string, 1: array{0: string}, 2: null}, 7: array{0: string, 1: array{0: string}, 2: null, 3: string}, 8: array{0: string, 1: array{0: string}, 2: string}, 9: array{0: string, 1: array{0: string}, 2: string, 3: string}, 10: array{0: string, 1: array{0: string}, 2: null}, 11: array{0: string, 1: array{0: string}, 2: null, 3: string}}
     */
    public function areActiveRoutesDataProvider(): array
    {
        $route_name = 'users.index';
        $deep_route_name = 'frontend.users.show.stats';

        // path, (array) input, result, output (optional) (null)
        return [
            [$route_name, ['users.index'], 'active'],
            [$route_name, ['users.index'], 'hello', 'hello'],
            [$route_name, ['clients.index'], null],
            [$route_name, ['clients.index'], null, 'hello'],

            [$route_name, ['users.*'], 'active'],
            [$route_name, ['users.*'], 'hello', 'hello'],
            [$route_name, ['clients.*'], null],
            [$route_name, ['clients.*'], null, 'hello'],

            [$deep_route_name, ['frontend.users.*'], 'active'],
            [$deep_route_name, ['frontend.users.*'], 'hello', 'hello'],
            [$deep_route_name, ['clients.*'], null],
            [$deep_route_name, ['clients.*'], null, 'hello'],
        ];
    }

    /**
     * @dataProvider areActiveRoutesDataProvider
     *
     * @test
     *
     * @return void
     */
    public function areActiveRoutes($routeName, array $input, $result, $output = null): void
    {
        $this->router->shouldReceive('currentRouteName')->times(1)->andReturn($routeName);

        $this->assertEquals($result, $this->ekko->areActiveRoutes($input, $output));
    }

    /**
     * @return (null|string)[][]
     *
     * @psalm-return array{0: array{0: string, 1: string, 2: string}, 1: array{0: string, 1: string, 2: string, 3: string}, 2: array{0: string, 1: string, 2: null}, 3: array{0: string, 1: string, 2: null, 3: string}, 4: array{0: string, 1: string, 2: string}, 5: array{0: string, 1: string, 2: string, 3: string}, 6: array{0: string, 1: string, 2: null}, 7: array{0: string, 1: string, 2: null, 3: string}}
     */
    public function isActiveURLDataProvider(): array
    {
        $user_index_path = '/users';
        $users_index_query_path = '/users?page=acme';

        // path, input, result, output (optional) (null)
        return [
            [$user_index_path, '/users', 'active'],
            [$user_index_path, '/users', 'hello', 'hello'],
            [$user_index_path, 'users', null],
            [$user_index_path, '/users/preview', null, 'hello'],

            [$users_index_query_path, '/users*', 'active'],
            [$users_index_query_path, '/users*', 'hello', 'hello'],
            [$users_index_query_path, 'users', null],
            [$users_index_query_path, '/users/preview', null, 'hello']
        ];
    }

    /**
     * @dataProvider isActiveURLDataProvider
     *
     * @test
     *
     * @return void
     */
    public function isActiveURL($path, $input, $result, $output = null): void
    {
        $this->request->shouldReceive('getRequestUri')->times(1)->andReturn($path);

        $this->assertEquals($result, $this->ekko->isActiveURL($input, $output));
    }

    /**
     * @return (null|string|string[])[][]
     *
     * @psalm-return array{0: array{0: string, 1: array{0: string}, 2: string}, 1: array{0: string, 1: array{0: string}, 2: string, 3: string}, 2: array{0: string, 1: array{0: string}, 2: null}, 3: array{0: string, 1: array{0: string}, 2: null, 3: string}}
     */
    public function areActiveURLsDataProvider(): array
    {
        $user_index_path = '/users';

        // path, (array) input, result, output (optional) (null)
        return [
            [$user_index_path, ['/users'], 'active'],
            [$user_index_path, ['/users'], 'hello', 'hello'],
            [$user_index_path, ['users'], null],
            [$user_index_path, ['/users/preview'], null, 'hello']
        ];
    }

    /**
     * @dataProvider areActiveURLsDataProvider
     *
     * @test
     *
     * @return void
     */
    public function areActiveURLs($path, array $input, $result, $output = null): void
    {
        $this->request->shouldReceive('getRequestUri')->times(1)->andReturn($path);

        $this->assertEquals($result, $this->ekko->areActiveURLs($input, $output));
    }

    /**
     * @test
     *
     * @return void
     */
    public function it_detects_active_match_in_url(): void
    {
        $this->request->shouldReceive('getRequestUri')->times(4)
            ->andReturn('/somewhere-over-the-rainbow');

        $this->assertEquals("active", $this->ekko->isActiveMatch('over-the-rainbow'));
        $this->assertEquals("hello", $this->ekko->isActiveMatch('over-the-rainbow', "hello"));
        $this->assertEquals(null, $this->ekko->isActiveMatch('under-the-rainbow'));
        $this->assertEquals(null, $this->ekko->isActiveMatch('under-the-rainbow', 'hello'));
    }

    /**
     * @return (null|string)[][]
     *
     * @psalm-return array{0: array{0: string, 1: string, 2: string}, 1: array{0: string, 1: string, 2: string, 3: string}, 2: array{0: string, 1: string, 2: null}, 3: array{0: string, 1: string, 2: null, 3: string}}
     */
    public function isActiveMatchDataProvider(): array
    {
        $article_path = '/somewhere-over-the-rainbow';

        // path, input, result, output (optional) (null)
        return [
            [$article_path, 'over-the-rainbow', 'active'],
            [$article_path, 'over-the-rainbow', 'hello', 'hello'],
            [$article_path, 'under-the-rainbow', null],
            [$article_path, 'under-the-rainbow', null, 'hello'],
        ];
    }

    /**
     * @dataProvider isActiveMatchDataProvider
     *
     * @test
     *
     * @return void
     */
    public function isActiveMatch(string $path, mixed $input, mixed $result, mixed $output = null): void
    {
        $this->request->shouldReceive('getRequestUri')->times(1)->andReturn($path);

        $this->assertEquals($result, $this->ekko->isActiveMatch($input, $output));
    }

    /**
     * @return (null|string|string[])[][]
     *
     * @psalm-return array{0: array{0: string, 1: array{0: string, 1: string}, 2: string}, 1: array{0: string, 1: array{0: string, 1: string}, 2: string, 3: string}, 2: array{0: string, 1: array{0: string, 1: string}, 2: null}, 3: array{0: string, 1: array{0: string, 1: string}, 2: null, 3: string}}
     */
    public function areActiveMatchesDataProvider(): array
    {
        $article_path = '/somewhere-over-the-rainbow';

        // path, (array) input, result, output (optional) (null)
        return [
            [$article_path, ['over-the-rainbow2', 'over*rainbow'], 'active'],
            [$article_path, ['over-the-rainbow2', '/*rainbow'], 'hello', 'hello'],
            [$article_path, ['under-the-rainbow2', '*bowd'], null],
            [$article_path, ['under-the-rainbow2', '/some*bowd'], null, 'hello']
        ];
    }

    /**
     * @dataProvider areActiveMatchesDataProvider
     *
     * @test
     *
     * @return void
     */
    public function areActiveMatches(string $path, array $input, mixed $result, mixed $output = null): void
    {
        $this->request->shouldReceive('getRequestUri')->times(2)->andReturn($path);

        $this->assertEquals($result, $this->ekko->areActiveMatches($input, $output));
    }

    /**
     * @test
     *
     * @return void
     */
    public function globalHelpers(): void
    {
        $this->assertFalse(function_exists('is_active_url'));
        $this->assertFalse(function_exists('isActiveURL'));
        $this->assertFalse(function_exists('are_active_urls'));
        $this->assertFalse(function_exists('areActiveURLs'));

        $this->assertFalse(function_exists('is_active_route'));
        $this->assertFalse(function_exists('isActiveRoute'));
        $this->assertFalse(function_exists('are_active_routes'));
        $this->assertFalse(function_exists('areActiveRoutes'));

        $this->assertFalse(function_exists('is_active_match'));
        $this->assertFalse(function_exists('isActiveMatch'));
        $this->assertFalse(function_exists('are_active_matches'));
        $this->assertFalse(function_exists('areActiveMatches'));

        // This function gets required in EkkoTest.php file
        // $this->assertFalse(function_exists('is_active'));

        $this->ekko->enableGlobalHelpers();

        $this->assertTrue(function_exists('is_active_url'));
        $this->assertTrue(function_exists('isActiveURL'));
        $this->assertTrue(function_exists('are_active_urls'));
        $this->assertTrue(function_exists('areActiveURLs'));

        $this->assertTrue(function_exists('is_active_route'));
        $this->assertTrue(function_exists('isActiveRoute'));
        $this->assertTrue(function_exists('are_active_routes'));
        $this->assertTrue(function_exists('areActiveRoutes'));

        $this->assertTrue(function_exists('is_active_match'));
        $this->assertTrue(function_exists('isActiveMatch'));
        $this->assertTrue(function_exists('are_active_matches'));
        $this->assertTrue(function_exists('areActiveMatches'));

        $this->assertTrue(function_exists('is_active'));
    }

    /**
     * @test
     *
     * @return void
     */
    public function defaultOutput(): void
    {
        $this->request->shouldReceive('getRequestUri')->times(2)->andReturn('/');

        $this->ekko->setDefaultOutput('highlight');

        $this->assertEquals('highlight', $this->ekko->isActiveURL('/'));
        $this->assertEquals('test', $this->ekko->isActiveURL('/', 'test'));
    }

    /**
     * @test
     *
     * @return void
     */
    public function urlProvider(): void
    {
        $this->assertInstanceOf(LaravelUrlProvider::class, $this->ekko->getUrlProvider());
    }
}
