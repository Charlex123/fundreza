<?php
session_start();
ini_set('display_errors','1');
require_once'dbh.php';
require_once'config.php';
require_once'ranStrGen.php';
require_once'mailer.php';

@$Email = $_SESSION['Email'];
@$Lname = $_SESSION['Lname'];
// $emailcode = $_SESSION['emailCode'];
@$emailUname = $_SESSION['emailUname'];
@$fundraiserType = $_SESSION['fundraiserType'];
$message = '';
$phoneError = "";

@$fundraiserTyp = @$_GET['fundraiserType'];
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
	  .stpsf {
		position: relative;
	  }
	  .StepProgress {
			padding-left: 45px;list-style: none;position: relative;
	  } 
    .StepProgress::before {
      display: inline-block;content:"";position: absolute;top: 0;left: 15px;width: 10px;height: 100%;border-left: 2px solid #cccccc;
    }
	  .StepProgress-item {
		  position: relative;counter-increment: list;margin-top: 2rem;
	  }
    .StepProgress-item::before {
      display: inline-block;content:"";position: absolute;left: -30px;height: 100%;width: 10px;
    }
    .StepProgress-item::after {
      display: inline-block;content:"\00d7";position: absolute;left: -38px;height: 20px;width: 20px;
      top: 0;border: 2px solid #cccccc;border-radius: 50%;background-color: #ffffff;font-size: 1.4rem;color: red;
    }
    .StepProgress-item.is-done::before {
      /* border: 2px solid #22a349; */
    }
    .StepProgress-item.is-done::after {
      /* border: 2px solid #22a349; */
      content:"\2713";font-size: 10px;color: #ffffff;background-color:#22a349;
    }
    .StepProgress-item.current::before {
      /* border: 2px solid #22a349; */
    }
    .StepProgress-item.current::after {
      border: 2px solid #22a349;content: counter(list);padding-top: 1px;width: 19px;height: 18px;
      top: -4px;left: -40px;font-size: 1rem;text-align: center;background-color: #ffffff;color: #22a349;
    }
    .StepProgress strong {
      display: block;
    }.fa-check-circle {
		  color: #22a349;z-index: 1;
	  }
	  .fa-times-circle {
		  color: #da093d;z-index: 1;
	  }
    .vcf {
      display: inline-block;margin-top: -2rem;
    }
    .cft {
      white-space: initial;display: inline-block;font-size: 14px;padding-top: 1rem;
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
    
   

    <div class="full-height bg-white">
      <!-- ./authfy-panel-left -->
      <div class="form-group inner">
      <div class="col-inn" id="ffn">
      <?php @$fundraserId; echo "<a href='https://fundreza.com/fundraiser-story/tell-your-story/$fundraiserType/$fundraiserId'><i class='fas fa-angle-left'></i> Back</a>"; ?>
      </div>
			<div class="col-inn" id="lln">
			<h3 class="text-left mt-5 mb-2 font-weight-bold">
				Hurray <span class='hu text-primary'><?php $re = ucfirst($emailUname); $uc = ucfirst($Lname);  echo @$re. ' '.@$uc;?></span>, Your fundraiser is ready
				<h3 class="text-left mt-3 mb-3 font-weight-bold">Let's start getting the donations</h3>	
			</h3>
          
			<div class="stpf">
				<div class="bleft">
				</div>
				<div class="chk">
					<i class="fas fa-check-circle mr-3" ></i> Set up your fundraiser
				</div>
				<ul class="StepProgress">
					<li class="StepProgress-item is-done">
						  Share to your friends and ask them to help you share
					</li>
					<li class="StepProgress-item current">
						  Post to all your social media platforms 
					</li>
					<li class="StepProgress-item">
						  Send reminders to your friends 
					</li>
          <li class="StepProgress-item">
						  Send reminders to your friends 
					</li>
				</ul>
				<div class="float" style='clear:both'></div>
			</div>

			<div class="wtd mt-3">
				<div class="vcf"><i class="fas fa-credit-card mr-3 fa-2x" style="color: #22a349;"></i></div> <div class="cft"> We would remind you to set up withdrawals once you get your first donation</div>
			</div>

			<div class="form-group mt-5 mx-auto text-center">
				<a href="share-with-family-and-friends.php"><button type='submit' class='nf pl-5 pr-5' style='border:none' name='submit'>Next</button></a>
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
        
      })
      
      function _(e) {
    return document.getElementById(e);
}


     
    </script>
    </body>
</html>