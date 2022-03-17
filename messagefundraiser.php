<?php
@session_start();
require_once'config.php';

if(isset($_POST['fMessage']) && isset($_POST['senderEmail']) && isset($_POST['senderName'])) {
   
    $fMessage = isset($_POST['fMessage']) ? $_POST['fMessage'] : false;
    $senderEmail = isset($_POST['senderEmail']) ? $_POST['senderEmail'] : false;
    $senderName = isset($_POST['senderName']) ? $_POST['senderName'] : false;

    if(strip_tags($fMessage)){
        $fMessage = $fMessage;
    }else {
        exit('invalid subject format');
    }

    if($_POST['senderName'] = ""){
        exit('enter message');
    }else if(strip_tags($senderName)){
        $senderName = $senderName;
    }else{
        exit('invalid message format');
    }

    if(!filter_var($senderEmail, FILTER_VALIDATE_EMAIL)) {
        exit('invalid email address, please verify your email address');
    }
    if(!preg_match("/^[a-z `A-Z0-9@.]*$/",$senderEmail) && strip_tags($senderEmail)) {
        exit('invalid, email format');
    }
    $time = time();

    $sql = $con -> prepare("INSERT INTO fundraiser_messages (fMessage,senderName,senderEmail,timestatus) VALUES (?,?,?,?)");
    $sql -> bindParam(1,$fMessage);
    $sql -> bindParam(2,$senderName);
    $sql -> bindParam(3,$senderEmail);
    $sql -> bindParam(4,$time);
    if($sql -> execute()) {
        echo 'Fundraiser organizer has received your message and will respond as soon as possible';
        
    }

}else {
    exit('All fields are required');
}

?>