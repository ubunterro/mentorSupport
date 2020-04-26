<?php
//настройки хоста
$host = "127.0.0.1";
$user = "xaxaton";
$pwd = "xaxaton";
$db = "xaxaton";


//инициализация и коннект

$mysqli = new mysqli($host, $user, $pwd, $db);

if ($mysqli->connect_errno) {
    echo  $mysqli->connect_errno . "\n" . $mysqli->connect_error . "\n";
    exit;
}


//для запросов
function query($query) {
    global $mysqli;
    return mysqli_query($mysqli, $query);
}