<?php require_once "data.php"; ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <title>Home</title>
</head>
<body>
<nav>
    <a href="#" title="Домашняя страница">
        <img src="../img/menu_icon_is_home.png" alt="Домашняя страница" height="40" width="40">
    </a>
    <a href="#" title="Мой профиль">
        <img src="../img/menu_icon_profile.png" alt="Мой профиль" height="40" width="40">
    </a>
    <a href="#" title="Добавить публикацию">
        <img src="../img/menu_icon_add.png" alt="Добавить публицаию" height="40" width="40">
    </a>
</nav>
<main>
    <?php foreach ($posts as $post) {
        include 'post_preview.php';
    }
    ?>
</main>
</body>
</html>



