<?php
session_start();
require_once'dbh.php';
require("config.php");

$_SESSION['user'];
$user_data = $_SESSION['user'];
$userid = $user_data['id'];
$name = $user_data['name'];
$status = 'logged out';

// $upLogin = $con -> prepare("UPDATE loginstatus SET status = ? WHERE id = ? AND name = ?");
// $upLogin -> bindParam(1,$status,PDO::PARAM_STR);
// $upLogin -> bindParam(2,$userid,PDO::PARAM_INT);
// $upLogin -> bindParam(3,$name,PDO::PARAM_STR);
// $upLogin -> execute();


session_destroy();
header("Location:https://my.fundreza.com/login");
exit();



?>