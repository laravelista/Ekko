<?php

namespace Laravelista\Ekko\Frameworks\Laravel;

use Laravelista\Ekko\Ekko as EkkoCore;
use Illuminate\Routing\Router;

class Ekko extends EkkoCore
{
    protected $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    static public function enableGlobalHelpers()
    {
        require_once(__DIR__.'/Helpers.php');

        parent::enableGlobalHelpers();
    }

    public function isActiveRoute($input, $output = null)
    {
        if (is_array($input)) {
            return $this->displayOutput($this->inArray($input, __FUNCTION__), $output);
        }

        $regex = '/^' . str_replace(preg_quote('*'), '[^.]*?', preg_quote($input, '/')) . '$/';

        return $this->displayOutput(preg_match($regex, $this->router->currentRouteName()), $output);
    }
}
