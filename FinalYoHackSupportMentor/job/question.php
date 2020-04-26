<?php
        include "../../engine/dbconf.php";


        $name=$_POST["name"];
        $namexakoton=$_POST["namexakoton"];
        $text=$_POST["text"];
        $select=$_POST["select"];
        $menname=$_POST["menname"];

        if(empty($name)or empty($text)or empty($select)or empty($menname)){
            exit ('Все поля обязательны для заполнения');
        }
       
        global $mysqli;



        $tekyh = query("SELECT * FROM `hackatons` WHERE `name`='$namexakoton'");

        $aret=mysqli_fetch_assoc($tekyh);
        $hack_id=$aret["hack_id"];


        $mentoran= query("SELECT * FROM `mentors` WHERE `hackId`='$hack_id' and `Name`='$menname'");
        $ar=mysqli_fetch_assoc($mentoran);
        $mentorId=$ar["mentorId"];


        $datatime=date('Y-m-d H:i:s');

        $avtoriz = "";

        if (isset($_COOKIE["avtoriz"])){
            $avtoriz = $_COOKIE["avtoriz"];
        } else {
            $avtoriz = uniqid();
            setcookie("avtoriz", $authorHash, time() + 2592000);
        }

        $rot=query("INSERT INTO `questions`(`hackId`,`author`, `mentor_addressant_id`, `text`, `topic`, `timestamp`,`isAnswered`, `rating`, `authorUUID`)  VALUES ('$hack_id','$name','$mentorId','$text','$select','$datatime','0', '0', '$avtoriz')");
        //echo(strval($rot));
        if($rot){
           


            echo "<meta http-equiv=\"refresh\" content=\"0;url=" . $_SERVER['HTTP_REFERER'] . "\">";
            
        }
        else{
            echo'Не добавили по какой-то причине, напишите разработчику ';
            echo  $datatime;
            echo mysqli_error($mysqli);
        }
?>