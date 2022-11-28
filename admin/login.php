<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="overflow-y: hidden;">
    <header>
        <a href="/"><img src="img/logo.svg" alt=""></a>
    </header>
    <section class="loginPage">
        <form method="post" action="login.php" class="loginForm">
            <p>
                <label for="login">Логин:</label>
                <input type="text" name="login" id="login" value="admin">
            </p>

            <p>
                <label for="password">Пароль:</label>
                <input type="password" name="password" id="password" value="admin">
            </p>

            <p class="login-submit">
                <button type="submit" class="login-button">Войти</button>
            </p>
        </form>
    </section>
</body>
</html>

<?php
$url = $_SERVER['REQUEST_URI'];
// echo $url;
if ($url == '/login.php') {
    header('Location: /',true);
}

$authData = parse_ini_file('./config.ini');

function authorised($authData)
{
    $inputLogin =    $_POST['login'];
    $inputPassword = $_POST['password'];

    $loginHash = password_hash($authData['login'], PASSWORD_DEFAULT);
    $passwordHash = password_hash($authData['password'], PASSWORD_DEFAULT);

    $verifyLogin = password_verify($inputLogin, $loginHash);
    $verifyPassword = password_verify($inputPassword, $passwordHash);

    if($verifyLogin && $verifyPassword){
        setcookie('login', $loginHash, time()+1800);
        setcookie('password', $passwordHash, time()+1800);
        header('Location: /');
    }
}
authorised($authData);