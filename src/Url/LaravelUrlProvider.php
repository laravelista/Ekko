<?php

namespace Laravelista\Ekko\Url;

use Illuminate\Http\Request;

class LaravelUrlProvider implements UrlProviderInterface
{
    /**
     * @var Request $request
     */
    protected $request;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * It returns the current URL with query parameters as string.
     *
     * eg. /user/1/edit, /index.php?page=about or /portfolio?year=2019
     *
     * @return string
     */
    public function current(): string
    {
        return $this->request->getRequestUri();
    }
}