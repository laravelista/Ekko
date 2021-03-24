<?php

use Illuminate\Support\Facades\App;
use Laravelista\Ekko\Frameworks\Laravel\Ekko;

/**
 * Route
 */

if (!function_exists('isActiveRoute')) {
    /**
     * @param array|string $input URL or array of URLs.
     * @param null|mixed $output User given output.
     * @return mixed|null Either user given output or the default output value or null.
     */
    function isActiveRoute(array|string $input, mixed $output = null): mixed
    {
        return App::resolve(Ekko::class)->isActiveRoute($input, $output);
    }
}

if (!function_exists('is_active_route')) {
    /**
     * @param array|string $input URL or array of URLs.
     * @param null|mixed $output User given output.
     * @return mixed|null Either user given output or the default output value or null.
     */
    function is_active_route(array|string $input, mixed $output = null): mixed
    {
        return App::resolve(Ekko::class)->isActiveRoute($input, $output);
    }
}

if (!function_exists('areActiveRoutes')) {
    /**
     * @param array|string $input URL or array of URLs.
     * @param null|mixed $output User given output.
     * @return mixed|null Either user given output or the default output value or null.
     */
    function areActiveRoutes(array|string $input, mixed $output = null): mixed
    {
        return App::resolve(Ekko::class)->isActiveRoute($input, $output);
    }
}

if (!function_exists('are_active_routes')) {
    /**
     * @param array|string $input URL or array of URLs.
     * @param null|mixed $output User given output.
     * @return mixed|null Either user given output or the default output value or null.
     */
    function are_active_routes(array|string $input, mixed $output = null): mixed
    {
        return App::resolve(Ekko::class)->isActiveRoute($input, $output);
    }
}

/**
 * URL
 */

if (!function_exists('is_active')) {
    /**
     * Backward compatibility with v2.
     *
     * @param array|string $input URL or array of URLs.
     * @param null|mixed $output User given output.
     * @return mixed|null Either user given output or the default output value or null.
     */
    function is_active(array|string $input, mixed $output = null): mixed
    {
        return App::resolve(Ekko::class)->isActive($input, $output);
    }
}

if (!function_exists('isActiveURL')) {
    /**
     * @param array|string $input URL or array of URLs.
     * @param null|mixed $output User given output.
     * @return mixed|null Either user given output or the default output value or null.
     */
    function isActiveURL(array|string $input, mixed $output = null): mixed
    {
        return App::resolve(Ekko::class)->isActive($input, $output);
    }
}

if (!function_exists('is_active_url')) {
    /**
     * @param array|string $input URL or array of URLs.
     * @param null|mixed $output User given output.
     * @return mixed|null Either user given output or the default output value or null.
     */
    function is_active_url(array|string $input, mixed $output = null): mixed
    {
        return App::resolve(Ekko::class)->isActive($input, $output);
    }
}

if (!function_exists('areActiveURLs')) {
    /**
     * @param array|string $input URL or array of URLs.
     * @param null|mixed $output User given output.
     * @return mixed|null Either user given output or the default output value or null.
     */
    function areActiveURLs(array|string $input, mixed $output = null): mixed
    {
        return App::resolve(Ekko::class)->isActive($input, $output);
    }
}

if (!function_exists('are_active_urls')) {
    /**
     * @param array|string $input URL or array of URLs.
     * @param null|mixed $output User given output.
     * @return mixed|null Either user given output or the default output value or null.
     */
    function are_active_urls(array|string $input, mixed $output = null): mixed
    {
        return App::resolve(Ekko::class)->isActive($input, $output);
    }
}

/**
 * Match
 */

if (!function_exists('isActiveMatch')) {
    /**
     * @param array|string $input URL or array of URLs.
     * @param null|mixed $output User given output.
     * @return mixed|null Either user given output or the default output value or null.
     */
    function isActiveMatch(array|string $input, mixed $output = null): mixed
    {
        return App::resolve(Ekko::class)->isActive($input, $output);
    }
}

if (!function_exists('is_active_match')) {
    /**
     * @param array|string $input URL or array of URLs.
     * @param null|mixed $output User given output.
     * @return mixed|null Either user given output or the default output value or null.
     */
    function is_active_match(array|string $input, mixed $output = null): mixed
    {
        return App::resolve(Ekko::class)->isActive($input, $output);
    }
}

if (!function_exists('AreActiveMatches')) {
    /**
     * @param array|string $input URL or array of URLs.
     * @param null|mixed $output User given output.
     * @return mixed|null Either user given output or the default output value or null.
     */
    function AreActiveMatches(array|string $input, mixed $output = null): mixed
    {
        return App::resolve(Ekko::class)->isActive($input, $output);
    }
}

if (!function_exists('are_active_matches')) {
    /**
     * @param array|string $input URL or array of URLs.
     * @param null|mixed $output User given output.
     * @return mixed|null Either user given output or the default output value or null.
     */
    function are_active_matches(array|string $input, mixed $output = null): mixed
    {
        return App::resolve(Ekko::class)->isActive($input, $output);
    }
}
