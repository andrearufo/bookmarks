<?php

namespace App\Controllers;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class PublicController extends Controller{

    public function index(Request $request, Response $response, $args) {
        $body = file_get_contents('app/Views/index.html');
        $response->getBody()->write($body);
        return $response;
    }

}
