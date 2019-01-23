<?php

declare(strict_types=1);

namespace Pusher\Beams\Tests\Laravel;

use Pusher\Beams\Laravel\PusherBeamsFactory;
use Pusher\PushNotifications\PushNotifications;

/**
 * This is the Pusher factory test class.
 *
 * @author José Ignacio Amelivia Santiago <jignacio.amelivia@gmail.com>
 */
class PusherBeamsFactoryTest extends AbstractTestCase
{
    public function testMakeStandard()
    {
        $factory = $this->getPusherBeamsFactory();

        $return = $factory->make([
            'instance_id' => 'your-instance-id',
            'secret_key' => 'your-secret-key',
        ]);

        $this->assertInstanceOf(PushNotifications::class, $return);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutInstanceId()
    {
        $factory = $this->getPusherBeamsFactory();

        $factory->make([
            'secret_key' => 'your-secret-key',
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMakeWithoutSecretKey()
    {
        $factory = $this->getPusherBeamsFactory();

        $return = $factory->make([
            'instance_id' => 'your-instance-id',
        ]);
    }

    protected function getPusherBeamsFactory()
    {
        return new PusherBeamsFactory();
    }
}
