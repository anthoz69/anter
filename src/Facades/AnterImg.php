<?php

namespace Anthoz69\Anter\Facades;

use Illuminate\Support\Facades\Facade;

class AnterImg extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'anter.img';
    }
}
