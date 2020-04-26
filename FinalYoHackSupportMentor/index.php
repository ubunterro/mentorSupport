<?php session_start();?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/body.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
     <script defer src="js/jquery-3.5.0.min.js" type="text/javascript"></script>
    <script defer src="js/jsty.js" type="text/javascript"></script>
    <title>Mentor Support</title>
</head>

<body style="background-color: #a5cf9a;">
    <header>

    <h1 class='logo'><img src="img/logo.jpg">Mentor Support</h1>
    <img class='imghead' src="img/from2.png">
    <h2>Оформить<br> страницу для коммуникации участников и менторов</h2>
    <a href="#formhack"><input class='but' type="button" value='Оформить' name=""></a>
    <h2>Заблудились,<br> можете поискать хакатон в котором участвуете здесь</h2>
    <a href="#search"><input class='but' type="button" value='Найти' name=""></a>
    
    </header>

    <div class="search"><a name="search"></a>
        <img style="width: 10%; margin: 0 0 -8% 0;" src="img/fonsearch.png">
        <h2>Присоединиться к странице хакатона</h2>
        <form id='searche' name='searche' class='formsearch'>
            <input class='textinput' type="text" name="namen" placeholder="Название хакатона">
            <input onclick="sherch()" class='but' type="button" name="" value="Найти">
        </form>
    </div>

    <div class='inf'>
        <h2 style="-webkit-transform: rotate(-90deg); transform: rotate(-90deg); font-size: 85px; margin: 19% -10% 0 -10%;">Инcтрукция</h2>
        <h2 style="margin: 15px 25%;">Регистрация хакатона</h2>
    <ul type="square">

        <li>Укажите название хакатона.</li>
        <li>Обязательно указажите данные менторов и организаторов.</li>
        <li>На указанную электронную почту будут высланы ссылки с привелигированным доступом.</li>
        <li>Пользователи не проходят авторизацию/регистрацию.</li>
        <li>Сортировка по тематикам упрощает навигацию.</li>
        <li>Не забудьте про время активности менторов/организаторов на сайте.</li>
        <li>Доступ для пользователей по единой ссылке созданнной страницы.</li>
    </ul>

    <img style="width: 20%; float: right; margin: -30% 5% 0 -30%" src="img/fait.png">
    </div>


    <div class="formhack"><a name="formhack"></a>
        <h2>Регистрация страницы вопросов для хакатона</h2>

        <form class="hackform" name="dob" id="dob" method='POST' enctype="multipart/form-data">
            <input  class='textform' type="text" name="name" placeholder="Название хакатона">
            <br>
            <h3>Сведения о менторах и организаторах для связи</h3><br> <br> <br> <br>
            <input class='textform' type="text" name="fi" placeholder="Имя Фамилия">
            <select class='textform' name="series">
             <option>Ментор</option>
             <option>Организатор</option>
            </select>
             <input class='textform' type="text" name="time" placeholder="Время активности на сайте">
             <select class='textform' name="option">
             <option>Технические вопросы</option>
            <option>Организационные вопросы</option>
             <option>Коммуникационные вопросы</option>
            <option>Вопросы по задачам хакатона</option>
            <option>Другие вопросы</option>
             </select>
            <input class='textform' type="text" name="email" placeholder="email">

            <input onclick="feedbackAjax()" style='height: 36px; width: 36px;'  type="button" name="" value="&plus;">
           <br>

            <input onclick="feedbackAjax()" class='but' type="button" name="" value="Зарегистрировать">
        </form>



        
         <img style="width: 10%; margin: 0 0 -5% 0; float: right;" src="img/fonsearch.png">
    </div>

    <footer class="main-footer">designer: veronika_bunina <br>&copy; ComputerCraft </footer>
</body>

</html>