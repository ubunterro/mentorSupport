
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
</head>

<body>
    <p>Временный тест добавления хакатона ид владельца / название</p>
    <form action="registerHackaton.php" method="post">
        <input type="text" name="owner_id" id="">
        <input type="text" name="name" id="">
        <button type="submit">Создать хакатон</button>
    </form>

    <p>Временный тест рассылки приглашений</p>
    <form action="/engine/invite.php" method="post">
        <textarea name="emails" id="" cols="30" rows="10"></textarea>
        <button type="submit">Разослать приглашения</button>
    </form>

    <?php mail("finko.ilya@gmail.com", 'Hackatooon Invite', "Youve been invited"); ?>
</body>

</html>