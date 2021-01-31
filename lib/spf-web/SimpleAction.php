<?php declare(strict_types=1);

namespace spf\web;

use Slim\Views\Twig;
use Psr\Container\ContainerInterface;

use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};

abstract class SimpleAction {

    protected Twig $view;

    public function __construct( ContainerInterface $c ) {
        $this->view = $c->get('view');
    }

    abstract public function __invoke( Request $request, Response $response );

    protected function render( Response $response, string $template, array $context = [] ) {
        return $this->view->render($response, $template, $context);
    }

}
