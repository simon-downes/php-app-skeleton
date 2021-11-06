<?php declare(strict_types=1);

use spl\SPL;
use Psr\Container\ContainerInterface;
use DI\ContainerBuilder;
use Slim\Views\Twig;
use spl\contracts\database\DatabaseConnection;
use spl\database\ConnectionManager;
use spl\database\DSN;

return function( ContainerBuilder $containerBuilder ) {

    $containerBuilder->addDefinitions([

        'view' => function( ContainerInterface $c ) {
            return $c->get(Twig::class);
        },

        'db' => function( ContainerInterface $c ) {
            return $c->get(DatabaseConnection::class);
        },

        Twig::class => function( ContainerInterface $c ) {

            $settings = $c->get('config')['view'];

            return Twig::create(
                $settings['template_path'] ?? APP_ROOT. '/resources/views',
                [
                    'cache'       => $settings['cache'] ?? false,
                    'debug'       => $settings['debug'] ?? SPL::isDebug(),
                    'auto_reload' => $settings['auto_reload'] ?? SPL::isDebug(),
                ]
            );
        },

        ConnectionManager::class => function( ContainerInterface $c ) {

            $dbm = new ConnectionManager();

            foreach( $c->get('config')->get('databases', []) as $name => $dsn ) {
                $dbm->add($name, new DSN($dsn));
            }

            return $dbm;

        },

        DatabaseConnection::class => function( ContainerInterface $c ) {

            return $c->get(ConnectionManager::class)->get();

        },

    ]);

};
