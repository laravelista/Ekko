<?php

use PHPUnit\Framework\TestCase;

class IsActiveTest extends TestCase
{
    public function testRoot()
    {
        $_SERVER['REQUEST_URI'] = '/';

        $this->assertTrue(is_active('/', true));
        $this->assertTrue(is_active('*', true)); // you can do this, but why?

        $this->assertNull(is_active('/test'));
        $this->assertNull(is_active(''));
    }

    public function testWildcards()
    {
        $_SERVER['REQUEST_URI'] = '/user/3/edit';

        $this->assertTrue(is_active('/user/3/edit', true));
        $this->assertTrue(is_active('/user/*/edit', true));
        $this->assertTrue(is_active('/user/3/*', true));
        $this->assertTrue(is_active('/user/*', true));
        $this->assertTrue(is_active('/user*', true));

        $this->assertNull(is_active('/user'));
        $this->assertNull(is_active('/user/3'));
        $this->assertNull(is_active('/user/3/'));
    }

    public function testMatches()
    {
        $_SERVER['REQUEST_URI'] = '/article/a-brown-fox-jumps-over-a-burning-bridge';

        $this->assertTrue(is_active('*fox*', true));
        $this->assertTrue(is_active('*fox*bridge', true));
        $this->assertTrue(is_active('*bridge', true));
        $this->assertTrue(is_active('/article/*', true));

        $this->assertNull(is_active('/article'));
        $this->assertNull(is_active('/a-brown-fox'));
        $this->assertNull(is_active('bridge'));
    }
}