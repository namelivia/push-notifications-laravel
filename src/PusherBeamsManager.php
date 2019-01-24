<?php

declare(strict_types=1);

namespace Pusher\Beams\Laravel;

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;
use Pusher\PushNotifications\PushNotifications;

/**
 * This is the Pusher Beams manager class.
 *
 * @author José Ignacio Amelivia Santiago <jignacio.amelivia@gmail.com>
 */
class PusherBeamsManager extends AbstractManager
{
    /**
     * The factory instance.
     *
     * @var \Pusher\Beams\Laravel\PusherBeamsFactory
     */
    private $factory;

    /**
     * Create a new Pusher Beams manager instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     * @param \Pusher\Beams\Laravel\PusherBeamsFactory $factory
     *
     * @return void
     */
    public function __construct(Repository $config, PusherBeamsFactory $factory)
    {
        parent::__construct($config);

        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param array $config
     *
     * @return Pusher\PushNotifications\PushNotifications
     */
    protected function createConnection(array $config): PushNotifications
    {
        return $this->factory->make($config);
    }

    /**
     * Get the configuration name.
     *
     * @return string
     */
    protected function getConfigName(): string
    {
        return 'pusher-beams';
    }

    /**
     * Get the factory instance.
     *
     * @return  \Pusher\Beams\Laravel\PusherBeamsFactory
     */
    public function getFactory(): PusherBeamsFactory
    {
        return $this->factory;
    }
}
