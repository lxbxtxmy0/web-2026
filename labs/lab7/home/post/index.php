<?php require_once "../data.php"; ?>

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
    <link rel="stylesheet" href="../style.css">
    <title>Post</title>
</head>
<nav>
    <a href="../" title="Домашняя страница">
        <img src="../img/menu_icon_is_home.svg" alt="Домашняя страница" height="40" width="40">
    </a>
    <a href="../../profile" title="Мой профиль">
        <img src="../img/menu_icon_profile.svg" alt="Мой профиль" height="40" width="40">
    </a>
    <a href="#" title="Добавить публикацию">
        <img src="../img/menu_icon_add.svg" alt="Добавить публицаию" height="40" width="40">
    </a>
</nav>
<body>
<main>
    <div class="post">
        <div class="header_of_post">
            <div class="author">
                <img src="../<?= $currentPost['avatar_image'] ?>" alt="Аватар" height="32" width="32" class="photo_avatar">
                <p><?= $currentPost['author'] ?></p>
            </div>
            <?php if ($currentPost['can_edit']): ?>
                <button>
                    <img src="../img/edit_icon.svg" alt="Редактирование публикации" height="24" width="24">
                </button>
            <?php endif; ?>
        </div>
        <div class="photo">
            <?php foreach ($currentPost['images'] as $image): ?>
                <img src="../<?= $image ?>" alt="<?= $currentPost['img_alt'] ?>" height="474" width="474">
            <?php endforeach; ?>
            <?php if ($currentPost['has_count']): ?>
                <span class="count_photos">1/3</span>
                <button class="slider_left">
                    <img src="../img/left_button.svg" alt="Предыдущее фото" height="20" width="20">
                </button>
                <button class="slider_right">
                    <img src="../img/right_button.svg" alt="Следуещее фото" height="20" width="20">
                </button>
            <?php endif; ?>
        </div>
        <?php if ($currentPost['count_likes'] > 0): ?>
            <button class="like">
                <img src="../img/heart_icon.png" alt="like" height="15" width="15" class="like_icon">
                <span><?= $currentPost['count_likes'] ?></span>
            </button>
        <?php endif; ?>
        <div class="info">
            <?php if ($currentPost['description'] != ''): ?>
                <p class="description">
                    <?= $currentPost['description'] ?>
                </p>
            <?php endif; ?>
            <?php if (isset($currentPost['post_time'])): ?>
                <span class="time">
            <?= date('d.m.Y H:i', $currentPost['post_time']) ?>
        </span>
            <?php endif; ?>
        </div>
    </div>
</main>
</body>
</html>





