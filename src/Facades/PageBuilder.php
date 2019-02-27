<?php

namespace Shetabit\PageBuilder\Facades;

use Illuminate\Support\Facades\Facade;

class PageBuilder extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'pagebuilder';
    }
}
