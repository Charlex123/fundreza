<?php
session_start();
ini_set('display_errors','1');
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

if(isset($_SESSION['Email'])) {
    $eemail = $_SESSION['Email'];
    $uploadedBY = $_SESSION['Email'];
  }else if(isset($user_data['email'])) {
    $eemail = $user_data['email'];
    $uploadedBY = $user_data['email'];
  }

$message = '';
$phoneError = "";

@$fundraiserTyp = $_GET['fundraiserType'];
$_SESSION['fundraiserType'] = @$fundraiserTyp;

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
	<title>Helpfundme | Start a fundraiser </title>
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
      .full-height {
        width: 30%;margin: 5rem auto;
      }
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
        .progressbar {
          white-space: nowrap;width: 100%;
        }
        #pbar1 {
          background-color: #22a349;
        }
        #hideP {
            float: right;margin: -1.8rem .4rem auto auto;color: #22a349;
        }
        .hint {
          font-size: 13px;color: #22a349;margin-top:.5rem;
        }
        .tooltipa {
        position:absolute; margin-top: .2rem;width:12rem;
        padding:.4rem;font-size: 12px;
        border-radius:8px;
        top: -140%;
        background-color: #f1f1f1;
        color: #000000;
        text-align:left;
        /* box-shadow: 2px 4px  4px 5px #ffffff; */
        white-space: initial;
        display:none;
      }
      .tooltipa:after {
        content: "";
        position:absolute;
        left: 75%;
        margin-left:-3px;
      
        top: 110%;
        transform:translateY(-50%);
      
        border: 15px solid #f1f1f1;
        border-color: #f1f1f1 transparent transparent transparent;
        
        display:none;
      }
      .showtip:hover .tooltipa, .showtip:hover .tooltipa:after {
        display:block;
      } 
      .sh10 {
          white-space: initial;border-bottom: 1px solid #cccccc;padding-bottom: 2rem;
      }
      .shnetw {
        white-space: initial;border-bottom: 1px solid #cccccc;padding-bottom: 2rem;
      }
      .netw {
          display: inline-block;margin: 1rem;
      }
      .icn {
          font-size: 35px;margin: auto;text-align: center;
      }
      .fa-facebook-square {
          color: #4267B2;
      } 
      .fa-twitter {
        color: #1DA1F2;
      }
      .fa-instagram {
        color: #fb3958;
      } 
      .fa-envelope {
          color: #545454;
      }
      .fa-whatsapp-square {
          color: green;
      }
      .fa-facebook-messenger {
          color: #0084ff;
      }
      .nett {
          font-size: 14px;margin: .6rem auto auto -.5rem;
      }
      .shlink {
          display: inline-block;width: 80%;border: 1px solid #cccccc;border-radius: 4px;
          padding: .6rem;position: relative;background-color: #ffffff;
      }
      .flink {
          font-size: 14px;margin-top: -1.3rem;position: absolute;background-color: #ffffff;
          padding: .2rem;
      }
      .sbtn {
          display: inline-block;margin-left: .5rem;z-index: 9000000;
      }
      .svfl {
          z-index: 1;position: relative;color: #545454;
      }
      .svflc {
          z-index: -1;
      }
      .prv {
            width: 100%;color: #ffffff;background-color: #025faa;text-align: center;
            padding: .4rem;border: none;border-radius: 4px;margin-top: 1rem;
        }
        .prv a {
            border: none;box-shadow: none;color: #ffffff;padding: .4rem;
        }
        .prv a:hover {
            color: #ffffff;
        }
        .fa-bolt {
            color: orange;
        }
      .sbtn button {
          background-color: #22a349;padding: .5rem 1rem;border: none;color: #ffffff;
          border-radius: 4px;margin-top:-2rem;z-index: 9000;
      }
      .shortl {
          margin: 1rem 0;font-size: 14px;
      }
      .shortl input {
        border: 1px solid #cccccc;
      }
      .btr h4 {
          white-space: initial;line-height: 24px;margin-bottom: 4rem;
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
		<!-- partial:partials/_horizontal-navbar.html -->
    
        <?php 
				require_once'dbh.php';
				$con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
				$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$ch = $con -> prepare("SELECT shortUrl,longString,fundraiserId,fundraiserTitle FROM fundraiser_table WHERE fundraiserEmail = ? ORDER BY dateSubmitted DESC");
				$ch ->bindParam(1,$eemail);
				$ch -> execute();

				if($ch -> execute() && $ch -> rowCount() > 0) {
					$s = $ch -> fetch(PDO::FETCH_ASSOC);
                    $fid = $s['fundraiserId'];
                    $ft = $s['fundraiserTitle'];
                    $fT = str_replace(" ",'-',$ft);
                    $shortUrl = $s['shortUrl'];
                    $lgUrl = $s['longString'];
                    $longUrl = "https://fundme.org/$lgUrl";
                }
        ?>

    <div class="full-height bg-white">
      <!-- ./authfy-panel-left -->
      <div class="form-group inner">
            <div class="col-inn" id="ffn">
                <a href="share-with-family-and-friends.php"><i class="fas fa-angle-left"></i> Back</a>
            </div>
			<div class="col-inn" id="lln">
			<h1 class="text-left mt-5 mb-2 font-weight-bold dt">
				Sharing is important 
			</h1>
            <h2 class="text-left sh10 mt-3 mb-3"> Have you shared your fundraiser yet?</h2>
          

            <div class="form-group mt-5 text-center btr">
                <h3 style="white-space: initial">Each social media sharing can generate up to $500 in donations</h3>
                <h4>Share your fundraiser as much as you can. Its the only way of raising all the funds you need.</h4>
                
				<i class='fas fa-bolt fa-5x text-center'></i>
			</div>

            <div class="form-group mt-5 prv">
				<?php echo "<a href='share-with-family-and-friends.php'>Go back to share</a>"; ?>
			</div>
            
            <div class="form-group mt-5">
				<?php echo "<a href='page.php?fundraiserId=$fid&fundraiserTitle=$fT'><button type='submit' class='funds_btn' name='submit'>Back to fundraiser <i class='fas fa-angle-right'></i></button></a>"; ?>
			</div>

        </div>
      </div>
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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js" type="text/javascript"></script>
  <script src="javascript/popper.js/umd/popper.min.js" type="text/javascript"></script>
  <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="javascript/login.js" type="text/javascript"></script>
  <script src="javascript/jquery-validation/jquery.validate.min.js" type="text/javascript"></script>
  <script type="text/javascript">
   $(document).ready(function() {
        
      });
      
      function _(e) {
    return document.getElementById(e);
      }

    
    function shortUrl() {
        var longUrldiv = document.getElementById("svflc"),
        chkbx = document.getElementById("chklink");
        longUrl = document.getElementById("svflc").getAttribute("name"),
        divLink = document.getElementById("chklink").getAttribute("name");
        if(chkbx.checked) {
            longUrldiv.innerHTML = divLink;
        }else {
            longUrldiv.innerHTML = longUrl;
        }
        
    }

    function copyTextToClipboard(text) {
    var textArea = document.createElement("textarea");
  
    // Place in top-left corner of screen regardless of scroll position.
    textArea.style.position = 'fixed';
    textArea.style.top = 0;
    textArea.style.left = 0;
  
    // Ensure it has a small width and height. Setting to 1px / 1em
    // doesn't work as this gives a negative w/h on some browsers.
    textArea.style.width = '2em';
    textArea.style.height = '2em';
  
    // We don't need padding, reducing the size if it does flash render.
    textArea.style.padding = 0;
  
    // Clean up any borders.
    textArea.style.border = 'none';
    textArea.style.outline = 'none';
    textArea.style.boxShadow = 'none';
  
    // Avoid flash of white box if rendered for any reason.
    textArea.style.background = 'transparent';
  
  
    textArea.value = text;
  
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
  
    try {
      var successful = document.execCommand('copy');
      var msg = successful ? 'successful' : 'unsuccessful';
    } catch (err) {
      console.log('Oops, unable to copy');
    }
  
    document.body.removeChild(textArea);
  }
  
  
//   var copyLink = document.getElementById("svflc").innerHTML;
  var copyButton = document.getElementById("copylink");

  copyButton.addEventListener('click', function(event) {
      var textToCopy;
      var longUrldiv = document.getElementById("svflc"),
        chkbx = document.getElementById("chklink");
        longUrl = document.getElementById("svflc").getAttribute("name"),
        divLink = document.getElementById("chklink").getAttribute("name");
        if(chkbx.checked) {
            longUrldiv.innerHTML = divLink;
            textToCopy = divLink;
        }else {
            longUrldiv.innerHTML = longUrl;
            textToCopy = longUrl;
        }
      copyButton.innerHTML = 'Copied';
    copyTextToClipboard(textToCopy);
  });


    </script>
    </body>
</html>