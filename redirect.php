<?php
session_start();
require_once'dbh.php';
require_once'config.php';

@$_SESSION['currentpage'] = $_SERVER['REQUEST_URI'];
strip_tags(@$_SESSION['currentpage']);

@$user_data = @$_SESSION['user'];
@$userid = @$user_data['id'];
@$email_of_user = @$user_data['email'];


if(isset($user_data)) {
    $gd = $con->prepare("SELECT * FROM users WHERE id = ? ");
    $gd -> bindParam(1,$userid);
    if($gd ->execute()) {
        header("location:https://fundreza.com/s/choose-type");
    }
}else {
    header("location:https://my.fundreza.com/login");
}
?>