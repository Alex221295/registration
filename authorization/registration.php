<?php
include_once 'db.php';
function de($data)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    exit();
}

echo '
<form>
<input type="name" name="name" placeholder="введите имя" required>
<input type="surename" name="surename" placeholder="введите фамилию" required>
<input type="email" name="email" placeholder="введите email" required>
<input type="password" name="password" placeholder="введите пароль" required>
<input type="submit" value="регистрация">
<br>
<a href="index.php">На главную</a>
<br>
</form>
';
if (isset($_GET['name']) && isset($_GET['surename']) && isset($_GET['email']) && isset($_GET['password'])) {
    $sql = "SELECT email FROM user";
    $result = $conn->query($sql);
    $checkUserEmail = '';
    foreach ($result->fetch_all(MYSQLI_ASSOC) as $userInfo) {
        if (isset($userInfo['email'])) {
            $checkUserEmail = $userInfo['email'];
        }
    }
    if ($checkUserEmail === $_GET['email']) {
        echo "Такой пользователь существует";
    } else {
        $sql = "INSERT INTO user (name,surname,email,password,role) VALUES ('" . $_GET['name'] . "',
           '" . $_GET['surename'] . "','" . $_GET['email'] . "','" . $_GET['password'] . "','user')";
        $result = $conn->query($sql);
        if ($result) {
            $id = $conn->insert_id;
//            de($id);
//            echo 'регистрация прошла успешно';
            header('Location:http://localhost:8888/authorization/category.php?id='.$id);
        }
    }


}