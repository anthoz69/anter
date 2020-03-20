<?php

namespace Anthoz69\Anter;

class Anter
{
    public function slug($string, $separator)
    {
        return strtolower(preg_replace('/[^A-Za-z0-9ก-เ]+/i', $separator, str_replace('&', '-and-', $string)));
    }

    public function file()
    {
        return app('anter.store');
    }

    public function img()
    {
        return app('anter.img');
    }
}
