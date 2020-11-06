<?php

require 'ClassLink.php';
$database = '../database/bookmarks.json';
$bookmarks = json_decode(file_get_contents($database), 1);

$links = [];
foreach ($bookmarks as $link) {
    $links[] = new Link($link['url']);
}

// echo '<pre>'.print_r($links, 1).'</pre>'; exit;

header('Content-Type: application/json');
echo json_encode($links, 1);
