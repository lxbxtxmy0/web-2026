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
<nav>
    <a href="../home" title="Домашняя страница">
        <img src="img/menu_icon_home.svg" alt="Домашняя страница" height="40" width="40">
    </a>
    <a href="#" title="Мой профиль">
        <img src="img/menu_icon_is_profile.svg" alt="Мой профиль" height="40" width="40">
    </a>
    <a href="#" title="Добавить публикацию">
        <img src="img/menu_icon_add.svg" alt="Добавить публицаию" height="40" width="40">
    </a>
</nav>
<main>
    <div class="header">
        <img src="<?= $profile['avatar_image'] ?>" alt="Аватар" height="123" width="123" class="avatar">
        <h1 class="name"><?= $profile['full_name'] ?></h1>
        <p class="description"><?= $profile['description'] ?></p>
        <div class="count_of_posts">
            <img src="img/image_icon.svg" alt="Иконка фото" width="16" height="16">
            <span><?= $profile['count_of_posts'] ?> поста</span>
        </div>
    </div>
    <div class="photos">
        <?php foreach ($profile['posts'] as $post): ?>
            <img src="<?= $post[0] ?>" alt="<?= $post[1] ?>" width="300" height="300">
        <?php endforeach; ?>
    </div>
</main>
</body>
</html>
