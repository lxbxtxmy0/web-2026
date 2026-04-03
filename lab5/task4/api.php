<?php
function protection(string $data): string {
    for ($i = 0; $i < strlen($data); $i++) {
        if ($data[$i] === '/' || $data[$i] === "\\") {
            $data[$i] = '&';
        }
    }
    return $data;
}

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

$inputData = file_get_contents('php://input');
if ($inputData === false) {
    echo 'invalid input' . PHP_EOL;
    exit;
}

$jsonData = json_decode($inputData, true);
if ($jsonData === null) {
    echo 'invalid input' . PHP_EOL;
    exit;
}

$imageName = $jsonData['image_name'] ?? null;
$imageDescription = $jsonData['image'] ?? null;

$imageName = protection($imageName);

if ($imageDescription === null || $imageName === null) {
    echo 'invalid input' . PHP_EOL;
    exit;
}

$decodedImage = base64_decode($imageDescription);
if ($decodedImage === false) {
    echo 'invalid input';
    exit;
}

$filePath = "static/$imageName.png";

file_put_contents($filePath, $decodedImage);
echo 'image saved' . PHP_EOL;
//добавить функции