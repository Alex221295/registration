<?php
set_time_limit(60);
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include_once 'db.php';
include_once 'func.php';
echo '
<form>
<input type="email" name="email" placeholder="введите email" required>
<input type="password" name="password" placeholder="введите пароль" required>
<input type="submit" value="вход">
<br>
<a href="authorization/registration.php">регистрация</a>
</form>
';
if (!empty($_GET)) {

    $sql = "SELECT * FROM user";
    $result = $conn->query($sql);
    $userEmail = '';
    $userPassword = '';
    $id = 0;
    foreach ($result->fetch_all(MYSQLI_ASSOC) as $email) {
        if ($email['email'] === $_GET['email']) {
            $userEmail = $_GET['email'];
            if ($email['password'] !== $_GET['password']) {
                echo 'не верный пароль';
            } else {
                $id = $email['id'];
                header('Location:http://localhost:8888/authorization/category.php?id=' . $id);
            }
        }
    }
    if (empty($userEmail)) {
        echo 'такого пользователя не существует,пройдите регистрацию!';
    }
}