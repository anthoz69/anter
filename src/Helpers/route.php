<?php

if (! function_exists('isRouteMatch')) {
    function isRouteMatch($path, $class = 'active')
    {
        return Request::is($path) ? $class : '';
    }
}

if (! function_exists('isRoute')) {
    function isRoute($routeName = '', $class = 'active')
    {
        return Route::currentRouteName() === $routeName ? $class : '';
    }
}
