<?php

include_once("engine.php");

$_SESSION["connection"] = new dbConnect;
$_SESSION["connection"]->connect();

function generateRandomString($length = 6) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

$user_code = generateRandomString();  


function generateRandomStringTermin($length = 2) {
    return substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

$random_number = generateRandomStringTermin();  

$lbo = $_REQUEST["lbo"];

$query = $_SESSION["connection"]->mysqli->query("SELECT * FROM korisnik WHERE LBO='$lbo'");
$num = $query->num_rows;


if ($num == 0){
    //Definisanje sifre pregleda
    $sifra_pregleda = date("d-m") . "-0800-" . $random_number;
    //Fiksno vreme pregleda, potrebno je pokupiti vrednost iz tabele
    $vreme_pregleda = "0900";
    //Status pregleda
    $status_pregleda = "C";
    //Fiksna ordinacija
    $ord = 5;
    //Visak, za testiranje samo
    $kor = 22;

    //Podaci korisnika sa sajta
    $ime = $_REQUEST['ime'];
    $prezime = $_REQUEST['prezime'];
    $email = $_REQUEST['email'];
    $telefon = $_REQUEST['telefon'];
    $lozinka = $user_code;
    $godiste = $_REQUEST['g_rodjenja'];
    $time = $_REQUEST["time"];
    $imeprez =  $ime . " " . $prezime;



    //echo $ime . " " . $prezime . " " . $email . " " . $telefon . " " . $lozinka . " " . $godiste . " " . $imeprez . " " . $time;

    //Setovanje simptoma na pocetnu vrednost
    $symp1 = 0;
    $symp2 = 0;
    $symp3 = 0;
    $symp4 = 0;
    $symp5 = 0;
    $symp6 = 0;
    $symp7 = 0;

    //Davanje vrednost "1" simptomu ako je stikliran
    if(isset($_REQUEST["symptom1"])){
        $symp1 = 1;
    }
    if(isset($_REQUEST["symptom2"])){
        $symp2 = 1;
    }
    if(isset($_REQUEST["symptom3"])){
        $symp3 = 1;
    }
    if(isset($_REQUEST["symptom4"])){
        $symp4 = 1;
    }
    if(isset($_REQUEST["symptom5"])){
        $symp5 = 1;
    }
    if(isset($_REQUEST["symptom6"])){
        $symp6 = 1;
    }
    if(isset($_REQUEST["symptom7"])){
        $symp7 = 1;
    }
    //echo "<br />";
    //echo $symp1 . " " . $symp2 . " " . $symp3 . " " . $symp4 . " " . $symp5 . " " . $symp6 . " " . $symp7 . " " . $symp8 . " " . $symp9;

    //Upis korisnika u tabelu korisika
    $statement = $_SESSION["connection"]->mysqli->prepare("INSERT INTO korisnik (IMEPREZ, EMAIL, GOD, TEL, LBO, TEMP, TDIS, BUG, GRLO, DIJA, KSZ, NS) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $statement->bind_param('ssisiiiiiiii', $imeprez, $email, $godiste, $telefon, $lbo, $symp1, $symp2, $symp3, $symp4, $symp5, $symp6, $symp7);
    
    if($statement->execute()){

    $query = $_SESSION["connection"]->mysqli->query("SELECT * FROM korisnik ORDER BY ID DESC LIMIT 1");
    
    $data = $query->fetch_object();
    $user_id = $data->ID;
    $user_name = $data->IMEPREZ;

    

    //$query = $_SESSION["connection"]->mysqli->query("SELECT * FROM termin WHERE VREME='$time' ");
    //echo $query->num_rows;
    
    $query = $_SESSION["connection"]->mysqli->query("SELECT * FROM termin WHERE VREME='$time' AND IDKOR IS NULL ORDER BY ORD_ID ASC LIMIT 1");

    $data = $query->fetch_object();
    $id_termina = $data->ID;
    $code = $data->SIRFA_PREGLEDA;


    //echo $data->ID . " " . $data->SIRFA_PREGLEDA . " " . $data->VREME . " " . $data->STATUS . " " . $data->TIP_PREGLEDA;

    $_SESSION["connection"]->mysqli->query("UPDATE termin SET IDKOR='$user_id' WHERE ID='$id_termina'");

        //  require_once '../vendor/autoload.php';
        //  $messagebird = new MessageBird\Client('lxkF5ERl687UkIu2So0e8meuh');
        //  $message = new MessageBird\Objects\Message();
        //  $message->originator = '+381...';
        //  $message->recipients = [ '+381...' ];
        //  $message->body = 'Postovani, ' . $user_name . ', Vas termin je zakazan pod sifrom: ' . $code . '';
        //  $response = $messagebird->messages->create($message);
        //  var_dump($response);


    // $from = "";
    // $cc = "";

    //     $headers = "From: " . $from . "\r\n";
    //     $headers .= "Reply-To: ". $email . "\r\n";
    //     $headers .= "CC:" . $cc . "\r\n";
    //     $headers .= "MIME-Version: 1.0\r\n";
    //     $headers .= "Content-Type: text/html; charset=UTF-8";

    //     $message = '<html><body>';
    //     $message .= '<h1>ПОДСЕТНИК ЗА ТЕРМИН</h1>';
    //     $message .= '<h3>Пoштовани/на: ' . $ime . ' ' . $prezime . '</h3>';
    //     $message .= '<p>Подсетник за термин: ' . date("d.m.y") . '</p>';
    //     $message .= '<p>Време: ' . date("d.m.y") . '</p>';
    //     $message .= '<p>Адреса установе: Змај Јовина 30, Крагујевац</p>';
    //     $message .= '<p>Шифра прегледа: ' . $user_code . '</h4>';
    //     $message .= '<hr>';
    //     $message .= '<h3><b>Напомена:</b> Шифра термина се узима као лозинка за пријаву на систем.</p></h3>';
    //     $message .= '</body></html>';

    //     mail($to, $subject, $message, $headers);

        // $from = "";
        // $cc = "";

        // $headers = "From: " . $from . "\r\n";
        // $headers .= "Reply-To: ". $email . "\r\n";
        // $headers .= "CC:" . $cc . "\r\n";
        // $headers .= "MIME-Version: 1.0\r\n";
        // $headers .= "Content-Type: text/html; charset=UTF-8";

        // $message = '<html><body>';
        // $message .= '<div class="mail" align="center">';
        // $message .= '<table>';
        // $message .= '<thead>';
        // $message .= '<img src="Logo.PNG" align="center" alt="Anti-Covid Logo" width="200" height="170">';
        // $message .= '<p></p>';
        // $message .= '</thead>';
        // $message .= '<tbody>';
        // $message .= '<tr>';
        // $message .= '<td bgcolor="CEF9FF">';
        // $message .= '<font size="5" face="cambria">';
        // $message .= '<p align="center"><b>Подсетник за термин</b></p>';
        // $message .= '</font>';
        // $message .= '</td>';
        // $message .= '</tr>';
        // $message .= '<tr>';
        // $message .= '<td>';
        // $message .= '<font size="4" face="cambria">';
        // $message .= '<p>Поштовани: ' . $user_name . ' </p>';
        // $message .= '<br>';
        // $message .= '<p>Подсетник за термин: ' . date('d.m.y') . '</p>';
        // $message .= '<p>Време: ' . $time . ' </p>';
        // $message .= '<br>';
        // $message .= '<p>Установа: АТД Крагујевац</p>';
        // $message .= '<p>Адреса: Змај Јовина 30, Крагујевац</p>';
        // $message .= '</font>';
        // $message .= '</td>';
        // $message .= '</tr>';
        // $message .= '<tr>';
        // $message .= '<td bgcolor="CEF9FF">';
        // $message .= '<font size="4" face="cambria">';
        // $message .= '<p><b>Шифра прегледа: </b>' . $code . ' </p>';
        // $message .= ' <p><b>Напомена: </b>Шифра термина се узима као лозинка за пријаву на систем.</p>';
        // $message .= '</font>';
        // $message .= '</td>';
        // $message .= '</tr>';
        // $message .= '</tbody>';
        // $message .= '</table>';
        // $message .= '</div>';
        // $message .= '</body></html>';

        // mail($to, $subject, $message, $headers);

    header("Location: ../prijava.php?success=1");
    }
    else{
        die('Error: (' . $_SESSION["connection"]->mysqli->errno . ')' . $_SESSION["connection"]->mysqli->error);
    }

}




?>