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

//$sql = "SELECT name FROM product WHERE category_id=" . $_GET['category_id'];
//$result = $conn->query($sql);
foreach (select('product','name',(array)$params) as $v) {
    echo $v['name']  . '<a href = #>   обновить</a>'. '<br>';
}