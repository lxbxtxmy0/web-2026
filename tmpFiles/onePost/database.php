<?php

function findPostInDatabase(PDO $connection, int $postId): ?array
{
    $postData = fetchPostById($connection, $postId);
    if (!$postData) {
        return null;
    }

    $images = fetchImagesByPostId($connection, $postId);

    return formatPostData($postData, $images);
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
