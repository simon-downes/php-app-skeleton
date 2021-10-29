<?php declare(strict_types=1);

use DI\ContainerBuilder;
use spl\SPL;
use spl\support\Config;

return function( ContainerBuilder $containerBuilder ) {

    // global settings object
    $containerBuilder->addDefinitions([
        'config' => new Config([

            'app' => [
                'name'  => $_ENV['APP_NAME'] ?? 'My App',
                'env'   => $_ENV['APP_ENV'] ?? 'dev',
                'debug' => SPL::isDebug(),
            ],

            'databases' => [
                'main' => $_ENV['DB_DSN'],
            ],

            // view settings
            'view' => [
                'template_path' => APP_ROOT. '/resources/views',
                'cache'         => filter_var($_ENV['VIEW_CACHE'], FILTER_VALIDATE_BOOLEAN) ? APP_ROOT. '/var/cache/views' : false,
                'debug'         => SPL::isDebug(),
                'auto_reload'   => true,
            ],

        ]),
    ]);

};
