<?php
session_start();
//usrs for the hosting 
//2y4yM95pzuCV -pass
//atlas95e_user - user
//atlas95e_test - database
//conection
//$server = 'localhost';
//$username   = 'atlas95e_user';
//$password   = '2y4yM95pzuCV';
//s$database   = 'atlas95e_test';

$user="atlas95e_user";
$pass="2y4yM95pzuCV";
$database="atlas95e_test";
$con = mysqli_connect("localhost","$user","$pass");



if (!$con) {
    die("Database connection failed: " . mysqli_error());
}

mysqli_select_db($con, $database);
$db_select = mysqli_select_db($con, $database);
if (!$db_select) {
    die("Database selection failed: " . mysqli_error());
}

?>