<?php

session_start();

//requiring mydatabase and connection
require_once('../config.php');

if( isset($_POST['login_identity']) && $_POST['login_identity'] != "" && $_POST['login_identity'] != null && isset($_POST['password']) && $_POST['password'] != "" && $_POST['password'] != null && isset($_POST['submit'])){
    
    $login_identity = isset($_POST['login_identity']) ? $_POST['login_identity'] : false;
    $error = ""; 

    if(!filter_var($login_identity, FILTER_VALIDATE_EMAIL)) {
        $error_email = ' invalid email address, please verify your email address';
        header("location:login.php");
        exit();
    }
    if(!preg_match("/^[a-z `A-Z0-9@.]*$/",$login_identity) && strip_tags($login_identity)) {
        $error_email = 'invalid, name format not accepted, special characters not allowed';
        header("location:login");
        exit();
    }

    $login_identity = $_POST['login_identity'];
        
    $password = trim($_POST['password']);
    
    $Active = 1;

        $con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
        $login = $con->prepare("SELECT * FROM users WHERE email = ? ");
        $login -> bindParam(1, $login_identity, PDO::PARAM_STR);
        
        if($login->execute()){
        $re = $login -> fetch(PDO::FETCH_ASSOC);
        $userid = $re['id'];
        
        if($login->rowCount() > 0 && $re['active'] == 0) {
            
        $error = "<div style='background:#ffc0cb;width:85%;text-align:center;border-radius:5px;padding:2%;margin: 0 auto;color: #001737;'>Your account is inactive, we already sent you your activation code in your email</div>";
            
            }else if($login->rowCount() == 0 && $re['active'] == null){
            $error = "<div style='background:#ffc0cb;width:85%;text-align:center;border-radius:5px;padding:2%;margin: 0 auto;color: #001737;'>You do not have account with us <a href='register.php' style='text-decoration;font-style:italic;color:#008;'>create account</a></div>";
            
        }else if($login->rowCount() > 0 && $re['active'] == 1 && $re['emailCode'] == 0) {
           
            if(password_verify($password, $re['password'])) {
                
                
                $gd = $con->prepare("SELECT * FROM users WHERE id = ? ");
                $gd -> bindParam(1,$re['id']);
                $gd ->execute();
                $h = $gd ->fetch(PDO::FETCH_ASSOC);
                $userid = $re['id'];
                $_SESSION['user'] = $h;
                $name = $h['uname'];
                $refid = $h['invite_id'];
                
                $status = 'logged in';
                $last_login = date("Y-m-d H:i:s", strtotime(date('h:i:sa')));
                $logStatus = $con -> prepare("SELECT * FROM loginstatus WHERE id = ?");
                $logStatus -> bindParam(1,$h['id'],PDO::PARAM_INT);
                if($logStatus -> execute() && $logStatus -> rowCount() > 0) {
                    $upLogin = $con -> prepare("UPDATE loginstatus SET status = ?, last_login_time = ? WHERE id = ?");
                    $upLogin -> bindParam(1,$status,PDO::PARAM_STR);
                    $upLogin -> bindParam(2,$last_login);
                    $upLogin -> bindParam(3,$h['id'],PDO::PARAM_INT);
                    $upLogin -> execute();
                
                }else {
                    
                    $insert = $con -> prepare("INSERT INTO loginstatus (id,status,last_login_time) VALUES (?,?,?)");
                    $insert -> bindParam(1,$h['id'],PDO::PARAM_INT);
                    $insert -> bindParam(2,$status,PDO::PARAM_STR);
                    $insert -> bindParam(3,$last_login);
                    $insert -> execute();

                }
                if(isset($_SESSION['currentpage'])) {
                    // header("Location:".$_SESSION['currentpage']);
                    // exit();
                }
                
                if($name !="" && isset($name)) {
                    header("Location:../account/dashboard.php?client=$name");
                    exit();
                }else {
                    header("Location:../account/dashboard.php?active=$refid");
                    exit();
                }
                
                }else{
                $error = "<div style='background:#ffc0cb;width:85%;text-align:center;border-radius:5px;margin: 0 auto;color:#001737;padding:2%;'>email and password does not match</div>";
                
            }
        }else {
            $error = "<div style='background:#ffc0cb;width:85%;text-align:center;border-radius:5px;padding:2%;margin: 0 auto;color: #001737;'>oops something happened, check your login details and try again</div>";
    }

        }else {
            $error = "<div style='background:#ffc0cb;width:85%;text-align:center;border-radius:5px;padding:2%;margin: 0 auto;color: #001737;'>oops something happened, check your login details and try again</div>";
    }
      
    

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
	<link rel="stylesheet" href="../css/fontastic.css">
	<!-- Google fonts - Poppins -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
	<title>Bitcoin News Today | Login </title>
    <!-- base:css -->
    <link rel="stylesheet" href="../vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
	<!-- End plugin css for this page -->
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	<script lang="javascript" type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
	<!-- Font Awesome CSS-->
	<link rel="stylesheet" type='text/css' href="../fontawesome/fontawesomefiles/css/fontawesome.min.css">
	<link rel="stylesheet" type='text/css' href="../fontawesome/fontawesomefiles/css/all.min.css">
	<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
	<script lang="javascript" type="text/javascript" src="../fontawesome/fontawesomefiles/js/fontawesome.min.js"></script>
	<script lang="javascript" type="text/javascript" src="../fontawesome/fontawesomefiles/js/all.min.js"></script>
    <!-- inject:css -->
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/customize.css">
  <link rel="stylesheet" href="../css/pageloaders.css?n=1">
  <link rel="stylesheet" href="../css/login_style.css">
    <!-- endinject -->
  <link rel="shortcut icon" href="../images/btclogo.png" />
  <script type="text/javascript">_atrk_opts = { atrk_acct:"jSv+k1aQeSI1/9", domain:"ecoinofficial.org",dynamic: true};(function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://certify-js.alexametrics.com/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();</script><noscript><img src="../https://certify.alexametrics.com/atrk.gif?account=jSv+k1aQeSI1/9" style="display:none" height="1" width="1" alt="javascript required" /></noscript>
  </head>
  <body>
    <header><a href="../home"><img src="../images/btclogo.png" alt="" class="fundrais"></a></header>
    <div class="container-scroller">
		
     <!-- pageloader  -->
  <div id="loader" class="bg-none bg-transparent">
    <img src="../images/svg-spin2.svg" alt="">
  </div>
  <!-- pageloader ends -->

		<!-- partial:partials/_horizontal-navbar.html -->
    <div class="container-fluid full-height">
    <div class="overlay"></div>
    <div class="row full-height">
      <div class="col-sm-12 col-md-12 col-md-6 authfy-panel authfy-panel-left text-center hidden-xs">
        <div class="hero-heading">
          <div class="headline">
            <h5>Start your fundraising journey now <img src="../images/bank.svg" alt="" class="fundrais" ></h5>
          </div>
        </div>

      </div> 
      <!-- ./authfy-panel-left -->
      
      <div class="authfy-panel authfy-panel-right bg-white">
      
        <!-- authfy-login start -->
        <div class="authfy-login bg-white">
          <!-- panel-login start -->
          <div class="authfy-panel panel-login text-center  active ">
            <div class="authfy-heading bg-white">
              <h3 class="auth-title"> <i class="fas fa-lock"></i> Login</h3>
            </div>
            
            <!-- <div class="social-login text-center">
              <h2 class="text-center reg-login-method">Login Using Social Media</h2>
              <ul class="facebook-google text-center">
                <li>
                   <a href="../facebook"><i class="fab fa-facebook-square"></i> Login Using Facebook</a>
                </li>

                <li>
                   <a href="../google"><i class="fab fa-google-plus-square"></i> Login Using Google</a>
                </li>
              </ul>
            </div> -->
            
            <div class="no-float"></div>
            
            <hr><br>

            <h2 class="text-center reg-login-method">Login Using Email </h2>


            <div class="row bg-white">
              <div class="col-xs-12 col-sm-12 bg-white">
              <form action='' method="post" class="form-validate">
                    
                    <div id="validation" class='validate p-2 mb-4 text-dark' style="color: #545454;"><?php echo @$error_email;?> <span class='close-alert' style='cursor:pointer'>&times;</span></div>
                    
                    <div class="form-group pr-5 pl-5">
                        <input type="email" class="form-control" name='login_identity' value="<?php echo @$_POST['login_identity']?>"id="login_id" onblur="loginIdCheck()" required placeholder="enter email ">
                    </div>
                    
                    <div class="form-group passnet pr-5 pl-5">
                        <a class="text-right"  href="resetpassword" target="_blank">Forgot password?</a>
                        <input type="password" class='form-control' name='password' id="passworded" onmouseout='loginCheck()' required placeholder="enter password">
                        <i class="fa fa-eye-slash" id = 'showP' style="cursor:pointer" onclick='showPassword()'></i>
                    </div>

                    <!-- ./remember-row -->
                    <button id="login" name='submit' class="btn">Login</button>

                    <!-- This should be submit button but I replaced it with <a> for demo purposes-->
                  </form>
                <br>
                <p>Don't have an account? <a href='createaccount' target="_blank" class="btn btn-sm login">Sign Up Free!</a></p>
                
               </div>
            </div>
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
    <script src="../vendors/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <!-- endinject -->
    <!-- plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <!-- End custom js for this page-->
	<script type="text/javascript">
		function toggleSidebar(ref){
			document.getElementById("sidebar").classList.toggle('active');
			}
	</script>
  <script type="text/javascript">
    
    $(document).ready(function() {
        document.getElementById("validation").style.display = 'none';
    })

    var closeAlert = document.querySelector(".close-alert");
        closeAlert.onclick = function() {
        this.parentElement.style.display = 'none';
    }

    function _(e) {
        return document.getElementById(e);
    }
    var error = document.getElementById("validation");
    var closeAlert = document.querySelector('.close-alert');
    function loginIdCheck() {
        var log = true;
        var loginId = document.getElementById("login_id").value;
        if(loginId != "" && loginId != null) {
            var hr = new XMLHttpRequest();
            hr.open("POST","../checklogin.php",true);
            hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            hr.onreadystatechange = function () {
                if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304) ) {
                    error.style.display = 'block';
                    closeAlert.style.display = 'block';
                    error.innerHTML = hr.responseText;
              
                }
            }
            hr.send("login_identity="+loginId+"&log="+log);
        }else {
            error.style.display = 'block';
            error.innerHTML = 'enter your email';
            return false;
        }

    }

    function showPassword() {
        var ddd = document.getElementById("passworded");
        var hideP = document.getElementById("hideP");

        if(ddd.getAttribute('type') == 'password') {
            ddd.setAttribute("type",'varchar');
            hideP.innerHTML = "<i class='fa fa-eye'></i>";
        }else {
            ddd.setAttribute("type",'password');
            hideP.innerHTML = "<i class='fa fa-eye-slash'></i>";
        }
      
      }


    var showP = document.getElementById("showP");
      if(showP) {
        var ddd = document.getElementById("passworded");
        var hideP = document.getElementById("hideP");
        showP.onclick = function() {
          // alert('ll')
        }
      }
    function loginCheck() {
        
        var log = true;
        var loginId = document.getElementById("login_id").value;
        var pass = document.getElementById("passworded").value;
        if(loginId != "" && loginId != null && pass != "" && pass != null) {
            var hr = new XMLHttpRequest();
            hr.open("POST","../checklogin.php",true);
            hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            hr.onreadystatechange = function () {
                if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304) ) {
                    error.style.display = 'block';
                    closeAlert.style.display = 'block';
                    error.innerHTML = hr.responseText;
                }
            }
            hr.send("login_identity="+loginId+"&password="+pass);
        }
        
    }

  </script>
  <script src="../javascript/progressloaders.js?n=1"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.16.2/dist/sweetalert2.all.min.js" async type="text/javascript"></script>
<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="|49" defer=""></script>
  </body>
</html>
