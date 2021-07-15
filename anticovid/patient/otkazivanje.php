<?php 
    
    include_once("../scripts/engine.php");
    session_start();
    $lbo = $_SESSION["pacijent"]["lbo"];
    require("../scripts/db.php");

    $id = 0;

    $sql = "SELECT termin.ID FROM termin INNER JOIN korisnik ON korisnik.ID = termin.IDKOR WHERE korisnik.LBO =  " . $lbo;
    $result = $mysqli->query($sql);

    while($row = mysqli_fetch_assoc($result)) {
        $id = $row["ID"];
    }

    if($id != 0){
        $sql = "DELETE FROM termin WHERE ID = " . $id;

        if ($mysqli->query($sql)) {
        } else {
           echo "Error deleting record";
        }

        $sql = "DELETE FROM korisnik WHERE LBO = " . $lbo;

        if ($mysqli->query($sql)) {
        } else {
           echo "Error deleting record: " . mysqli_error($conn);
        }
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
    <link rel="stylesheet" href="./..dist/css/custom.css">
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
            <h2 style="text-align:center;">УСПЕШНО СТЕ ОТКАЗАЛИ ПРЕГЛЕД</h2>
        </div>
        <div class="col-lg-12 col-sm-3">
            <button type="button" class="btn btn-danger btn-lg btn-block" onclick='window.location.replace("../index.php")'>Почетна страна</button>
        </div>
    </div>


    
    <script src="./../dist/js/jquery.min.js"></>
    <script src="./../dist/js/bootstrap.bundle.min.js"></script>
    <script src="./../dist/js/custom.js"></script>


</body>

</html>