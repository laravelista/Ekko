<?php

use PHPUnit\Framework\TestCase;
use Laravelista\Ekko\Ekko;
use Laravelista\Ekko\Url\GenericUrlProvider;

class EkkoTest extends TestCase
{
    protected $ekko;

    protected function setUp(): void
    {
        $this->ekko = new Ekko;
    }

    public function isActiveDataProvider()
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
     * @dataProvider isActiveDataProvider
     */
    public function isActive($path, $input, $result, $output = null)
    {
        $_SERVER['REQUEST_URI'] = $path;

        $this->assertEquals($result, $this->ekko->isActive($input, $output));
    }

    /**
     * @test
     */
    public function globalHelpers()
    {
        $_SERVER['REQUEST_URI'] = '/';

        $this->ekko->enableGlobalHelpers();

        $this->assertEquals('active', is_active('/'));
    }

    /**
     * @test
     */
    public function defaultOutput()
    {
        $_SERVER['REQUEST_URI'] = '/';

        $this->ekko->setDefaultOutput('highlight');

        $this->assertEquals('highlight', $this->ekko->isActive('/'));
        $this->assertEquals('test', $this->ekko->isActive('/', 'test'));
    }

    /**
     * @test
     */
    public function urlProvider()
    {
        $this->assertInstanceOf(GenericUrlProvider::class, $this->ekko->getUrlProvider());
    }
}