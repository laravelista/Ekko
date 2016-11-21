<?php

use \Laravelista\Ekko\Ekko;

if (!function_exists('isActiveRoute')) {
    /**
     * @param        $routeName
     * @param string $output
     *
     * @return string
     */
    function isActiveRoute($routeName, $output = "active")
    {
        return app(Ekko::class)->isActiveRoute($routeName, $output);
    }
}

if (!function_exists('isActiveURL')) {
    /**
     * @param        $url
     * @param string $output
     *
     * @return string
     */
    function isActiveURL($url, $output = "active")
    {
        return app(Ekko::class)->isActiveURL($url, $output);
    }
}

if (!function_exists('isActiveMatch')) {
    /**
     * @param        $string
     * @param string $output
     *
     * @return string
     */
    function isActiveMatch($string, $output = "active")
    {
        return app(Ekko::class)->isActiveMatch($string, $output);
    }
}

if (!function_exists('areActiveRoutes')) {
    /**
     * @param array  $routeNames
     * @param string $output
     *
     * @return string
     */
    function areActiveRoutes(array $routeNames, $output = "active")
    {
        return app(Ekko::class)->areActiveRoutes($routeNames, $output);
    }
}

if (!function_exists('areActiveURLs')) {
    /**
     * @param array  $urls
     * @param string $output
     *
     * @return string
     */
    function areActiveURLs(array $urls, $output = "active")
    {
        return app(Ekko::class)->areActiveURLs($urls, $output);
    }
}
