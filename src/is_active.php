<?php

if (!function_exists('is_active')) {
    function is_active($input, $output = 'active')
    {
        if (is_array($input)) {
            return count(array_filter($input, 'is_active')) > 0 ? $output : null;
        }

        $regex = '/^' . str_replace(preg_quote('*'), '[^.]*?', preg_quote($input, '/')) . '$/';

        return preg_match($regex, strtok($_SERVER['REQUEST_URI'], '?')) ? $output : null;
    }
}
