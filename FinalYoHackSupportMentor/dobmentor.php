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
        include_once 'job/bd_connect.php';


         
         $tekyh=query("SELECT * FROM `hackatons` WHERE `name`='$name'");
         $tekyhro=mysqli_num_rows($tekyh);
         $aret=mysqli_fetch_assoc($tekyh);

         $hack_id=$aret['hack_id'];

         $nameet='/YoHack/'.$name.'.php';
         $namee=$name.'.php';


        if($tekyhro==1){

         }
        else{

        $roty=query("INSERT INTO `hackatons`(`name`, `adress`) VALUES ('$name','$nameet')");

        $tekyh=query("SELECT * FROM `hackatons` WHERE `name`='$name'");
        $tekyhro=mysqli_num_rows($tekyh);
        $aret=mysqli_fetch_assoc($tekyh);

        $hack_id=$aret['hack_id'];
        /*
        $a=5;
        $g=fopen($namee, "w+");
        fwrite($g, $a);
        fclose($g);
        */

         }


         			$unique_value = hash("whirlpool", $email . "sul"); //

					$subject = "Регистрация на хакатон";
					$message = '<p>Вот ваша ссылка для входа: </p>' . "http://localhost/YoHack/" .$namee. "/?uv=" . $unique_value;


					$headers = "Content-type: text/html; charset=utf8 \r\n"; //Для правильного отображения руских букв
					$headers .= "From: mentorSuport <from@example.com>\r\n"; //

					mail($email, $subject, $message, $headers);


        $rot=query("INSERT INTO `mentors`(`hackId`, `Name`, `status`, `time`, `section`, `email`, `hech`) VALUES ('$hack_id','$fi','$series','$time','$option','$email','$unique_value')");


        if($rot=='TRUE'){
            echo 'добавлен';
        }
        else{
            echo'Не добавили по какой-то причине, напишите разработчику';
        }


