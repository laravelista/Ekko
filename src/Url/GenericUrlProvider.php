<?php

namespace Laravelista\Ekko\Url;

class GenericUrlProvider implements UrlProviderInterface
{
    public function current(): string
    {
        // with query parameters
        return $_SERVER['REQUEST_URI'];

        // without query parameters
        // return strtok($_SERVER['REQUEST_URI'], '?');
    }
}