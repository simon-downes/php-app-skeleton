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
     * Default implementation that just renders the template defined in the calling class.
     */
    public function __invoke( Request $request, Response $response ): Response {
        return $this->render($request, $response);
    }

    /**
     * Render the specified template (or the class default) with the specified context.
     */
    protected function render( Request $request, Response $response, array $context = [], ?string $template = null ): Response {
        return $this->view->render($response, $template ?? static::VIEW_TEMPLATE, $context);
    }

}
