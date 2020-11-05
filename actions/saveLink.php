<?php

if (!isset($_POST['url'])) exit;

$url = htmlspecialchars($_POST['url']);

$response = [
    'error' => false,
    'success' => false,
];

if ( empty($url) || !filter_var($url, FILTER_VALIDATE_URL) ){
    $response['error'] = 'Not valid url';

    header('Content-Type: application/json');
    echo json_encode($response);
    die;
}

require 'ClassLink.php';
$database = '../database/bookmarks.json';

$bookmarks = json_decode(file_get_contents($database));
$bookmarks[] = new Link($url);

$file = fopen($database, 'w') or die('Unable to open file!');
fwrite($file, json_encode($bookmarks));
fclose($file);

$response['success'] = $url.' new link added';

header('Content-Type: application/json');
echo json_encode($response);
