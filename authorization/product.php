<?php
include_once 'db.php';
include_once 'func.php';
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
    if (insert('product',(array) $params)) {
        header('Location:http://localhost:8888/authorization/product.php?category_id=' . $_GET['category_id']);
    }
}
$params['category_id'] = $_GET['category_id'];
if (!empty($_GET['update'])){
    $paramsForUpdate['name'] = $_GET['update'];
    $conditional['id'] = $_GET['category_id'];
    update('product',$paramsForUpdate,$conditional);
}
if (isset($_GET['delete'])){
    delete($_GET['tableName'],$_GET['id']);
}
foreach (select('product','*',(array)$params) as $v) {
    echo $v['name'] ;
    echo "<a href='/authorization/update.php?category_id=" . $v['id'] . "&id=".$v['category_id']."&name=".$v['name']."&tableName=product'> обновить</a>";
    echo "<a href='/authorization/product.php?delete&category_id=" . $_GET['category_id'] . "&tableName=product&id=".$v['id']."'>X</a>";
    echo '<br>';
}