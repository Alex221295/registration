<?php
set_time_limit(60);
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

function de($data)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    exit();

}

function select($tableName, $column, $params = [])
{
    global $conn;
    $sql = "SELECT $column FROM $tableName";
    if (!empty($params)) {
        $sql .= " WHERE";
        foreach ($params as $key => $value) {
            $sql .= " $key = $value and";
        }
        $sql = substr($sql, 0, -3);
    }
    $result = $conn->query($sql);
    $result = $result->fetch_all(MYSQLI_ASSOC);
    return $result;
}

function insert($tableName, $params)
{
    global $conn;
    $sql = "INSERT INTO $tableName (";
    foreach ($params as $column => $value) {
        $sql .= $column . ',';
    }
    $sql = substr($sql, 0, -1);
    $sql .= ') VALUES (';
    foreach ($params as $value) {
        $sql .= '"'.$value . '",';
    }
    $sql = substr($sql, 0, -1);
    $sql .= ')';
    $result = $conn->query($sql);
    if ($result) {
        return $result;
    }else{
        de('Ошибка в скрипте');
    }
    return true;
}

function update($tableName, $params, $conditional)
{
    global $conn;
    $sql = "UPDATE $tableName SET ";
    foreach ($params as $column => $value) {
        $sql .= "$column = '$value' ,";
    }
    $sql = substr($sql, 0, -1);
    $sql .= " WHERE ";
    foreach ($conditional as $key => $value) {
        $sql .= "$key = $value and";
    }
    $sql = substr($sql, 0, -3);
    $result = $conn->query($sql);
    if ($result) {
        return $result;
    }else{
        de('Ошибка в скрипте');
    }
    return true;

}




