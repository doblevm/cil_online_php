<?php 
$host="db";
$port=3306;
$socket="";
$user="admin";
$password="admin";
$dbname="Horimetros";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

?>
