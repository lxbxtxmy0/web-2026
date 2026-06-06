<?php

function connectDatabase(): PDO
{
    $dsn = 'mysql:host=localhost;dbname=blog;charset=utf8mb4';
    $user = 'root';
    $password = 'VasAnt2006';
    return new PDO($dsn, $user, $password);
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
    $statement = $connection->query($sql);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function fetchAllImages(PDO $connection): array
{
    $sql = "SELECT post_id, image_source, sort_order FROM image ORDER BY sort_order";
    $statement = $connection->query($sql);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function formatPostData(array $dbRow, array $images): array
{
    $userId = 1;
    return [
        'id' => $dbRow['id'],
        'author' => $dbRow['first_name'] . ' ' . $dbRow['last_name'],
        'avatar_image' => $dbRow['avatar_source'],
        'can_edit' => ($userId == $dbRow['user_id']),
        'count_likes' => $dbRow['count_likes'],
        'description' => $dbRow['description'],
        'post_time' => strtotime($dbRow['published_at']),
        'img_alt' => 'Фото публикации',
        'images' => $images
    ];
}

function getFeedPosts(PDO $connection): array
{
    $postsData = fetchAllPosts($connection);
    if (empty($postsData)) {
        return [];
    }

    $allImages = fetchAllImages($connection);
    $imagesByPost = [];
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