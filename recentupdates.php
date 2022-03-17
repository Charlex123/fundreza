<?php
session_start();

    require_once'dbh.php';
    require_once'config.php';
    $user_data = @$_SESSION['user'];
    $userid = $user_data['id'];
    $email = $user_data['email'];

    $rt = new dbh();
    $rt ->referralEarningsCalc();
?>