<?php
function correctRequest(): void {
    $method = $_SERVER['REQUEST_METHOD'] ?? null;
    if ($method !== 'POST') {
        http_response_code(405);
        echo json_encode(['error' => 'Method Not Allowed']);
        exit;
    }
    $contentType = $_SERVER['HTTP_CONTENT_TYPE'] ?? $_SERVER['CONTENT_TYPE'] ?? '';
    if (stripos($contentType, 'application/json') === false) {
        http_response_code(415);
        echo json_encode(['error' => 'Unsupported Media Type, must be json']);
        exit;
    }
}
