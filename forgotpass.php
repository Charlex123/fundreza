<?php
session_start();
require_once('dbh.php');


if(isset($_POST['submit']) && isset($_POST['Email']) && $_POST['Email'] !=''){
  $Email= trim(filter_var($_POST['Email'],FILTER_VALIDATE_EMAIL));//get users emails for password reset
  $_SESSION['email'] = trim(filter_var($_POST['Email'],FILTER_VALIDATE_EMAIL));
  $_SESSION['email'];
  $emailcut = substr($Email, 0, 5);
  $hash = md5(uniqid(true)); //get alphanumeric code for users password reset
  $resetcode = $emailcut.$hash;
  $_SESSION['resetcode'] = $resetcode;
  $_SESSION['resetcode'];

class passRecover extends dbh {
    
    public function recoverPassword($Email, $resetcode) {

      try{
    
    
      if(!filter_var($Email, FILTER_VALIDATE_EMAIL)===false) {
      $con= new PDO("mysql:host=$this->serverhost;dbname=bitcsvxl_213;" , $this->serverusername, $this->serverpassword);
      $checkmail= $con->prepare("SELECT Email FROM users WHERE Email = ? LIMIT 1");
      $checkmail -> bindParam(1,$Email,PDO::PARAM_STR);
      $row=$checkmail->execute();

      if($row){

        $row= $checkmail->fetch(PDO::FETCH_ASSOC);
        $results[]=$row;
        $checkmail->rowCount();
        if($row=$checkmail->rowCount()>0) {
        $lostpass=$resetcode;
        $updat=$con->prepare("UPDATE users SET lostpass ='".$resetcode."'  WHERE Email=? LIMIT 1");
        $updat ->bindParam(1,$Email,PDO::PARAM_STR);  
             
        //update our users table with unique password hash
        //sending them their password code
         if($updat->execute()){ 
        $headers= " From: Support@greensharescommunity.net\r\n ";
        $headers .= " Do not Reply\r\n";
        $headers .= " CC:greensharescommunity.net\r\n";
        $headers .= " MIME-Version:1.0\r\n";
        $headers .= " Content-Type: text/html; charset=utf-8\r\n";                    
         $to.= $email;
         $subject.= "Your Password Recover Link\r\n";
         $header.= "From https://www.silverhub.com\r\n";
         $message.="Dear Esteemed participant, here is Your link to Reset and Recover Your Password<br>\r\n";
         $message.="To recover your password and Activate your account, COPY THE GENERATED PASSWORD BELOW:<br><strong>$resetcode</strong><br> \r\n";
         $message.="AND PASTE IT IN THE UPDATE PASSWORD PAGE THAT WILL OPEN ON CLICKING THE BELOW LINK\r\n";
         $message.= '<h4>'.$_SERVER['SERVER_NAME'].'/silverhub/forgotpass.php?email='.$Email.'&resetcode='.$resetcode.'</h4>';
         
         $message= mail($to, $subject, $message, $header);
  
         header("location:recover_password.php");
             
            exit();
          }else{
            echo 'password update failed, invalid email address';
            header("location:home.php");
            exit();
          }

            }else{
               echo 'Hello the email you provided does not exist in our database';
               header("location:home.php");
               exit();
            }
          }
          else{
               echo 'Hello the email you provided does not belong to any account';
               header("location:home.php");
               exit();
            }
          }
        }catch(PDOException $e) {
          throw new Exception($e->getMessage());

        }

    }

} 
$object = new passRecover();
$object ->recoverPassword($Email, $resetcode);
}
?>