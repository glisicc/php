<?php 
    include_once("../scripts/engine.php");
    session_start();
 
    if($_SESSION["pacijent"]["priv"] != 1){
      die(header("Location: ../index.php?error=2"));
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

<script>
      function otkazivanje() {
        if (confirm("Da li ste sigurni da zelite da otkazete pregled?")) {
          window.location.replace("./otkazivanje.php")
        } 
      }
    </script>

  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="#">
      <?php
             $lbo = $_SESSION["pacijent"]["lbo"];
             require("../scripts/db.php");
             $sql = "SELECT `IMEPREZ` FROM korisnik WHERE LBO = '$lbo'";
             $result = $mysqli->query( $sql);

            while($row = mysqli_fetch_assoc($result)) {
              echo $row['IMEPREZ'];
            }
             ?>
    </a>
    <div class="navbar-collapse">
      <form class="form-inline my-2 my-lg-0">
        <a href="#" onclick='window.open("./oglasna.php")' class="btn btn-secondary my-2 my-sm-0" type="submit">Огласна
          табла</a>
        <a href="../scripts/logout.php" class="btn btn-secondary my-2 my-sm-0" id="odjava" type="submit">Одјава</a>
      </form>
    </div>

    </div>
  </nav>


  <div class="container">
    <div class="row">

      <!-- <div class="col-2">

            </div> -->
      <div class="col-12 col-10">

        <div class="card full-page">
          <h3 class="card-header"><?php $lbo = $_SESSION["pacijent"]["lbo"];
             require("../scripts/db.php");

             $sql = "SELECT termin.VREME FROM termin INNER JOIN korisnik ON korisnik.ID = termin.IDKOR AND korisnik.LBO = '$lbo'";
             $result = $mysqli->query( $sql);
             $ind = 0;

             echo date("d.m.Y.\t");
             while($row = mysqli_fetch_assoc($result)) {
              echo $row["VREME"];
            }?></h3>
          <div class="card-body">
            <h5 class="card-title">Шифра прегледа:</h5>

          </div>

          <svg xmlns="http://www.w3.org/2000/svg" class="d-block user-select-none" width="100%" height="150"
            aria-label="Placeholder: IME I PREZIME PACIJENTA" focusable="false" role="img"
            preserveAspectRatio="xMidYMid slice" viewBox="0 0 318 180" style="font-size: 25 rem;text-anchor:middle">
            <?php 

               $lbo = $_SESSION["pacijent"]["lbo"];
               require("../scripts/db.php");

               $sql = "SELECT termin.STATUS FROM termin INNER JOIN korisnik ON korisnik.ID = termin.IDKOR AND korisnik.LBO = " . $lbo;
               $result = $mysqli->query($sql);

             while($row = mysqli_fetch_assoc($result)) {
              if($row["STATUS"] == 'Z'){
                echo '<rect width="100%" height="100%" fill="lightred"></rect>';
              }
              if($row["STATUS"] == 'T'){
                echo '<rect width="100%" height="100%" fill="lightgreen"></rect>';
              }
              if($row["STATUS"] == 'C'){
                echo '<rect width="100%" height="100%" fill="yellow"></rect>';
              }
             }


            ?>
            <text x="50%" y="50%" fill="#000000" dy=".3em">
              <?php $lbo = $_SESSION["pacijent"]["lbo"];
               require("../scripts/db.php");

               $sql = "SELECT termin.SIRFA_PREGLEDA FROM termin INNER JOIN korisnik ON termin.IDKOR = korisnik.ID AND korisnik.LBO =" . $lbo;
               $result = $mysqli->query($sql);

              while($row = mysqli_fetch_assoc($result)) {
                echo $row["SIRFA_PREGLEDA"];
              }
                 ?> </text>
          </svg>
          <div class="card-body full-page">
            <p class="card-text"> <b>Име и презиме: </b>
              <?php 
             $lbo = $_SESSION["pacijent"]["lbo"];
             require("../scripts/db.php");

             $sql = "SELECT `IMEPREZ` FROM korisnik WHERE LBO = " . $lbo;
             $result = $mysqli->query( $sql);
             $ind = 0;

            while($row = mysqli_fetch_assoc($result)) {
              echo $row["IMEPREZ"];
            }
             ?></p>
            <p class="card-text"> <b>Година рођења: </b>
              <?php 
             $lbo = $_SESSION["pacijent"]["lbo"];
             require("../scripts/db.php");

             $sql = "SELECT `GOD` FROM korisnik WHERE LBO = " . $lbo;
             $result = $mysqli->query($sql);
             $ind = 0;

            while($row = mysqli_fetch_assoc($result)) {
              echo $row["GOD"];
            }
             ?></p>
            <p class="card-text"> <b>ЛБО: </b> <?php echo $_SESSION["pacijent"]["lbo"] . "<br />"; ?></p>

            <p class="card-text"> <b>Одабрани симптоми: </b> </p>

          </div>
          <ul class="list-group list-group-flush">
            <?php 
             $lbo = $_SESSION["pacijent"]["lbo"];
             require("../scripts/db.php");

             $sql = "SELECT `GOD`, `TEMP`, `TDIS`, `BUG`, `GRLO`, `DIJA`, `KSZ` FROM korisnik WHERE LBO = " . $lbo;
             $result = $mysqli->query( $sql);
             $ind = 0;

             while($row = mysqli_fetch_assoc($result)) {
              if($row["GOD"] == 1){
                echo '<li class="list-group-item">Преко 65 година</li>';
                $ind++; 
              }
              if($row["TEMP"] == 1){
                echo '<li class="list-group-item">Температура већа од 38,5°</li>';
                $ind++;
              }
              if($row["TDIS"] == 1){
                echo '<li class="list-group-item">Тешкоће при дисању и губитак даха</li>';
                $ind++;
              }
              if($row["BUG"] == 1){
                echo '<li class="list-group-item">Бол или притисак у грудима</li>';
                $ind++;
              }
              if($row["GRLO"] == 1){
                echo '<li class="list-group-item">Сув кашаљ, упаљено грло</li>';
                $ind++;
              }
              if($row["DIJA"] == 1){
                echo '<li class="list-group-item">Дијареја</li>';
                $ind++;
              }
              if($row["KSZ"] == 1){
                echo '<li class="list-group-item">Контакт са зараженим</li>';
                $ind++;
              }
            }
            if($ind == 0){
              echo '<li class="list-group-item">Немам симптоме</li>';
            }
            ?>
          </ul>
          <div class="card-body">
            <button class="btn btn-primary" onclick='otkazivanje()'>Oткажи преглед</button>
          </div>
          <div class="card-footer text-muted">

          </div>
        </div>

      </div>
    </div>

  </div>

  </div>


  <script src="./../dist/js/jquery.js"></script>
  <script src="./../dist/js/bootstrap.bundle.min.js"></script>
  <script src="./../dist/js/custom.js"></script>


</body>

</html>