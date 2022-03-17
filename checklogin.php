
<?php
@session_start();
error_reporting(E_ALL);
ini_set('display_errors','0');
require_once('dbh.php');
require_once'config.php';


if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['login_identity']) && $_POST['login_identity'] !="" && $_POST['login_identity'] != null && isset($_POST['log']) && $_POST['log'] !="") {
    
    $login_identity = isset($_POST['login_identity']) ? $_POST['login_identity'] : false; 

    if(!filter_var($login_identity, FILTER_VALIDATE_EMAIL)) {
        echo " invalid email address, please verify your email address <i class='fas fa-times' style='color: red'></i>";
        exit();
    }
    $con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
    $login = $con->prepare("SELECT * FROM users WHERE email = ? ");
    $login -> bindParam(1, $login_identity, PDO::PARAM_STR);

    if($login->execute()){
    $re = $login -> fetch(PDO::FETCH_ASSOC);
    @$userid = @$re['id'];

    if($login->rowCount() > 0 && @$re['active'] === 0) {

    echo "Your account is inactive, we already sent you your activation code in your email";
    exit();
        }else if($login->rowCount() === 0 && @$re['active'] == null){
        echo "we can't find a match with email <span style='color:#808080;font-style:italic;'>$login_identity</span>";
        
        exit();
    }else {
        echo 'match found, enter your password and click login';
        exit();
    }
    }else {
        echo 'oops something happened';
        exit();
    }
    
}

?>


  <?php

    
    //requiring mydatabase and connection
    require_once('config.php');

    if( isset($_POST['login_identity']) && $_POST['login_identity'] != "" && $_POST['login_identity'] != null && isset($_POST['password']) && $_POST['password'] != "" && $_POST['password'] != null){
        
        $error = ""; 

        if(preg_match("/^[a-z A-Z0-9@.]*$/",$_POST['login_identity'])) {
        $login_identity = $_POST['login_identity'];
 
        $password = trim($_POST['password']);
    
        $Active = 1;

            $con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
            $login = $con->prepare("SELECT * FROM users WHERE email = ? ");
            $login -> bindParam(1, $login_identity, PDO::PARAM_STR);
            
            if($login->execute()){
            $re = $login -> fetch(PDO::FETCH_ASSOC);
            $userid = @$re['id'];
            
            if($login->rowCount() > 0 && $re['active'] == 0) {
            
            echo $error = "Your account is inactive, we already sent you your activation code in your email";
            
                }else if($login->rowCount() == 0 && @$re['active'] == null){
                echo $error = "You do not have account with us, <a href='javascript:showsignUp()' style='text-decoration;font-style:italic;color:#008;'>create account</a>";
                
            }else if($login->rowCount() > 0 && $re['active'] == 1) {
                if(password_verify($password, $re['password'])) {
                    echo $error = "account verified, click login";
                    }else{
                        
                  echo $error = "email and password does not match";
                    exit();
                }
            }
            }else {
                echo $error = "oops something happened, check your login details and try again";
                exit();
            }
        
        
    }else {
        echo $error = "unrecognized login details";
        exit();
    }

}
    
?>