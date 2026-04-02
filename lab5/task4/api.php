<?php

$method = $_SERVER['REQUEST_METHOD'] ?? null;
if ($method != 'POST') {
    echo 'not POST request' . PHP_EOL;
    exit;
}
$contentType = $_SERVER['CONTENT_TYPE'] ?? null;
if ($contentType != 'application/json') {
    echo 'invalid input' . PHP_EOL;
    exit;
}
//rename
$jsonFileData = file_get_contents('php://input');
if ($jsonFileData === false) {
    echo 'invalid input' . PHP_EOL;
    exit;
}
$data = json_decode($jsonFileData, true);
if ($data === null) {
    echo 'invalid input' . PHP_EOL;
    exit;
}

$imageName = $data['image_name'] ?? null;
$imageDescription = $data['image'] ?? null;

if ($imageDescription === null || $imageName === null) {
    echo 'invalid input' . PHP_EOL;
    exit;4
}

$decodedImage = base64_decode($imageDescription);
if ($decodedImage === false) {
    echo 'invalid input';
    exit;
}

$filePath = "static/$imageName.png";

file_put_contents($filePath, $decodedImage);



