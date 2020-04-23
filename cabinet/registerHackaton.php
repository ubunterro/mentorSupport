<?php
/// Входные данные для регистрации хакатона 
/// owner_id - id владельца хакатона 
/// name - название хакатона


include $_SERVER['DOCUMENT_ROOT'] .  "/dbconf.php";

if(isset($_POST['owner_id']) && isset($_POST['name']))
{

    //TODO проверка на уникальность имени

    registerHackaton(intval($_POST['owner_id']), $_POST['name']);
}


function registerHackaton($owner_id, $name){
    query("INSERT INTO hackatons (name, owner_id) VALUES ('$name', '$owner_id')");
    echo "<h1>hackaton added</h1>";
}

?>