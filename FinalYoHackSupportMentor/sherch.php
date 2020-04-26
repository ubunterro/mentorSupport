<?php
        $name=$_POST["namen"];


        if(empty($name)){
            exit ('Все поля обязательны для заполнения');
        }
        include_once '../engine/dbconf.php';

         $tekyh=query("SELECT * FROM `hackatons` WHERE `name`='$name'");
         $tekyhro= mysqli_num_rows($tekyh);

         $array=mysqli_fetch_assoc($tekyh);
         $adress=$array["adress"];

         if($tekyhro==1){
            echo $adress;
         }
         else{
         	echo "не найдено";
         }
