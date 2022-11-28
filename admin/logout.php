<?php
if ($_COOKIE['login'] && $_COOKIE['password']) {
    setcookie('login', $loginHash, time()-10);
    setcookie('password', $passwordHash, time()-10);
    header('Location: /');
}
