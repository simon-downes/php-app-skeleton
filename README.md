# PHP Web Application Skeleton

## Libraries

- `slim/slim` - provides the core framework
- `slim/psr7` - PSR7 implementation for HTTP messages
- `slim/twig-view` - provides the glue between Slim and Twig
- `php-di/php-di` - provides the DI container
- `symfony/dotenv` - provides support for `.env` files
- `simon-downes/spl` - provides utilty functionality, including database connections

## Structure

- `bin` -
  - `serve.php` - executes the built-in php web server to serve the application
- `bootstrap` -
  - `app.php` - creates and bootstraps the slim application instance
- `public` -
- `resources` -
- `src` -
