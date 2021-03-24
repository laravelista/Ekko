<?php

use Laravelista\Ekko\Ekko;

if (!function_exists('is_active')) {
    /**
     * @param array|string $input URL or array of URLs.
     * @param null|mixed $output User given output.
     * @return mixed|null Either user given output or the default output value or null.
     */
    function is_active(array|string $input, $output = null)
    {
        return (new Ekko())->isActive($input, $output);
    }
}
