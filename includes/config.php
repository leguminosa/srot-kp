<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "srot-kp";

$connection = mysqli_connect($servername, $username, $password, $dbname);

if(!$connection) {
    die("Connection Failed : ".mysql_connect_error());
}

?>