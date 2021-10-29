<?php declare(strict_types=1);

namespace App\Actions;

use Slim\Views\Twig;
use spl\contracts\database\DatabaseConnection;

use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};

trait TwigAction {

    /**
     * Context array that will be passed to the twig template.
     */
    protected array $context = [];

    /**
     * Default implementation that just renders the template defined in the calling class.
     */
    public function __invoke( Request $request, Response $response ): Response {
        return $this->render($response, static::TWIG_TEMPLATE);
    }

    /**
     * Render the specified twig template using the class-level context array.
     */
    protected function render( Response $response, string $template ): Response {
        return $this->view->render($response, $template, $this->context);
    }

}
