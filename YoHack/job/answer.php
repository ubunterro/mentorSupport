<?php

include_once "../../engine/dbconf.php";

$test = false;

$hackid = $test ? 13 : $_POST["hackid"];
$qid = $test ? 4 : $_POST["qid"];
$who = $test ? "Test User" : $_POST["ansman"];
$ismentor = $test ? "false" : $_POST["ismentor"];
$text = $test ? "Omagad" : $_POST["text"];


if (!isset($qid) || !isset($who) || !isset($ismentor) || !isset($text)) {
    echo "Ошибка. Заполнены не все поля";
    return;
}

if ($ismentor == 'true') {
    $ment = query("SELECT * FROM `mentors` WHERE `mentorId`='$who' AND `hackId`='$hackid'");

    if (mysqli_num_rows($ment) == 0) {
        echo "Не найден ментор";
        return;
    } else {
        $mentn = mysqli_fetch_assoc($ment)["Name"];
        $time = date('Y-m-d H:i:s');
        //zapis
        if (!query("INSERT INTO answers 
        (`hackid`, `mentorid`, `nameparticipants`, `questionId`, `text`, `timestamp`) VALUES 
        ('$hackid', '$who', '$mentn', '$qid', '$text', '$time')")) {
            echo "Ошибка...";
        } else {
            echo "OK";
        }
    }
} else {

    $hackurl = "http://185.5.250.61" . mysqli_fetch_assoc(query("SELECT `adress` FROM `hackatons` WHERE `hack_id`='$hackid'"))["adress"];
    $qment = query("SELECT `mentor_addressant_id` FROM `questions` WHERE `questionId`='$qid' AND `hackId`='$hackid'");

    if (mysqli_num_rows($qment) == 0) {
        echo "Ошибка брат...";
        return;
    }

    $qment = mysqli_fetch_assoc($qment)["mentor_addressant_id"];
    $time = date('Y-m-d H:i:s');

    if (!query("INSERT INTO answers 
    (`hackid`, `mentorid`, `nameparticipants`, `questionId`, `text`, `timestamp`) VALUES 
    ('$hackid', '$qment', '$who', '$qid', '$text', '$time')")) {
    } else {
        echo "OK";
        header("Location: $hackurl");
    }
}
