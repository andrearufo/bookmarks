<?php

namespace App\Controllers;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

class ApiController extends Controller{

    public function index(Request $request, Response $response, $args) {

        $data = [
            'hello' => 'Hello Api',
            'by' => 'by Controller!'
        ];

        $payload = json_encode($data);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

}
