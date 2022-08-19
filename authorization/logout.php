<?php
include_once 'func.php';
session_start();
unset($_SESSION['token']);
header('Location:http://localhost:8888/authorization/');
