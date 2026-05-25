<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
    <script src="slider.js"></script>
    <script src="modalWindow.js"></script>
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
            <img src="img/menu_icon_add.svg" alt="Добавить публикацию" height="40" width="40">
        </a>
    </nav>
    <main>
        <?php foreach ($posts as $post): ?>
            <?php include __DIR__ . '/post_preview.php'; ?>
        <?php endforeach; ?>
    </main>
</div>
<div class="modal_window">
    <div class="post_window">
        <button class="close_button">
            <img src="img/close_window.svg" alt="закрыть">
        </button>
        <div class="photo">
            <div class="photos"></div>
            <button class="modal_slider_left">
                <img src="img/left_button.svg" alt="Предыдущее фото" height="20" width="20">
            </button>
            <button class="modal_slider_right">
                <img src="img/right_button.svg" alt="Следуещее фото" height="20" width="20">
            </button>
        </div>
        <span class="modal_count_photos"></span>
    </div>
</div>
</body>
</html>