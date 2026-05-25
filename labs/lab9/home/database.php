<?php

function connectDatabase(): PDO
{
    $dsn = 'mysql:host=localhost;dbname=blog;charset=utf8mb4';
    $user = 'root';
    $password = 'VasAnt2006';
    return new PDO($dsn, $user, $password);
}

function fetchPostById(PDO $connection, int $postId): ?array
{
    $sql = <<<SQL
        SELECT 
            p.id, p.description, p.count_likes, p.published_at,
            u.id AS user_id, u.first_name, u.last_name, u.avatar_source
        FROM post p 
          INNER JOIN user u ON p.user_id = u.id
        WHERE p.id = :id
    SQL;

    $stmt = $connection->prepare($sql);
    $stmt->execute(['id' => $postId]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ?: null;
}

function fetchImagesByPostId(PDO $connection, int $postId): array
{
    $sql = "SELECT image_source, sort_order FROM image WHERE post_id = :id ORDER BY sort_order";
    $stmt = $connection->prepare($sql);
    $stmt->execute(['id' => $postId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function fetchAllPosts(PDO $connection): array
{
    $sql = <<<SQL
        SELECT 
            p.id, p.description, p.count_likes, p.published_at,
            u.id AS user_id, u.first_name, u.last_name, u.avatar_source
        FROM post p INNER JOIN user u
        ON p.user_id = u.id
        ORDER BY p.published_at DESC
    SQL;
    $stmt = $connection->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function fetchAllImages(PDO $connection): array
{
    $sql = "SELECT post_id, image_source, sort_order FROM image ORDER BY sort_order";
    $stmt = $connection->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function formatPostData(array $dbRow, array $images): array
{
    return [
        'id' => $dbRow['id'],
        'author' => $dbRow['first_name'] . ' ' . $dbRow['last_name'],
        'avatar_image' => $dbRow['avatar_source'],
        'profile_link' => 'profile.php?id=' . $dbRow['user_id'],
        'can_edit' => false,
        'count_likes' => $dbRow['count_likes'],
        'description' => $dbRow['description'],
        'post_time' => strtotime($dbRow['published_at']),
        'img_alt' => 'Фото публикации',
        'images' => $images,
        'has_count' => count($images) > 1
    ];
}

function findPostInDatabase(PDO $connection, int $postId): ?array
{
    $postData = fetchPostById($connection, $postId);
    if (!$postData) {
        return null;
    }

    $images = fetchImagesByPostId($connection, $postId);

    return formatPostData($postData, $images);
}


function getFeedPosts(PDO $connection): array
{
    $postsData = fetchAllPosts($connection);
    if (empty($postsData)) {
        return [];
    }

    $allImages = fetchAllImages($connection); $imagesByPost = [];
    foreach ($allImages as $img) {
        $imagesByPost[$img['post_id']][] = [
            'image_source' => $img['image_source'],
            'sort_order'   => $img['sort_order']
        ];
    }

    $feed = [];
    foreach ($postsData as $postData) {
        $postId = $postData['id'];
        $postImages = $imagesByPost[$postId] ?? [];
        $feed[] = formatPostData($postData, $postImages);
    }

    return $feed;
}