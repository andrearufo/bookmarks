<?php

namespace App\Controllers;

use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Link as Link;

class ApiController extends Controller{

    private function success($data, $response){
        $payload = json_encode($data);
        $response->getBody()->write($payload);
        return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(201);
    }

    private function error($message, $response){
        $payload = json_encode([
            'message' => $message
        ]);
        $response->getBody()->write($payload);
        return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(400);;
    }

    public function index(Request $request, Response $response, $args) {
        $data = [
            'hello' => 'Hello Api',
            'by' => 'by Controller!'
        ];
        return $this->success($data, $response);
    }

    public function list(Request $request, Response $response, $args) {
        $data = [];
        $data['links'] = Link::all();
        return $this->success($data, $response);
    }

    public function save(Request $request, Response $response, $args) {
        $post = $request->getParsedBody();
        $link = new Link($post['url']);

        // return $this->success($link, $response);

        if ($link->save()) {
            return $this->success($link, $response);
        }else{
            return $this->error('Error on save link', $response);
        }
    }

    public function fetch(Request $request, Response $response, $args) {
        $post = $request->getParsedBody();
        $data['link'] = new Link($post['url']);

        return $this->success($data, $response);
    }

    public function delete(Request $request, Response $response, $args) {
        $post = $request->getParsedBody();

        if(!isset($post['id']) || !$post['id']){
            return $this->error('The id is required', $response);
        }

        $id = $post['id'];
        $link = Link::findOrFail($id);

        if ($link->delete()) {
            $data = [
                'message' => 'Link deleted'
            ];
            return $this->success($data, $response);
        }else{
            return $this->error('Not deleted!', $response);
        }

    }
}
