<?php

namespace Wulfheart\LaravelGin;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Wulfheart\LaravelGin\LaravelGin
 */
class LaravelGinFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-gin';
    }
}
