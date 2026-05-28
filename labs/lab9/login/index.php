<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <title>Login</title>
</head>
<body>
<div class="page">
    <div class="welcome_side">
        <h1>Войти</h1>
        <img src="../src/img/welcome.png" alt="welcome" class="welcome_img">
    </div>
    <form class="login">
        <p class="error_field"></p>
        <div class="email">
            <label for="email-field">Электропочта</label>
            <input type="email" class="email_field" id="email-field">
            <p class="example">Введите электропочту в формате *****@***.**</p>
        </div>
        <div class="password">
            <label for="password-field">Пароль</label>
            <input type="password" class="password_field" id="password-field">
            <button type="button" class="hide_password">
                <img src="../src/img/eye_off.svg" alt="Скрыть пароль" class="img_eye_off">
            </button>
        </div>
        <button type="submit" class="continue">Продолжить</button>
    </form>
</div>
</body>
</html>
