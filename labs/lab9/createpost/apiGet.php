<?php
require_once '../database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(400);
    die(json_encode(['error' => 'Только GET запросы'], JSON_UNESCAPED_UNICODE));
}

$postId = $_GET['id'] ?? null;

if (!$postId) {
    http_response_code(400);
    die(json_encode(['error' => 'Не передан ID поста'], JSON_UNESCAPED_UNICODE));
}

try {
    $connection = connectDatabase();

    $stmt = $connection->prepare("SELECT description FROM post WHERE id = :id");
    $stmt->execute(['id' => $postId]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$post) {
        throw new Exception('Пост не найден');
    }

    $stmtImg = $connection->prepare("SELECT image_source FROM image WHERE post_id = :post_id");
    $stmtImg->execute(['post_id' => $postId]);
    $imagesRaw = $stmtImg->fetchAll(PDO::FETCH_ASSOC);

    $imageUrls = [];
    foreach ($imagesRaw as $img) {
        $imageUrls[] = $img['image_source'];
    }

    http_response_code(200);
    echo json_encode([
        'description' => $post['description'],
        'images' => $imageUrls
    ], JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
}