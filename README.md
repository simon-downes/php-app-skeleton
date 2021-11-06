# PHP Web Application Skeleton

## Requirements

- PHP 8
- [Sass](https://sass-lang.com/)
- [Minify](https://github.com/tdewolff/minify)

## Setup

- Install the dependencies
- Clone the repo
- Run `composer install`
- Download the latest Bulma version to `resources/sass/bulma/`

## Libraries

The following Composer packages are used:

- [`slim/slim`](https://www.slimframework.com/) - provides the core framework
- [`slim/psr7`](https://github.com/slimphp/Slim-Psr7) - PSR7 implementation for HTTP messages
- [`slim/twig-view`](https://github.com/slimphp/Twig-View) - provides the glue between Slim and Twig
- [`php-di/php-di`](https://php-di.org/) - provides the DI container
- [`vlucas/phpdotenv`](https://github.com/vlucas/phpdotenv) - provides support for `.env` files
- [`simon-downes/spl`](https://github.com/simon-downes/spl) - provides utilty functionality, including database connections

For the frontend we use:

- [Bulma](https://bulma.io/)
- [Font Awesome](https://fontawesome.com/)
- [Cash JS](https://github.com/fabiospampinato/cash)

## Structure

- `bin` -
  - `serve.php` - executes the built-in php web server to serve the application
- `bootstrap` -
  - `app.php` - creates and bootstraps the slim application instance
- `public` -
- `resources` -
- `src` -
