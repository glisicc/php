<?php

    include_once("../scripts/engine.php");
    session_start();
 
    if($_SESSION['ordinacija']->priv != 'ordinacija'){
        die(header("Location: ../prijava.php?error=2"));
    }
    
?> 

<?php 
   if(isset($_REQUEST['buttonZavrsen'])){
        if(isset($_POST['_checkbox'])){
            $sifra = $_SESSION['ordinacija']->sifraPregleda;
            $vreme = $_SESSION['ordinacija']->vreme;
            $sql = "SELECT korisnik.IMEPREZ, korisnik.GOD, korisnik.LBO, termin.SIRFA_PREGLEDA, korisnik.TEMP, korisnik.TDIS, korisnik.BUG, korisnik.GRLO, korisnik.DIJA, korisnik.KSZ FROM korisnik INNER JOIN termin ON korisnik.TERID = termin.ID INNER JOIN ordinacija ON termin.ORD_ID = ordinacija.ORD_ID WHERE ordinacija.ORD_ID = '$id' AND termin.VREME = '$vreme' AND termin.TIP_PREGLEDA = 'R'";
            $mysqli->query($sql);
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
                

            }}

        $termini = array("07:00", "07:30", "08:00", "08:30", "09:00", "09:30", "10:00", "10:30", "11:00",
        "11:30", "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30",
        "16:00", "16:30", "17:00", "17:30", "18:00", "18:30", "19:00", "19:30", "20:00",
        "20:30", "21:00", "21:30", "22:00");

        $duzina = count($termini);
        $trenutno = new DateTime(date("H:i:s"));
        echo "drugi deo requesta";
        for($i = 1; $i < $duzina; $i++){
            $prvi = new DateTime($termini[$i - 1]);
            $drugi = new DateTime($termini[$i]);
            if($trenutno >= $prvi && $trenutno <= $drugi){
                echo $termini[$i];
                $_SESSION['ordinacija']->vreme = $termini[$i];
                $razlika = $drugi->diff($trenutno);
                $sleepTime = $razlika->i * 60 + $razlika->s;
                sleep($sleepTime);
            }
            header("Refresh:0");
        }}
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
        #odjava{
            margin-left: 10px;
        }
    </style>
    <!--<script type="text/javascript" src="./../js/populateOrdinacijaScript.js"></script>-->
</head>

<body> 

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <a class="navbar-brand" href="#" id="imeOrdinacije"><?php
        $ime = $_SESSION['ime'];
        echo $ime;
        require("../scripts/db.php");
        $sql = "SELECT ORD_ID FROM ordinacija WHERE NAZIV = '" . $ime . "'";
        $result = $mysqli->query($sql);
        $row = mysqli_fetch_assoc($result);
        $id = $row["ORD_ID"];
    ?></a>
  
    <div class="navbar-collapse">
        <form class="form-inline my-2 my-lg-0">
        <a href="#" onclick='window.open("./kontrolniPregledOrdinacija.php")' class="btn btn-secondary my-2 my-sm-0" type="submit">Контролни преглед</a>
        <a href="../scripts/logout.php" class="btn btn-secondary my-2 my-sm-0" type="submit" id="odjava">ОДЈАВА</a>
        </form>
    </div>
    
  </div>
</nav>


    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">

                <div class="card mb-3">
                    <h3 class="card-header" id="cardDate"></h3>
                    <div class="card-body">
                        <h5 class="card-title">Тип прегледа: Регуларни</h5>
                        <h6 class="card-subtitle text-muted" id="tipPregleda"></h6>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="d-block user-select-none" width="100%" height="150"
                        aria-label="Placeholder: IME I PREZIME PACIJENTA" focusable="false" role="img"
                        preserveAspectRatio="xMidYMid slice" viewBox="0 0 318 180"
                        style="font-size:0.75rem;text-anchor:middle">
                        <rect width="100%" height="100%" fill="#868e96"></rect>
                        <text x="50%" y="50%" fill="#dee2e6" dy=".3em" id="cardName">
                        <?php
                         $vreme = $_SESSION['ordinacija']->vreme;
                         $sql = "SELECT korisnik.IMEPREZ, korisnik.GOD, korisnik.LBO, termin.SIRFA_PREGLEDA, korisnik.TEMP, korisnik.TDIS, korisnik.BUG, korisnik.GRLO, korisnik.DIJA, korisnik.KSZ FROM korisnik INNER JOIN termin ON korisnik.ID = termin.IDKOR INNER JOIN ordinacija ON ordinacija.ORD_ID = termin.ORD_ID WHERE termin.VREME = '$vreme'";
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
                             
                             $_SESSION['ordinacija']->sifraPregleda = $sifra;

                             $sql1 = "UPDATE `termin` SET `STATUS` = 'T' WHERE SIRFA_PREGLEDA = '$sifra'";
                             $mysqli->query($sql1);
                         } else{
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
                    <div class="card-body">
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                     <div style="margin-left: 20px;">
                        <input class="form-check-input" type="checkbox" value="" name="_checkbox" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault" name="checkKontrolni"> Заказати контролни преглед </label>
                     </div>
                     <div>
                        <button class="btn btn-success" type="submit" name="buttonZavrsen">Завршен преглед</button>
                     </div>
                    </form>
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