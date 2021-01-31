<?php declare(strict_types=1);

namespace App\Actions;

use spf\web\SimpleAction;

use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};

class HomeAction extends SimpleAction {

    public function __invoke( Request $request, Response $response ) {
        return $this->render($response, 'home.html');
    }

}
