<?php
set_time_limit(60);
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
function de($data)
{
    echo '<pre>';
    var_dump($data);
    echo '<pre>';
    exit();
}

de($_GET);
if (empty($_GET)) {

    echo '<form>';
    echo '<label>Страна</label>';
    echo '<input type="text" name="country">';
    echo '<input type="submit">';
    echo '</form>';
}
if (!empty($_GET)) {
    echo "<a href = 'get_params.php'> удалить</a>";
    echo '<br>';

}

if (isset($_GET['country'])) {
    $allCountry = [];
    $allCountry[] = $_GET['country'];
    $urlCountry = http_build_query($allCountry);
//    $allCity[] = $_GET['city'];
//    $urlCity = http_build_query($allCity);
    echo '<form>';
    echo '<label>Страна</label>';
    echo "<input type='text' name='addCountry' > ";
    echo "<input type='hidden' name='hiddenCountry' value='$urlCountry'> ";
    echo '<input type="submit" >';
    echo '<br>';
    echo $_GET['country'];
    echo '<br>';
    echo '<label>Город</label>';
    echo "<input type='text' name='city' > ";
    echo '<input type="submit" >';

    echo '<br>';
    echo '</form>';
}
//if (isset())
if (!empty($_GET['city'])) {
    $country = explode('=', $_GET['hiddenCountry']);
    $stringCountry = [];
    for ($i = 1; $i <= count($country) - 1; $i++) {
        $stringCountry[] = $country[$i];
    }
    $urlCountry = http_build_query($stringCountry);
    $allCity[] = $_GET['city'];
    $urlCity = http_build_query($allCity);
    echo '<form>';
    echo '<label>Страна</label>';
    echo "<input type='text' name='addCountry' > ";
    echo "<input type='hidden' name='hiddenCountry' value='$urlCountry'> ";
    echo '<input type="submit" >';
    echo '<br>';
    echo $country[1] . "<br>";
    echo $_GET['city'] . "<br>";
    echo '<label>Город</label>';
    echo "<input type='text' name='addCity' > ";
    echo "<input type='hidden' name='hiddenCity' value='$urlCity' > ";
    echo '<input type="submit" >';


}
if (isset($_GET['hiddenCity']) && empty($_GET['addCountry'])) {
    $enCodCountry = explode('=', $_GET['hiddenCountry']);
    $country = [];
    $country[] = $enCodCountry[1];
    $urlCountry = http_build_query($country);
    $allCity = [];
    if (stristr($_GET['hiddenCity'], '&') !== FALSE) {
        $oldCity = explode('&', $_GET['hiddenCity']);
        foreach ($oldCity as $citi) {
            $oneCity = explode('=', $citi);
            $allCity[] = $oneCity[1];
        }
//            de($allCity);
        array_push($allCity, $_GET['addCity']);

    } else {
        $oldCity = explode('=', $_GET['hiddenCity']);
        unset($oldCity[0]);
        for ($i = 1; $i <= count($oldCity) ; $i++) {
            if ($i % 2 == 0) {
                continue;
            } else {
                $allCity[] = $oldCity[$i];
            }
        }

        array_push($allCity, $_GET['addCity'][2]);
//        de($allCity);
    }
    $urlCity = http_build_query($allCity);
    echo '<form>';
    echo '<label>Страна</label>';
    echo "<input type='text' name='addCountry' > ";
    echo "<input type='hidden' name='hiddenCountry' value='$urlCountry'> ";
    echo '<input type="submit" >';
    echo '<br>';
    echo $enCodCountry[1] . '<br>';
    foreach ($allCity as $city) {
        echo $city . '<br>';
    }
    echo '<label>Город</label>';
    echo "<input type='text' name='addCity' > ";
    echo "<input type='hidden' name='hiddenCity' value='$urlCity' > ";
    echo '<input type="submit" >';

}
if (isset($_GET['hiddenCountry']) && isset($_GET['addCity']) && isset($_GET['hiddenCity']) && !empty($_GET['addCountry'])) {

    $allCity = explode('=', $_GET['hiddenCity']);
    $oldCountry = explode('=', $_GET['hiddenCountry']);
//    de($allCity);
    unset($oldCountry[0]);
    unset($allCity[0]);
    array_push($oldCountry, $_GET['addCountry']);
//    de($allCity);
    $urlCountry = http_build_query($oldCountry);
    $urlCity = http_build_query($allCity);

    echo '<form>';
    echo '<label>Страна</label>';
    echo "<input type='text' name='addCountry' > ";
    echo "<input type='hidden' name='hiddenCountry' value='$urlCountry'> ";
    echo '<input type="submit" >';
    echo '<br>';
    for ($i = 1; $i <= count($oldCountry); $i++) {
        echo $oldCountry[$i] . '<br>';
        if (isset($allCity[$i])){
            echo $allCity[$i] . '<br>';
        }
        echo '<label>Город</label>';
        echo "<input type='text' name='addCity[$i]' > ";
        echo "<input type='hidden' name='hiddenCity' value='$urlCity' > ";
        echo '<input type="submit" >';
        echo '<hr>';
//        de($_GET);
    }
}
if (isset($_GET['hiddenCountry']) && empty($_GET['city']) && empty($_GET['hiddenCity'])) {
    $newCountry = $_GET['addCountry'];
    $oldCountry = explode('&', $_GET['hiddenCountry']);
    $allStringCountry = [];
    $allCountry = [];
    foreach ($oldCountry as $k => $v) {
        $country = explode('=', $v);
        echo $country[1];
        echo '<br>';
        echo '<label>Город</label>';
        echo "<input type='text' name='city' > ";
        echo '<input type="submit" name="submitCity">';

        echo '<br>';
        echo '<hr>';

        $allCountry[] = $country[1];
    }
    de($allCountry);
    echo $newCountry . '<br>';
    echo '<br>';
    echo '<label>Город</label>';
    echo "<input type='text' name='city' > ";
    echo '<input type="submit" name="submitCity">';

    echo '<hr>';


    $allCountry[] = $newCountry;

    $urlCountry = http_build_query($allCountry);
    echo '<form>';
    echo '<label>Страна</label>';
    echo "<input type='text' name='addCountry' > ";
    echo "<input type='hidden' name='hiddenCountry' value='$urlCountry'> ";
    echo '<input type="submit">';
    echo '<br>';
    echo '<br>';


}


