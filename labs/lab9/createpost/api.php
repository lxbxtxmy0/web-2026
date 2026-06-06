<?php
require_once '../database.php';


$connection = connectDatabase();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(400);
    die(json_encode(['error' => 'Только POST'], JSON_UNESCAPED_UNICODE));
}

$description = $_POST['description'] ?? null;
$userId = $_POST['user_id'] ?? null;
$editPostId = $_POST['edit_post_id'] ?? null;

if (!$description || !$userId) {
    http_response_code(400);
    die(json_encode(['error' => 'Не переданы айди и описание'], JSON_UNESCAPED_UNICODE));
}

$uploadDirPhysical = __DIR__ . '/../src/img/';
$uploadDirDb = '../src/img/';

$savedPhysicalFiles = [];

try {
    $connection->beginTransaction();
    if ($editPostId) {
        $sqlPost = "UPDATE post SET description = :description WHERE id = :post_id AND user_id = :user_id";
        $statementPost = $connection->prepare($sqlPost);
        $statementPost->execute([
            'description' => $description,
            'post_id' => $editPostId,
            'user_id' => $userId
        ]);

        $postId = $editPostId;
    } else {
        $sqlPost = "INSERT INTO post (user_id, description) VALUES (:user_id, :description)";
        $statementPost = $connection->prepare($sqlPost);
        $statementPost->execute([
            'user_id' => $userId,
            'description' => $description
        ]);

        $postId = $connection->lastInsertId();
    }
    if (!empty($_FILES['images']['name'][0])) {
        $countPhotos = count($_FILES['images']['name']);
        $startingSortOrder = 0;
        if ($editPostId) {
            $statementMax = $connection->prepare("SELECT MAX(sort_order) FROM image WHERE post_id = :post_id");
            $statementMax->execute(['post_id' => $postId]);
            $maxOrder = $statementMax->fetchColumn();
            $startingSortOrder = (int)$maxOrder;
        }
        $sqlImage = "INSERT INTO image (post_id, image_source, sort_order) VALUES (:post_id, :source, :sort_order)";
        $statementImage = $connection->prepare($sqlImage);
        for ($i = 0; $i < $countPhotos; $i++) {
            if ($_FILES['images']['error'][$i] !== UPLOAD_ERR_OK) {
                throw new Exception('Ошибка загрузки файла номер ' . ($i + 1));
            }
            $uniqFileName = uniqid() . '_' . basename($_FILES['images']['name'][$i]);
            $physicalPath = $uploadDirPhysical . $uniqFileName;
            $dbPath = $uploadDirDb . $uniqFileName;
            if (!move_uploaded_file($_FILES['images']['tmp_name'][$i], $physicalPath)) {
                throw new Exception('Не удалось сохранить файл на сервер');
            }
            $savedPhysicalFiles[] = $physicalPath;
            $statementImage->execute([
                'post_id' => $postId,
                'source' => $dbPath,
                'sort_order' => $startingSortOrder + $i
            ]);
        }
    }
    $connection->commit();
    http_response_code(200);
    echo json_encode(['success' => true, 'post_id' => $postId], JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    if ($connection->inTransaction()) {
        $connection->rollBack();
    }
    foreach ($savedPhysicalFiles as $fileToRemove) {
        unlink($fileToRemove);

    }
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
}

