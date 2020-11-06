<?php

use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

$app->group('/', function (RouteCollectorProxy $group) {
    $group->get('', 'App\Controllers\PublicController:index');
});

$app->group('/api', function (RouteCollectorProxy $group) {
    $group->get('', 'App\Controllers\ApiController:index')->setName('api-index');
});

// // Disable errors in production
// // If you are adding the pre-packaged ErrorMiddleware set `displayErrorDetails` to `false`
// $app->addErrorMiddleware(false, true, true);

$app->run();
