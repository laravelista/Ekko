<?php

namespace Laravelista\Ekko\Url;

use Illuminate\Http\Request;

class LaravelUrlProvider implements UrlProviderInterface
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function current(): string
    {
        $path = $this->request->getBasePath();

        return empty($path) ? '/' : $path;
    }
}