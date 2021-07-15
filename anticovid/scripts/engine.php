<?php

class dbConnect{
    var $host = "localhost";
    var $user = "root";
    var $password = "";
    var $dbName = "database";
    
    function connect(){
        $this->mysqli = new mysqli($this->host, $this->user, $this->password, $this->dbName);

        if($this->mysqli->connect_error){
            die('Error : (' . $this->mysqli->connect_errno . ') ' . $this->mysqli->connect_error);
        }
    }

    function logout(){
        session_destroy();
        die(header("Location: ../prijava.php?success=2"));
    }
    
    function close(){
        $this->close = $this->mysqli->close();
    }
}

class user{
    var $name;
    var $lastname;
    var $email;
    var $lbo;
    var $code;
    var $phone;
    var $priv;
    var $tip;
    var $broj;
}



?>