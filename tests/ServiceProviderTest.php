<?php

declare(strict_types=1);

namespace Pusher\Beams\Tests\Laravel;

use GrahamCampbell\TestBenchCore\ServiceProviderTrait;
use Pusher\Beams\Laravel\PusherBeamsFactory;
use Pusher\Beams\Laravel\PusherBeamsManager;
use Pusher\PushNotifications\PushNotifications;

/**
 * This is the service provider test class.
 *
 * @author José Ignacio Amelivia Santiago <jignacio.amelivia@gmail.com>
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function testPusherBeamsFactoryIsInjectable()
    {
        $this->assertIsInjectable(PusherBeamsFactory::class);
    }

    public function testPusherBeamsManagerIsInjectable()
    {
        $this->assertIsInjectable(PusherBeamsManager::class);
    }

    public function testBindings()
    {
        $this->assertIsInjectable(PushNotifications::class);

        $original = $this->app['pusher-beams.connection'];
        $this->app['pusher-beams']->reconnect();
        $new = $this->app['pusher-beams.connection'];

        $this->assertNotSame($original, $new);
        $this->assertEquals($original, $new);
    }
}
