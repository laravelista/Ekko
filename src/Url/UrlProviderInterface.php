<?php

namespace Laravelista\Ekko\Url;

/**
 * All Url providers must implement this interface.
 */
interface UrlProviderInterface
{
    /**
     * It returns the current URL with query parameters as string.
     *
     * eg. /user/1/edit, /index.php?page=about or /portfolio?year=2019
     */
    public function current(): string;
}
