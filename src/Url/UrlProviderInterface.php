<?php

namespace Laravelista\Ekko\Url;

interface UrlProviderInterface
{
    public function current(): string;
}
