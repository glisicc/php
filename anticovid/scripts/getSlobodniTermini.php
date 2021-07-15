<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "database";

$conn = mysqli_connect($host, $user, $password, $dbname);
$resultTermini = mysqli_query($conn, "SELECT VREME FROM `termin`");
$brojLekara = mysqli_query($conn, "SELECT USER_ORD FROM `ordinacija`");

$termini = array();
$lekari = array();

while ($row = mysqli_fetch_assoc($brojLekara)){
    $lekari[] = $row;
}
$termini[] = count($lekari);

while ($row = mysqli_fetch_assoc($resultTermini)){
    $termini[] = $row;
}

echo json_encode($termini);