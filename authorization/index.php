<?php

set_time_limit(60);
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include_once 'db.php';
include_once 'func.php';
session_start();
if (isset($_SESSION['token']) && !empty($_SESSION['token'])){
    header('Location:http://localhost:8888/authorization/category.php');
}else {
    echo '
<form action="login.php">
<input type="email" name="email" placeholder="введите email" required>
<input type="password" name="password" placeholder="введите пароль" required>
<input type="submit" value="вход">
<br>
<a href="registration.php">регистрация</a>
</form>
';
}