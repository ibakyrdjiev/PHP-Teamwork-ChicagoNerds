<?php
session_start();
//conection
$server = 'localhost';
$username   = 'root';
$password   = '';
$database   = 'test';
// connection variable for the server
$con = mysqli_connect($server, $username, $password);
if (!$con) {
    die("Connection failed");
}
if(!mysql_select_db($database))
{
    exit('Error: could not select the database');
}
echo "Connected successfully";
?>