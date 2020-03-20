<?php

if (! function_exists('truncate')) {
    function truncate($number, $precision = 0)
    {
        $shift = pow(10, $precision);

        return intval($number * $shift) / $shift;
    }
}

if (! function_exists('setCurrency')) {
    function setCurrency($number, $percision = 2)
    {
        return number_format(floor($number * 100) / 100, $percision, '.', ',');
    }
}
