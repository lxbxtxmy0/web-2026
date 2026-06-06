<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <title>CREATE POST</title>
</head>
<body>
<div class="page">
    <nav>
        <a href="../home" title="Домашняя страница">
            <img src="../src/img/menu_icon_home.svg" alt="Домашняя страница" height="40" width="40">
        </a>
        <a href="../profile" title="Мой профиль">
            <img src="../src/img/menu_icon_profile.svg" alt="Мой профиль" height="40" width="40">
        </a>
        <a href="#" title="Добавить публикацию">
            <img src="../src/img/menu_icon_add.svg" alt="Добавить публикацию" height="40" width="40">
        </a>
    </nav>
    <main>
        <h1 class="page_title">Новая публикация</h1>
        <p class="success">Пост успешно сохранён!</p>
        <p class="error_message"></p>
        <form class="create_post">
            <input type="file" id="file_input" class="hidden_input">
            <div class="post_container">
                <div class="add_photo_field">
                    <div class="add_photo_block">
                        <span class="img_icon">🖼️</span>
                        <button type="button" id="black_btn" class="add_button">Добавить фото</button>
                    </div>
                    <button type="button" class="slider_left">
                        <img src="../src/img/left_button.svg" alt="Предыдущее фото" height="10" width="10">
                    </button>
                    <button type="button" class="slider_right">
                        <img src="../src/img/right_button.svg" alt="Следуещее фото" height="10" width="10">
                    </button>
                </div>
                <button type="button" id='blue_btn' class="add_photo">
                    <img src="../src/img/add_icon.svg" alt="добавить фото" width="16" height="16">
                    Добавить фото
                </button>
                <textarea maxlength="400" placeholder="Добавьте подпись..." class="description_field" id="post-description" name="description"></textarea>
            </div>
            <button type="submit" class="share" id="submit_btn">Поделиться</button>
        </form>
    </main>
</div>
</body>
</html>