<?php declare(strict_types=1);

use DI\ContainerBuilder;
use spf\SPF;
use spf\web\Config;

return function( ContainerBuilder $containerBuilder ) {

    // global settings object
    $containerBuilder->addDefinitions([
        'config' => new Config([

            'app' => [
                'name'  => $_ENV['APP_NAME'] ?? 'My App',
                'env'   => $_ENV['APP_ENV'] ?? 'dev',
                'debug' => SPF::isDebug(),
            ],

            'database' => [
                'dsn' => $_ENV['DB_DSN'],
            ],

            // view settings
            // 'view' => [
            //     'template_path' => APP_ROOT. '/resources/views',
            //     'cache'         => filter_var($_ENV['VIEW_CACHE'] ?? !SPF::isDebug(), FILTER_VALIDATE_BOOLEAN),
            //     'debug'         => SPF::isDebug(),
            //     'auto_reload'   => true,
            // ],

        ]),
    ]);

};
