<?php namespace Laravelista\Ekko\Facades;

use Illuminate\Support\Facades\Facade;
use Laravelista\Ekko\Ekko;

class Ekko extends Facade
{

    protected static function getFacadeAccessor()
    {
        return Ekko::class;
    }

}
