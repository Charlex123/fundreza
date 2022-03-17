<?php

session_start();
require_once'dbh.php';
require_once'config.php';

$user_data = @$_SESSION['user'];
$userid = $user_data['id'];
$name = @$user_data['fname'];
$email_of_user = @$user_data['email'];


$con = new PDO("mysql:host=$serverhost;dbname=coinauct_db;" , $serverusername, $serverpassword);
$chec = $con -> prepare("SELECT totalEarning AS bidEarning,auction_type FROM auction_table WHERE clientEmail = ?");
$chec ->bindParam(1,$email_of_user);
$chec -> execute();
$result = $chec -> fetchAll(PDO::FETCH_ASSOC);
$data = array();
foreach ($result as $row) {
$data[] = $row;
}

echo json_encode($data);
?>
