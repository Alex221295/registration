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
    if (insert('category', $paramsForInsert)) {
        header('Location:http://localhost:8888/authorization/category.php?id=' . $_GET['id']);
    }
}

if (!empty($_GET['update'])){
    $paramsForUpdate['name'] = $_GET['update'];
    $conditional['id'] = $_GET['category_id'];
    update('category',$paramsForUpdate,$conditional);
}
if (isset($_GET['delete'])){
    delete($_GET['tableName'],$_GET['category_id']);
}
$result = select('category','*');
foreach ($result as $v) {
    echo "<a href='/authorization/product.php?category_id=" . $v['id'] . "'>" . $v['name']  . "</a>";
    echo "<a href='/authorization/update.php?category_id=" . $v['id'] . "&id=".$_GET['id']."&name=".$v['name']."&tableName=category'> обновить</a>";
    echo "<a href='/authorization/category.php?delete&category_id=" . $v['id'] . "&tableName=category&id=".$_GET['id']."'>X</a>";
    echo '<br>';
}