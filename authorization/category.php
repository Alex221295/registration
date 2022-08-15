<?php
include_once 'db.php';
include_once 'func.php';
if (!empty($_GET['id'])) {
    $params['id'] = $_GET['id'];
}
$roleForUser = select('user', 'role', $params);
foreach ($roleForUser as $role) {
    if ($role['role'] === 'admin') {
        echo '<form>
<input type="text" name="addCategory">
<input type="hidden" name="id" value="' . $_GET['id'] . '">
<input type="submit" >
</form>';
    }
}
if (isset($_GET['addCategory'])) {
    $paramsForInsert['name'] = $_GET['addCategory'];
    try {
        insert('category', $paramsForInsert);
        header('Location:http://localhost:8888/authorization/category.php?id=' . $_GET['id']);

    }catch (TypeError $exception){
        echo "не правельный возврат данных в методе insert".$exception->getLine();
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