<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>Просмотр публикации</title>
</head>
<body>
<div class="page">
    <nav>
        <a href="index.php" title="Домашняя страница">
            <img src="img/menu_icon_home.svg" alt="Домашняя страница" height="40" width="40">
        </a>
    </nav>
    <main>
        <?php include __DIR__ . '/post_preview.php'; ?>
    </main>
</div>
</body>
</html>