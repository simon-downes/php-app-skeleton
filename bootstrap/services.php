<?php declare(strict_types=1);

use spf\SPF;
use Psr\Container\ContainerInterface;
use DI\ContainerBuilder;
use Slim\Views\Twig;

return function( ContainerBuilder $containerBuilder ) {

    $containerBuilder->addDefinitions([

        'view' => function( ContainerInterface $c ) {

            $settings = $c->get('config')['view'];

            return Twig::create(
                $settings['template_path'] ?? APP_ROOT. '/resources/views',
                [
                    'cache'       => $settings['cache'] ?? !SPF::isDebug(),
                    'debug'       => $settings['debug'] ?? SPF::isDebug(),
                    'auto_reload' => $settings['auto_reload'] ?? SPF::isDebug(),
                ]
            );
        },

    ]);

};
