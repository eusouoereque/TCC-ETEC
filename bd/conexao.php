<?php
$ip = "localhost";
$user = "root";
$pass = "";
$db = "tcc";
$mysqli = new mysqli($ip, $user, $pass, $db);
// mysqli_set_charset($mysqli, "utf-8");
// mysqli_query($mysqli, "SET NAMES 'utf8'");
// mysqli_query($mysqli, "SET character_set_connection=utf8");
// mysqli_query($mysqli, "SET character_set_client=utf8");
// mysqli_query($mysqli, "SET character_set_results=utf8");

if ($mysqli->connect_errno) {
	print "ERROR:" . $mysqli->connect_errno . " = " . $mysqli->connect_error;
die();
}


?>