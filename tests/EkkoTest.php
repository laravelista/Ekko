<?php

use Laravelista\Ekko\Ekko;
use Laravelista\Ekko\Url\GenericUrlProvider;
use PHPUnit\Framework\TestCase;

class EkkoTest extends TestCase
{
    protected Ekko $ekko;

    protected function setUp(): void
    {
        $this->ekko = new Ekko();
    }

    /**
     * @return (null|string|string[])[][]
     *
     * @psalm-return array{0: array{0: string, 1: string, 2: string}, 1: array{0: string, 1: string, 2: null}, 2: array{0: string, 1: string, 2: string}, 3: array{0: string, 1: string, 2: string}, 4: array{0: string, 1: array{0: string, 1: string}, 2: string}, 5: array{0: string, 1: string, 2: null}, 6: array{0: string, 1: string, 2: null}, 7: array{0: string, 1: array{0: string, 1: string}, 2: null}, 8: array{0: string, 1: string, 2: string}, 9: array{0: string, 1: string, 2: string}, 10: array{0: string, 1: string, 2: string}, 11: array{0: string, 1: string, 2: string}, 12: array{0: string, 1: string, 2: string}, 13: array{0: string, 1: string, 2: string}, 14: array{0: string, 1: array{0: string, 1: string}, 2: string}, 15: array{0: string, 1: string, 2: null}, 16: array{0: string, 1: string, 2: null}, 17: array{0: string, 1: string, 2: null}, 18: array{0: string, 1: array{0: string, 1: string}, 2: null}, 19: array{0: string, 1: string, 2: string}, 20: array{0: string, 1: string, 2: string}, 21: array{0: string, 1: string, 2: string}, 22: array{0: string, 1: string, 2: string}, 23: array{0: string, 1: array{0: string, 1: string}, 2: string}, 24: array{0: string, 1: array{0: string, 1: string}, 2: string, 3: string}, 25: array{0: string, 1: string, 2: null}, 26: array{0: string, 1: string, 2: null}, 27: array{0: string, 1: string, 2: null}, 28: array{0: string, 1: array{0: string, 1: string}, 2: null}, 29: array{0: string, 1: string, 2: string}, 30: array{0: string, 1: string, 2: string}, 31: array{0: string, 1: string, 2: string}, 32: array{0: string, 1: string, 2: null}, 33: array{0: string, 1: string, 2: string}, 34: array{0: string, 1: string, 2: string, 3: string}, 35: array{0: string, 1: string, 2: string}, 36: array{0: string, 1: string, 2: string}, 37: array{0: string, 1: string, 2: string}, 38: array{0: string, 1: string, 2: string}, 39: array{0: string, 1: string, 2: null}, 40: array{0: string, 1: string, 2: null}}
     */
    public function isActiveDataProvider(): array
    {
        $root_path = '/';
        $user_edit_path = '/user/3/edit';
        $article_path = '/article/a-brown-fox-jumps-over-a-burning-bridge';
        $portfolio_search_path = '/portfolio?client=acme&year=2019';
        $index_query_path = '/index.php?page=something&id=2';

        // routeName, input, result, output (optional) (null)
        return [
            ['', '', 'active'],
            ['', '/', null],

            [$root_path, '/', 'active'],
            [$root_path, '*', 'active'],
            [$root_path, ['/', '*'], 'active'],
            [$root_path, '', null],
            [$root_path, '/test', null],
            [$root_path, ['/test', ''], null],

            [$user_edit_path, '/user/3/edit', 'active'],
            [$user_edit_path, '/user/3/edit*', 'active'],
            [$user_edit_path, '/user/*/edit', 'active'],
            [$user_edit_path, '/user/3/*', 'active'],
            [$user_edit_path, '/user/*', 'active'],
            [$user_edit_path, '/user*', 'active'],
            [$user_edit_path, ['/user/3/edit', '/user/*/edit'], 'active'],
            [$user_edit_path, '/user', null],
            [$user_edit_path, '/user/3', null],
            [$user_edit_path, '/user/3/', null],
            [$user_edit_path, ['/user', '/user/3'], null],

            [$article_path, '*fox*', 'active'],
            [$article_path, '*fox*bridge', 'active'],
            [$article_path, '*bridge', 'active'],
            [$article_path, '/article/*', 'active'],
            [$article_path, ['*fox*', '*bridge'], 'active'],
            [$article_path, ['*fox*', '*bridge'], 'hello', 'hello'],
            [$article_path, '/article', null],
            [$article_path, '/a-brown-fox', null],
            [$article_path, 'bridge', null],
            [$article_path, ['/article', '/a-brown-fox'], null],

            [$portfolio_search_path, '/portfolio*', 'active'],
            [$portfolio_search_path, '/portfolio*client*', 'active'],
            [$portfolio_search_path, '/portfolio', 'active'],
            [$portfolio_search_path, '/portfolio&client=', null],

            [$index_query_path, '/index.php*', 'active'],
            [$index_query_path, '/index.php*', 'highlight', 'highlight'],
            [$index_query_path, '/index.php*page*id*', 'active'],
            [$index_query_path, '/index.php?page=something*', 'active'],
            [$index_query_path, '/index.php', 'active'],
            [$index_query_path, '/*', 'active'],
            [$index_query_path, '/', null],
            [$index_query_path, '/index.php?page=something', null],
        ];
    }

    /**
     * @test
     *
     * @dataProvider isActiveDataProvider
     *
     * @return void
     */
    public function isActive($path, $input, $result, $output = null): void
    {
        $_SERVER['REQUEST_URI'] = $path;

        $this->assertEquals($result, $this->ekko->isActive($input, $output));
    }

    /**
     * @test
     *
     * @return void
     */
    public function globalHelpers(): void
    {
        $_SERVER['REQUEST_URI'] = '/';

        $this->ekko->enableGlobalHelpers();

        $this->assertEquals('active', is_active('/'));
    }

    /**
     * @test
     *
     * @return void
     */
    public function defaultOutput(): void
    {
        $_SERVER['REQUEST_URI'] = '/';

        $this->ekko->setDefaultOutput('highlight');

        $this->assertEquals('highlight', $this->ekko->isActive('/'));
        $this->assertEquals('test', $this->ekko->isActive('/', 'test'));
    }

    /**
     * @test
     *
     * @return void
     */
    public function urlProvider(): void
    {
        $this->assertInstanceOf(GenericUrlProvider::class, $this->ekko->getUrlProvider());
    }
}
