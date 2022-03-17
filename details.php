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

@$fundraiserTyp = $_GET['fundraiserType'];

if (isset($_GET['fundraiserType']) && isset($_POST['fundraiserTitle']) && preg_match("/^[a-zA-Z-]*$/",$_GET['fundraiserType'])) {
   
  $fundraiserTitled = isset($_POST['fundraiserTitle']) ? $_POST['fundraiserTitle'] : false;
  
  if(isset($_SESSION['Email'])) {
    $fundraiserBy = $emailUname. ' ' .$Lname;
  }else if($user_data['email']) {
    $fundraiserBy = $fnamee. ' ' .$lnamee;
  }else {
      header("location:https://my.fundreza.com/login");
      exit();
  }
  
  $_SESSION['fundraiserType'] = @$fundraiserTyp;

  $fundraiserCountry = isset($_POST['fundraiserCountry']) ? $_POST['fundraiserCountry'] : false;
  $fundraiserState = isset($_POST['fundraiserState']) ? $_POST['fundraiserState'] : false;
  $fundraiserCategory = isset($_POST['fundraiserCategory']) ? $_POST['fundraiserCategory'] : false;
  $fundraiserForfromInput = isset($_POST['fundraiserFor']) ? $_POST['fundraiserFor'] : false;
  $fundraiserForfromList = isset($_POST['fundraiserForfromList']) ? $_POST['fundraiserForfromList'] : false;
 
      if(isset($fundraiserForfromInput)) {
        $fundraiserFor = $fundraiserForfromInput;
      }else {
        $fundraiserFor = $fundraiserForfromList;
      }
    $fundraiserType = $fundraiserTyp;
      
  if(htmlentities($fundraiserTitled) && htmlentities($fundraiserBy)  && htmlentities($fundraiserFor) && htmlentities($fundraiserType) && strip_tags($fundraiserType)) {

      $fundraiserTitle = str_replace("'","",$fundraiserTitled);
      $_SESSION['fundraiserTitle'] = $fundraiserTitle;
      $_SESSION['fundraiseredBy'] = $fundraiserBy;
      $timestatus = time(); 
      $fundraiserId = randStrGena(8);
      
      if(isset($_POST['fundraiserTitle'])) {
          $fundraiserTitle = isset($_POST['fundraiserTitle']) ? $_POST['fundraiserTitle'] : false;
          $fundraiserCategory = isset($_POST['fundraiserCategory']) ? $_POST['fundraiserCategory'] : false;
          
          if(isset($fundraiserForfromInput)) {
            $fundraiserFor = $fundraiserForfromInput;
          }else {
            $fundraiserFor = $fundraiserForfromList;
          }
          
          if(strip_tags($fundraiserTitle) && htmlentities($fundraiserTitle) && htmlentities($fundraiserFor)) {
              $_SESSION['fundraiserTitle'] = $fundraiserTitle;
              $_SESSION['fundraiserBy'] = $fundraiserBy;

              $shortUrl = "https://fundreza.com/a/$fundraiserId";
              $longStr = randStrGen(50);
              $totallikes = 0;
              $totalshares = 0;
              $totalviews = 0;
              $totallikes = 0;
              $totalfollowers = 0;
              $totaldownloads = 0;
              $totalupVote = 0;
              $totalcomments = 0;
              $fundraiserStatus = 'Active';
  
              if(isset($_SESSION['Email'])) {
                $eemail = $_SESSION['Email'];
              }else if(isset($user_data['email'])) {
                $eemail = $user_data['email'];
              }

              $con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
              $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $invst = $con ->prepare("INSERT INTO fundraiser_table (fundraiserId,fundraiserEmail,fundraiserBy,fundraiserFor,fundraiserType,fundraiserTitle,fundraiserCategory,fundraiserCountry,fundraiserState,shortUrl,longString,totalLikes,totalFollowers,totalupVotes,totalShares,totalViews,totalComments,dateSubmitted,fundraiserStatus) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
              $invst -> bindParam(1,$fundraiserId);
              $invst -> bindParam(2,$eemail);
              $invst -> bindParam(3,$fundraiserBy);
              $invst -> bindParam(4,$fundraiserFor);
              $invst -> bindParam(5,$fundraiserType);
              $invst -> bindParam(6,$fundraiserTitle);
              $invst -> bindParam(7,$fundraiserCategory);
              $invst -> bindParam(8,$fundraiserCountry);
              $invst -> bindParam(9,$fundraiserState);
              $invst -> bindParam(10,$shortUrl);
              $invst -> bindParam(11,$longStr);
              $invst -> bindParam(12,$totallikes);
              $invst -> bindParam(13,$totalfollowers);
              $invst -> bindParam(14,$totalupVote);
              $invst -> bindParam(15,$totalshares);
              $invst -> bindParam(16,$totalviews);
              $invst -> bindParam(17,$totalcomments);
              $invst -> bindParam(18,$timestatus);
              $invst -> bindParam(19,$fundraiserStatus);
              if($invst->execute()) {
                  $lastInsertId = $con -> lastinsertId();
  
                  $Email = $_SESSION['Email'];
                  $Lname = $_SESSION['Lname'];
                  // $emailcode = $_SESSION['emailCode'];
                  echo $emailUname = $_SESSION['emailUname'];
                  header("location:https://fundreza.com/funding/set/fundraising-goal/$fundraiserTyp");

              }
         
          }
      }

  }
  
}?>
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
	<title>Fundreza.com | Start a fundraiser </title>
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
        .pbar4 {
            width: 20%;height: 3px;margin: 2%;display: inline-block;
        }
        .pbar5 {
            width: 15%;height: 3px;margin: 2%;display: inline-block;
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
      .se {
        margin: 2rem auto; text-align: center;
      }
      .se .ors {
        font-weight: bold;color: #000000;
      }
      select#fundf {
        border: 1px solid #cccccc;border-radius: 8px;
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
      $che = $con -> prepare("SELECT userCountry,userCity FROM users WHERE email = ? ");
      $che ->bindParam(1,$Email);
      $che -> execute();

      $ches = $con -> prepare("SELECT userCountry,userCity FROM users WHERE email = ? ");
      $ches ->bindParam(1,$email_of_user);
      $ches -> execute();

      if($che -> execute() && $che -> rowCount() > 0) {
          $c = $che -> fetch(PDO::FETCH_ASSOC);
          $fCountry = $c['userCountry'];
          $fSate = $c['userCity'];
      }

      else if($ches -> execute() && $ches -> rowCount() > 0) {
        $cs = $ches -> fetch(PDO::FETCH_ASSOC);
        $fCountry = $cs['userCountry'];
        $fSate = $cs['userCity'];
    }
    ?>

    <div class="full-height bg-white">
      <!-- ./authfy-panel-left -->
      <div class="form-group inner">
        <div class="col-inn" id="ffn">
            <a href="https://fundreza.com/s/choose-type"><i class="fas fa-angle-left"></i> Back</a>
        </div>
        <div class="col-inn" id="lln">
        <?php $fundraiserTy = @$_GET['fundraiserType'];  if(isset($fundraiserTy) && strip_tags($fundraiserTy) && $fundraiserTy == "individual") {?>
          <h4>Step 1 of 4</h4>
          <div class="progressbar"><div class="pbar4" id="pbar1"></div><div class="pbar4"></div><div class="pbar4"></div><div class="pbar4"></div></div>
          <h4 class="text-left mt-5 mb-2">Let's get you started?</h4>
          <?php } else if(isset($fundraiserTy) && strip_tags($fundraiserTy) && $fundraiserTy == "non-profit") {?>
            <h4>Step 1 of 5</h4>
          <div class="progressbar"><div class="pbar5" id="pbar1"></div><div class="pbar5"></div><div class="pbar5"></div><div class="pbar5"></div><div class="pbar5"></div></div>
          <h4 class="text-left mt-5 mb-2">Let's get you started?</h4>
          <?php }?>
          <form method="POST">
            
          <?php $fundraiserTy = @$_GET['fundraiserType'];  if(isset($fundraiserTy) && strip_tags($fundraiserTy) && $fundraiserTy == "individual") {?>
          
            <div class="form-group">
              <label for="">Country of registration : </label>
              <input type="text" name="fundraiserCountry" id="fTitle" readonly value="<?php echo @$fCountry;?>" class="form-control">
            </div>
            <div class="form-group showtip" style='position: relative'>
              <label for="" > Enter recipient's name <i class="fas fa-question-circle"></i> <div class="tooltipa"> Name of the person you are fundraising for!, enter your name if you are fundraisng for yourself </div> </label>
              <input type="text" name="fundraiserFor" id="fFor" value="<?php echo @$fFor;?>" placeholder="enter name of recipient" class="form-control">
            </div>
            <div class="form-group">
              <label for="">What are you fundraising for?</label>
              <select name='fundraiserCategory' id='fundraiserCategory' class="form-control investmentPack text-dark" >
                <option value=''> -Select Fundraiser Category </option>
                <option value='Accidents & Emergency'> Accidents & Emergencies </option>
                <option value='Business & Enterpreneurs'> Business & Entrepreneurs </option>
                <option value='Celebration & Events'> Celebrations & Events </option>
                <option value='Community & Neighbours'> Community & Neighbours </option>
                <option value='Covid-19'> Covid-19 Relief </option>
                <option value='Arts, Music & Films'> Creative Arts, Music & Film </option>
                <option value='Education & Learning'> Education & Learning </option>
                <option value='Funerals & Memorials'> Funerals & Memorials </option>
                <option value='Medical & Health'> Medical, Health and Illness</option>
                <option value='Missions, Faith, Church & Mosque'>Missions, Faith, Church & Mosque </option>
                <option value='Politics'> Political Campaign </option>
                <option value='Rent, Food & Bills'> Rent, Food & Bills </option>
                <option value='Research & Science'> Research & Science </option>
                <option value='Sports, Team & Clubs'> Sports, Teams & Clubs </option>
                <option value='Talent'> Talent </option>
                <option value='Travel & Adventures'> Travel & Adventure </option>
                <option value='Weddings & Honeymoons'> Weddings & Honeymoons </option>
                <option value='Others'> Others </option>
              </select>
            </div>
            <div class="form-group">
              <label for="">What is your fundraiser title?</label>
              <input type="text" name="fundraiserTitle" maxlength="50" id="input1" required placeholder="E.g Help Juan Start Her Business" class="form-control">
              <span class="hideP" id="count1">50</span>
              <div class="hint">Hint: Try to include a personal name or purpose</div>
            </div>

            <!-- for non-profit -->


          <?php }else if(isset($fundraiserTy) && strip_tags($fundraiserTy) && $fundraiserTy == "non-profit") {?>

            <div class="form-group">
              <label for="">Country of registration : </label>
              <input type="text" name="fundraiserCountry" id="fTitle" readonly value="<?php echo @$fCountry;?>" class="form-control">
            </div>
            <div class="form-group">
              <?php
                require_once'dbh.php';
                $fnT = 'non-profit';
                $con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
                $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $chee = $con -> prepare("SELECT DISTINCT fundraiserFor FROM fundraiser_table WHERE fundraiserType = ? ");
                $chee ->bindParam(1,$fnT);
                $chee -> execute();
                
              ?>
              <label for="">Which non-profit organization are you fundraising for?</label>
              <input type="text" name="fundraiserFor" id="inpu" placeholder="Enter name of non profit organization" class="form-control">
            </div>
            
            <div class="se"><span class='ors'> OR </span> </div>

            <div>
                <label for="">select from the list below</label>
                <select name='fundraiserForfromList' id='fundf' class="form-control" >
                <option value=''> -Non profit organizations </option>
              <?php if($chee -> execute() ) {
                      $c = $chee -> fetchAll(PDO::FETCH_ASSOC);
                   foreach($c as $p => $v): ?>
                  <option value="<?php echo @$v['fundraiserFor']; ?>"> <?php echo @$v['fundraiserFor']; ?> </option>
                <?php  endforeach;}?>
                </select>
            </div>
            <div class="form-group">
              <label for="">What are you fundraising for?</label>
              <select name='fundraiserCategory' id='fundraiserCategory' class="form-control investmentPack text-dark" >
                <option value=''> -Select Fundraiser Category </option>
                <option value='Accidents & Emergency'> Accidents & Emergencies </option>
                <option value='Business & Enterpreneurs'> Business & Entrepreneurs </option>
                <option value='Celebration & Events'> Celebrations & Events </option>
                <option value='Community & Neighbours'> Community & Neighbours </option>
                <option value='Covid-19'> Covid-19 Relief </option>
                <option value='Arts, Music & Films'> Creative Arts, Music & Film </option>
                <option value='Education & Learning'> Education & Learning </option>
                <option value='Funerals & Memorials'> Funerals & Memorials </option>
                <option value='Medical & Health'> Medical, Health and Illness</option>
                <option value='Missions, Faith, Church & Mosque'>Missions, Faith, Church & Mosque </option>
                <option value='Politics'> Political Campaign </option>
                <option value='Rent, Food & Bills'> Rent, Food & Bills </option>
                <option value='Research & Science'> Research & Science </option>
                <option value='Sports, Team & Clubs'> Sports, Teams & Clubs </option>
                <option value='Talent'> Talent </option>
                <option value='Travel & Adventures'> Travel & Adventure </option>
                <option value='Weddings & Honeymoons'> Weddings & Honeymoons </option>
                <option value='Others'> Others </option>
              </select>
            </div>
            <div class="form-group">
              <label for="">What is your fundraiser title?</label>
              <input type="text" name="fundraiserTitle" maxlength="50" id="input1" required placeholder="Ex Joel's fundraiser for Rotary Club" class="form-control">
              <span class="hideP" id="count1">50</span>
              <div class="hint">Hint: Try to include a personal name or purpose</div>
            </div>
            
          <?php } ?>

            <div class="form-group">
              <button class="funds_btn">Submit</button>
            </div>

          </form>
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


      // function countText(e) {
      //   console.log(e)
      //   var curLength = document.getElementById('input1').value.length;
      //   console.log(curLength)
      // }


      _("input1").addEventListener("input", function () {
        var target = event.currentTarget;
        var maxLength = target.getAttribute("maxlength");
        var currentLength = target.value.length;
        if(currentLength >= maxLength) {
          _("count1").innerHTML = maxLength - currentLength;
          _("count2").innerHTML = maxLength - currentLength;
        }else {
          _("count1").innerHTML = maxLength - currentLength;
          _("count2").innerHTML = maxLength - currentLength;
        }
      })

      _("input2").addEventListener("input", event => {
        const target = event.currentTarget;
        const maxLength = target.getAttribute("maxlength");
        const currentLength = target.value.length;
        if(currentLength >= maxLength) {
          _("count1").innerHTML = maxLength - currentLength;
          _("count2").innerHTML = maxLength - currentLength;
        }else {
          _("count1").innerHTML = maxLength - currentLength;
          _("count2").innerHTML = maxLength - currentLength;
        }
      })
      
    </script>
    </body>
</html>   