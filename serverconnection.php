<?php

$dbhost = "localhost:3307";
$dbuser = "root";
$dbpass = "root";
$dbname = "simpleticket";

if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)){

	die("Connection Failed.");
}
?>