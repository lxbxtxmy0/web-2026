<?php

function connectDatabase(): PDO
{
    $dsn = 'mysql:host=localhost;dbname=blog;charset=utf8mb4';
    $user = 'root';
    $password = 'VasAnt2006';
    return new PDO($dsn, $user, $password);
}

function findPostInDatabase(PDO $connection, int $postId): ?array
{
    $sqlPost = <<<SQL
        SELECT 
            p.id, p.description, p.count_likes, p.published_at,
            u.id AS user_id, u.first_name, u.last_name, u.avatar_source
        FROM posts p
        JOIN users u ON p.author_id = u.id
        WHERE p.id = :id
    SQL;

    $stmtPost = $connection->prepare($sqlPost);
    $stmtPost->execute(['id' => $postId]);
    $postData = $stmtPost->fetch(PDO::FETCH_ASSOC);

    if (!$postData) {
        return null;
    }
    $sqlImages = <<<SQL
        SELECT image_source 
        FROM images 
        WHERE post_id = :id 
        ORDER BY sort_order ASC
    SQL;

    $stmtImages = $connection->prepare($sqlImages);
    $stmtImages->execute(['id' => $postId]);
    $imagesData = $stmtImages->fetchAll(PDO::FETCH_ASSOC);

    $images = array_column($imagesData, 'image_source');

    return [
        'id' => $postData['id'],
        'author' => $postData['first_name'] . ' ' . $postData['last_name'],
        'avatar_image' => $postData['avatar_source'] ?: 'img/avatar.svg',
        'profile_link' => 'profile.php?id=' . $postData['user_id'],
        'can_edit' => false,
        'count_likes' => $postData['count_likes'],
        'description' => $postData['description'],
        'post_time' => strtotime($postData['published_at']),
        'img_alt' => 'Фото публикации',
        'images' => $images,
        'has_count' => count($images) > 1
    ];
}

function getFeedPosts(PDO $connection): array
{
    $sqlPosts = <<<SQL
        SELECT 
            p.id, p.description, p.count_likes, p.published_at,
            u.id AS user_id, u.first_name, u.last_name, u.avatar_source
        FROM posts p
        JOIN users u ON p.author_id = u.id
        ORDER BY p.published_at DESC
        SQL;

    $stmtPosts = $connection->query($sqlPosts);
    $postsData = $stmtPosts->fetchAll(PDO::FETCH_ASSOC);

    if (empty($postsData)) {
        return [];
    }

    $sqlImages = "SELECT post_id, image_source FROM images ORDER BY sort_order ASC";
    $stmtImages = $connection->query($sqlImages);
    $allImages = $stmtImages->fetchAll(PDO::FETCH_ASSOC);
    $imagesByPost = [];
    foreach ($allImages as $img) {
        $imagesByPost[$img['post_id']][] = $img['image_source'];
    }
    $feed = [];
    foreach ($postsData as $postData) {
        $postId = $postData['id'];
        $postImages = $imagesByPost[$postId] ?? [];

        $feed[] = [
            'id' => $postId,
            'author' => $postData['first_name'] . ' ' . $postData['last_name'],
            'avatar_image' => $postData['avatar_source'] ?: 'img/avatar.svg',
            'profile_link' => 'profile.php?id=' . $postData['user_id'],
            'can_edit' => false,
            'count_likes' => $postData['count_likes'],
            'description' => $postData['description'],
            'post_time' => strtotime($postData['published_at']),
            'img_alt' => 'Фото публикации',
            'images' => $postImages,
            'has_count' => count($postImages) > 1
        ];
    }
    return $feed;
}
