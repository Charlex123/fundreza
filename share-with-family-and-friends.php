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


echo @$Email = $_SESSION['Email'];
echo @$Lname = $_SESSION['Lname'];
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

@$fundraiserTyp = $_GET['fundraiserType'];
$_SESSION['fundraiserType'] = @$fundraiserTyp;
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
	<title> Start a fundraiser | Fundreza.com </title>
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
      .mfr-img {
    width: 100%;border-radius: 4px;height: 15rem;max-height: 16rem;
}
.funda {
  background-color: #ffffff;border-radius: 4px;box-shadow: 1px 1px 1px 2px #f1f1f1;font-family: "PT Sans";margin-bottom: 2rem;
  font-size: 16px;height: 34rem;max-height: 34rem;
}
.funda .f-con {
  padding: .4rem;margin: auto;
}
.funda img {
-webkit-filter: grayscale(40%);
filter: grayscale(40%);
border-radius: 4px;
transition: all 0.3s;
}
.funda .mfr-img {
    height: 13rem;
}
.mfrsc-in {
font-size: 16px;
}
.mfrsc-ft {
    position: absolute;top: 0;white-space: nowrap;box-shadow: 1px 1px 1px 2px #f1f1f1;border-radius: 4px;
    padding: .3rem 1rem;z-index: 9;font-stretch: ultra-condensed;padding-left: 0;display: none;
    background-color: #ffffff;font-family: "Roboto";text-align: left;
}
.mfrsc-title:hover .mfrsc-ft{
    display: block;
}
.mfrsc-td,.mfrsc-dona {
    display: inline-block;font-size: 14px;
}
.mfrscc {
    display: inline-block;text-align: justify;text-align-last: justify;width: 100%;
}
.mfrsc-time {
    display: inline-block;font-size: 14px;font-style: italic;
}
.mfrsc-eyev {
    display: inline-block;font-size: 20px;
}
.mfr-img {
    width: 100%;border-radius: 4px;height: 12rem;max-height: 13rem;border-radius: 8px;
}
.defa {
    border-radius: 8px;
}
.mfrs {
    box-shadow: 1px 1px 1px 2px #f1f1f1;width: 100%;position: relative;border-radius: 8px;
}
.mfrsct {
    border-radius: 8px;
}
.mfrsc {
    padding: .5rem;
}
.mfrsc-in {
    text-align: left;text-align-last: left;margin: .3rem;
}
.dorna {
    margin: 1rem auto;position: relative;text-align: left;
}
.by-img {
    width:2rem;max-width: 3rem;max-height: 3rem;height: 2rem;border-radius: 50%;float: left;margin-left: .4rem;margin-right: .3rem;margin-top: -.3rem;
}
.fb-b {
    font-weight: bold;color: #22a349;
}
.icc {
    color: #22a349
}
.mfrsc-title {
    font-size: 14px;line-height: 18px;position: relative;background: transparent;margin: 1rem .6rem;font-weight: bold;
    font-family: "Roboto";color: #888868;text-align: left;
}
.mfrsc-title a{
    font-weight: normal;font-family: "Roboto";color: #525753;text-align: left;
}
.fulltitled {
    font-weight: normal;font-family: "Roboto";color: #525753;text-align: left;
}
.mfrsc-ft {
    position: absolute;top: 0;white-space: nowrap;box-shadow: 1px 1px 1px 2px #f1f1f1;border-radius: 4px;
    padding: .3rem 1rem;z-index: 9;font-stretch: ultra-condensed;padding-left: 0;display: none;
    background-color: #ffffff;font-family: "Roboto";text-align: left;
}
.mfrsc-title:hover .mfrsc-ft{
    display: block;
}
.mfrsc-td,.mfrsc-dona {
    display: inline-block;font-size: 14px;
}

