<?php

namespace Web;

use Illuminate\Support\Str;

if (! function_exists('web_path')) {
    /**
     * Get Overdrive WEB absolute directory path.
     *
     * @param string $path
     *
     * @return string
     */
    function web_path(string $path): string
    {
        return realpath(__DIR__.'/../'.($path ? DIRECTORY_SEPARATOR.$path : $path));
    }
}




