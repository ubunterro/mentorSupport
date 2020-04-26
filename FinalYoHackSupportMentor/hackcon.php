<?php
include_once '../engine/dbconf.php';
$mentor = $_SERVER['QUERY_STRING'];
$tekyh =  query("SELECT * FROM `mentors` WHERE `hech`='$mentor'");
$tekyhro = mysqli_num_rows($tekyh);
if ($tekyhro == 1) {
    if (empty($_COOKIE['mentor'])) {
        setcookie("mentor", $mentor);
    }
} else {
    if (empty($_COOKIE['avtoriz'])) {
        $value1 = uniqid();
        setcookie("avtoriz", $value1);
    }
}

$user = isset($_COOKIE['avtoriz']) ? $_COOKIE['avtoriz'] : null;
$ment = isset($_COOKIE['mentor']) ? $_COOKIE['mentor'] : null;





$url = $_SERVER['REQUEST_URI'];
$url = explode('?', $url);
$url = $url[0];

$tekyh =  query("SELECT * FROM `hackatons` WHERE `adress`='$url'");

$array = mysqli_fetch_assoc($tekyh);
$name = $array["name"];
$hackId = $array["hack_id"];



include_once 'struct/head.php';

?>



<header class='srch'>
    <h2><?php echo $name; ?></h2>
    <form id='allsearch'>
        <input id='idfocus'class='typopoisk' type="text" name="allsearch" placeholder="Универсальный поиск">
        <input class='butt' type="button" name="" value="Найти">
    </form>

</header>


<div class='floatright'>
    <h3>Менторы/Организаторы</h3>
    <div class='teg'>
        <div>Время</div>
        <div style='width:35%'>Имя</div>
        <div>Тематика</div>
    </div>

    <?php



    $tek = query("SELECT * FROM `mentors` WHERE `hackId`='$hackId'");
    $o = mysqli_num_rows($tek);

    for ($i = 0; $i < $o; $i++) {

        $arr = mysqli_fetch_array($tek);

        $time = $arr["time"];
        $Name = $arr["Name"];
        $section = $arr["section"];

        print <<<g
        <div class='teg'><div>$time</div><div style='width:35%;color:#ff6e40;'>$Name</div><div style='color:#ff6e40;'>$section</div></div>
g;
    }

    ?>

</div>

<ul class='nav'>
    <a href="#pop">
        <li>Популярное</li>
    </a>
    <a href="#section">
        <li>Разделы</li>
    </a>
    <a href="#questions">
        <li>Задать вопрос</li>
    </a>
    <a href="#mane">
        <li>Мои вопросы</li>
    </a>
</ul>


<?php
//вопросики ответики

class Answer
{
    public $aId;
    public $aAuthor;
    public $aText;
    public $aTime;
    public $mentorId;

    function ConstructString()
    {
        $ment = mysqli_fetch_array(query("SELECT `Name`, `status` FROM `mentors` WHERE `mentorId`='$this->mentorId'"));
        return
            "<p>Ответ:" . $this->aText . " </p>
            <span style='float:right;'>" . $ment["status"] . ": " . $ment["Name"] . " $this->aTime</span>";
    }
}

class Question
{
    public $qId;
    public $qHackid;
    public $qAddressant;
    public $qText;
    public $qAuthorName;
    public $qTime;
    public $qRating;
    public $qStatus;
    public $qSection;
    public $authorUUID;

    public $qAnswers = [];

    function __construct($id, $hack, $addressant, $text, $author, $time, $rating, $answerStatus, $section,$authorUUID)
    {
        $this->qId = $id;
        $this->qHackid = $hack;
        $this->qAddressant = $addressant;
        $this->qText = $text;
        $this->qAuthorName = $author;
        $this->qTime = $time;
        $this->qRating = $rating;
        $this->qStatus = $answerStatus;
        $this->qSection = $section;
        $this->qauthorUUID = $authorUUID;
    }


    function FindAnswers()
    {
        //функция дублируется, нам этого не нужно
        if(sizeof($this->qAnswers) > 0)
            return;

        $aQuery = query("SELECT * FROM `answers` WHERE `hackid`='$this->qHackid' AND `questionId`='$this->qId'");




        while ($answer = mysqli_fetch_assoc($aQuery)) {
            $ans = new Answer();

            $ans->aId = $answer["answer_id"];
            $ans->aAuthor = $answer["nameparticipants"];
            $ans->aText = $answer["text"];
            $ans->aTime = $answer["timestamp"];
            $ans->mentorId = $answer["mentorid"];


            array_push($this->qAnswers, $ans);
        }
    }

