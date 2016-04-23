<?php namespace Laravelista\Ekko\Facades;

use Illuminate\Support\Facades\Facade;

class Ekko extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Laravelista\Ekko\Ekko::class;
    }
}
