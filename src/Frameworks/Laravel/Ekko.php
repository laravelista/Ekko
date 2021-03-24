<?php

namespace Laravelista\Ekko\Frameworks\Laravel;

use Illuminate\Routing\Router;

class Ekko extends \Laravelista\Ekko\Ekko
{
    /**
     * @param Router $router
     */
    public function __construct(protected Router $router)
    {
        parent::__construct();    
    }

    /**
     * This static method uses `require_once` to
     * include global helper functions. By default
     * global functions are not enabled.
     *
     * This includes Laravel specific helpers.
     *
     * @return void
     */
    static public function enableGlobalHelpers()
    {
        require_once(__DIR__.'/Helpers.php');
    }

    /**
     * Compares given route name with current route name.
     * Any section of the route name can be replaced with a * wildcard.
     * eg. user.*
     *
     * @param string|array $input
     * @param mixed|null $output
     * @return mixed|null
     */
    public function isActiveRoute($input, $output = null)
    {
        if (is_array($input)) {
            return $this->displayOutput($this->inArray($input, __FUNCTION__), $output);
        }

        $regex = '/^' . str_replace(preg_quote('*'), '.*?', preg_quote($input, '/')) . '$/';

        return $this->displayOutput((bool) preg_match($regex, $this->router->currentRouteName() ?? ''), $output);
    }

    /**
     * It passes the input array to the isActiveRoute method.
     *
     * @param array $input
     * @param mixed|null $output
     * @return mixed|null
     */
    public function areActiveRoutes(array $input, $output = null)
    {
        return $this->isActiveRoute($input, $output);
    }

    /**
     * It passes the input to the isActive
     * method on the parent class.
     *
     * @param string|array $input
     * @param mixed|null $output
     * @return mixed|null
     */
    public function isActiveURL($input, $output = null)
    {
        return $this->isActive($input, $output);
    }

    /**
     * It passes the input array to the
     * isActive method on the parent class.
     *
     * @param array $input
     * @param mixed|null $output
     * @return mixed|null
     */
    public function areActiveURLs(array $input, $output = null)
    {
        return $this->isActive($input, $output);
    }

    /**
     * Every Url of input is enclosed with wildcard '*'
     * before being passed to the isActive method
     * on the parent class.
     *
     * @param string|array $input
     * @param mixed|null $output
     * @return mixed|null
     */
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

    /**
     * It passes the input array to the isActiveMatch method.
     *
     * @param array $input
     * @param mixed|null $output
     * @return mixed|null
     */
    public function areActiveMatches(array $input, $output = null)
    {
        return $this->isActiveMatch($input, $output);
    }
}
