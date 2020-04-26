<?php
        include "../../engine/dbconf.php";


        $questionId = $_POST["id"];
    

        if(empty($questionId)){
            exit ('Нельзя любить то, чего нет...');
        }
       
        global $mysqli;


        $canLike = false;

      
        $liked = "";

        if (isset($_COOKIE["hackLiked"])){
            $liked = $_COOKIE["hackAuthor"];

            $likedQuestions = array();
            $likedQuestions = explode(" ", $liked);

            // если ещё не лайкано
            if (!in_array(strval($questionId), $likedQuestions)){
                array_push($likedQuestions, strval($questionId));
                $liked = implode(" ", $likedQuestions);
                setcookie("hackLiked", $liked);

                $canLike = true;
            }

            
        } else {
            $liked = "";
            setcookie("hackLiked", strval($questionId));

            $canLike = true;
        }
    

        if ($canLike){
            $likeQuery = query("UPDATE `questions` SET `rating` = `rating` + 1 WHERE `questionId` = $questionId");

            if ($likeQuery){   
                echo '{"result" : 1}';              
            }
            else{
                //echo "false";
                echo '{"result" : -1}';  
                echo mysqli_error($mysqli);
            }
        } else {
            echo '{"result" : 0}';  
        }
      

       
?>