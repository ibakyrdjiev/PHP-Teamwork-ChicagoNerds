<?php

$errors = array(); /* declare the array for later use */
//check
if (isset($_POST['name'])) {
    //the user name exists
    if (!ctype_alnum($_POST['name'])) {
        if (!preg_match("/[а-яА-Яa-zA-Z\s]+/", $_POST['name'])){
            $errors[] = 'Невалидно име';

        }
    }
    if (strlen($_POST['name']) > 30) {
        $errors[] = 'Потребителското име не може да бъде по-дълго от 30 символа.';
    }
} else {
    $errors[] = 'Полето за име не може да остане празно.';
}
if (isset($_POST['email'])) {
    if (!preg_match_all("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $_POST['email'])) {
        $errors[] = 'Неправилен E-mail адрес';
    }

}
else{
    $errors[] = 'Полето за e-mail не може да остане празно.';
}
if (isset($_POST['phone'])) {
    if (!preg_match_all("/\d+/", $_POST['phone'])) {
        $errors[] = 'Неправилен Телефон';
    }

}
if (isset($_POST['msg'])) {

}
else{
    $errors[] = 'Полето за съобщение не може да остане празно.';
}


//check
if (!empty($errors)) //this is for BABA PENKA usr
{
    echo 'Каска не чупи!<br /><br />';
    echo '<ul>';
    foreach ($errors as $key => $value) /* walk through the array so all the errors get displayed */ {
        echo '<li>' . $value . '</li>'; /* this generates a nice error list */
    }
    echo '</ul>';
    echo '<a href="about.php">Назад</a>';
} else {
    $Name = $_POST['name'];
    $Email = $_POST['email'];
    $Tel = $_POST['phone'];
    $Message = $_POST['msg'];
    str_replace("<", "'<'", $message);
    str_replace(">", "'>'", $message);
    str_replace("\"", "\"\"", $message);
    str_replace("\'", "\'\'", $message);

    /*Sending Email*/
    $to = "teamForum@atlas95.eu";
    $subject = "Web Mail";
    $message = "
From: $Name <br>
E-mail: $Email <br>
Telephone: $Tel <br>
Message: $Message
";
    $headers = 'From: ' . $email . "\r\n" .
        'Reply-To: ' . $email . "\r\n" .
        'Content-Type:text/html; charset=UTF-8' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    $from = "$Name";


    if (mail($to, $subject, $message, $headers))
        header("Location: about.php");
    else
        echo "Mail send failure - message not sent";
}

?>