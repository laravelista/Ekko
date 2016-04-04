<?php namespace Laravelista\Ekko;

use Route;
use URL;

class Ekko {

    /**
     * Compares given route name with current route name.
     * Any section of the route name can be replaced with a * wildcard.
     * Example: user.*
     *
     * @param  string  $routeName
     * @param  string  $output
     * @return boolean
     */
    public function isActiveRoute($routeName, $output = "active")
    {
        if(strpos($routeName, '*') !== false) {
            // Quote all RE characters, then undo the quoted '*' characters to match any
            // sequence of non-'.' characters.
            $regex = '/^' . str_replace(preg_quote('*'), '[^.]*?', preg_quote($routeName, '/')) . '$/';
            if (preg_match($regex, Route::currentRouteName())) return $output;
        } elseif(Route::currentRouteName() == $routeName) {
            return $output;
        }

        return null;
    }

    /**
     * Compares given URL with current URL.
     *
     * @param  string  $url
     * @param  string  $output
     * @return boolean
     */
    public function isActiveURL($url, $output = "active")
    {
        if(URL::current() == url($url)) return $output;

        return null;
    }

    /**
     * Detects if the given string is found in the current URL.
     *
     * @param  string  $string
     * @param  string  $output
     * @return boolean
     */
    public function isActiveMatch($string, $output = "active")
    {
        if(strpos(URL::current(), $string)) return $output;

        return null;
    }

    /**
     * Compares given array of route names with current route name.
     *
     * @param  array  $routeNames
     * @param  string $output
     * @return boolean
     */
    public function areActiveRoutes(array $routeNames, $output = "active")
    {
        foreach($routeNames as $routeName)
        {
            if(Route::currentRouteName() == $routeName) return $output;
        }

        return null;
    }

    /**
     * Compares given array of URLs with current URL.
     *
     * @param  array  $urls
     * @param  string $output
     * @return boolean
     */
    public function areActiveURLs(array $urls, $output = "active")
    {
        foreach($urls as $url)
        {
            if(URL::current() == url($url)) return $output;
        }

        return null;
    }

}
