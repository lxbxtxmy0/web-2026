<?php

$profile = [
    'full_name' => 'Ваня Денисов',
    'description' => 'Привет! Я системный аналитик в ACME :) Тут моя жизнь только для самых классных!',
    'avatar_image' => 'img/avatar.svg',
    'count_of_posts' => 43,
    'posts' => [
        ['img/snowy_street.jpg', 'Снежная улица'],
        ['img/building.jpg', 'Здание'],
        ['img/cake.jpg', 'Пирожоное'],
        ['img/students.jpg', 'Студенты'],
        ['img/packet.jpg', 'Пакет'],
        ['img/book.jpg', 'Книга'],
        ['img/sunny_street.jpg', 'Солнечная улица'],
        ['img/selfie.jpg', 'Селфи двух парней'],
        ['img/pot.jpg', 'Кастрюля'],
    ],
]
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>Profile</title>
</head>
<body>
<div class="page">
    <nav>
        <a href="../home" title="Домашняя страница">
            <img src="img/menu_icon_home.svg" alt="Домашняя страница" class="menu_icon">
        </a>
        <a href="#" title="Мой профиль">
            <img src="img/menu_icon_is_profile.svg" alt="Мой профиль" class="menu_icon">
        </a>
        <a href="#" title="Добавить публикацию">
            <img src="img/menu_icon_add.svg" alt="Добавить публицаию" class="menu_icon">
        </a>
    </nav>
    <main>
        <div class="header">
            <img src="<?= $profile['avatar_image'] ?>" alt="Аватар" class="avatar">
            <h1 class="name"><?= $profile['full_name'] ?></h1>
            <p class="description"><?= $profile['description'] ?></p>
            <div class="count_of_posts">
                <img src="img/image_icon.svg" alt="Иконка фото" class="photo_icon">
                <span><?= $profile['count_of_posts'] ?> поста</span>
            </div>
        </div>
        <div class="photos">
            <?php foreach ($profile['posts'] as $post): ?>
                <img src="<?= $post[0] ?>" alt="<?= $post[1] ?>" class="post_photo">
            <?php endforeach; ?>
        </div>
    </main>
</div>
</body>
</html>
