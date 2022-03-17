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


@$Email = $_SESSION['Email'];
@$Lname = $_SESSION['Lname'];
// $emailcode = $_SESSION['emailCode'];
@$emailUname = $_SESSION['emailUname'];
@$fundraiserType = $_SESSION['fundraiserType'];
$message = '';
$phoneError = "";

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
$userCountryCurCode = $geoDetails['geoplugin_currencyCode'];
$countryCurSymbol = $geoDetails['geoplugin_currencySymbol'];
$countryflag = $geoDetails['geoplugin_countryCode'];
$countryFlg = strtolower($countryflag);
$countryFlag = $countryFlg.'.png';

if(isset($_SESSION['Email'])) {
    // $fundraiserBy = $emailUname. ' ' .$Lname;
    @$fundraiserType = $_SESSION['fundraiserType'];
  }else if($user_data['email']) {
    // $fundraiserBy = $fnamee. ' ' .$lnamee;
    @$fundraiserType = strip_tags($_GET['fundraiserType']);
  }else {
      header("location:https://my.fundreza.com/login");
      exit();
  }
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['amount']) && !isset($_GET['fundraiserId']) ) {
    
      
    $fGoal = isset($_POST['amount']) ? $_POST['amount'] : false;

        if(strip_tags($fGoal) && htmlentities($fGoal)) {
            $fgoal = str_replace(",","",$fGoal);
            if(isset($user_data['email'])) {

    @$fundraiserType = strip_tags($_GET['fundraiserType']);
                $query = $con->prepare("UPDATE fundraiser_table SET fundraiserGoal = ? WHERE fundraiserEmail = ? ORDER BY dateSubmitted DESC LIMIT 1");
                $query->bindParam(1, $fgoal);
                $query->bindParam(2, $email_of_user, PDO::PARAM_STR);
                $query->execute();
            
                $Email = $_SESSION['Email'];
                $Lname = $_SESSION['Lname'];
                // $emailcode = $_SESSION['emailCode'];
                $emailUname = $_SESSION['emailUname'];
                header("location:https://fundreza.com/add-media/setup/addpicture-video/$fundraiserType");


            }else if($_SESSION['Email']) {
                
                    @$fundraiserType = $_SESSION['fundraiserType'];
                    
                $queryy = $con->prepare("UPDATE fundraiser_table SET fundraiserGoal = ? WHERE fundraiserEmail = ? ORDER BY dateSubmitted DESC LIMIT 1");
                $queryy ->bindParam(1, $fgoal);
                $queryy ->bindParam(2, $Email);
                echo $queryy ->execute();
                
                $Email = $_SESSION['Email'];
                $Lname = $_SESSION['Lname'];
                // $emailcode = $_SESSION['emailCode'];
                $emailUname = $_SESSION['emailUname'];
                header("location:https://fundreza.com/add-media/setup/addpicture-video/$fundraiserType");
            }
            
        }
          
        
  }elseif($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['amount']) && isset($_GET['fundraiserId']) ) {
      $fGoal = isset($_POST['amount']) ? $_POST['amount'] : false;
    $fid = strip_tags($_GET['fundraiserId']);
    
        if(strip_tags($fGoal) && htmlentities($fGoal)) {
            $fgoal = str_replace(",","",$fGoal);
            if(isset($user_data['email'])) {

    @$fundraiserType = strip_tags($_GET['fundraiserType']);
                $query = $con->prepare("UPDATE fundraiser_table SET fundraiserGoal = ? WHERE fundraiserEmail = ? AND fundraiserId = ? ORDER BY dateSubmitted DESC LIMIT 1");
                $query->bindParam(1, $fgoal);
                $query->bindParam(2, $email_of_user, PDO::PARAM_STR);
                $query->bindParam(3, $fid);
                $query->execute();
            
                $Email = $_SESSION['Email'];
                $Lname = $_SESSION['Lname'];
                // $emailcode = $_SESSION['emailCode'];
                $emailUname = $_SESSION['emailUname'];
                header("location:https://fundreza.com/add-media/setup/addpicture-video/$fundraiserType/$fid");


            }else if($_SESSION['Email']) {
                
                    @$fundraiserType = $_SESSION['fundraiserType'];
                    
                $queryy = $con->prepare("UPDATE fundraiser_table SET fundraiserGoal = ? WHERE fundraiserEmail = ? AND fundraiserId = ?  ORDER BY dateSubmitted DESC LIMIT 1");
                $queryy ->bindParam(1, $fgoal);
                $queryy ->bindParam(2, $Email);
                $queryy ->bindParam(3, $fid);
                $queryy ->execute();
                
                $Email = $_SESSION['Email'];
                $Lname = $_SESSION['Lname'];
                // $emailcode = $_SESSION['emailCode'];
                $emailUname = $_SESSION['emailUname'];
                header("location:https://fundreza.com/add-media/setup/addpicture-video/$fundraiserType/$fid");
            }
            
        }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <base href="https://fundreza.com/"/>
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
  <script lang="javascript" type="text/javascript" src="javascript/jquery-3.2.1.min.js"></script>
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
    <script type="text/javascript" src="javascript/ajax.js"></script>
    <link rel="shortcut icon" href="images/favicon.png" />
    <script type="text/javascript">_atrk_opts = { atrk_acct:"jSv+k1aQeSI1/9", domain:"ecoinofficial.org",dynamic: true};(function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://certify-js.alexametrics.com/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();</script><noscript><img src="https://certify.alexametrics.com/atrk.gif?account=jSv+k1aQeSI1/9" style="display:none" height="1" width="1" alt="javascript required" /></noscript>
    <style>
        header {
            border-bottom: 1px solid #f1f1f1;height: 4rem;
        }
        header img {
            margin: .4rem;
        }
        .full-height {
            width: 30%;margin: 5rem auto;position: relative;
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
        }.inner {
            display: inline-block;width: 100%;padding-left: 0;margin-left: 0;padding-right: 0;margin-right: 0;
            margin-top: 0;white-space: nowrap;
        }
        .inner .col-inn {
            display: inline-block;padding: 0;margin: 0;
        }
        .inner .col-inn#ffn {
            margin-left: 0;margin-right: 1%;width: 10%;white-space: nowrap;margin-top: 0;float: left;
        }
        .inner .col-inn#lln {
            margin-right: 0;margin-left: 4%;width: 80%;
        }
         .pbar4 {
            width: 20%;height: 3px;margin: 2%;display: inline-block;
        }
        .pbar5 {
            width: 15%;height: 3px;margin: 2%;display: inline-block;
        }
        #pbar1 {
          background-color: #22a349;
        }
        #pbar2 {
          background-color: #22a349;
        }
        .hideP {
            float: right;margin: -1.8rem .4rem auto auto;color: #22a349;
        }
        .hint {
          font-size: 13px;color: #22a349;margin-top:.5rem;white-space: initial;
          word-wrap: break-word;
        }
        label {
            white-space: initial;
        }
        ul {
            margin: 0 !important;
        }
        ul li {
            float: none;white-space: initial;text-align: left;font-size: 13px;
            list-style: none;margin-left: 0 !important;
        }
        .fa-check {
            color: #22a349;
        }
        .spt {
            position: absolute;top: 30%;left: 100%;right: 10%;width: 100%;box-shadow: 1px 2px 2px 2px #f1f1f1;
            border-radius: 4px;padding: .5rem;
        }
        .spt img {
            float: left;width: 2rem;border-radius: 50%;margin: -.4rem .4rem;
        }
        .spt .below {
            border-top: 1px solid #eaeaea;padding-top: 1rem;margin-top: 1rem; 
            font-size: 13px;white-space: initial;
        }
        @media screen and (max-width:967px) {
          
        .full-height {
          width: 80%;
        }
      }
        @media screen and (max-width:767px) {
          .full-height {
          width: 90%;
        }
      }
    </style>
    <body class="bg-white">
        <div class="container-scroller bg-white">
            <header><a href="home"><img src="images/fundrezalogo.png" alt="" class="fundrais"></a></header>
    
            <div class="full-height bg-white">
                <!-- ./authfy-panel-left -->
                <div class="form-group inner">
                    <div class="col-inn" id="ffn">
                    <?php echo "<a href='https://fundreza.com/start/details/$fundraiserType'><i class='fas fa-angle-left'></i> Back</a>"; ?>
                    </div>
                    <div class="col-inn" id="lln">
                        <?php  $fundraiserTy = @$_GET['fundraiserType'];  if(isset($fundraiserTy) && strip_tags($fundraiserTy) && $fundraiserTy == "individual") {?>
                        <h4>Step 2 of 4</h4>
                        <div class="progressbar"><div class="pbar4" id="pbar1"></div><div class="pbar4" id="pbar2"></div><div class="pbar4"></div><div class="pbar4"></div></div>
                        <h4 class="text-left mt-5 mb-2">Set your fundraising goal</h4>
                        <?php $fundraiserTy = @$_GET['fundraiserType']; } else if(isset($fundraiserTy) && strip_tags($fundraiserTy) && $fundraiserTy == "non-profit") {?>
                            <h4>Step 2 of 5</h4>
                        <div class="progressbar"><div class="pbar5" id="pbar1"></div><div class="pbar5" id="pbar2"></div><div class="pbar5"></div><div class="pbar5"></div><div class="pbar5"></div></div>
                        <h4 class="text-left mt-5 mb-2">Set your fundraising goal</h4>
                        <?php }?>
                        <form method="POST">
                            <div><label for="">How much would you like to raise? </label></div>
                            
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text text-white" style="background-color:#22a349;"><?php echo @$countryCurSymbol;?></span>
                              </div>
                              <input type="text" name="currency_symbol" id="currency_symbol" value="<?php echo @$countryCurSymbol;?>" hidden>
                              <input type="text" name="from_cugrrency" id="from_currency" value="GBP" hidden>
                              <input type="text" name="to_currency" id="to_currency" value="<?php echo @$userCountryCurCode;?>" hidden>
                              <input type="text" name="amount" id="amount" onmouseout = "commaSeparateNumber()" required placeholder="enter goal amount" class="form-control">
                              <div class="input-group-append">
                                <span class="input-group-text text-white" style="background-color:#22a349;">.00</span>
                              </div>
                              <div class="hint">Keep in mind that transaction fees both credit and debit charges are deducted from each donation</div>
                            </div>

                            <div class="mb-3">
                              <div id="converted_rate" style="color: #22a349"></div>
                              <div id="converted_amount" style="color: #22a349"></div>
                              <div class="">
                                <button type="button" name="convert" id="convert" class="btn btn-sm text-white" style="font-weight: normal;background-color: #22a349"
                                >Check Current Exchange Rate</button>
                              </div>
                            </div>

                            <div class="form-group">
                                <label for="">To receive donated funds please make sure the receiver has the following</label>
                                <ul>
                                    <li>
                                        <i class="fas fa-check"></i> A valid phone number from your country of registration
                                    </li>
                                    <li>
                                        <i class="fas fa-check"></i> A valid government-issued identification means (SSN for US recipients)
                                    </li>
                                    <li>
                                        <i class="fas fa-check"></i> A valid bank account from the country of registration
                                    </li>
                                </ul>
                            </div>
                            <div class="form-group">
                                <button class="funds_btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="spt">
                    <div class="up"><img src="images/fsupport.png" alt="" class="sp-img"> <h4 class="con mt-2">Tip from Maria, our fundraising support expert</h4><div style="clear:both"></div></div>
                    <div class="below">You can always change your goal amount later, if you not sure where to start, most campaigns have goal amount starting from <?php echo @$countryCurSymbol?>1,000</div>
                </div>
            </div>
  
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
     
    function commaSeparateNumber() {
        var fgGoalv = document.getElementById("amount").value;
        var fG = fgGoalv.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
        document.getElementById("frGoal").value = fgGoalv.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    } 
    
    </script>
    </body>
</html>