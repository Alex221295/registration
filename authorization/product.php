<?php
include_once 'db.php';
include_once 'func.php';
session_start();
echo "<a href = 'logout.php'>выйти</a>  <br>";
if (isset($_SESSION['token']) && !empty($_SESSION['token'])){
echo '<form>
<a href="category.php">назад</a>
<br>
<input type="text" name="addProduct">
<input type="hidden" name="category_id" value="' . $_GET['category_id'] . '">
<input type="submit" >
</form>';
if (isset($_GET['addProduct'])) {
    $params['name'] = $_GET['addProduct'];
    $params['category_id'] = $_GET['category_id'];
    try {
        insert('product', $params);
        header('Location:http://localhost:8888/authorization/product.php?category_id=' . $_GET['category_id']);
    }catch (TypeError $exception){
        echo "не правельный возврат данных в методе insert".$exception->getLine();
    }
}
$params['category_id'] = $_GET['category_id'];
if (!empty($_GET['update'])){
    $paramsForUpdate['name'] = $_GET['update'];
    $conditional['id'] = $_GET['id'];
    try {
        update('product',$paramsForUpdate,$conditional);
    }catch (TypeError $exception){
        echo "не правельный тип данных в методе update".$exception->getLine();
    }
}
if (isset($_GET['delete'])){
    $paramsForDelete['id'] = $_GET['id'];
    try {
        delete($_GET['tableName'],$paramsForDelete);
    }catch (TypeError $exception){
        echo "не правельный тип данных в методе delete ".$exception->getFile();
        echo " строка: ".$exception->getLine();
        echo '<br>';
    }
}
try {
    $result = select('product','*',$params);
}catch (TypeError $exception){
    echo "не правельный возврат данных в методе select".$exception->getLine();
}
foreach ($result as $v) {
    echo $v['name'] ;
    echo "<a href='/authorization/update.php?category_id=" . $v['category_id'] . "&id=".$v['id']."&name=".$v['name']."&tableName=product'> обновить</a>";
    echo "<a href='/authorization/product.php?delete&category_id=" . $_GET['category_id'] . "&tableName=product&id=".$v['id']."'>X</a>";
    echo '<br>';
}
}else{
    header('Location:http://localhost:8888/authorization/');
}