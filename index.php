<?php

use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

// The database

$settings = array(
    'driver' => 'sqlite',
    'host' => 'localhost',
    'database' => 'database/database.SQLite3'
);
$capsule = new Illuminate\Database\Capsule\Manager;
$capsule->addConnection($settings);
$capsule->bootEloquent();

// The routes

$app->group('/', function (RouteCollectorProxy $group) {
    $group->get('', 'App\Controllers\PublicController:index');
});

$app->group('/api', function (RouteCollectorProxy $group) {
    $group->get('', 'App\Controllers\ApiController:index')->setName('api-index');
    $group->get('/list', 'App\Controllers\ApiController:list')->setName('api-list');
    $group->post('/save', 'App\Controllers\ApiController:save')->setName('api-save');
    $group->post('/fetch', 'App\Controllers\ApiController:fetch')->setName('api-fetch');
    $group->post('/delete', 'App\Controllers\ApiController:delete')->setName('api-delete');
});

    // // Disable errors in production
    // // If you are adding the pre-packaged ErrorMiddleware set `displayErrorDetails` to `false`
    // $app->addErrorMiddleware(false, true, true);

// The Run

$app->run();
