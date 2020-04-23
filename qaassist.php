<?php
include 'dbconf.php';

error_reporting(E_ALL);
ini_set('display_errors','On');

/**
 * Обновляет кеш вопрос-ответов
 * @param  mixed $hackid ID Хакатона
 * @return mixed true при успешном добавлении, и текст ошибки при неудачном
 */
function UpdateCacheQA($hackid)
{
    $sql = "SELECT `topic` FROM `questions` WHERE `hackId` = $hackid";

    $qres = query($sql);

    global $mysqli;

    if (!$qres)
    {
        echo "alert(Ошибка запроса к БД: " . mysqli_error($mysqli) . ')';
        return;
    }

    $result = mysqli_fetch_all($qres);

    if(sizeof($result) == 0)
        return;

    $json = json_encode($result);

    $cachefile = fopen("cache/questions/$hackid.json", "w");
    if (fwrite($cachefile, $json) != false) {
        fclose($cachefile);
        echo 'OK ' . $hackid;
    } else {
        echo "Ошибка при записи текста в кеш";
    }
}

//Взаимодействие через пост-запрос
if (isset($_POST['hackId']))
    UpdateCacheQA($_POST['hackId']);


?>

<html>

<body>
    <form action="qaassist.php" method="post">
        ID Хакатона: <input type="text" name="hackId" value="">
        <input type="submit" value="Отправить" />
    </form>
</body>

</html>