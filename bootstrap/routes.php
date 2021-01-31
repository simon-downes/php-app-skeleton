<?php declare(strict_types=1);

use Slim\App;

use App\Actions\HomeAction;

return function( App $app ) {

    $app->get('/', HomeAction::class);

};
