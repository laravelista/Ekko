<?php

namespace Laravelista\Ekko\Frameworks;

use Laravelista\Ekko\Ekko;
use Illuminate\Routing\Router;

class LaravelEkko extends Ekko
{
    protected $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function isActiveRoute($input, $output = null)
    {
        if (is_array($input)) {
            return count(array_filter($input, '__FUNCTION__')) > 0 ? $output : null;
        }

        $regex = '/^' . str_replace(preg_quote('*'), '[^.]*?', preg_quote($input, '/')) . '$/';

        return preg_match($regex, $this->router->currentRouteName()) ? $output : null;
    }
}
