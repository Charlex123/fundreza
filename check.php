<?php
        @session_start();
        error_reporting(E_ALL);
        ini_set('display_errors','1');
        require_once('dbh.php');
        require_once'config.php';
        
        if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['Fname']) && $_POST['Fname'] !="") {
            
            $name = isset($_POST['Fname']) ? $_POST['Fname'] : false;

            if(strlen($name) < 3 || strlen($name) > 80) {
                echo 'Name must be between 3 - 80 characters';
                exit(); 
            }elseif(!preg_match("/^[a-z A-Z0-9.]*$/",$name) && strip_tags($name)) {
                echo 'invalid, name must be alphanumerics with no special characters';
                exit();
        }
    }
            
?>


<?php
        @session_start();
        error_reporting(E_ALL);
        ini_set('display_errors','1');
        require_once('dbh.php');
        require_once'config.php';
        
        if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['uname']) && $_POST['uname'] !="") {
            
            $Uname = isset($_POST['uname']) ? $_POST['uname'] : false;

            if(strlen($Uname) < 3 || strlen($Uname) > 50) {
                $message = "<div class='alert-danger pt-2 pb-2 rounded'>Username name must be between 3 - 50 characters <span class='close-err'>&times;</span> </div>";
                exit(); 
            }elseif(!preg_match("/^[a-z0-9A-Z.]*$/",$Uname) && strip_tags($Uname)) {
              $message = "<div class='alert-danger pt-2 pb-2 rounded'>invalid,  Username must be a misture of alphabets and numbers with no special characters and spaces <span class='close-err'>&times;</span> </div>";
              exit();
          }else {
            $con= new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
                      $query = $con->prepare("SELECT uname FROM users WHERE uname=? LIMIT 1");
                      $e_Check = $query->bindParam(1, $Uname, PDO::PARAM_STR);
                      $e_Check = $query->execute();
                      if( $e_Check=$query->rowCount() > 0) {
                        $message =  "username already taken, please choose another <i class='fas fa-times' style='color: red'></i>";
                        exit();
                      }else{
                        $message = $Uname. ' is OK <i class="fas fa-check" style="color: green"></i>';
                        exit();
                      }
          }
    }
            
?>


<?php
@session_start();
error_reporting(E_ALL);
ini_set('display_errors','1');
require_once('dbh.php');
require_once'config.php';


if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['password']) && $_POST['password'] !="" && !isset($_POST['password1']) && $_POST['password1'] =="") {
    
    $password = isset($_POST['password']) ? $_POST['password'] : false;
    
    
    // if(in_array($passArray,$specialChar) || in_array($passArray1,$specialChar) || in_array($passArray2,$specialChar) || in_array($passArray3,$specialChar) || in_array($passArray4,$specialChar)) {
    //     echo 'contains special char';
    // }else {
    //     echo 'no special char';
    // }

    if(strlen($password) < 5) {
           echo 'Password must be more than 5 characters';
         exit();
        }
        else if(strlen($password) >= 5 && strlen($password) <= 10) {
            echo 'Password strength .....<span style="color:#800;"> Weak ';
            exit();
         }
        else if(strlen($password) > 10 && strlen($password) <= 16) {
            echo 'Password strength .....<span style="color:#adff2f;"> Good ';
            exit();
         }
         else if(strlen($password) > 16 ) {
            echo 'Password strength .....<i class="fas fa-check" style="color: green"> </i> ';
            exit();
         }
         

         if(strlen($password) > 16 ) {
            echo 'Password strength .....<i class="fas fa-check" style="color: green"></i> ';
            exit();
         }
            
    
    
    }
    
    ?>

<?php
@session_start();
error_reporting(E_ALL);
ini_set('display_errors','1');
require_once('dbh.php');
require_once'config.php';


if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['password']) && isset($_POST['password1']) && $_POST['password'] !="" && $_POST['password1'] !="") {
    
    $password = isset($_POST['password']) ? $_POST['password'] : false;
    $password1 = isset($_POST['password1']) ? $_POST['password1'] : false;
   
    if(strlen($password) < 5) {
        echo 'Password must be more than 5 characters';
      exit();
     }
     else if(strlen($password) >= 5 && strlen($password) <= 8) {
         echo 'Password strength .....<span style="color:#800;"> Weak <i class="fas fa-times" style="color: green"></i>';
         
      }
     else if(strlen($password) > 8 && strlen($password) <= 16) {
         echo 'Password strength .....<span style="color:#adff2f;"> Good <i class="fas fa-check" style="color: green"></i>';
        
      }
      else if(strlen($password) > 16 ) {
         echo 'Password strength .....<span style="color:#008000;"> Very Good <i class="fas fa-check" style="color: green"></i>';
         
      }
      

      if(strlen($password) > 16 ) {
         echo 'Password strength .....<span style="color:#008000;"> Very Good <i class="fas fa-check" style="color: green"></i>';
         
      }
      
    if($password === $password1) {
        echo "<span style='color:#008000'> and Passwords matched <i class='fas fa-check' style='color: green'></i> </span>";
        exit();
    }
    else {
        
        echo "<span style='color:red'> and Passwords do not match</span>";
        exit();
    }    
    
    
    }else if(isset($_POST['password']) && !isset($_POST['password1'])) {
        echo "<span style='color:#008000'>Confirm password cannot be empty!!</span>";
      exit();
     }
?>

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
             echo "invalid, email format not accepted, special characters not allowed <i class='fas fa-times' style='color: red'></i>";
             exit();
            
         }else{
            //check Email
            $con= new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
            $query = $con->prepare("SELECT email FROM users WHERE email=? LIMIT 1");
            $e_Check = $query->bindParam(1, $Email, PDO::PARAM_STR);
            $e_Check = $query->execute();
            if( $e_Check=$query->rowCount() > 0) {
                echo  "email already taken, please choose another <i class='fas fa-times' style='color: red'></i>";
                exit();
            }else{
                echo $Email. ' is OK <i class="fas fa-check" style="color: green"></i>';
                exit();
            }
        }
    
    }
        ?>

<?php
@session_start();
error_reporting(E_ALL);
ini_set('display_errors','1');
require_once('dbh.php');
require_once'config.php';


if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['phonenumber']) && $_POST['phonenumber'] !="") {
    
        $phonenumber = isset($_POST['phonenumber'])? $_POST['phonenumber'] : false;
    
     if($phonenumber =="") {
            echo $error_phonenumber = 'phonenumber empty!!';
            exit();
        }else if($phonenumber != htmlentities(strip_tags($_POST['phonenumber']))) {
            echo $error_phonenumber = "invalid phonenumber <i class='fas fa-times' style='color: red'></i>";
            exit();
        }else if(!preg_match("/^[ +0-9]*$/",$phonenumber) && !ctype_digit($phonenumber)) {
            echo $error_phonenumber = "only numbers required! <i class='fas fa-times' style='color: red'></i>";
            exit();
        }  
     $query = $con->prepare("SELECT phonenumber FROM users WHERE phonenumber = ? LIMIT 1");
     $e_Check = $query->bindParam(1, $phonenumber, PDO::PARAM_STR);
     $e_Check = $query->execute();
     $e_Check = $query->rowCount();
     if( $p_Check=$query->rowCount() > 0) {
         echo $phonenumber." already taken, please choose another <i class='fas fa-times' style='color: red'></i>";
           exit();     
        }else{
            echo  $phonenumber. ' is OK <i class="fas fa-check" style="color: green"></i>';
            exit();  
      }      
        
  }
?>
