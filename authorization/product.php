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
    $sql = 'INSERT INTO product (name,category_id) VALUES (\'' . $_GET['addProduct'] . '\',\'' . $_GET['category_id'] . '\')';
    $result = $conn->query($sql);
    if ($result) {
        header('Location:http://localhost:8888/category_product/product.php?category_id=' . $_GET['category_id']);
    }

}

$sql = "SELECT name FROM product WHERE category_id=" . $_GET['category_id'];
$result = $conn->query($sql);
foreach ($result->fetch_all(MYSQLI_ASSOC) as $v) {
    echo $v['name'] . '<br>';
}