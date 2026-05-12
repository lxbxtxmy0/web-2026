<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
<div class="page">
    <div class="welcome_side">
        <h1>Войти</h1>
        <img src="img/welcome.png" alt="welcome" class="welcome_img">
    </div>
    <form class="login">
        <div class="email">
            <label for="email-field">Электропочта</label>
            <input type="email" class="input-field" id="email-field">
            <p class="example">Введите электропочту в формате *****@***.**</p>
        </div>
        <div class="password">
            <label for="password-field">Пароль</label>
            <input type="password" class="input-field" id="password-field">
            <button class="hide_password">
                <img src="img/eye_off.svg" alt="Скрыть пароль" class="img_eye_off">
            </button>
        </div>
        <button class="continue">Продолжить</button>
    </form>
</div>
</body>
</html>
