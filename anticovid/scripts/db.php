<?php

// DATABASE CONNECTION PARAMETERS

$host = "localhost";
$user = "root";
$password = "";
$dbname = "database";

$mysqli = new mysqli($host, $user, $password, $dbname);

if($mysqli->connect_error){
    die('Error : (' . $this->mysqli->connect_errno . ') ' . $this->mysqli->connect_error);
}

?>