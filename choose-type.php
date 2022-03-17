<?php
session_start();
ini_set('display_errors','0');
require_once'dbh.php';
require_once'config.php';
require_once'ranStrGen.php';
require_once'mailer.php';


@$user_data = @$_SESSION['user'];
@$userid = @$user_data['id'];
@$email_of_user = @$user_data['email'];
@$fnamee = @$user_data['Fname'];
@$lnamee = @$user_data['Lname'];

@$Email = $_SESSION['Email'];
@$Lname = $_SESSION['Lname'];
// $emailcode = $_SESSION['emailCode'];
@$emailUname = $_SESSION['emailUname'];
$message = '';
$phoneError = "";
if(isset($_SESSION['Email'])) {
    // echo $fundraiserBy = $emailUname. ' ' .$Lname;
  }else if($user_data['email']) {
    // echo $fundraiserBy = $fnamee. ' ' .$lnamee;
  }else {
      header("location:https://my.fundreza.com/login");
      exit();
  }
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['Fname']) && isset($_POST['Lname']) && isset($_POST['verify']) ) {
    
      
    $Fname = isset($_POST['Fname']) ? $_POST['Fname'] : false;
    $Lname = isset($_POST['Lname']) ? $_POST['Lname'] : false;
    $Uname = isset($_POST['uname']) ? $_POST['uname'] : false;


    if(strlen($Uname) < 3 || strlen($Uname) > 50) {
      $message = "<div class='alert-danger pt-2 pb-2 rounded'>Username name must be between 3 - 50 characters <span class='close-err'>&times;</span> </div>";
      $nameError = "First name must be between 3 - 50 characters";
      // exit(); 
  }elseif(!preg_match("/^[a-z0-9A-Z.]*$/",$Uname) && strip_tags($Uname)) {
    $message = "<div class='alert-danger pt-2 pb-2 rounded'>invalid,  Username must be a misture of alphabets and numbers with no special characters and spaces <span class='close-err'>&times;</span> </div>";
    $nameError = "invalid,  first name must be alphabets with no special characters and spaces";
    // exit();
}else {
  $con= new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
            $query = $con->prepare("SELECT uname FROM users WHERE uname=? LIMIT 1");
            $e_Check = $query->bindParam(1, $Uname, PDO::PARAM_STR);
            $e_Check = $query->execute();
            if( $e_Check=$query->rowCount() > 0) {
              $message =  "username already taken, please choose another <i class='fas fa-times' style='color: red'></i>";
              $nameError =  "username already taken, please choose another <i class='fas fa-times' style='color: red'></i>";
                // exit();
            }else{
              $message = $Uname. ' is OK <i class="fas fa-check" style="color: green"></i>';
              $nameError = $Uname. ' is OK <i class="fas fa-check" style="color: green"></i>';
                // exit();
            }
}
            if(strlen($Fname) < 3 || strlen($Fname) > 80) {
                $message = "<div class='alert-danger pt-2 pb-2 rounded'>First name must be between 3 - 80 characters <span class='close-err'>&times;</span> </div>";
                $nameError = "First name must be between 3 - 80 characters";
                // exit(); 
            }elseif(!preg_match("/^[a-zA-Z.]*$/",$Fname) && strip_tags($Fname)) {
                $message = "<div class='alert-danger pt-2 pb-2 rounded'>invalid,  first name must be alphabets with no special characters and spaces <span class='close-err'>&times;</span> </div>";
                $nameError = "invalid,  first name must be alphabets with no special characters and spaces";
                // exit();
            }elseif(strlen($Lname) < 3 || strlen($Lname) > 80) {
                $message = "<div class='alert-danger pt-2 pb-2 rounded'>Last name must be between 3 - 80 characters <span class='close-err'>&times;</span> </div>";
                $nameError = "First name must be between 3 - 80 characters";
                // exit(); 
            }elseif(!preg_match("/^[a-zA-Z.]*$/",$Lname) && strip_tags($Lname)) {
                $message = "<div class='alert-danger pt-2 pb-2 rounded'>invalid,  last name must be alphabets with no special characters and spaces <span class='close-err'>&times;</span> </div>";
                $nameError = "invalid,  last name must be alphabets with no special characters and spaces";
                // exit();
        }
        
        if(strip_tags($Uname) && preg_match("/^[a-z0-9A-Z.]*$/",$Uname) && strip_tags($Fname) && strip_tags($Lname) && preg_match("/^[a-zA-Z.]*$/",$Fname) && preg_match("/^[a-zA-Z.]*$/",$Lname)) {
            $uname = $Fname;
            $query = $con->prepare("UPDATE users SET uname = ? Fname = ?, Lname = ? WHERE email = ? LIMIT 1");
            $query->bindParam(1, $Uname);
            $query->bindParam(2, $Fname);
            $query->bindParam(3, $Lname);
            $query->bindParam(4, $Email, PDO::PARAM_STR);
            $query->execute();
                
            $message = "<div class='alert-danger pt-2 pb-2 rounded'> $Fname $Lname successully updated <span class='close-err'>&times;</span> </div>";
            nameVerification($Email,$emailUname,$Fname);
        }
          
        
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <base href="https://fundreza.com/">
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
	<title>Start a fundraiser | Fundreza.com </title>
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
    <link rel="shortcut icon" href="images/favicon.png" />
    <script type="text/javascript">_atrk_opts = { atrk_acct:"jSv+k1aQeSI1/9", domain:"ecoinofficial.org",dynamic: true};(function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://certify-js.alexametrics.com/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();</script><noscript><img src="https://certify.alexametrics.com/atrk.gif?account=jSv+k1aQeSI1/9" style="display:none" height="1" width="1" alt="javascript required" /></noscript>
    <style>
    header {
        border-bottom: 1px solid #f1f1f1;height: 4rem;
    }
    header img {
        margin: .4rem;
    }
        h4 {
          font-weight: 600;color: #444444;font-size: 14px;margin-bottom: .4rem;
        }
        p {
          font-size: 14px;text-align: left;
        }
        a,a:hover {
          text-decoration: none;color: #545454;
        }
        .col-xv {
          border: 1px solid #f1f1f1;border-radius: 4px;margin: 2rem auto;width: 30%;
          box-shadow: 1px 2px 2px 1px #f1f1f1;
        }
        .cvc {
          display: inline-block;
        }
        .col-xv img{
          float: left;border-radius: 50%;width: 4rem;
        }
        .col-xv .bvc {

        }
        .col-xv h4 {
          margin-top: 1rem;margin-bottom: 1rem;text-align: left;
        }
        @media screen and (max-width:1267px) {
          .first-col {
          padding-left: .8rem;padding-right: .8rem;margin: auto;
        }
      }
        @media screen and (max-width:967px) {
          .first-col {
          padding-left: 0.5;padding-right: 0.5rem;margin: auto;
        }
        .col-xv {
          width: 80%;
        }
      }
        @media screen and (max-width:767px) {
          .first-col {
          padding-left: 0;padding-right: 0;margin: auto;
        }
        .col-xv {
          width: 90%;
        }
      }
        @media screen and (max-width:567px) {
          .first-col {
          padding-left: 0;padding-right: 0;margin: auto;
        }
        .col-xv {
          width: 90%;
        }
        
    }
    </style>
    <body class="bg-white">
    <div class="container-scroller bg-white">
		<header><a href=""><img src="images/fundrezalogo.png" alt="" class="fundrais"></a></header>
		<!-- partial:partials/_horizontal-navbar.html -->
    
    <h4 class="mx-auto text-center mt-5 mb-2">Hello <?php echo @$emailUname. ' ' .@$Lname;?>, who are you fundraising for?</h4>
    <div class="full-height bg-white">
      <!-- ./authfy-panel-left -->
      
      <form method="POST">
        <div class="col-xv">
            <div class="col-xs-12 col-sm-12 col-md-12 form-col">
                <div class="cvc">
                  <a href="https://fundreza.com/start/details/individual"><img src="images/charity.jpg" alt="" class="fundrais"> <div class="bvc"><h4>Yourself or someone else</h4><p class='font-weight-normal'>Donations will be deposited into a personal or business bank account</p></div></a>
                </div> 
            </div>
        </div>
        <div class="col-xv">
          <div class="col-xs-12 col-sm-12 col-md-12 form-col">
              <div class="cvc">
                  <a href="https://fundreza.com/start/details/non-profit"><img src="images/charity2.jpg" alt="" class="fundrais"><div class="bvc"><h4>A non-profit or charity</h4><p class='font-weight-normal'>Donations will be automatically delivered to your chosen non profit organization</p></div></a>
              </div> 
          </div>
        </div>
      </form>
    </div>
  </div>
		<!-- partial:partials/_footer.html -->
		
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
   $(document).ready(function() {
        
      })
      
      
      function usernamecheck() {
      
          var status1 = document.getElementById("usernameStatus");
          $("#usernameStatus").show();
          
          var u = document.getElementById("nameer").value;
          
          if(u !="" && u != null) {
              status1.innerHTML = '....checking';
              status1.style.color = 'orange';
              var hr = new XMLHttpRequest();
              hr.open("POST","check.php",true);
              hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
              hr.onreadystatechange = function () {
                  if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304) ) {
                      status1.style.color = 'orange';
                      status1.innerHTML = hr.response;
                      
                  }
              }
              hr.send("Fname="+u);
          }else {
              status1.style.color = 'orange';
              status1.innerHTML = 'name cannot be empty!!';
          }
      
      };
      
      
      
      function namecheck() {
      
      var status2 = document.getElementById("nameStatus");
      $("#nameStatus").show();
      
      var un = document.getElementById("uname").value;
      
      if(un !="" && un != null) {
          status2.innerHTML = '....checking';
          status2.style.color = 'orange';
          var hr = new XMLHttpRequest();
          hr.open("POST","check.php",true);
          hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
          hr.onreadystatechange = function () {
              if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304) ) {
                  status2.style.color = 'orange';
                  status2.innerHTML = hr.response;
                  
              }
          }
          hr.send("uname="+un);
      }else {
          status2.style.color = 'orange';
          status2.innerHTML = 'name cannot be empty!!';
      }
      
      };
    </script>
    </body>
</html>