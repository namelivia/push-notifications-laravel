<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Pusher Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        'main' => [
            'instance_id' => env('PUSHER_BEAMS_INSTANCE_ID', 'your-instance-id'),
            'secret_key' => env('PUSHER_BEAMS_SECRET_KEY', 'your-secret-key'),
        ],

        'alternative' => [
            'instance_id' => 'your-instance-id',
            'secret_key' => 'your-secret-key',
        ],

    ],

];
