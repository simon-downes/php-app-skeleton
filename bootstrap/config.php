<?php declare(strict_types=1);

use Psr\Container\ContainerInterface;
use DI\ContainerBuilder;
use spl\SPL;
use spl\support\Config;

return function( ContainerBuilder $containerBuilder ) {

    // global settings object
    $containerBuilder->addDefinitions([

        'config' => function( ContainerInterface $c ) {
            return $c->get(Config::class);
        },

        Config::class => new Config([

            'app' => [
                'name'  => env('APP_NAME', 'My App'),
                'env'   => env('APP_ENV', 'dev'),
                'debug' => SPL::isDebug(),
            ],

            'databases' => [
                'main' => env('DB_DSN'),
            ],

            // view settings
            'view' => [
                'template_path' => APP_ROOT. '/resources/views',
                'cache'         => env('VIEW_CACHE') ? APP_ROOT. '/var/cache/views' : false,
                'debug'         => SPL::isDebug(),
                'auto_reload'   => true,
            ],

        ]),

    ]);

};
