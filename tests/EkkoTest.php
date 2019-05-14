<?php

use PHPUnit\Framework\TestCase;
use Laravelista\Ekko\Ekko;

class EkkoTest extends TestCase
{
    protected $ekko;

    protected function setUp(): void
    {
        $this->ekko = new Ekko;
    }

    public function testIsActiveRoot()
    {
        $_SERVER['REQUEST_URI'] = '/';

        $this->assertTrue($this->ekko->isActive('/', true));
        $this->assertTrue($this->ekko->isActive('*', true)); // you can do this, but why?
        $this->assertTrue($this->ekko->isActive(['/', '*'], true));

        $this->assertNull($this->ekko->isActive('/test'));
        $this->assertNull($this->ekko->isActive(''));
        $this->assertNull($this->ekko->isActive(['/test', '']));
    }

    public function testIsActiveWildcards()
    {
        $_SERVER['REQUEST_URI'] = '/user/3/edit';

        $this->assertTrue($this->ekko->isActive('/user/3/edit', true));
        $this->assertTrue($this->ekko->isActive('/user/*/edit', true));
        $this->assertTrue($this->ekko->isActive('/user/3/*', true));
        $this->assertTrue($this->ekko->isActive('/user/*', true));
        $this->assertTrue($this->ekko->isActive('/user*', true));
        $this->assertTrue($this->ekko->isActive(['/user/3/edit', '/user/*/edit'], true));

        $this->assertNull($this->ekko->isActive('/user'));
        $this->assertNull($this->ekko->isActive('/user/3'));
        $this->assertNull($this->ekko->isActive('/user/3/'));
        $this->assertNull($this->ekko->isActive(['/user', '/user/3']));
    }

    public function testIsActiveMatches()
    {
        $_SERVER['REQUEST_URI'] = '/article/a-brown-fox-jumps-over-a-burning-bridge';

        $this->assertTrue($this->ekko->isActive('*fox*', true));
        $this->assertTrue($this->ekko->isActive('*fox*bridge', true));
        $this->assertTrue($this->ekko->isActive('*bridge', true));
        $this->assertTrue($this->ekko->isActive('/article/*', true));
        $this->assertTrue($this->ekko->isActive(['*fox*', '*bridge'], true));

        $this->assertNull($this->ekko->isActive('/article'));
        $this->assertNull($this->ekko->isActive('/a-brown-fox'));
        $this->assertNull($this->ekko->isActive('bridge'));
        $this->assertNull($this->ekko->isActive(['/article', '/a-brown-fox']));
    }

    public function testGlobalHelpers()
    {
        $_SERVER['REQUEST_URI'] = '/';

        // TODO: Need to figure out why this works.
        // Ekko::enableGlobalHelpers();

        $this->ekko->enableGlobalHelpers();

        $this->assertTrue(is_active('/', true));
    }
}