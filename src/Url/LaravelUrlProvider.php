<?php

namespace Laravelista\Ekko\Url;

use Illuminate\Routing\UrlGenerator as Url;

class LaravelUrlProvider implements UrlProviderInterface
{
    protected $url;

    public function __construct(Url $url)
    {
        $this->url = $url;
    }

    public function current(): string
    {
        return $this->url->current();
    }
}