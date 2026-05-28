<?php
require_once 'database.php';

$postId = (int)($_GET['postId'] ?? 0);

if (!$postId) {
    die('Ошибка: Не передан ID публикации.');
}

$connection = connectDatabase();
$post = findPostInDatabase($connection, $postId);

if ($post === null) {
    die('Ошибка: Публикация не найдена или была удалена.');
}

require __DIR__ . '/view/post.php';
