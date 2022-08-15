<?php

set_time_limit(60);
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include_once "db.php";
function de($data)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    exit();

}

function select(string $tableName, string $column, array $params = [] ) : array
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

function insert( string $tableName, array $params) : int
{
    global $conn;
    $sql = "INSERT INTO $tableName (";
    foreach ($params as $column => $value) {
        $sql .= $column . ',';
    }
    $sql = substr($sql, 0, -1);
    $sql .= ') VALUES (\''.implode('\',\'',$params).'\')';
    $result = $conn->query($sql);
    $lastId = $conn->insert_id;
    return $lastId;
}

function update(string $tableName, array $params, array $conditional) : bool
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
    return $result;

}
function delete(string $tableName,array $conditional) : bool
{
    global $conn;
    $sql = "DELETE FROM $tableName WHERE"; // несколько параметров
    foreach ($conditional as $column=>$value){
        $sql.= " $column = $value and";
    }
    $sql = substr($sql,0,-3);
    $result = $conn->query($sql);
    return $result;
}




