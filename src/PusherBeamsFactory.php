<?php

declare(strict_types=1);

namespace Pusher\Beams\Laravel;

use InvalidArgumentException;
use Pusher\PushNotifications\PushNotifications;

/**
 * This is the Pusher Beams factory class.
 *
 * @author José Ignacio Amelivia Santiago <ohcan2@gmail.com>
 */
class PusherBeamsFactory
{
    /**
     * Make a new Pusher Beams client.
     *
     * @param array $config
     *
     * @return \Pusher\PushNotifications\PushNotifications
     */
    public function make(array $config): PushNotifications
    {
        $config = $this->getConfig($config);

        return $this->getClient($config);
    }

    /**
     * Get the configuration data.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return array
     */
    protected function getConfig(array $config): array
    {
        $keys = [
            'instance_id',
            'secret_key',
        ];

        foreach ($keys as $key) {
            if (!array_key_exists($key, $config)) {
                throw new InvalidArgumentException("Missing configuration key [$key].");
            }
        }
	
        return array_only($config, $keys);
    }

    /**
     * Get the pusher beams client.
     *
     * @param string[] $auth
     *
     * @return \Pusher\PushNotifications\PushNotifications
     */
    protected function getClient(array $auth): PushNotifications
    {
        return new PushNotifications([
            'instanceId' => $auth['instance_id'],
            'secretKey' => $auth['secret_key'],
        ]);
    }
}
