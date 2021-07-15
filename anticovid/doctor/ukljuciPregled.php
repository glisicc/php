<?php 
    
    include_once("../scripts/engine.php");
    session_start();
    $id = $_SESSION["ime"];
    require("../scripts/db.php");

    $sql = "UPDATE ordinacija SET STATUS = '1' WHERE ORD_ID = " .$id;
    if ($mysqli->query($sql)) {
    } else {
        echo "Error changing status!";
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="./../dist/css/bootstrap.css">
    <link rel="stylesheet" href="./../dist/css/custom.min.css">
    <link rel="stylesheet" href="./css_patient/style.css">

    <style>
        .navbar-collapse {
            justify-content: flex-end;
        }
    </style>

</head>

<body>

    <br>
    <br>
    <br>
    <br>
    <div class="container" style = "position:relative; top:100px;">
        <div class="col-lg-12 col-sm-3">
            <h2 style="text-align:center;">УСПЕШНО СТЕ УКЉУЧИЛИ ОРДИНАЦИЈУ</h2>
        </div>
        <div class="col-lg-12 col-sm-3">
            <button type="button" class="btn btn-danger btn-lg btn-block" onclick='window.location.replace("./panel.php")'>Натраг на страницу ординације</button>
        </div>
    </div>


    
    <script src="./../dist/js/jquery.js"></>
    <script src="./../dist/js/bootstrap.bundle.min.js"></script>
    <script src="./../dist/js/custom.js"></script>


</body>

</html>