.mfrscc {
    display: inline-block;text-align: justify;text-align-last: justify;width: 100%;
}
.mfrsc-time {
    display: inline-block;font-size: 14px;font-style: italic;
}
.mfrsc-eyev {
    display: inline-block;font-size: 20px;
}
.p-con {
    width: 100%;
}
.p-con .amtt {
    font-weight: bold;margin-bottom: .2rem;
}
.p-con .amtt .amtraisedc {
    float: left;;font-style: normal;font-weight: lighter;
}
.p-con .amtt .amttotalc {
    float: right;color: #525753;
}
.progress {
    height: .4rem;background-color: #eaeaea;
}
.progress-bar {
    background-color: transparent;
}
.mfu {
    position: relative;width: 100%;
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
                <?php if(isset($_GET['fundraiserId'])) {
                
                }else {
                    echo '<a href="step-f.php"><i class="fas fa-angle-left"></i> Back</a>';
                }
                ?>
            </div>
			<div class="col-inn" id="lln">
			<h3 class="text-left mt-5 mb-2 font-weight-bold dt">
				Share your fundraiser 
			</h3>
            <div class="text-left sh10 mt-3 mb-3">Ask 5-10 friends to help you share. Fundraisers shared on social networks raise up o 10x more.</div>
          
			<div class="shnetw">
				<div class="netw"><a href="https://facebook.com"><i class="fab fa-facebook-square icn"></i><div class="nett">Facebook</div></a></div>
                <div class="netw"><a href="https://twitter.com"><i class="fab fa-twitter icn"></i><div class="nett">Twitter</div></a></div>
                <div class="netw"><a href="https://instagram.com"><i class="fab fa-instagram icn"></i><div class="nett">Instagram</div></a></div>
                <div class="netw"><a href="https://wa.me"><i class="fab fa-whatsapp-square icn"></i></a><div class="nett">Whatsapp</div></div>
                <div class="netw"><a href="https://tiktok.com"><span><img src="images/tiktok-logo.svg" alt="" class="tiktok" style="width: 2rem;max-width: 2rem;"></span><div class="nett">Tiktok</div></a></div>
                <div class="netw"><a href="https://gmail.com"><i class="fas fa-envelope icn"></i><div class="nett">Email</div></a></div>
                <div class="netw"><a href="https://m.me"><i class="fab fa-facebook-messenger icn"></i><div class="nett">Messenger</div></a></div>
        </div>

        <?php 
				require_once'dbh.php';
				$con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
				$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$ch = $con -> prepare("SELECT shortUrl,longString,fundraiserId,fundraiserTitle FROM fundraiser_table WHERE fundraiserEmail = ? ORDER BY dateSubmitted DESC");
				$ch ->bindParam(1,$eemail);
				$ch -> execute();

				if($ch -> execute() && $ch -> rowCount() > 0 ) {
					$s = $ch -> fetch(PDO::FETCH_ASSOC);
              $fid = @$s['fundraiserId'];
              $ft = @$s['fundraiserTitle'];
              @$fT = str_replace(" ",'-',$ft);
              $shortUrl = @$s['shortUrl'];
              $lgUrl = @$s['longString'];
              $longUrl = "https://fundreza.com/a/$lgUrl";
            
        ?>
        
      <?php } if(isset($_GET['fundraiserId'])) {
                $fisd = htmlspecialchars($_GET['fundraiserId']);
                $mfs = new dbh(); $mfs-> mfShare(); 
                $con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
                $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $chi = $con -> prepare("SELECT shortUrl,longString,fundraiserId,fundraiserTitle FROM fundraiser_table WHERE fundraiserId = ?");
                $chi ->bindParam(1,$fisd);
                $chi -> execute();

                if($chi -> execute() && $chi -> rowCount() > 0 ) {
                  $is = $chi -> fetch(PDO::FETCH_ASSOC);
                      $fiid = @$is['fundraiserId'];
                      $fit = @$is['fundraiserTitle'];
                      @$fT = str_replace(" ",'-',$ft);
                      $shortUrl = @$is['shortUrl'];
                      $lgUrl = @$is['longString'];
                      $longUrl = "https://fundreza.com/a/$lgUrl";
                }
            }
        ?>
        <div class="form-group mt-5">
				        <div class="shlink"><div class="flink">Fundraiser Link</div> <input type="submit" class="form-control svfl text-left" id="svflc" value="<?php echo @$longUrl; ?>" name="<?php echo @$longUrl; ?>"> </div>
                <div class="sbtn"><button type="submit" class="sh_btn" id="copylink" value="<?php echo @$fiid;?>" onclick ="copyTextToClipboard(this)" name="submit"><i class="far fa-copy"></i> Copy</button></div>
                <div class="shortl">
                    <input type="checkbox" name="<?php echo $shortUrl;?>" id="chklink" onclick="shortUrl(this)"> Shorten Link
                </div>
			  </div>

            <div class="form-group mt-5">
				<?php echo "<a href='share-remind.php'><button type='submit' class='funds_btn' name='submit'>Continue</button></a>"; ?>
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
  <script src="javascript/front.js" type="text/javascript"></script>
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
            longUrldiv.value = divLink;
        }else {
            longUrldiv.value = longUrl;
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
            // alert(longUrldiv)
        }else {
            longUrldiv.innerHTML = longUrl;
            textToCopy = longUrl;
            // alert(longUrldiv)
        }

      copyButton.innerHTML = 'Copied';
    copyTextToClipboard(textToCopy);

    var fupcId = this.getAttribute("value");
    // alert(fupcId)
    var shares = 'true';
    var v = new XMLHttpRequest();
        v.open("POST","shares.php",true);
        v.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        v.onreadystatechange = function () {
            if((v.readyState == 4) && (v.status == 200 || v.status == 304) ) {
                
                return false;
            }
        }
        v.send("shares="+shares+"&fundraiserId="+fupcId);

  });


    </script>
    </body>
</html>