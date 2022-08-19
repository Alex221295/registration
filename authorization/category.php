<?php
include_once 'db.php';
include_once 'func.php';
session_start();
echo "<a href = 'logout.php'>выйти</a> <br>";

if (isset($_SESSION['token']) && !empty($_SESSION['token'])){

if (!empty($_GET['id'])) {
    $params['id'] = $_GET['id'];
}
$roleForUser = select('user', '*', $params);
foreach ($roleForUser as $infoForUser) {
    if ($infoForUser['role'] === 'admin') {
        if ($infoForUser)
        echo '<form>
<input type="text" name="addCategory">
<input type="hidden" name="id" value="' . $_GET['id'] . '">
<input type="submit" >
</form>';
    }
}
if (isset($_GET['addCategory'])) {
    $paramsForInsert['name'] = $_GET['addCategory'];
    if (insert('category', $paramsForInsert)){
        header('Location:http://localhost:8888/authorization/category.php?id=' . $_GET['id']);
    }else{
        echo 'Ошибка метод insert';
    }
}

if (!empty($_GET['update'])){
    $paramsForUpdate['name'] = $_GET['update'];
    $conditional['id'] = $_GET['category_id'];
    try {
        update('category',$paramsForUpdate,$conditional);
    }catch (TypeError $exception){
        echo "не правельный возврат данных в методе select".$exception->getLine();
    }
}
if (isset($_GET['delete'])){
    $paramsForDelete['id'] = $_GET['category_id'];
    delete($_GET['tableName'],$paramsForDelete);
    try {
        delete($_GET['tableName'],$paramsForDelete);
    }catch (TypeError $exception){
        echo "не правельный возврат данных в методе delete".$exception->getLine();
    }
}
try {
    $result = select('category','*');
}catch (TypeError $exception){
    echo "не правельный возврат данных в методе select".$exception->getLine();
}
foreach ($result as $v) {
    echo "<a href='/authorization/product.php?category_id=" . $v['id'] . "'>" . $v['name']  . "</a>";
    echo "<a href='/authorization/update.php?category_id=" . $v['id'] . "&id=".$_GET['id']."&name=".$v['name']."&tableName=category'> обновить</a>";
    echo "<a href='/authorization/category.php?delete&category_id=" . $v['id'] . "&tableName=category&id=".$_GET['id']."'>X</a>";
    echo '<br>';
}
}else{
    header('Location:http://localhost:8888/authorization/');
}