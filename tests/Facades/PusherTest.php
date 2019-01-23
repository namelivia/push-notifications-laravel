<?php

declare(strict_types=1);

namespace Pusher\Beams\Tests\Laravel\Facades;

use GrahamCampbell\TestBenchCore\FacadeTrait;
use Pusher\Beams\Laravel\Facades\PusherBeams;
use Pusher\Beams\Laravel\PusherBeamsManager;
use Pusher\Beams\Tests\Laravel\AbstractTestCase;

/**
 * This is the Pusher Beams test class.
 *
 * @author Vincent Klaiber <hello@vinkla.com>
 */
class PusherTest extends AbstractTestCase
{
    use FacadeTrait;

    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'pusher-beams';
    }

    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return PusherBeams::class;
    }

    /**
     * Get the facade root.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return PusherBeamsManager::class;
    }
}
