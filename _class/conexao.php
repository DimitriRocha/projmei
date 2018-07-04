<?php
session_start();

// $DB_host = "localhost";
// $DB_user = "root";
// $DB_pass = "";
// $DB_name = "dblogin";

$DB_host = "localhost";
$DB_user = "consu967_mei";
$DB_pass = "Kp4v6CpaPu";
$DB_name = "consu967_bdlogin";


try{
    $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
    $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    //echo $e->getMessage();
}

include '_class/loginT.php';

$login = new LoginT($DB_con);
?>