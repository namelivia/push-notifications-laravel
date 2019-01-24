<?php

declare(strict_types=1);

namespace Pusher\Beams\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * This is the Pusher facade class.
 *
 * @author José Ignacio Amelivia Santiago <jiamelivia@gmail.com>
 */
class PusherBeams extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'pusher-beams';
    }
}
