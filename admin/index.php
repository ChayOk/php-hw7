<?php
// require_once './explorer.php';
if ($_COOKIE['login'] != $loginHash && $_COOKIE['password'] != $passwordHash) {
    require_once './explorer.php';
}else{
    require_once './login.php';
}

