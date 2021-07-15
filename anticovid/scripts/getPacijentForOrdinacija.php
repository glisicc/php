<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "database";

$conn = mysqli_connect($host, $user, $password, $dbname);

$result = mysqli_query($conn, "SELECT * FROM `korisnik`");

$ordinacije = array();

while ($row = mysqli_fetch_assoc($result)){
    $ordinacije[] = $row;
}
echo json_encode($ordinacije);


