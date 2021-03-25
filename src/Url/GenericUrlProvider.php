<?php

namespace Laravelista\Ekko\Url;

class GenericUrlProvider implements UrlProviderInterface
{
    /**
     * It returns the current URL with query parameters as string.
     *
     * eg. /user/1/edit, /index.php?page=about or /portfolio?year=2019
     */
    public function current(): string
    {
        // with query parameters
        return $_SERVER['REQUEST_URI'];

        // without query parameters
        // return strtok($_SERVER['REQUEST_URI'], '?');
    }
}
