<?php require_once "data.php"; ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>
<body>
<div class="page">
    <nav>
        <a href="#" title="Домашняя страница">
            <img src="img/menu_icon_is_home.svg" alt="Домашняя страница" height="40" width="40">
        </a>
        <a href="../profile" title="Мой профиль">
            <img src="img/menu_icon_profile.svg" alt="Мой профиль" height="40" width="40">
        </a>
        <a href="#" title="Добавить публикацию">
            <img src="img/menu_icon_add.svg" alt="Добавить публицаию" height="40" width="40">
        </a>
    </nav>
    <main>
        <?php foreach ($posts as $post) {
            include 'post_preview.php';
        }
        ?>
    </main>
</div>
</body>
</html>



