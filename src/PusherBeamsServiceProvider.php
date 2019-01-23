<?php

declare(strict_types=1);

namespace Pusher\Beams\Laravel;

use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;
use Pusher\PushNotifications\PushNotifications;

/**
 * This is the Pusher Beams service provider class.
 *
 * @author José Ignacio Amelivia Santiago <jignacio.amelivia@gmail.com>
 */
class PusherBeamsServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../config/pusher-beams.php');

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('pusher-beams.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('pusher-beams');
        }

        $this->mergeConfigFrom($source, 'pusher-beams');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFactory();
        $this->registerManager();
        $this->registerBindings();
    }

    /**
     * Register the factory class.
     *
     * @return void
     */
    protected function registerFactory()
    {
        $this->app->singleton('pusher-beams.factory', function () {
            return new PusherBeamsFactory();
        });

        $this->app->alias('pusher-beams.factory', PusherBeamsFactory::class);
    }

    /**
     * Register the manager class.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton('pusher-beams', function (Container $app) {
            $config = $app['config'];
            $factory = $app['pusher-beams.factory'];

            return new PusherBeamsManager($config, $factory);
        });

        $this->app->alias('pusher-beams', PusherBeamsManager::class);
    }

    /**
     * Register the bindings.
     *
     * @return void
     */
    protected function registerBindings()
    {
        $this->app->bind('pusher-beams.connection', function (Container $app) {
            $manager = $app['pusher-beams'];

            return $manager->connection();
        });

        $this->app->alias('pusher-beams.connection', PushNotifications::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides(): array
    {
        return [
            'pusher-beams',
            'pusher-beams.factory',
            'pusher-beams.connection',
        ];
    }
}
