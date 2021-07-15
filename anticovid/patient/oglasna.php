<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Огласна табла</title>

    <link rel="stylesheet" type="text/css" href="./../css/adminPanel.css">
    <link rel="stylesheet" href="./../dist/css/bootstrap.css">


</head>
<body>
<div class="container centered">
    <div class="row">
    <div class="col-4" id="oglasna-col">
        <div class="list-group">
    <?php

 require("../scripts/db.php");

$sql = "SELECT `SIRFA_PREGLEDA`, `VREME`, `ORD_ID` FROM termin WHERE TIP_PREGLEDA = 'R' AND STATUS = 'T' LIMIT 5";
$result = $mysqli->query($sql);

if (mysqli_num_rows($result) > 0) {

  while($row = mysqli_fetch_assoc($result)) {
        echo '<a href="#" class="list-group-item list-group-item-action flex-column align-items-start noHover active-pacient color-black">
        <div class="d-flex w-100 justify-content-between"><h5 class="mb-1 mobile small-m title-pos"><b>ПРЕГЛЕД У ТОКУ</b></h5>';
        echo '<small class="mobile small-m time-pos">';
        echo $row['VREME']; 
        echo '</small>';
        echo '</div><h5 class="d-flex justify-content-center mobile small-m">ШИФРА ПРЕГЛЕДА: ';
        echo ('<br>'); 
        echo $row['SIRFA_PREGLEDA'];
        echo '</h5><small class="d-flex justify-content-center mobile small-m">ОРДИНАЦИЈА: ';
        echo $row['ORD_ID']; 
        echo('</small></a>');
    }
}
?>

        </div>
      </div>


    <!-- Druga kolona -->
    <div class="col-4" id="oglasna-col">
        <div class="list-group">

<?php

require("../scripts/db.php");
$sql = "SELECT `SIRFA_PREGLEDA`, `VREME`, `ORD_ID` FROM termin WHERE TIP_PREGLEDA = 'R' AND STATUS = 'C' LIMIT 5";
$result = $mysqli->query($sql);

if (mysqli_num_rows($result) > 0) {

  while($row = mysqli_fetch_assoc($result)) {
        echo '<a href="#" class="list-group-item list-group-item-action flex-column align-items-start noHover hold-pacient color-black">
        <div class="d-flex w-100 justify-content-between"><h5 class="mb-1 mobile small-m title-pos"><b>СЛЕДЕЋИ НА РЕДУ</b></h5>';
        echo '<small class="mobile small-m time-pos">';
        echo $row['VREME']; 
        echo '</small>';
        echo '</div><h5 class="d-flex justify-content-center mobile small-m">ШИФРА ПРЕГЛЕДА: '; 
        echo ('<br>');
        echo $row['SIRFA_PREGLEDA'];
        echo '</h5><small class="d-flex justify-content-center mobile small-m">ОРДИНАЦИЈА: ';
        echo $row['ORD_ID']; 
        echo('</small></a>');
    }
}
?>
        </div>
      </div>

      <!-- Treca kolona -->
      <div class="col-4" id="oglasna-col">
        <div class="list-group">


<?php

require("../scripts/db.php");
$sql = "SELECT `SIRFA_PREGLEDA`, `VREME`, `ORD_ID` FROM termin WHERE TIP_PREGLEDA = 'K' AND STATUS = 'T' LIMIT 1";
$result = $mysqli->query($sql);

if (mysqli_num_rows($result) > 0) {

  while($row = mysqli_fetch_assoc($result)) {
        echo '<a href="#" class="list-group-item list-group-item-action flex-column align-items-start noHover control-pacient color-black">
        <div class="d-flex w-100 justify-content-between"><h5 class="mb-1 mobile small-m title-pos"><b>ПРЕГЛЕД У ТОКУ</b></h5>';
        echo '<small class="mobile small-m time-pos">';
        echo $row['VREME']; 
        echo '</small>';
        echo '</div><h5 class="d-flex justify-content-center mobile small-m">ШИФРА ПРЕГЛЕДА:';
        echo ('<br>'); 
        echo $row['SIRFA_PREGLEDA'];
        echo '</h5><small class="d-flex justify-content-center mobile small-m">ОРДИНАЦИЈА: ';
        echo $row['ORD_ID']; 
        echo('</small></a>');
    }
}

//<a href="#" class="list-group-item list-group-item-action flex-column align-items-start noHover control-pacient color-black">
?>


<?php

require("../scripts/db.php");

$sql = "SELECT `SIRFA_PREGLEDA`, `VREME`, `ORD_ID` FROM termin WHERE TIP_PREGLEDA = 'K' AND STATUS = 'C' LIMIT 1";
$result = $mysqli->query($sql);

if (mysqli_num_rows($result) > 0) {

  while($row = mysqli_fetch_assoc($result)) {
        echo '<a href="#" class="list-group-item list-group-item-action flex-column align-items-start noHover control-pacient color-black">
        <div class="d-flex w-100 justify-content-between"><h5 class="mb-1 mobile small-m title-pos"><b>СЛЕДЕЋИ НА РЕДУ</b></h5>';
        echo '<small class="mobile small-m time-pos">';
        echo $row['VREME']; 
        echo '</small>';
        echo '</div><h5 class="d-flex justify-content-center mobile small-m">ШИФРА ПРЕГЛЕДА: '; 
        echo ('<br>');
        echo $row['SIRFA_PREGLEDA'];
        echo '</h5><small class="d-flex justify-content-center mobile small-m">ОРДИНАЦИЈА: ';
        echo $row['ORD_ID']; 
        echo('</small></a>');
    }
}

?>

        </div>
      </div>

    </div>
  </div>

</body>
</html>