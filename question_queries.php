<?php 
include('dbconf.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$row = mysqli_fetch_assoc(query("SELECT * FROM `questions`"));

echo $row["author"];

echo 'blyat';

?>