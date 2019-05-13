<?php

if (!function_exists('is_active')) {
    function is_active($input, $output = 'active')
    {
        return (new Ekko)->isActive($input, $output);
    }
}

if (!function_exists('isActiveUrl')) {
    function isActiveUrl($input, $output = 'active')
    {
        return (new Ekko)->isActive($input, $output);
    }
}

if (!function_exists('is_active_url')) {
    function is_active_url($input, $output = 'active')
    {
        return (new Ekko)->isActive($input, $output);
    }
}
