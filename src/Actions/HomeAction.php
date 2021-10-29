<?php declare(strict_types=1);

namespace App\Actions;

use Slim\Views\Twig;

use spl\contracts\database\DatabaseConnection;

use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};

class HomeAction {

    use TwigAction;

    private const TWIG_TEMPLATE = 'home.html';

    public function __construct( protected Twig $view, protected DatabaseConnection $db ) {
    }

}
