<?php
include 'dbconf.php';

$sql = "SELECT text, topic FROM questions ORDER BY questionId";
$result = $mysqli->query($sql);

$questionsTable = "";

while ($question = $result->fetch_assoc()) {
    $questionsTable .= "
        <p> ". $question['topic'] . "</p>
    ";
}

?>