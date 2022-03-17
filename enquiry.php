<?php
@session_start();
require_once'config.php';

if(isset($_POST['clientName']) && isset($_POST['clientEmail']) && isset($_POST['clientMessage'])) {
   
    $clientname = isset($_POST['clientName']) ? $_POST['clientName'] : false;
    $clientemail = isset($_POST['clientEmail']) ? $_POST['clientEmail'] : false;
    $clientmessage = isset($_POST['clientMessage']) ? $_POST['clientMessage'] : false;
    $clientsubject = isset($_POST['clientSubject']) ? $_POST['clientSubject'] : false;

    if(strip_tags($clientname) && preg_match("/^[a-z `A-Z0-9.]*$/",$clientname)){
        $clientName = $clientname;
    }else {
        exit('invalid name format');
    }

    if(strip_tags($clientsubject)){
      $clientSubject = $clientsubject;
    }else {
        exit('invalid subject format');
    }

    if($_POST['clientMessage'] = ""){
        exit('enter message');
    }else if(strip_tags($clientmessage)){
        $clientMessage = $clientmessage;
    }else{
        exit('invalid message format');
    }

    if(!filter_var($clientemail, FILTER_VALIDATE_EMAIL)) {
        exit('invalid email address, please verify your email address');
    }
    if(!preg_match("/^[a-z `A-Z0-9@.]*$/",$clientemail) && strip_tags($clientemail)) {
        exit('invalid, email format');
    }
    $time = date('Y-m-d H:i:s',time());

    $sql = $con -> prepare("INSERT INTO clientenquiries (clientName,clientEmail,clientSubject,clientMessage,timestatus) VALUES (?,?,?,?,?)");
    $sql -> bindParam(1,$clientName);
    $sql -> bindParam(2,$clientemail);
    $sql -> bindParam(3,$clientSubject);
    $sql -> bindParam(4,$clientMessage);
    $sql -> bindParam(5,$time);
    if($sql -> execute()) {
        echo 'thank you, we will reply your message shortly';
        
    }

}else {
    exit('All fields are required');
}

?>