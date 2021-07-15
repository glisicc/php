<?php

include_once("../scripts/engine.php");

$_SESSION["connection"] = new dbConnect;
$_SESSION["connection"]->connect();

$admin_user = 00000000000;
$admin_password = "admin";

$lbo = $_REQUEST["lbo"];
$lozinka = $_REQUEST["password"];

//$query = $_SESSION["connection"]->mysqli->query("SELECT * FROM sifdok WHERE USER='$lbo' AND PASS='$lozinka'");
//$doc_login = $query->num_rows;

if(($_REQUEST["lbo"] == $admin_user) && ($_REQUEST["password"] == $admin_password)){

    session_start();
    $_SESSION['admin'] = new user;
    $_SESSION['admin']->priv = "admin";

    header("Location: ../admin/panel.php");

}
else {
    

    $query = $_SESSION["connection"]->mysqli->query("SELECT * FROM ordinacija WHERE USER_ORD='$lbo' AND PASS_ORD='$lozinka'");
    
    if($query->num_rows == 1){
    
        $data = $query->fetch_object();
        
        session_start();

        $_SESSION["ordinacija"] = new user;
        $_SESSION["ordinacija"]->priv = "ordinacija";
        $_SESSION["ordinacija"]->tip = "regularni";
        $_SESSION["ordinacija"]->broj = "1";

        $_SESSION['ime'] = $data->NAZIV;

        $termini = array("07:00", "07:30", "08:00", "08:30", "09:00", "09:30", "10:00", "10:30", "11:00",
        "11:30", "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30",
        "16:00", "16:30", "17:00", "17:30", "18:00", "18:30", "19:00", "19:30", "20:00",
        "20:30", "21:00", "21:30", "22:00");

        $duzina = count($termini);
        $trenutno = new DateTime(date("H:i:s"));
        for($i = 1; $i < $duzina; $i++){
            $prvi = new DateTime($termini[$i - 1]);
            $drugi = new DateTime($termini[$i]);
            if($trenutno >= $prvi && $trenutno <= $drugi){
                $_SESSION['ordinacija']->vreme = $termini[$i - 1];
            }
        }
    
        header("Location: ../doctor/panel.php");
    }
    else{

    $lbo = stripcslashes($_REQUEST["lbo"]);
    $lozinka = stripcslashes($_REQUEST["password"]);
    
    
    $query = $_SESSION["connection"]->mysqli->query("SELECT korisnik.LBO FROM korisnik INNER JOIN termin ON korisnik.ID = termin.IDKOR WHERE korisnik.LBO = '$lbo' AND termin.SIRFA_PREGLEDA = '$lozinka'");
    // 24703737736
    // 26-04-0700-P3
    if($query->num_rows == 1){
        
        session_start();
        $_SESSION["pacijent"]["lbo"] = $lbo;
        $_SESSION["pacijent"]["priv"] = 1;

    
        header("Location: ../patient/panel.php");
    }
    else{
        die(header("Location: ../index.php?error=1"));
    
    }
  }
}





?>