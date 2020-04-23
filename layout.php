<?php include 'questionsList.php' ?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles_index.css">
    <title>Document</title>
</head>

<body>
    <header class="main-header">
        <h1 class="visually-hidden">Mentor Support</h1>
        <div class="main-auth"><button class="login">Войти</button></div>
    </header>
    <div class="main-questionbar">
        <form>
            <textarea cols="30" rows="1"></textarea>
            <button class="askButton">Искать</button>
        </form>
    </div>

    <div class="main-questions">
        <main class="content"><?php //$questionBar; ?></main>
    </div>

    <div class="main-questionbar">
        <main class="content"><?= $questionsTable; ?></main>
    </div>
    <footer class="main-footer">&copy; ComputerCraft </footer>
</body>

</html>