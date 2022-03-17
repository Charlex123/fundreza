<?php
@session_start();
// error_reporting(E_ALL);
ini_set('display_errors','0');
require_once'dbh.php';
require_once'config.php';
require_once'ranStrGen.php';
require_once'mailer.php';


    $step = 'step1';
    $ref = isset($_GET['ref']) ? $_GET['ref'] : false;
    if( ($_SERVER['REQUEST_METHOD']=='POST') && isset($_POST['submit_account']) && isset($_POST['password']) && isset($_POST['Email']) && isset($_POST['password1']) && isset($_POST['Fname']) && isset($_POST['Lname'])) {
        $password = isset($_POST['password']) ? $_POST['password'] : false;
        $password1 = isset($_POST['password1']) ? $_POST['password1'] : false;
        $Email = isset($_POST['Email']) ? $_POST['Email'] : false;
        $Lname = isset($_POST['Lname']) ? $_POST['Lname'] : false;
        $Fname = isset($_POST['Fname']) ? $_POST['Fname'] : false;
        
        $sanitizeRef = strip_tags($ref);
        
        $eror_password = "";
        $errror_password = "";
        $error_password = "";
        $eror_email = "";
        $error_email = "";
        $errror_email = "";
        $error_phonenumber = "";
        $error_name = "";
        
        $errorSmt = "";
        
        
         if((isset($_POST['Email']) && isset($_POST['password']) && isset($_POST['password1'])) ) {
            
            //check referral Email
            $query = $con->prepare("SELECT email FROM investors WHERE email = ? LIMIT 1");
            $query->bindParam(1, $Email, PDO::PARAM_STR);
            
            if( $query->execute() && $query->rowCount() > 0) {
                $eror_email =  $Email.' already taken, please choose another';
                
            }else {

            }
                      
        }
        
        
        if($password !== $password1) {
            $error_password = 'Password and RepeatPassword do not match';
            
         } 
        if($password !== $password1) {
            $error_password = 'Password and RepeatPassword do not match';
            
         }
         if(strlen($password) < 5) {
            $error_password = 'Weak password, Password must be more than 5 characters';
            
         }
         if(strlen($password) > 5 && strlen($password) <= 16) {
            $error_password = 'Password strength..<span style="color:#800080;">Good ';
            
         }
         if(strlen($password) > 16 ) {
            $error_password = '<i class="far fa-check"></i>';
            
         }

         if(!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
             $error_email = ' invalid email address, please verify your email address';
         }
         if(!preg_match("/^[a-z `A-Z0-9@.]*$/",$Email) && strip_tags($Email)) {
             $error_email = 'invalid, name format not accepted, special characters not allowed';
            
         }

         $phonenumber = isset($_POST['phonenumber'])? $_POST['phonenumber'] : false;
    
         
     
     if(($error_email == "" && $Email != "" && $password !="" && $password1 != "" && $password == $password1 && strip_tags($Lname) && strip_tags($Fname)) ) {
        
                    class reg extends dbh {

                    public function userCheck($password,$Email) {
                    try {   
                            $password = isset($_POST['password']) ? $_POST['password'] : false;
                            $password1 = isset($_POST['password1']) ? $_POST['password1'] : false;
                            $Email = isset($_POST['Email']) ? $_POST['Email'] : false;
                            echo $Lname = isset($_POST['Lname']) ? $_POST['Lname'] : false;
                            echo $Fname = isset($_POST['Fname']) ? $_POST['Fname'] : false;
                            if(isset($_GET['ref']) && strip_tags($_GET['ref'])) {
                              $sanitizeRef = intval($_GET['ref']);
                            }else {
                              $sanitizeRef = 'NULL';
                            }
                            
                            $ip= $_SERVER['REMOTE_ADDR'];
                            
                            $passenc = password_hash($password, PASSWORD_DEFAULT, array('cost'=>11));
                            $email_code = rand(00000,99999).'@'.randStrGen(50);
                            $explode  = explode('@',$email_code);
                            $emailCode = $explode[0];
                            $_SESSION['emailCod'] = $emailCode;
                            if($emailCode == "" || $emailCode == null) {
                                exit();
                            }

                            $client  = @$_SERVER['HTTP_CLIENT_IP'];
                            $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
                            $remote  = @$_SERVER['REMOTE_ADDR'];
                            $result  = array('country'=>'', 'city'=>'');
                            if(filter_var($client, FILTER_VALIDATE_IP)){
                                $ip = $client;
                            }elseif(filter_var($forward, FILTER_VALIDATE_IP)){
                                $ip = $forward;
                            }else{
                                $ip = $remote;
                            }
                            $geoDetails = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
                            
                            $userCountry = $geoDetails['geoplugin_countryName'];
                            $countryflag = $geoDetails['geoplugin_countryCode'];
                            $countryFlg = strtolower($countryflag);
                            $countryFlag = $countryFlg.'.png';
                            
                            $accType = 'user';
                            $inviteCount = 0;
                            $activation = 'false';
                            $activation_confirm = 'false';
                            $Active = 0;
                            $empowerAmount = 0;
                            $lostpass = "";
                            $exploded = explode('@',$Email);
                            $inviteId = rand(00000,99999);
                            $reg_time = date('Y-m-d H:i:s',time()); 
                            $userIP = $_SERVER['REMOTE_ADDR'];
                            $tracking_id = rand().''.randStrGen(5);
                            $empowerStatus = 'Inactive';
                            $profile_pics = "images/users_profilePics/default_profilePic.jpg";
                            // creating users table
                            $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;", $this->serverusername, $this->serverpassword);
                            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            // inserting users details into database
        
                            $lastempListing = 'NULL';
                            $empowerListingCount = 0;
                            $totalempListing = 0;
                            $query = $con->prepare("SELECT email FROM users WHERE email = ? LIMIT 1");
                            $e_Check = $query->bindParam(1, $Email, PDO::PARAM_STR);
                            $e_Check = $query->execute();
                            if( $e_Check = $query->rowCount() > 0) {
                                // echo "account already registered";
                            }else{
                                $insert = $con->prepare("INSERT INTO users (account_type,invite_id,activation,activation_confirm,Fname,Lname,email,password,active,lostpass,userCountry,countryFlag,created_at,updated_at,emailCode,profile_pics,empowerStatus,user_ip) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                                $insert->bindParam(1,$accType,PDO::PARAM_STR);
                                $insert->bindParam(2,$inviteId,PDO::PARAM_STR);
                                $insert->bindParam(3,$activation,PDO::PARAM_STR);
                                $insert->bindParam(4,$activation_confirm,PDO::PARAM_STR);
                                $insert->bindParam(5,$Fname,PDO::PARAM_STR);
                                $insert->bindParam(6,$Lname,PDO::PARAM_STR);
                                $insert->bindParam(7,$Email,PDO::PARAM_STR);
                                $insert->bindParam(8,$passenc,PDO::PARAM_STR);
                                $insert->bindParam(9,$Active,PDO::PARAM_INT);
                                $insert->bindParam(10,$lostpass,PDO::PARAM_STR);
                                $insert->bindParam(11,$userCountry,PDO::PARAM_STR);
                                $insert->bindParam(12,$countryFlag,PDO::PARAM_STR);
                                $insert->bindParam(13,$reg_time,PDO::PARAM_STR);
                                $insert->bindParam(14,$reg_time,PDO::PARAM_STR);
                                $insert->bindParam(15,$emailCode,PDO::PARAM_STR);
                                $insert->bindParam(16,$profile_pics);
                                $insert->bindParam(17,$empowerStatus);
                                $insert->bindParam(18,$userIP);
                                $insert ->execute();
                                    if(isset($sanitizeRef) && $sanitizeRef != "" ) {

                                      $sanitizeRef;
                                      $_SESSION['email_code'] = $email_code;
                                      
                                      $referredId = $con -> lastinsertId();
                                      $accStat = 'Inactive';
                                      $date_time = date('Y-m-d H:i:s',time()); 
                                      $auction = 0;
                                      $inviteBonus = 0;
                                      $inviteeActEarns = 0;
                                      $que = $con -> prepare("SELECT email FROM users WHERE invite_id = ?");
                                      $que -> bindParam(1,$sanitizeRef);
                                      

                                  }
                                    //send email code to users
                                    $_SESSION['Lname'] = $Lname;
                                    $emailUname = $Fname;
                                    $_SESSION['emailUname'] = $emailUname;
                                    $_SESSION['Email'] = $Email;
                                    $emailCode = $_SESSION['emailCod'];
                                    // sendregistrationMail($Email,$emailCode,$emailUname);
                                    header("location:choose-type.php");
                                    exit();  
                                
                                    if($insert==true){
                                          
                                    }else {
                                    header("location:reg-failure.html");
                                        exit();
                                }
                            }
                    
                } catch (PDOException $e){
                    throw new PDOException($e->getMessage());
                }
            }


        }
        $object = new reg();
        $object->userCheck($password, $Email);
     }
        
}else {
      // $eeee = 'fields are required';
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
	<title> Start A Fundraiser Now | Helpfundme </title>
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
    <style>
      h4 {
          font-weight: 600;color: #444444;font-size: 14px;margin-bottom: .4rem;
          color: #545454;
        }
              ul {
            margin: 0 !important;
        }
        ul li {
            float: none;white-space: initial;text-align: left;font-size: 13px;
            list-style: none;margin-left: 0 !important;color: #545454;
        }
        .fa-check {
            color: #22a349;
        }
        .spt {
            position: absolute;top: 30%;left: 100%;right: 10%;width: 70%;box-shadow: 1px 2px 2px 2px #f1f1f1;
            border-radius: 4px;padding: .5rem;background-color: #ffffff;margin-left: 1rem;
        }
        .spt h4 {
          color: #545454;
        }
        .spt img {
            float: left;width: 2rem;border-radius: 50%;margin: -.4rem .4rem;
        }
        .spt .below {
            border-top: 1px solid #eaeaea;padding-top: 1rem;margin-top: 1rem; 
            font-size: 13px;white-space: initial;
        }
    </style>
    <link rel="shortcut icon" href="images/btclogo.png" />
    <script type="text/javascript">_atrk_opts = { atrk_acct:"jSv+k1aQeSI1/9", domain:"ecoinofficial.org",dynamic: true};(function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://certify-js.alexametrics.com/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();</script><noscript><img src="https://certify.alexametrics.com/atrk.gif?account=jSv+k1aQeSI1/9" style="display:none" height="1" width="1" alt="javascript required" /></noscript>
  </head>
    <body>
    <header><a href="home"><img src="images/btclogo.png" alt="" class="fundrais"></a></header>
    <div class="container-scroller">
		
		<!-- partial:partials/_horizontal-navbar.html -->
    
    <div class="container-fluid full-height">
      
    <div class="overlay"></div>
    <!-- <div class="reg-steps mt-5 pt-5 pb-5 mb-5">
      <h4>Registartion Steps</h4>
      <div class="steps"><span class="step1" style="color:#22a349">Step 1</span><span class="step1"> Step 2</span><span class="step1">Step 3</span><span class="step1"> Step 4</span></div>
    </div> -->
    <div class="row full-height">
      <div class="col-sm-12 col-md-12 col-md-6 authfy-panel authfy-panel-left text-center hidden-xs">
        <div class="hero-heading">
          <div class="headline">
            <h5>Start your fundraising journey now <img src="images/bank.svg" alt="" class="fundrais" ></h5>
          </div>
        </div>  

      </div> 
      <!-- ./authfy-panel-left -->
      
      <div class="authfy-panel authfy-panel-right">
      
        <!-- authfy-login start -->
        <div class="authfy-login">
          <!-- panel-login start -->
          <div class="authfy-panel panel-login text-center active ">
            <div class="authfy-heading">
              <h4 class="auth-title mt-3" style="color: #545454;font-weight:normal;"> <i class="fas fa-user-lock"></i> Start a fundraiser</h4>
            </div>
            
            <!-- <div class="social-login text-center mx-auto">
              <h2 class="text-center reg-login-method">Join Using Social Media</h2>
              <ul class="facebook-google text-center mx-auto">
                <li>
                   <a href="facebook"><i class="fab fa-facebook-square"></i> Login Using Facebook</a>
                </li>

                <li>
                   <a href="google"><i class="fab fa-google-plus-square"></i> Login Using Google</a>
                </li>
              </ul>
            </div> -->
            
            <hr>
              <!-- <div class="row"> -->
              <div class="col-xs-12 col-sm-12 col-md-12 form-col">
                  <div class="spt">
                    <div class="up"><img src="images/avatar-0.jpg" alt="" class="sp-img"> <h4 class="con mt-2">Tip from Maria, our fundraising support expert</h4><div style="clear:both"></div></div>
                    <!-- <h5>You can raise funds for</h5> -->
                    <div class="below">
                      <div class="text-dark text-left mb-2 mt-1 pb-1 pl-3">You can raise funds for</div>
                      <ul>
                          <li>
                              <i class="fas fa-check"></i> your health, hospital or medical bills
                          </li>
                          <li>
                              <i class="fas fa-check"></i> political campaigns
                          </li>
                          <li>
                              <i class="fas fa-check"></i> your business support
                          </li>
                          <li>
                              <i class="fas fa-check"></i> non profits or charity organizations
                          </li>
                      </ul>    
                    </div>
                  </div>

                  <form action="" method="POST" class="form-validate text-center">
                    
                    <div class="form-group inner">
                      <div class="col-inn" id="ffn">
                        <input id="fname" type="text" name="Fname" required placeholder="Enter your first name" value="<?php echo @$_POST['Fname']?>" class="form-control">
                      </div>
                      <div class="col-inn" id="lln">
                        <input id="lname" type="text" name="Lname" required placeholder="enter your last name" value="<?php echo @$_POST['Lname']?>" class="form-control">
                      </div>
                    </div>

                    <div class="form-group">
                      <input id="emailer" type="email" name="Email" required placeholder="enter a valid email address" value="<?php echo @$_POST['Email']?>" onmouseout ="regemailcheck()" onclick="removeStatus()" value="" class="form-control">
                      <div id="emailStatus" style='color: red'></div>
                      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>

                    <div class="form-group">
                      <input type="password" name="password" id="regpassword" onmouseout="passeeCheck()" required placeholder="Enter Password" class="form-control">
                      <i class="fa fa-eye-slash" id = 'hideP' onclick='showPassword()'></i>
                    </div>

                    <div class="form-group">
                      <input type="password" name='password1' id="regpassword1" onmouseout ="passcheck()" required placeholder="Confirm password" class="form-control" />
                      <div id='allpasswordStatus' style='color: red'><span id ="passwordStatus"></span><span id ="passStatus" style='margin-bottom:-10px;'></span></div>
                    </div>

                    <?php 
                        if(isset($_GET['ref'])) {?>
                        <div class='text-left text-secondary' style='color:#333333'><span class="tool-tip"><small>Ensure this is your sponsor id, you can't change it after registration</small></span></div>
                        <div class="form-group">
                          <input type="number" name='refsponsor' id="refid" value="<?php echo @$_GET['ref'];?>" class="form-control" readonly/>
                        </div>
                        <?php }?>
                           

                    <!-- <div class='form-group' >
                        <select name='investment_currency' id='investment-cur' class="form-control">
                            <option value=''> -Investment Currency- </option>
                            <option value='Pounds'> £ Pounds</option>
                            <option value='Dollar'> $ Dollars </option>
                            <option value='Euro'> € Euros</option>
                        </select>
                    </div> -->
                    <div id="perr1"></div>
                    <div id="perr2"></div>
                    <div id="perr4"></div>
                    <div id="perr5"></div>
                    <div id="perr6"></div>
                    <div id="perr7"></div>
                    
                    <div class="form-group terms-conditions text-left">
                      <label for="form-check-label" class="mt-3"> GoFundMe's fee is 5% from each donation you receive. The payment processor fee is 2.9% + $0.30 per donation. By continuing, you agree to the GoFundMe terms and acknowledge receipt of our privacy policy.</label>
                    </div>

                    <div style='clear:both'></div>
                    <div class="form-group mt-2">
                      <button id="register" type="submit" name="submit_account" class="btn font-weight-normal" id='submit_account'>Submit</button>
                    </div>

                  </form>
                <p class="text-sec"> Already have an account? <a href='login' target="_blank" class="btn btn-sm login font-weight-normal">Login</a></p>
              </div>
            <!-- </div> -->
            <img src="images/secure.png" alt="" class="fundrais">
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
    
    $(document).ready(function() {
        var invSelect = document.getElementById("invest-select").getAttribute("value");

        var select = document.getElementById("investment-type");
        for(var i = 0;i < select.options.length;i++){
            if(select.options[i].value == invSelect ){
                select.options[i].selected = true;
            }
        }
})


function _(e) {
    return document.getElementById(e);
}


function passeeCheck() {
    
    $("#emailStatus").hide();
    $("#phonenumberStatus").hide();
    $("#usernameStatus").hide();
    $("#passStatus").hide();
    $("#passwordStatus").hide();
    $("#passeeStatus").show();

    var passid = document.getElementById("passeeStatus");
    

    var p = document.getElementById("regpassword").value;
    if (p == '' || p == null) {
      _('perr1').innerHTML = "<span style='color=red'><i class='fas fa-times'></i> Password cannot be empty</span>";
    }else{
      _('perr1').style.color = '#22a349';
      _('perr1').innerHTML = "<span style='color=#22a349'><i class='fas fa-check-square'></i> Password cannot be empty</span>";
    }
    if (p.length <= 8 ) {
      _('perr2').innerHTML = "<span style='color=red'><i class='fas fa-times'></i> Password must be at least 8 characters</span>";
    }else {
      _('perr2').style.color = '#22a349';
      _('perr2').innerHTML = "<span style='color=#22a349'><i class='fas fa-check-square'></i> Password must be at least 8 characters</span>";
    }
    if (p.length > 30) {
      _('perr4').innerHTML = "<span style='color=red'><i class='fas fa-times'></i> Password must be less than 30 characters</span>";
    }
    if (p.search(/[a-zA-Z]/i) < 0) {
      _('perr5').innerHTML = "<span style='color=red'><i class='fas fa-times'></i> Password must contain both lower case and upper case letters.</span>"; 
    }
    else {
      _('perr5').style.color = '#22a349';
      _('perr5').innerHTML = "<span style='color=red'><span style='color=#22a349'><i class='fas fa-check-square'></i> Password must contain at least one lower case.</span>";
    }
    if (p.search(/[0-9]/i) < 0) {
      _('perr6').innerHTML = "<i class='fas fa-times'></i> Password must contain at least one digit.</span>";
    }else {
      _('perr6').style.color = '#22a349';
      _('perr6').innerHTML = "<span style='color=red'><span style='color=#22a349'><i class='fas fa-check-square'></i> Password must contain at least one digit.</span>";
    }
    if (p.search(/[!#$@^%&?'"]/i) < 0) {
      _('perr7').innerHTML = "<span style='color=red'><i class='fas fa-times'></i> Password must contain at least one special character.</span>";
    }else {
      _('perr7').style.color = '#22a349';
      _('perr7').innerHTML = "<span style='color=#22a349'><i class='fas fa-check-square'></i> Password must contain at least one special character.</span>";
    }
    

}



function passcheck() {
    $("#emailStatus").hide();
    $("#phonenumberStatus").hide();
    $("#usernameStatus").hide();
    $("#passeeStatus").hide();
    $("#passwordStatus").show();

    var status2 = document.getElementById("passwordStatus");
    var approved = document.getElementById("passStatus");
    
    var p = document.getElementById("regpassword").value;
    var p1 = document.getElementById("regpassword1").value;
    
    
    if(p !="" && p1 !="" && p != null && p1 != null) {

        status2.style.color = '#22a349';  
        status2.innerHTML = '....checking';
        var hr = new XMLHttpRequest();
        hr.open("POST","check.php",true);
        hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        hr.onreadystatechange = function () {
            if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304)) {
                    status2.style.color = '#22a349';
                    status2.innerHTML = hr.responseText;
                    
                }
        }
        hr.send("password="+p+"&password1="+p1);
    }else {
        status2.style.color = 'red';  
        status2.innerHTML = 'PasswordRepeat cannot be empty';
    }

};  


function showPassword() {
        var ddd = document.getElementById("regpassword");
        var hideP = document.getElementById("hideP");

        if(ddd.getAttribute('type') == 'password') {
            ddd.setAttribute("type",'varchar');
            hideP.innerHTML = "<i class='fa fa-eye'></i>";
        }else {
            ddd.setAttribute("type",'password');
            hideP.innerHTML = "<i class='fa fa-eye-slash'></i>";
        }
      
      }


function regemailcheck() {
    
    $("#passwordStatus").hide();
    $("#usernameStatus").hide();
    $("#phonenumberStatus").hide();
    $("#mainpassStatus").hide();

    var status3 = document.getElementById("emailStatus");
    status3.style.display = 'block';
    var e = document.getElementById("emailer").value;
    
    if(e !="" ) {
        status3.innerHTML = '....checking';
        status3.style.color = '#22a349';
        var hr = new XMLHttpRequest();
        hr.open("POST","check.php",true);
        hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        hr.onreadystatechange = function () {
            if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304) ) {
                status3.style.color = '#22a349';
                status3.innerHTML = hr.responseText;
                
            }
        }
        hr.send("Email="+e);
    }else {
        status3.style.color = 'red';
        status3.innerHTML = 'email required!!';
    }

};

  </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.16.2/dist/sweetalert2.all.min.js" async type="text/javascript"></script>
<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="|49" defer=""></script>
  </body>
</html>

