<?php declare(strict_types=1);

use Slim\Factory\AppFactory;
use DI\ContainerBuilder;
use Dotenv\Dotenv;
use Slim\Views\TwigMiddleware;
use spl\SPL;

define('APP_ROOT', realpath(__DIR__. '/..'));

require APP_ROOT. '/vendor/autoload.php';

// we return a closure responsible for bootstrapping our application instance
// so we don't pollute the global namespace with our temp variables
return function() {

    SPL::init();

    // load environment file
    $dotenv = Dotenv::createUnsafeImmutable(APP_ROOT);
    $dotenv->safeLoad();

    // set debug flag based on env file
    SPL::setDebug(env('APP_DEBUG', false));

    // create a ContainerBuilder instance into which we can load our definitions
    $containerBuilder = new ContainerBuilder();

    // not in debug mode so enable container caching
    // TODO: need to remove cached file otherwise
    if( !SPL::isDebug() ) {
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

    // error handling middleware - this must be the last middleware
    $app->addErrorMiddleware(SPL::isDebug(), true, true);

    // load our routes
    (require APP_ROOT . '/bootstrap/routes.php')($app);

    return $app;

};
