<?php
@session_start();
error_reporting(E_ALL);
ini_set('display_errors','1');
require_once('dbh.php');
require_once'config.php';


if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['Email']) && $_POST['Email'] !="") {
    
    $Email = isset($_POST['Email']) ? $_POST['Email'] : false;

     if($Email == "") {
         echo 'email empty!!';
         exit();
     }

     if(!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            echo ' invalid email address, please verify your email address';
            exit();
        }else if(!preg_match("/^[a-z `A-Z0-9@.]*$/",$Email) && strip_tags($Email)) {
             echo 'invalid, email format not accepted, special characters not allowed';
             exit();
            
         }else{
            //check Email
            $con= new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
            $query = $con->prepare("SELECT email FROM users WHERE email =? LIMIT 1");
            $e_Check = $query->bindParam(1, $Email, PDO::PARAM_STR);
            $e_Check = $query->execute();
            $e_Check = $query->rowCount();
            if( $p_Check=$query->rowCount() > 0) {
                echo 'Email verification successful, click submit';
                exit();
            }else{
                echo $Email. ' not found, enter your registration email please';
                exit();
            }
        }
    
    }
        ?>
