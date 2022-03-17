
<?php

session_start();
require_once('dbh.php');
require_once'mailer.php';

if(!isset($_GET['active']) && empty($_GET['active']) && $_GET['active'] == null ) {
    echo 'Email Codes required !!!!';
    exit();
}elseif(isset($_GET['active']) && !empty($_GET['active']) && $_GET['active'] != null ) {
    $email_code = filter_var(($_GET['active']), FILTER_SANITIZE_STRING);
    $explode = explode('@',$email_code);
    $emailCode = $explode[0];
    if($emailCode == "" || $emailCode == null) {
        exit();
    }
class activate extends dbh {
    
 public function getUserByUserid($emailCode) {
     try{
        $email_code = filter_var(($_GET['active']), FILTER_SANITIZE_STRING);
        $explode = explode('@',$email_code);
        $emailCode = $explode[0];
        $con = new PDO("mysql:host=$this->serverhost;dbname=bitcsvxl_213;" , $this->serverusername, $this->serverpassword);

        $lon = $con->prepare("SELECT * FROM users WHERE emailCode = ? LIMIT 1");
        $lon -> bindParam(1, $emailCode);
        $lon -> execute();
        if(!$lon){
        die("Execute query error, because:".print_r($connect->errorinfo()));
        }else{
        $result = $lon->fetch(PDO::FETCH_ASSOC);
        $_SESSION['emailcode'] = $result['emailCode'];
        return $result;
             }
             
        }catch(PDOException $e){
       throw new PDOException($e->getMessage());
     }
}



public function activateMe($emailCode){
   try{ 
        $email_code = filter_var(($_GET['active']), FILTER_SANITIZE_STRING);
        $explode = explode('@',$email_code);
        $emailCode = $explode[0];
        
        if($emailCode === $_SESSION['emailcode']) {
            
            $con = new PDO("mysql:host=$this->serverhost;dbname=bitcsvxl_213;" , $this->serverusername, $this->serverpassword);
            
            $activ = $con->prepare("UPDATE users SET active = 1, emailCode = 0 WHERE emailCode = ?");
            $activ->bindParam(1, $emailCode, PDO::PARAM_STR);
            
            $selv = $con -> prepare("SELECT fname,email FROM users WHERE emailCode = ? LIMIT 1");
                $selv -> bindParam(1,$emailCode);
                $selv -> execute();
                

                $reslt = $selv -> fetch(PDO::FETCH_ASSOC);
                $name = $reslt['fname'];
                $email = $reslt['email'];
                $_SESSION['Fname'] = $name;
                $_SESSION['Email'] = $email;
                
            if($activ -> execute()){
                $Email = $_SESSION['Email'];
                $uname = $_SESSION['Fname'];
                accountverificationSuccess($Email,$uname);
                
                }else{
                header("Location:verify-email.php");
                exit();
                }

                }else{
                    echo 'invalid email code';
                    exit();
                }
                
            }catch(PDOException $e) {
            throw new PDOException($e->getMessage());
        }
        }

        }
        $activated = new activate();
        $activated->getUserByUserid($emailCode);
        $activated ->activateMe($emailCode);

}
?>
