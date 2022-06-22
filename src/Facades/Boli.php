<?php

namespace Javaabu\Boli\Facades;

use Illuminate\Support\Facades\Facade;

class Boli extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'boli';
    }
}
