
<?php
/// модуль для работы с ссылками для приглашений

include "dbconf.php";

if(isset($_POST['emails']))
{

    //TODO проверка на уникальность имени

    sendInvites(intval($_POST['emails']));
}


/**
 * sendInvites
 *
 * @param  mixed $invites
 * @return void
 */
function sendInvites($invites){
    $emails = explode("\n", $invites);

    foreach ($emails as $key => $email) {
        mail($email, 'Hackaton Invite', "Youve been invited");
    }
}


?>