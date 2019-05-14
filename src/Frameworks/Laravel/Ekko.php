<?php

namespace Laravelista\Ekko\Frameworks\Laravel;

use Illuminate\Routing\Router;

class Ekko extends \Laravelista\Ekko\Ekko
{
    protected $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function enableGlobalHelpers()
    {
        require_once(__DIR__.'/Helpers.php');
    }

    public function isActiveRoute($input, $output = null)
    {
        if (is_array($input)) {
            return $this->displayOutput($this->inArray($input, __FUNCTION__), $output);
        }

        $regex = '/^' . str_replace(preg_quote('*'), '[^.]*?', preg_quote($input, '/')) . '/';

        return $this->displayOutput(preg_match($regex, $this->router->currentRouteName()), $output);
    }

    public function areActiveRoutes(array $input, $output = null)
    {
        return $this->isActiveRoute($input, $output);
    }

    public function isActiveURL($input, $output = null)
    {
        return $this->isActive($input, $output);
    }

    public function areActiveURLs(array $input, $output = null)
    {
        return $this->isActive($input, $output);
    }

    public function isActiveMatch($input, $output = null)
    {
        if (is_array($input)) {
            $input = array_map(function ($url) {
                return "*{$url}*";
            }, $input);
        } else {
            $input = "*{$input}*";
        }

        return $this->isActive($input, $output);
    }

    public function areActiveMatches(array $input, $output = null)
    {
        return $this->isActive($input, $output);
    }
}
