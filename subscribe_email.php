<?php
@session_start();
require_once'config.php';

if(isset($_POST['subName']) && isset($_POST['subEmail'])) {
   
    $subname = isset($_POST['subName']) ? $_POST['subName'] : false;
    $subemail = isset($_POST['subEmail']) ? $_POST['subEmail'] : false;

    if(strip_tags($subname) && preg_match("/^[a-z `A-Z0-9.]*$/",$subname)){
        $subName = $subname;
    }else {
        exit('invalid name format');
    }

    if(!filter_var($subemail, FILTER_VALIDATE_EMAIL)) {
        exit('invalid email address, please verify your email address');
    }
    if(!preg_match("/^[a-z `A-Z0-9@.]*$/",$subemail) && strip_tags($subemail)) {
        exit('invalid, email format');
    }
    $time = date('Y-m-d H:i:s',time());

    $sql = $con -> prepare("INSERT INTO email_sub (subname,email,timestatus) VALUES (?,?,?)");
    $sql -> bindParam(1,$subName);
    $sql -> bindParam(2,$subemail);
    $sql -> bindParam(3,$time);
    if($sql -> execute()) {
        echo 'Update subscription successful';
        
    }

}

?>