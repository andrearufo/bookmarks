<?php

$url = htmlspecialchars($_POST['url']);

$response = [
    'error' => false,
    'success' => false,
];

if ( empty($url) || !filter_var($url, FILTER_VALIDATE_URL) ){
    $response['error'] = 'Not valid url';

    header('Content-Type: application/json');
    http_response_code(400)
    echo json_encode($response);
    die;
}

// TODO

return;
