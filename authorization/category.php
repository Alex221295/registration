<?php
include_once 'db.php';
include_once 'func.php';
$result = $conn->query($sql);
$result = $result->fetch_all(MYSQLI_ASSOC);
$sql = "SELECT role FROM user WHERE id =".$_GET['id'];


foreach ($result as $role){
    if ($role['role'] === 'admin'){
        echo '<form>
<input type="text" name="addCategory">
<input type="submit" >
</form>';
        if (isset($_GET['addCategory'])){
            $sql = 'INSERT INTO category (name) VALUES (\''.$_GET['addCategory'].'\')';
//    de($sql);
            $result = $conn->query($sql);
            if ($result){
                header('Location:http://localhost:8888/authorization/category.php');
            }
        }
    }
}

$sql = "SELECT * FROM category";
$result = $conn->query($sql);
$result = $result->fetch_all(MYSQLI_ASSOC);
//de($result);
foreach ($result as $v){
//    echo "<a href='/category_product/index.php?category=1'>1</a>";
    echo "<a href='/authorization/product.php?category_id=".$v['id']."'>".$v['name'].'<br>'."'</a>'";
}