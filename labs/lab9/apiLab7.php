<?php

require_once __DIR__ . '/database.php';

$connection = connectDatabase();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(400);
    die(json_encode(['error' => 'Только POST запросы'], JSON_UNESCAPED_UNICODE));
}

if (!isset($_POST['data'])) {
    http_response_code(400);
    die(json_encode(['error' => 'Отсутствует поле data'], JSON_UNESCAPED_UNICODE));
}

$data = json_decode($_POST['data'], true);

if (!$data || !isset($data['description'], $data['user'])) {
    http_response_code(400);
    die(json_encode(['error' => 'Некорректный JSON в поле data'], JSON_UNESCAPED_UNICODE));
}

if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    die(json_encode(['error' => 'Файл картинки обязателен'], JSON_UNESCAPED_UNICODE));
}

$uploadDir = __DIR__ . '/src/img/';


$fileName = uniqid() . '_' . basename($_FILES['image']['name']);
$uploadFileOnServer = $uploadDir . $fileName;
$uploadFileForDB = '../src/img/' . $fileName;

if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadFileOnServer)) {
    http_response_code(500);
    die(json_encode(['error' => 'Ошибка сохранения файла'], JSON_UNESCAPED_UNICODE));
}

try {
    $connection->beginTransaction();

    $sqlPost = "INSERT INTO post (user_id, description, count_likes) VALUES (:user, :description, 0)";
    $statement = $connection->prepare($sqlPost);
    $statement->execute([
        'user' => $data['user'],
        'description' => $data['description']
    ]);

    $postId = $connection->lastInsertId();

    $sqlImage = "INSERT INTO image (post_id, image_source) VALUES (:post_id, :source)";
    $statement = $connection->prepare($sqlImage);
    $statement->execute([
        'post_id' => $postId,
        'source' => $uploadFileForDB
    ]);

    $connection->commit();
    http_response_code(200);
    echo json_encode(['status' => 'success', 'post_id' => $postId], JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    $connection->rollBack();
    http_response_code(500);
    echo json_encode(['error' => 'Ошибка БД: ' . $e->getMessage()], JSON_UNESCAPED_UNICODE);
}

