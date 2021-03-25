<?php

use Illuminate\Support\Facades\App;
use Laravelista\Ekko\Frameworks\Laravel\Ekko;

/**
 * Route
 */

if (!function_exists('isActiveRoute')) {
    function isActiveRoute(array|string $input, mixed $output = null): mixed
    {
        return App::make(Ekko::class)->isActiveRoute($input, $output);
    }
}

if (!function_exists('is_active_route')) {
    function is_active_route(array|string $input, mixed $output = null): mixed
    {
        return App::make(Ekko::class)->isActiveRoute($input, $output);
    }
}

if (!function_exists('areActiveRoutes')) {
    function areActiveRoutes(array|string $input, mixed $output = null): mixed
    {
        return App::make(Ekko::class)->isActiveRoute($input, $output);
    }
}

if (!function_exists('are_active_routes')) {
    function are_active_routes(array|string $input, mixed $output = null): mixed
    {
        return App::make(Ekko::class)->isActiveRoute($input, $output);
    }
}

/**
 * URL
 */

if (!function_exists('is_active')) {
    /**
     * Backward compatibility with v2.
     */
    function is_active(array|string $input, mixed $output = null): mixed
    {
        return App::make(Ekko::class)->isActive($input, $output);
    }
}

if (!function_exists('isActiveURL')) {
    function isActiveURL(array|string $input, mixed $output = null): mixed
    {
        return App::make(Ekko::class)->isActive($input, $output);
    }
}

if (!function_exists('is_active_url')) {
    function is_active_url(array|string $input, mixed $output = null): mixed
    {
        return App::make(Ekko::class)->isActive($input, $output);
    }
}

if (!function_exists('areActiveURLs')) {
    function areActiveURLs(array|string $input, mixed $output = null): mixed
    {
        return App::make(Ekko::class)->isActive($input, $output);
    }
}

if (!function_exists('are_active_urls')) {
    function are_active_urls(array|string $input, mixed $output = null): mixed
    {
        return App::make(Ekko::class)->isActive($input, $output);
    }
}

/**
 * Match
 */

if (!function_exists('isActiveMatch')) {
    function isActiveMatch(array|string $input, mixed $output = null): mixed
    {
        return App::make(Ekko::class)->isActive($input, $output);
    }
}

if (!function_exists('is_active_match')) {
    function is_active_match(array|string $input, mixed $output = null): mixed
    {
        return App::make(Ekko::class)->isActive($input, $output);
    }
}

if (!function_exists('AreActiveMatches')) {
    function AreActiveMatches(array|string $input, mixed $output = null): mixed
    {
        return App::make(Ekko::class)->isActive($input, $output);
    }
}

if (!function_exists('are_active_matches')) {
    function are_active_matches(array|string $input, mixed $output = null): mixed
    {
        return App::make(Ekko::class)->isActive($input, $output);
    }
}
