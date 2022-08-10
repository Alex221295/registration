<?php

$servername = "localhost";
$username = "alex";
$password = "";
$db = "authorization";

$check = 1111;
$conn = new mysqli($servername, $username, $password,$db);
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}else{
    echo 'Подключена БД <hr>';
}
