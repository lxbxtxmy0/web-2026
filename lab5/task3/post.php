<?php require_once 'data.php'; ?>

<?php
$postId = $_GET['postId'] ?? null;
if ($postId == null) {
    echo 'invalid request' . PHP_EOL;
    exit;
} else {
    $postId = (int)$postId;
}

$currentPost = null;

foreach ($posts as $post) {
    if ($post['id'] === $postId) {
        $currentPost = $post;
        break;
    }
}

if ($currentPost == null) {
    echo 'invalid id' . PHP_EOL;
    exit;
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <title>Post</title>
</head>
<body>
<main>
    <div class="post">
        <div class="head-of-post">
            <p><?= $postId ?></p>
            <img src="<?= $currentPost['avatar_modifier'] ?>" alt="Аватар" height="32" width="32" class="avatar">
            <p class="name-text"><?= $currentPost['author'] ?></p>
            <?php if ($currentPost['can_edit']): ?>
                <button>
                    <img src="img/edit_icon.png" alt="Редактирование публикации" height="24" width="24">
                </button>
            <?php endif; ?>
        </div>
        <div>
            <img src="<?= $currentPost['img_modifier'] ?>" alt="<?= $currentPost['img_alt'] ?>" height="474"
                 width="474">
            <?php if ($currentPost['has_count']): ?>
                <span>1 / 3</span>
                <button>
                    <img src="img/left_button.png" alt="Предыдущее фото" height="20" width="20">
                </button>
                <button>
                    <img src="img/right_button.png" alt="Следуещее фото" height="20" width="20">
                </button>
            <?php endif; ?>
        </div>
        <?php if ($currentPost['count_likes'] > 0): ?>
            <button class="likes">
                <img src="img/heart_icon.png" alt="like" height="16" width="16">
                <span><?= $currentPost['count_likes'] ?></span>
            </button>
        <?php endif; ?>
        <?php if ($currentPost['description'] != ''): ?>
            <p class="description">
                <?= $currentPost['description'] ?>
            </p>
        <?php endif; ?>
        <?php if (!empty($currentPost['post_time'])): ?>
            <span class="post-time">
        <?= date('d.m.Y H:i', $currentPost['post_time']) ?>
            </span>
        <?php endif; ?>
    </div>
</main>
</body>
</html>





