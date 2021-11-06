<?php declare(strict_types=1);

namespace App\Actions;

use Slim\Views\Twig;

use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};

class HomeAction {

    use TwigAction;

    private const VIEW_TEMPLATE = 'home.html';

    public function __construct( protected Twig $view ) {
    }

}
