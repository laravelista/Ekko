<?php

use Laravelista\Ekko\Ekko;

if (!function_exists('is_active')) {
    function is_active(array|string $input, mixed $output = null): mixed
    {
        return (new Ekko())->isActive(
            input: $input,
            output: $output
        );
    }
}
