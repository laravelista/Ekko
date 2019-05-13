<?php

namespace Laravelista\Ekko\Url;

class StandardUrlProvider implements UrlProviderInterface
{
    public function current(): string
    {
        return strtok($_SERVER['REQUEST_URI'], '?');
    }
}