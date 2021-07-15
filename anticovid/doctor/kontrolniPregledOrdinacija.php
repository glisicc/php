<?php

    include_once("../scripts/engine.php");
    session_start();
 
    if($_SESSION['ordinacija']->priv != 'ordinacija'){
        die(header("Location: ../prijava.php?error=2"));
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
    <link rel="stylesheet" href="./../dist/css/custom.css">

    <style>
        .navbar-collapse {
        justify-content: flex-end;
    }
    </style>
    <script type="text/javascript" src="./../js/ordinacijaKontrolniPregled.js"></script>
</head>

<body onload="onLoadFunction()"> 



    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
            <?php
        $ime = $_SESSION['ime'];
        require("../scripts/db.php");
        $sql = "SELECT ORD_ID FROM ordinacija WHERE NAZIV = '" . $ime . "'";
        $result = $mysqli->query($sql);
        $row = mysqli_fetch_assoc($result);
        $id = $row["ORD_ID"];
    ?>

                <div class="card mb-3">
                    <div class="card-body">
                        <label for="fname">Претражи корисника по његовој шифри:</label><br>
                        <input type="text" id="patientPasswordInput" class="form-control" placeholder="Корисникова шифра..."><br>
                        <button class="btn btn-primary" onclick="getPatientByPassword()">Претражи</button>
                    </div>
                    <h3 class="card-header" id="cardDate"></h3>
                    <svg xmlns="http://www.w3.org/2000/svg" class="d-block user-select-none" width="100%" height="150"
                        aria-label="Placeholder: IME I PREZIME PACIJENTA" focusable="false" role="img"
                        preserveAspectRatio="xMidYMid slice" viewBox="0 0 318 180"
                        style="font-size:0.75rem;text-anchor:middle">
                        <rect width="100%" height="100%" fill="#868e96"></rect>
                        <text x="50%" y="50%" fill="#dee2e6" dy=".3em" id="cardName"><?php
                         $sql = "SELECT korisnik.IMEPREZ, korisnik.GOD, korisnik.LBO, termin.SIRFA_PREGLEDA, korisnik.TEMP, korisnik.TDIS, korisnik.BUG, korisnik.GRLO, korisnik.DIJA, korisnik.KSZ FROM korisnik INNER JOIN termin ON korisnik.TERID = termin.ID INNER JOIN ordinacija ON termin.ORD_ID = ordinacija.ORD_ID WHERE ordinacija.ORD_ID = '$id' AND termin.STATUS = 'T' AND termin.TIP_PREGLEDA = 'K'";
                         $result = $mysqli->query($sql);
                         if(mysqli_num_rows($result) > 0){
                             $row = mysqli_fetch_assoc($result);
                             $imePacijenta = $row["IMEPREZ"];
                             $godiste = $row["GOD"];
                             $lbo = $row["LBO"];
                             $sifra = $row["SIRFA_PREGLEDA"];
                             $temp = $row["TEMP"];
                             $tdis = $row["TDIS"];
                             $bug = $row["BUG"];
                             $grlo = $row["GRLO"];
                             $dija = $row["DIJA"];
                             $ksz = $row["KSZ"];
                         }else {
                            $imePacijenta = "";
                            $godiste = 0;
                            $lbo = "";
                            $sifra = "";
                            $temp = "";
                            $tdis = "";
                            $bug = "";
                            $grlo = "";
                            $dija = "";
                            $ksz = "";
                         }
                         echo $imePacijenta;
                        ?></text>
                    </svg>
                    <div class="card-body">
                        <p class="card-text" id="cardBornYear"><?php echo 'Година рођења: ';if($godiste != 0){echo $godiste;}?></p>
                        <p class="card-text" id="cardLBO"><?php echo 'LBO: '. $lbo;?></p>
                        <p class="card-text" id="cardPassword"><?php echo 'Шифра прегледа: '. $sifra;?></p>
                    </div>
                    <ul class="list-group list-group-flush" id="simptomList">
                    <?php
                    if(date("Y") - $godiste > 65 && $godiste != 0){
                        echo '<li class="list-group-item" id="simptomGodine">Пацијент старији од 65 година</li>';}
                    if($temp == 1){
                        echo '<li class="list-group-item" id="simptomTemperatura">Температура већа од 38°c</li>';}
                    if($tdis == 1){
                        echo '<li class="list-group-item" id="simptomDisanje">Отежано дисање</li>';}
                    if($bug == 1){
                        echo '<li class="list-group-item" id="simptomGrudi">Бол у грудима</li>';}
                    if($grlo == 1){
                        echo '<li class="list-group-item" id="simptomGrlo">Кашаљ или бол у грлу</li>';}
                    if($dija == 1){
                        echo '<li class="list-group-item" id="simptomDijareja">Дијареја</li>';}
                    if($ksz == 1){
                        echo '<li class="list-group-item" id="simptomKontakt">Контакт са зараженим</li>';}
                    ?>
                    </ul>
                </div>
                
            </div>
            <div class="col-2">
                <br>
                <br>
            </div>

        </div>

    </div>


    <script type="text/javascript" src="./../dist/js/jquery.js"></script>
    <script type="text/javascript" src="./../dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="./../dist/js/custom.js"></script>

</body>

</html>