<?php

if (!function_exists('getTHMonth')) {
    function getTHMonth($index, $short = true)
    {
        $fullMonth  = config('anter.time.full_month');
        $shortMonth = config('anter.time.short_month');
        if ($short) {
            return $shortMonth[$index];
        }
        return $fullMonth[$index];
    }
}

if (!function_exists('getDateTH')) {
    function getDateTH($strDate, $shortMonth = true, $time = false)
    {
        $year   = date('Y', strtotime($strDate)) + 543;
        $month  = date('n', strtotime($strDate));
        $day    = date('j', strtotime($strDate));
        $hour   = date('H', strtotime($strDate));
        $minute = date('i', strtotime($strDate));

        $month = getTHMonth($month, $shortMonth);

        if ($time) {
            return "$day $month $year $hour:$minute";
        }

        return "$day $month $year";
    }
}

if (!function_exists('getTimeFromDate')) {
    function getTimeFromDate($strDate, $second = false)
    {
        $hour    = date('H', strtotime($strDate));
        $minute  = date('i', strtotime($strDate));
        $seconds = date('s', strtotime($strDate));

        if ($second) {
            return "$hour:$minute:$seconds";
        }

        return "$hour:$minute";
    }
}
