<?php

use \Laravelista\Ekko\Frameworks\Laravel\Ekko;

/**
 * Route
 */

if (!function_exists('isActiveRoute')) {
    function isActiveRoute($routeName, $output = null)
    {
        return app(Ekko::class)->isActiveRoute($routeName, $output);
    }
}

if (!function_exists('is_active_route')) {
    function is_active_route($routeName, $output = null)
    {
        return app(Ekko::class)->isActiveRoute($routeName, $output);
    }
}

if (!function_exists('areActiveRoutes')) {
    function areActiveRoutes(array $input, $output = null)
    {
        return app(Ekko::class)->isActiveRoute($input, $output);
    }
}

if (!function_exists('are_active_routes')) {
    function are_active_routes(array $input, $output = null)
    {
        return app(Ekko::class)->isActiveRoute($input, $output);
    }
}

/**
 * URL
 */

if (!function_exists('isActiveURL')) {
    function isActiveURL($url, $output = null)
    {
        return app(Ekko::class)->isActive($url, $output);
    }
}

if (!function_exists('is_active_url')) {
    function is_active_url($url, $output = null)
    {
        return app(Ekko::class)->isActive($url, $output);
    }
}

if (!function_exists('areActiveURLs')) {
    function areActiveURLs(array $input, $output = null)
    {
        return app(Ekko::class)->isActive($input, $output);
    }
}

if (!function_exists('are_active_urls')) {
    function are_active_urls(array $input, $output = null)
    {
        return app(Ekko::class)->isActive($input, $output);
    }
}

/**
 * Match
 */

if (!function_exists('isActiveMatch')) {
    function isActiveMatch($input, $output = null)
    {
        return app(Ekko::class)->isActive($input, $output);
    }
}

if (!function_exists('is_active_match')) {
    function is_active_match($input, $output = null)
    {
        return app(Ekko::class)->isActive($input, $output);
    }
}

if (!function_exists('AreActiveMatches')) {
    function AreActiveMatches($input, $output = null)
    {
        return app(Ekko::class)->isActive($input, $output);
    }
}

if (!function_exists('are_active_matches')) {
    function are_active_matches($input, $output = null)
    {
        return app(Ekko::class)->isActive($input, $output);
    }
}