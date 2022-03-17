<?php
$serverhost = "localhost";
$serverdbname = "fundgcmf_db";
$serverusername = "fundgcmf_db";
$serverpassword = "Charles@9845";


$con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
if(isset($con)) { 
// echo 'connected';
}else {
   // header("index.php");
   // exit();
}  
?>