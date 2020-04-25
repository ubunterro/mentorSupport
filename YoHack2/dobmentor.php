<?php
        $name=$_POST["name"];
        $fi=$_POST["fi"];
        $series=$_POST["series"];
        $time=$_POST["time"];
        $option=$_POST["option"];
        $email=$_POST["email"];

        if(empty($name)or empty($fi)or empty($series)or empty($time)or empty($option)or empty($email)){
            exit ('Все поля обязательны для заполнения');
        }
        include_once 'bd_connect.php';


         $rot= mysql_query("INSERT INTO `mentors`(`hackId`, `Name`, `status`, `time`, `section`, `email`) VALUES ('$name','$fi','$series','$time','$option','$email')");

         $tekyh=  mysql_query("SELECT * FROM `hackatons` WHERE `name`='$name'");
         $tekyhro= mysql_num_rows($tekyh);

         $aret=mysql_fetch_assoc($tekyh);
         $nameet=$name.'.php';

         if($tekyhro==1){

         }
         else{

         	$roty= mysql_query("INSERT INTO `hackatons`(`name`, `adress`) VALUES ('$name','$nameet')");


         $a=0;
        $g=fopen($nameet, "w");
        copy($file, $new_file); // делаем копию
        unlink($file); // удаляем оригинал

        fwrite($g, $a);
        fclose($g);




         }


        if($rot=='TRUE'){
            echo 'добавлен';
        }
        else{
            echo'Не добавили по какой-то причине, напишите разработчику';
        }

