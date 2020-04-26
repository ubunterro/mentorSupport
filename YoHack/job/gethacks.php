<?php 

include "../../engine/dbconf.php";


$q = query("SELECT `name`, `adress` FROM `hackatons`");



echo json_encode(mysqli_fetch_all($q));


?>