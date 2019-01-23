# Laravel Pusher Beams Notifications

> A [Pusher Beams](https://github.com/pusher/push-notifications-php) bridge for Laravel. Heavily based on `pusher/pusher-http-php`.

```php
// Sends broadcast notifications to groups of subscribed devices using Interests
PusherBeams::publish(
	["hello", "donuts"],
	[
		"fcm" => [
			"notification" => [
				"title" => "Hi!",
				"body" => "This is my first Push Notification!"
				]
		],
		"apns" => ["aps" => [
				"alert" => [
					"title" => "Hi!",
					"body" => "This is my first Push Notification!"
				]
		]]
	]
);

```

## Installation

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

```bash
$ composer require namelivia/push-notifications-laravel
```

Add the service provider to `config/app.php` in the `providers` array. If you're using Laravel 5.5 or greater, there's no need to do this.

```php
Pusher\Beams\Laravel\PusherBeamsServiceProvider::class
```

If you want you can use the [facade](http://laravel.com/docs/facades). Add the reference in `config/app.php` to your aliases array.

```php
'PusherBeams' => Pusher\Beams\Laravel\Facades\PusherBeams::class
```

## Configuration

Laravel Pusher requires connection configuration. To get started, you'll need to publish all vendor assets:

```bash
$ php artisan vendor:publish --provider="Pusher\Beams\Laravel\PusherBeamsServiceProvider"
```

This will create a `config/pusher-beams.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

#### Default Connection Name

This option `default` is where you may specify which of the connections below you wish to use as your default connection for all work. Of course, you may use many connections at once using the manager class. The default value for this setting is `main`.

#### Pusher Connections

This option `connections` is where each of the connections are setup for your application. Example configuration has been included, but you may add as many connections as you would like.

## Usage

#### PusherBeamsManager

This is the class of most interest. It is bound to the ioc container as `pusher-beams` and can be accessed using the `Facades\PusherBeams` facade. This class implements the ManagerInterface by extending AbstractManager. The interface and abstract class are both part of [Graham Campbell's](https://github.com/GrahamCampbell) [Laravel Manager](https://github.com/GrahamCampbell/Laravel-Manager) package, so you may want to go and checkout the docs for how to use the manager class over at that repository. Note that the connection class returned will always be an instance of `PushNotification`.

#### Facades\PusherBeams

This facade will dynamically pass static method calls to the `pusher-beams` object in the ioc container which by default is the `PusherBeamsManager` class.

#### PusherBeamsServiceProvider

This class contains no public methods of interest. This class should be added to the providers array in `config/app.php`. This class will setup ioc bindings.

### Examples

Here you can see an example of just how simple this package is to use. Out of the box, the default adapter is `main`. After you enter your authentication details in the config file, it will just work:

```php
// You can alias this in config/app.php.
use Pusher\Beams\Laravel\Facades\PusherBeams;

PusherBeams::publish(
	["hello", "donuts"],
	[
		"fcm" => [
			"notification" => [
				"title" => "Hi!",
				"body" => "This is my first Push Notification!"
				]
		],
		"apns" => ["aps" => [
				"alert" => [
					"title" => "Hi!",
					"body" => "This is my first Push Notification!"
				]
		]]
	]
);
// We're done here - how easy was that, it just works!
```

The Pusher Beams manager will behave like it is a `PusherBeams`. If you want to call specific connections, you can do that with the connection method:

```php
use Pusher\Beams\Laravel\Facades\PusherBeams;

// Writing this…
PusherBeams::connection('main')->publish([...]);

// …is identical to writing this
PusherBeams::publish([...]);

// and is also identical to writing this.
PusherBeams::connection()->publish([...]);

// This is because the main connection is configured to be the default.
PusherBeams::getDefaultConnection(); // This will return main.

// We can change the default connection.
PusherBeams::setDefaultConnection('alternative'); // The default is now alternative.
```

If you prefer to use dependency injection over facades like me, then you can inject the manager:

```php
use Pusher\Beams\Laravel\PusherBeamsManager;

class Foo
{
    protected $pusherBeams;

    public function __construct(PusherBeamsManager $pusherBeams)
    {
        $this->pusherBeams = $pusherBeams;
    }

    public function bar()
    {
        $this->pusherBeams->publish('my-channel', 'my-event', ['message' => $message]);
    }
}

App::make('Foo')->bar();
```

## Documentation

This is package is a Laravel wrapper of [the official Pusher Beams package](https://github.com/pusher/push-notifications-php).

## License

[MIT](LICENSE)
