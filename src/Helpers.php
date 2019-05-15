<?php

use Laravelista\Ekko\Ekko;

if (!function_exists('is_active')) {
    function is_active($input, $output = null)
    {
        return (new Ekko)->isActive($input, $output);
    }
}
