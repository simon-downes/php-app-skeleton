<?php declare(strict_types=1);

use Slim\Factory\AppFactory;
use DI\ContainerBuilder;
use Symfony\Component\Dotenv\Dotenv;
use Slim\Views\TwigMiddleware;
use spf\SPF;

define('APP_ROOT', realpath(__DIR__. '/..'));

require APP_ROOT. '/vendor/autoload.php';

// we return a closure responsible for bootstrapping our application instance
// so we don't pollute the global namespace with our temp variables
return function() {

    SPF::init();

    // load environment file
    $dotenv = new Dotenv();
    $dotenv->load(APP_ROOT. '/.env');

    // set debug flag based on env file
    SPF::setDebug(filter_var($_ENV['APP_DEBUG'], FILTER_VALIDATE_BOOLEAN));

    // create a ContainerBuilder instance into which we can load our definitions
    $containerBuilder = new ContainerBuilder();

    // not in debug mode so enable container caching
    // TODO: need to remove cached file otherwise
    if( !SPF::isDebug() ) {
        $containerBuilder->enableCompilation(APP_ROOT. '/var/cache');
    }

    // load application config
    (require APP_ROOT . '/bootstrap/config.php')($containerBuilder);

    // load application services
    (require APP_ROOT . '/bootstrap/services.php')($containerBuilder);

    // build our DI container and create an application instance from it
    $app = AppFactory::createFromContainer(
        $containerBuilder->build()
    );

    // add the Twig middleware to handle templating
    $app->add(TwigMiddleware::createFromContainer($app));

    // load our routes
    (require APP_ROOT . '/bootstrap/routes.php')($app);

    return $app;

};
