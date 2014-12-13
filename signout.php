<?php
//signout.php
include 'connect.php';
include 'functions.php';
siteHeader("signIN");
echo '<h2>Изход</h2>';

//check if user if signed in

if($_SESSION['signed_in'] == true)
{
    //unset all variables
    unset($_SESSION['signed_in']);
    unset($_SESSION['user_name']);
    unset($_SESSION['user_id']);

    echo 'Чао .';
}
else
{
    echo '<a href="signin.php">Вход</a>?';
}

siteFooter();
?>