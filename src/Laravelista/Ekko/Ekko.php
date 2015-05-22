<?php  namespace Laravelista\Ekko;

use Route;
use URL;

class Ekko {

    /*
    |--------------------------------------------------------------------------
    | Detect Active Route
    |--------------------------------------------------------------------------
    |
    | Compare given route with current route and return output if they match.
    | Very useful for navigation, marking if the link is active.
    |
    */
    public function isActiveRoute($route, $output = "active")
    {
        if(Route::currentRouteName() == $route) return $output;

        return null;
    }

    /*
    |--------------------------------------------------------------------------
    | Detect Active URL (use route instead)
    |--------------------------------------------------------------------------
    |
    | Compare given url with current url and return output if they match.
    | Very useful for navigation, marking if the link is active.
    |
    */
    public function isActiveURL($url, $output = "active")
    {
        if(URL::current() == url($url)) return $output;

        return null;
    }

    /*
    |--------------------------------------------------------------------------
    | Detect Active Match (use route instead)
    |--------------------------------------------------------------------------
    |
    | Compare given string with current url and return output if they match.
    | Very useful for navigation, marking if the link is active.
    |
    */
    public function isActiveMatch($string, $output = "active")
    {
        if(strpos(URL::current(), $string)) return $output;

        return null;
    }

    /*
    |--------------------------------------------------------------------------
    | Detect Active Routes
    |--------------------------------------------------------------------------
    |
    | Compare given routes with current route and return output if they match.
    | Very useful for navigation, marking if the link is active.
    |
    */
    public function areActiveRoutes(Array $routes, $output = "active")
    {
        foreach($routes as $route)
        {
            if(Route::currentRouteName() == $route) return $output;
        }

        return null;
    }

    /*
    |--------------------------------------------------------------------------
    | Detect Active URLs (use routes instead)
    |--------------------------------------------------------------------------
    |
    | Compare given url with current url and return output if they match.
    | Very useful for navigation, marking if the link is active.
    |
    */
    public function areActiveURLs(Array $urls, $output = "active")
    {
        foreach($urls as $url)
        {
            if(URL::current() == url($url)) return $output;
        }

        return null;
    }

}