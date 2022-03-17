<?php
session_start();
require_once('dbh.php');
require_once'mailer.php';

if(isset($_POST['submit']) && isset($_POST['Email']) && $_POST['Email'] !='' && isset($_POST['newPass']) && $_POST['newPass'] !='' && isset($_POST['confirmnewPass']) && $_POST['confirmnewPass'] !='') {
  $Email= trim(filter_var($_POST['Email'],FILTER_VALIDATE_EMAIL));//get users emails for password reset
  $_SESSION['email'] = trim(filter_var($_POST['Email'],FILTER_VALIDATE_EMAIL));
  $password = isset($_POST['newPass']) ? $_POST['newPass'] : false;
  $confirmpassword = isset($_POST['confirmnewPass']) ? $_POST['confirmnewPass'] : false;
  $errorMessage = '';

class passRecover extends dbh {
    
    public function recoverPassword($Email, $password) {

      try{
    
    $password = isset($_POST['newPass']) ? $_POST['newPass'] : false;
    $passenc = password_hash($password, PASSWORD_DEFAULT, array('cost'=>11));
    $confirmpassword = isset($_POST['confirmnewPass']) ? $_POST['confirmnewPass'] : false;
    $errorMessage = '';
    if(!filter_var($Email, FILTER_VALIDATE_EMAIL)===false && $password == $confirmpassword) {
    $con= new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
    $checkmail= $con->prepare("SELECT email,Fname FROM users WHERE email = ? LIMIT 1");
    $checkmail -> bindParam(1,$Email,PDO::PARAM_STR);
    $row=$checkmail->execute();
      
    if($row){

    $row= $checkmail->fetch(PDO::FETCH_ASSOC);
    $_SESSION['Fname'] = $row['Fname'];
    $_SESSION['Email'] = $row['email'];
    $results[]=$row;
    $checkmail->rowCount();
    if($checkmail->rowCount()>0) {
    $lostpass= 0;
    
    $updat = $con -> prepare("UPDATE users SET lostpass = ? , password = ? WHERE email=? LIMIT 1");
    $updat -> bindParam(1,$lostpass,PDO::PARAM_STR);
    $updat -> bindParam(2,$passenc,PDO::PARAM_STR);
    $updat -> bindParam(3,$Email,PDO::PARAM_STR);  
            
    //update our users table with unique password hash
    //sending them their password code
        if($updat->execute()){
            $Emailo = $_SESSION['Email'];
            $exploded  = explode('@',$Emailo);
            $uname = $exploded[0];
        passwordReset($Emailo,$uname);
        
        }else{
        $errorMessage = 'password update failed, invalid email address';
        return false;
        }

        }else{
            $errorMessage = 'Hello the email you provided does not exist in our database';
            return false;
        }
        }
        else{
        $errorMessage = 'Hello the email you provided does not belong to any account';
            return false;
        }
        }
    }catch(PDOException $e) {
        throw new Exception($e->getMessage());

    }

}

} 
$object = new passRecover();
$object ->recoverPassword($Email, $password);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="robots" content="all,follow">
	<link href='https://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Satisfy' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Chilanka' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Girassol' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Cinzel' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Libre Baskerville' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Kulim Park' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Josefin Sans' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=cabin' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=PT Sans' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=EB Garamond' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Exo' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Permanent Marker' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Monoton' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Cookie' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Antic' rel='stylesheet'>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Caveat' rel='stylesheet'>
	<!-- Fontastic Custom icon font-->
	<link rel="stylesheet" href="css/fontastic.css">
	<!-- Google fonts - Poppins -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
	<title>Bitcoin News Today | Reset Password </title>
    <!-- base:css -->
    <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
	<!-- End plugin css for this page -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script lang="javascript" type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<!-- Font Awesome CSS-->
	<link rel="stylesheet" type='text/css' href="fontawesome/fontawesomefiles/css/fontawesome.min.css">
	<link rel="stylesheet" type='text/css' href="fontawesome/fontawesomefiles/css/all.min.css">
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<script lang="javascript" type="text/javascript" src="fontawesome/fontawesomefiles/js/fontawesome.min.js"></script>
	<script lang="javascript" type="text/javascript" src="fontawesome/fontawesomefiles/js/all.min.js"></script>
    <!-- inject:css -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/customize.css">
  <link rel="stylesheet" href="css/login_style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="images/btclogo.png" />
    <script type="text/javascript">_atrk_opts = { atrk_acct:"jSv+k1aQeSI1/9", domain:"ecoinofficial.org",dynamic: true};(function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://certify-js.alexametrics.com/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();</script><noscript><img src="https://certify.alexametrics.com/atrk.gif?account=jSv+k1aQeSI1/9" style="display:none" height="1" width="1" alt="javascript required" /></noscript>
    </head>
    <body>
    <div class="container-scroller">
		
		<!-- partial:partials/_horizontal-navbar.html -->
    
    <div class="container-fluid full-height">
    <div class="overlay"></div>
    
    <div class="row full-height">
      <div class="col-sm-12 col-md-12 col-md-6 authfy-panel authfy-panel-left text-center hidden-xs">
        
      </div> 
      <!-- ./authfy-panel-left -->
      
      <div class="authfy-panel authfy-panel-right">
      
        <!-- authfy-login start -->
        <div class="authfy-login">
          <!-- panel-login start -->
          <div class="authfy-panel panel-login text-center active ">
            <div class="authfy-heading">
              <h3 class="auth-title" style='font-size: 16px;'> <i class="fas fa-mail-bulk" style='color: orange'></i> Reset Password</h3>
            </div>
            
            <hr><br>

             <div class="col-xs-12 col-sm-12 col-md-12 form-col">
                
                <form action="" method='POST' autocomplete="off">
                    
                    <br/>
                    <div><?php echo @$errorMessage ?></div>
                    <br/>
                    <div class="form-group pr-5 pl-5">
                        <input type="email" class="form-control" name='Email' id='recpassmail' placeholder="Enter your email" onmouseout='forgotpassCheck()' required><div style='clear:right;'></div>
                        <div id='recpassStatus'></div>    
                    </div>

                    <div class="form-group pr-5 pl-5">
                        <input type="password" class="form-control" name='newPass' id='recpass' placeholder="Enter new password" onmouseout='forgotpassCheck()' required><div style='clear:right;'></div>
                        <div id='recoverpassStatus'></div>    
                    </div>

                    <div class="form-group pr-5 pl-5">
                        <input type="password" class="form-control" name='confirmnewPass' id='recpass1' placeholder="Repeat new password" onmouseout='forgotpassCheck()' required><div style='clear:right;'></div>
                        <div id='recoverpassStatus'></div>    
                    </div>
                    <div style='clear:both'></div>
                    <button type="submit" class="btn btn-lg" name='submit' value="Submit" > Submit </button>

                </form>
              </div>
            <!-- </div> -->
          </div>
         
        </div>
      </div>
    </div>
  </div>
		<!-- partial:partials/_footer.html -->
		
				<!-- partial -->
			</div>
			<!-- main-panel ends -->
		</div>
		<!-- page-body-wrapper ends -->
    </div>
		<!-- container-scroller -->
    <!-- base:js -->
    <script src="vendors/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="js/template.js"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <!-- End plugin js for this page -->
    <script src="vendors/chart.js/Chart.min.js"></script>
    <script src="vendors/progressbar.js/progressbar.min.js"></script>
		<script src="vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js"></script>
		<script src="vendors/justgage/raphael-2.1.4.min.js"></script>
		<script src="vendors/justgage/justgage.js"></script>
    <!-- Custom js for this page-->
    <script src="js/dashboard.js"></script>
    <!-- End custom js for this page-->
	<script type="text/javascript">
		function toggleSidebar(ref){
			document.getElementById("sidebar").classList.toggle('active');
			}
	</script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js" type="text/javascript"></script>
  <script src="javascript/popper.js/umd/popper.min.js" type="text/javascript"></script>
  <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="javascript/login.js" type="text/javascript"></script>
  <script src="javascript/jquery-validation/jquery.validate.min.js" type="text/javascript"></script>
  <script type="text/javascript">
   
    </script>
    </body>
</html>