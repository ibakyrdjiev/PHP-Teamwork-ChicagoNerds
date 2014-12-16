<?php


//    session_start();
//error_reporting(0);


//usrs for the hosting 
//2y4yM95pzuCV -pass
//atlas95e_user - user
//atlas95e_test - database
//conection
//$server = 'localhost';
//$username   = 'atlas95e_user';
//$password   = '2y4yM95pzuCV';
//s$database   = 'atlas95e_test';

$user="root";
$pass="";
$database="test";
$con = mysqli_connect("localhost","$user","$pass");



if (!$con) {
    die("Database connection failed: " . mysqli_error($con));
}

mysqli_select_db($con, $database);
$db_select = mysqli_select_db($con, $database);
if (!$db_select) {
    die("Database selection failed: " . mysqli_error($con));
}
