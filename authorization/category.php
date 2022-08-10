<?php
include_once 'db.php';
include_once 'func.php';
if (!empty($_GET['id'])){
    $params['id'] = $_GET['id'];
}
$roleForUser = select('user', 'role', $params);
foreach ($roleForUser as $role) {
    if ($role['role'] === 'admin') {
        echo '<form>
<input type="text" name="addCategory">
<input type="hidden" name="id" value="'.$_GET['id'].'">
<input type="submit" >
</form>';
    }
}
//de($_GET);
if (isset($_GET['addCategory'])) {
    $paramsForInsert['name'] = $_GET['addCategory'];
    if (insert('category', $paramsForInsert)) {
        header('Location:http://localhost:8888/authorization/category.php?id=' . $_GET['id']);
    }
}



$sql = "SELECT * FROM category";
$result = $conn->query($sql);
$result = $result->fetch_all(MYSQLI_ASSOC);
//de($result);
foreach ($result as $v) {
//    echo "<a href='/category_product/index.php?category=1'>1</a>";
    echo "<a href='/authorization/product.php?category_id=" . $v['id'] . "'>" . $v['name'] . '<br>' . "'</a>'";
}