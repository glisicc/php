<?php

require_once("engine.php");
session_start();

$_SESSION["connection"] = new dbConnect;
$_SESSION["connection"]->logout();

?>