<?php
        $name=$_POST["name"];


        if(empty($name)){
            exit ('Все поля обязательны для заполнения');
        }
        include_once 'bd_connect.php';

         $tekyh=  mysql_query("SELECT * FROM `hackatons` WHERE `name`='$name'");
         $tekyhro= mysql_num_rows($tekyh);

         $array=mysql_fetch_assoc($tekyh);
         $adress=$array["adress"];

         if($tekyhro==1){
            echo $adress;
         }
         else{
         	echo "не найдено";
         }
         allsearch.php
