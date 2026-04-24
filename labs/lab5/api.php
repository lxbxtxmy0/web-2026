<?php
function secure(string $data): string {
    for ($i = 0; $i < strlen($data); $i++) {
        if ($data[$i] === '/' || $data[$i] === "\\") {
            $data[$i] = '&';
        }
    }
    return $data;
}

function correctRequest(): void {
    $method = $_SERVER['REQUEST_METHOD'] ?? null;
    if ($method !== 'POST') {
        echo 'not POST request' . PHP_EOL;
        exit;
    }

    $contentType = $_SERVER['CONTENT_TYPE'] ?? null;
    if ($contentType !== 'application/json') {
        echo 'invalid input' . PHP_EOL;
        exit;
    }
}

function getJsonInput(): ?array {
    $inputData = file_get_contents('php://input');
    if ($inputData === false) {
        return null;
    }
    return json_decode($inputData, true);
}

function saveImage(string $imageName, string $imageBase64Data): bool {
    $decodedImage = base64_decode($imageBase64Data);
    if ($decodedImage === false) {
        return false;
    }

    $filePath = "static/$imageName.png";
    return file_put_contents($filePath, $decodedImage) !== false;
}

correctRequest();

$jsonData = getJsonInput();
if ($jsonData === null) {
    echo 'invalid input' . PHP_EOL;
    exit;
}

$imageName = $jsonData['image_name'] ?? null;
$imageDescription = $jsonData['image'] ?? null;

if ($imageName === null || $imageDescription === null) {
    echo 'invalid input' . PHP_EOL;
    exit;
}

$sanitizedImageName = secure($imageName);

if (saveImage($sanitizedImageName, $imageDescription)) {
    echo 'image saved' . PHP_EOL;
} else {
    echo 'invalid input';
    exit;
}

