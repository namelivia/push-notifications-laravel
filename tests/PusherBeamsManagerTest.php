<?php

declare(strict_types=1);

namespace Pusher\Beams\Tests\Laravel;

use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
use Illuminate\Contracts\Config\Repository;
use Mockery;
use Pusher\Beams\Laravel\PusherBeamsFactory;
use Pusher\Beams\Laravel\PusherBeamsManager;
use Pusher\PushNotifications\PushNotifications;

/**
 * This is the Pusher manager test class.
 *
 * @author José Ignacio Amelivia Santiago <jignacio.amelivia@gmail.com>
 */
class PusherBeamsManagerTest extends AbstractTestBenchTestCase
{
    public function testCreateConnection()
    {
        $config = ['path' => __DIR__];

        $manager = $this->getManager($config);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('pusher-beams.default')->andReturn('pusher-beams');

        $this->assertSame([], $manager->getConnections());

        $return = $manager->connection();

        $this->assertInstanceOf(PushNotifications::class, $return);

        $this->assertArrayHasKey('pusher-beams', $manager->getConnections());
    }

    protected function getManager(array $config)
    {
        $repository = Mockery::mock(Repository::class);
        $factory = Mockery::mock(PusherBeamsFactory::class);

        $manager = new PusherBeamsManager($repository, $factory);

        $manager->getConfig()->shouldReceive('get')->once()
            ->with('pusher-beams.connections')->andReturn(['pusher-beams' => $config]);

        $config['name'] = 'pusher-beams';

        $manager->getFactory()->shouldReceive('make')->once()
            ->with($config)->andReturn(Mockery::mock(PushNotifications::class));

        return $manager;
    }
}
