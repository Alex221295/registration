<?php

$servername = "localhost";
$username = "alex";
$password = "";
$db = "authorization";

// Создание соединения
$conn = new mysqli($servername, $username, $password,$db);
// Проверка соединения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}else{
    echo 'Подключена БД <hr>';
}