    function ConstructQuestion()
    {
        $answersText = "";

        $this->FindAnswers();

        for ($a = 0; $a < sizeof($this->qAnswers); $a++) {
            $answersText = $answersText . $this->qAnswers[$a]->ConstructString();
        }

        return "
        <div class='teg'>
            <div class='likes' id='$this->qId' style='float:right'>" . ($this->qStatus ? "&#128154;" : "&#128155;") . " $this->qRating</div>
            <p>Вопрос: $this->qText</p>

            <span style='float:right;'>Участник: $this->qAuthorName $this->qTime</span>

            $answersText

            <div class='ov'>
                <p>Напиши свой ответ:</p>
                <br>
                <form action='job/answer.php' method='POST' >
                <input type='hidden' name='hackid' value='$this->qHackid'>
                <input type='hidden' name='qid' value='$this->qId'>
                <input type='hidden' name='ansman' value='Пользователь хакатона'>
                <input type='hidden' name='ismentor' value='false'>
                <input class='namesearch' type='text' name='text' placeholder='Текст ответа'>
                <input class='butt' type='submit' value='Ответить'>
                </form>
            </div>
        </div>
";
    }
}

$questionsQuery = query("SELECT * FROM `questions` WHERE `hackId`='$hackId' ORDER BY `rating` DESC");

$questions = [];

while ($question = mysqli_fetch_assoc($questionsQuery)) {
    $q = new Question($question["questionId"], $question["hackId"], $question["mentor_addressant_id"], $question["text"], $question["author"], $question["timestamp"], $question["rating"], $question["isAnswered"], $question["topic"],$question["authorUUID"]);
    array_push($questions, $q);
}
?>


<div class='pop'><a name="pop"></a>
    <h3>Популярное</h3>

    <?php

    for ($q = 0; $q < 5; $q++) {

        //защита от недостатка вопросов
        if($q >= sizeof($questions))
    break;

        echo $questions[$q]->ConstructQuestion();
    }

    ?>

</div>




<div class='section'><a name="section"></a>

    <h3>Разделы</h3>
    <div style='background-color: #f0f3b2;' class='lisection'>Технические вопросы</div>


    <?php

    for ($q = 0; $q < sizeof($questions); $q++) {
        if ($questions[$q]->qSection != "Технические вопросы")
            continue;


        echo $questions[$q]->ConstructQuestion();
    }

    ?>
    <div style='background-color: #f3cbb2;' class='lisection'>Организационные вопросы</div>


    <?php

    for ($q = 0; $q < sizeof($questions); $q++) {
        if ($questions[$q]->qSection != "Организационные вопросы")
            continue;


        echo $questions[$q]->ConstructQuestion();
    }

    ?>

    <div style='background-color: #d4f3b2;' class='lisection'>Коммуникационные вопросы</div>


    <?php

    for ($q = 0; $q < sizeof($questions); $q++) {
        if ($questions[$q]->qSection != "Коммуникационные вопросы")
            continue;


        echo $questions[$q]->ConstructQuestion();
    }

    ?>



    <div style='background-color: #b2f3e5;' class='lisection'>Задачи хакатона</div>


    <?php

    for ($q = 0; $q < sizeof($questions); $q++) {
        if ($questions[$q]->qSection != "Задачи хакатона")
            continue;


        echo $questions[$q]->ConstructQuestion();
    }

    ?>



    <div style='background-color: #b2f3c2;' class='lisection'>Другие вопросы</div>


    <?php

    for ($q = 0; $q < sizeof($questions); $q++) {
        if ($questions[$q]->qSection != "Другие вопросы")
            continue;


        echo $questions[$q]->ConstructQuestion();
    }

    ?>

</div>


</div>
</div>


<div class='questions'><a name="questions"></a>

    <h3>Задать вопрос</h3>

    <form id='question' name='question' action="job/question.php" method="POST">
        <textarea name='text' class='questionstext' placeholder="Текст вопроса"></textarea>
        <input class='textlim' type="text" name="name" placeholder="Имя">
        <?php
        print <<<g
<input style='display:none;' type="text" value="$name" name="namexakoton">
g;
        ?>
        <select name='select' class='textlim'>
            <option>Технические вопросы</option>
            <option>Организационные вопросы</option>
            <option>Коммуникационные вопросы</option>
            <option>Задачи хакатона</option>
            <option>Другие вопросы</option>
        </select>
        <input class='textlim' type="text" name="menname" placeholder="Имя ментора">
        <input style='float:left; clear: left;' class='butt' type="submit" value="Отправить">
    </form>

</div>


<div class='mane'><a name="mane"></a>
    <h3>Мои вопросы</h3>

<?php

    for ($q = 0; $q < sizeof($questions); $q++) {
        if ($questions[$q]->qauthorUUID != $user)
            continue;


        echo $questions[$q]->ConstructQuestion();
    }

    ?>

    </div>



    <footer class="main-footer">designer: veronika_bunina <br>&copy; ComputerCraft </footer>
    </body>

    </html>