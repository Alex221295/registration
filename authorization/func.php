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
function select($tableName, $column, $params = null)
{
    global $conn;
    $sql = "SELECT $column FROM $tableName";
    if (!empty($params)) {
        $sql .= " WHERE";
        foreach ($params as $key => $value) {
            $sql .= " $key = $value and";
        }
        $sql = substr($sql,0,-3);
    }
    $result = $conn->query($sql);
    $result = $result->fetch_all(MYSQLI_ASSOC);
    return $result;
}



