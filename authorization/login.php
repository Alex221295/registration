<?php
include_once 'func.php';
include_once 'db.php';
session_start();
if (!empty($_GET)) {
    $result= select('user','*');
    $userEmail = '';
    $userPassword = '';
    foreach ($result as $userInfo) {
        if ($userInfo['email'] === $_GET['email']) {
            $userEmail = $_GET['email'];
            if ($userInfo['password'] !== $_GET['password']) {
                echo 'не верный пароль';
            } else {
                $token = bin2hex(openssl_random_pseudo_bytes(20));
                $_SESSION['token'] = $token;
                $userId['id'] = $userInfo['id'];
                $params['token'] = $token;
                if (update('user',$params,$userId))     {
                    header('Location:http://localhost:8888/authorization/category.php?id=' . $userId['id']);
                }else{
                    echo 'Не удалось создать токен';
                }

            }
        }
    }
    if (empty($userEmail)) {
        echo 'такого пользователя не существует,пройдите регистрацию!';
    }
}