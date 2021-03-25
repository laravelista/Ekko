<?php

namespace Laravelista\Ekko\Frameworks\Laravel;

use Illuminate\Routing\Router;

class Ekko extends \Laravelista\Ekko\Ekko
{
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
     */
    public static function enableGlobalHelpers(): void
    {
        require_once(__DIR__.'/Helpers.php');
    }

    /**
     * Compares given route name with current route name.
     * Any section of the route name can be replaced with a * wildcard.
     * eg. user.*
     */
    public function isActiveRoute(string|array $input, mixed $output = null): mixed
    {
        if (is_array($input)) {
            return $this->displayOutput(
                result: $this->inArray(
                    input: $input,
                    methodName: __FUNCTION__
                ),
                output: $output
            );
        }

        $regex = '/^' .
            str_replace(
                search: preg_quote('*'),
                replace: '.*?',
                subject: preg_quote(
                    str: $input,
                    delimiter: '/'
                )
            ) .
            '$/';

        return $this->displayOutput(
            result: (bool) preg_match(
                pattern: $regex,
                subject: $this->router->currentRouteName() ?? ''
            ),
            output: $output
        );
    }

    /**
     * It passes the input array to the isActiveRoute method.
     */
    public function areActiveRoutes(array $input, mixed $output = null): mixed
    {
        return $this->isActiveRoute($input, $output);
    }

    /**
     * It passes the input to the isActive
     * method on the parent class.
     */
    public function isActiveURL(string|array $input, mixed $output = null): mixed
    {
        return $this->isActive($input, $output);
    }

    /**
     * It passes the input array to the
     * isActive method on the parent class.
     */
    public function areActiveURLs(array $input, mixed $output = null): mixed
    {
        return $this->isActive($input, $output);
    }

    /**
     * Every Url of input is enclosed with wildcard '*'
     * before being passed to the isActive method
     * on the parent class.
     */
    public function isActiveMatch(string|array $input, mixed $output = null): mixed
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
     */
    public function areActiveMatches(array $input, mixed $output = null): mixed
    {
        return $this->isActiveMatch($input, $output);
    }
}
