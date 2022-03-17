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
@$fundraiserType = strip_tags($_GET['fundraiserType']);

if(isset($_SESSION['Email'])) {
    $eemail = $_SESSION['Email'];
    $uploadedBY = $_SESSION['Email'];
    @$fundraiserType = $_SESSION['fundraiserType'];
  }else if(isset($user_data['email'])) {
    $eemail = $user_data['email'];
    $uploadedBY = $user_data['email'];
    @$fundraiserType = strip_tags($_GET['fundraiserType']);
  }else {
      header("location:https://my.fundreza.com/login");
      exit();
  }

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['fundraiserStory'])) {
    
      
    $fundraiserStory = isset($_POST['fundraiserStory']) ? $_POST['fundraiserStory'] : false;
    $con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $ch = $con -> prepare("SELECT fundraiserId FROM fundraiser_table WHERE fundraiserEmail = ? ORDER BY dateSubmitted DESC");
    $ch ->bindParam(1,$eemail);
    $ch -> execute();
    $s = $ch -> fetch(PDO::FETCH_ASSOC);
    @$fundraisaId = $s['fundraiserId'];


    if(strip_tags($_POST['fundraiserStory']) && htmlentities($_POST['fundraiserStory']))  {

        $con= new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
        $upd = $con -> prepare("UPDATE fundraiser_table SET fundraiserStory = ? WHERE fundraiserId = ? ");
        $upd -> bindParam(1,$fundraiserStory);
        $upd -> bindParam(2,$fundraisaId);
        $upd -> execute();
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
	<title>Fundreza | Start a fundraiser </title>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/12.2.0/classic/ckeditor.js"></script>
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/page.css">
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
        #overlay {
            position: fixed;opacity: .1;filter: opacity(1);display: none;
            width: 100%;height: inherit;max-height: inherit;background-size: auto;background-color: #545454;
            top: 0;left: 0;right: 0;bottom: 0;
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
        .progressbar {
          white-space: nowrap;width: 100%;
        }
        .hideP {
            float: right;margin: -1.8rem .4rem auto auto;color: #22a349;
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
        
        #pbar3 {
            background-color: #22a349;
        }
        #pbar4 {
            background-color: #22a349;
        }
        .hint {
          font-size: 13px;color: #22a349;margin-top:.5rem;white-space: initial;
          word-wrap: break-word;
        }
        label {
            white-space: initial;float: none;clear: both;
        }
        textarea {
            float: none;clear: both;border: 1px solid #eaeaea;border-radius: 4px;width: 100%;
        }
        textarea::placeholder {
            padding: .5rem;font-size: 14px;
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
        #drop_file_zone {
            background-color: #f1f1f1;
            border: #999 1px dashed;
            border-radius: 4px;
            width: 100%;
            height: 150px;
            margin: 2rem auto;
            padding: 8px;
            font-size: 18px;
        }
        #drag_upload_file {
            width:50%;
            margin:10% auto;
        }
        #drag_upload_file p {
            text-align: center;color: gray;
        }
        #drag_upload_file #selectfile {
            display: none;
        }
        #loaded-n-total,#status {
            color: gray;
        }
        .svg-animate {
            position: relative;height: 120px;width: 100%;
            display: none;
        }
        .arrows {
            width: 60px;
            height: 72px;
            position: absolute;
            left: 50%;
            margin-left: -30px;
            bottom: 20px;
        }

        .arrows path {
            stroke: #2994D1;
            fill: transparent;
            stroke-width: 1px;	
            animation: arrow 2s infinite;
            -webkit-animation: arrow 2s infinite; 
        }

        @keyframes arrow
        {
        0% {opacity:0}
        40% {opacity:1}
        80% {opacity:0}
        100% {opacity:0}
        }

        @-webkit-keyframes arrow /*Safari and Chrome*/
        {
        0% {opacity:0}
        40% {opacity:1}
        80% {opacity:0}
        100% {opacity:0}
        }

        .arrows path.a1 {
            animation-delay:-1s;
            -webkit-animation-delay:-1s; /* Safari 和 Chrome */
        }

        .arrows path.a2 {
            animation-delay:-0.5s;
            -webkit-animation-delay:-0.5s; /* Safari 和 Chrome */
        }

        .arrows path.a3 {	
            animation-delay:0s;
            -webkit-animation-delay:0s; /* Safari 和 Chrome */
        }
        .or {
            margin: 3rem auto;font-size: 20px;text-align: center;
        }
        .vidlinktop {
            width: 100%;margin: auto;text-align: center;
        }
        .close-now {
            font-size: 2rem;cursor:pointer;margin-right: 1rem;float: right;color: red;
            z-index: 9999999999999999999999999999999;margin-top: 2rem;position: absolute;left: 96%;right: 4%;
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
    <div id="overlay"></div>
    <div id="status"></div>
        <div class="container-scroller bg-white">
            <header><a href="home"><img src="images/fundrezalogo.png" alt="" class="fundrais"></a></header>
    
            <div class="full-height bg-white">
                <!-- ./authfy-panel-left -->
                <div class="form-group inner">
                    <div class="col-inn" id="ffn">
                        <?php echo "<a href='https://fundreza.com/add-media/setup/addpicture-video/$fundraiserType'><i class='fas fa-angle-left'></i> Back</a>"; ?>
                    </div>
                    <div class="col-inn" id="lln">
                        <?php $fundraiserTy = @$_GET['fundraiserType'];  if(isset($fundraiserTy) && strip_tags($fundraiserTy) && $fundraiserTy == "individual") {?>
                        <h4>Step 4 of 4</h4>
                        <div class="progressbar"><div class="pbar4" id="pbar1"></div><div class="pbar4" id="pbar2"></div><div class="pbar4" id="pbar3"></div><div class="pbar4" id="pbar4"></div></div>
                        
                        <?php $fundraiserTy = @$_GET['fundraiserType']; } else if(isset($fundraiserTy) && strip_tags($fundraiserTy) && $fundraiserTy == "non-profit") {?>
                            <h4>Step 4 of 5</h4>
                        <div class="progressbar"><div class="pbar5" id="pbar1"></div><div class="pbar5" id="pbar2"></div><div class="pbar5" id="pbar3"></div><div class="pbar5" id="pbar4"></div><div class="pbar5" ></div></div>
                        <?php }?>

                        <form method="POST" id="prevform">
                            
                            <?php 
                                    ob_start();
                                    require_once'dbh.php';
                                    $con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
                                    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    $fnT = 'non-profit';
                                    $chee = $con -> prepare("SELECT fundraiserFor FROM fundraiser_table WHERE fundraiserEmail = ?  AND fundraiserType = ? ORDER BY dateSubmitted DESC");
                                    $chee ->bindParam(1,$eemail);
                                    $chee ->bindParam(2,$fnT);
                                    $chee -> execute();
                                    if($chee -> execute() && $chee -> rowCount() > 0) {
                                        $fF = $chee -> fetch(PDO::FETCH_ASSOC);
                                        $npo = $fF['fundraiserFor'];
                                    }
                                    $ch = $con -> prepare("SELECT fundraiserStory FROM fundraiser_table WHERE fundraiserEmail = ? ORDER BY dateSubmitted DESC");
                                    $ch ->bindParam(1,$eemail);
                                    $ch -> execute();
                                    $s = $ch -> fetch(PDO::FETCH_ASSOC);
                                    $fStory = $s['fundraiserStory'];
                                    if($fStory <> null || $fStory <> '') {

                                        $chl = $con -> prepare("SELECT fundraiserId,fundraiserTitle FROM fundraiser_table WHERE fundraiserEmail = ? ORDER BY dateSubmitted DESC");
                                        $chl ->bindParam(1,$eemail);
                                        $chl -> execute();
                                        $sl = $chl -> fetch(PDO::FETCH_ASSOC);
                                        @$fundrid = $sl['fundraiserId'];
                                        @$fundrT = $sl['fundraiserTitle'];


                                        if(isset($_GET['fundraiserId'])) {
                                          $fid = htmlspecialchars($_GET['fundraiserId']);
                                          $ch = $con -> prepare("SELECT fundraiser_table.fundraiserId,fundraiser_table.fundraiserTitle,fundraiser_table.fundraiserEmail,fundraiser_table.youtubeLink,fundraiser_table.fundraiserBy,fundraiser_table.fundraiserFor,fundraiser_table.fundraiserType,fundraiser_table.fundraiserTitle,fundraiser_table.fundraiserStory,fundraiser_table.fundraiserUpdate,fundraiser_table.fundraiserCategory,fundraiser_table.fundraiserThumbnail,fundraiser_table.fundraiserGoal,fundraiser_table.fundraiserStatus,fundraiser_table.totalBitcoinDonations,fundraiser_table.bitcoinDonations,fundraiser_table.totaldonationsReceived,fundraiser_table.supportTipReceived,fundraiser_table.shortUrl,fundraiser_table.longString,fundraiser_table.totalLikes,fundraiser_table.totalShares,fundraiser_table.totalViews,fundraiser_table.totalFollowers,fundraiser_table.totalComments,fundraiser_table.totalDonations,count(donation_table.donatedBy) AS donatedBy FROM fundraiser_table LEFT JOIN donation_table ON fundraiser_table.fundraiserId = donation_table.fundraiserId WHERE fundraiser_table.fundraiserId = ?
                                ");
                                          $ch ->bindParam(1,$fid);
                                          $ch -> execute();
                                
                                          if($ch -> execute() && $ch -> rowCount() > 0) {
                                            $s = $ch -> fetch(PDO::FETCH_ASSOC);
                                            @$fId = $s['fundraiserId'];
                                            @$fTitle = $s['fundraiserTitle'];
                                            @$fType = $s['fundraiserType'];
                                            @$fFor = $s['fundraiserFor'];
                                            @$fBy = $s['fundraiserBy'];
                                            @$dBy = $s['donatedBy'];
                                            @$fStory = $s['fundraiserStory'];
                                            @$fCateg = $s['fundraiserCategory'];
                                            @$fThumb = $s['fundraiserThumbnail'];
                                            @$fGoal = $s['fundraiserGoal'];
                                            @$youtubeLink = $s['youtubeLink'];
                                            @$ffGoal = number_format($s['fundraiserGoal']);
                                            @$fDonations = $s['fundraiserdonationsReceived'];
                                            $fSupportTip = $s['supportTipReceived'];
                                            $fTotalDonations = $s['totaldonationsReceived'];
                                            $fbtcDonations = $s['bitcoinDonations'];
                                            $fbtcTotalDonations = $s['totalBitcoinDonations'];
                                            @$fStatus = $s['fundraiserStatus'];
                                            @$fShares = $s['totalShares'];
                                            @$fViews = $s['totalViews'];
                                            @$fLikes = $s['totalLikes'];
                                            @$fFollowers = $s['totalFollowers'];
                                            @$ffShares = number_format($s['totalShares']);
                                            @$ffViews = number_format($s['totalViews']);
                                            @$ffLikes = number_format($s['totalLikes']);
                                            @$ffFollowers = number_format($s['totalFollowers']);
                                            @$dateSub = $s['dateSubmitted'];
                                            @$flUrl = $s['longString'];
                                            @$fbyy = strtolower(@$fBy);
                                            @$fbby = str_replace(' ','-',@$fbyy);
                                            @$ftitled = str_replace(' ','-',$fTitle);
                                            @$shortUrl = $s['shortUrl'];
                                            $se = $con -> prepare("SELECT uploadedDocument FROM documentuploads WHERE fundraiserId = ? ORDER BY time_uploaded DESC");
                                            $se -> bindParam(1,$fundraisaId);
                                            $se -> execute();
                                            $dc = $se -> fetch(PDO::FETCH_ASSOC);
                                              
                                            @$imgDo = $dc['uploadedDocument'];
                                
                                            $ftitled = str_replace(" ",'-',$fTitle);
                                            $fcategd= str_replace("-",' ',$fCateg);
                                
                                            if($fCateg == 'Rent-Food-Bills') {
                                              $fcateged = 'rent and bills';
                                            }
                                
                                            if($fBy == $fFor) {
                                              $fFund = "<span class='hyurf'> ". @$fBy . "</span> is organizing this fundraiser";
                                            }else {
                                              $fFund = "<span class='hyurf'> ". @$fBy . "</span> is organizing this fundraiser onbehalf of <span class='hyurf'> ".@$fFor."'s </span>" .@$fcateged;
                                            }
                                
                                            $shortStory = substr($fStory,0,320);
                                
                                            if(isset($youtubeLink)) {
                                                $youtubevideoembed = "<iframe width='100%' height='100%' src='https://www.youtube.com/embed/$youtubeLink' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
                                                $youtubevideoembedlist = "<iframe width='100' height='100%' src='https://www.youtube.com/embed/$youtubeLink' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen class='img-tiny'></iframe>";
                                                $imgvidShow ="<iframe width='100%' height='100%' style='margin-top: 2rem' src='https://www.youtube.com/embed/$youtubeLink' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen id='iframeVd'></iframe>";
                                              }else {
                                                $youtubevideoembed = "";
                                                $youtubevideoembedlist = "";
                                                $imgvidShow = "<img src='".@$fThumb."' alt='' class='image-cover'>";
                                            }
                                            
                                            $longUrl = "https://fundreza.com/$fId/$ftitled/$flUrl";
                                            if($fDonations == "" || $fDonations == null) {
                                              $fiat = '$0';
                                            }else {
                                              $fiat = '$'.$fDonations;
                                            }if($fbtcDonations == "" || $fbtcDonations == null) {
                                              $btc = '$0';
                                            }else {
                                              $btc = '$'.$fbtcDonations;
                                            }if($fTotalDonations == "" || $fTotalDonations == null) {
                                              $fTotal = '$0';
                                              $ffTotal = '$0';
                                            }else {
                                              $fTotal = '$'.$fTotalDonations;
                                              $ffTotal = '$'.number_format($fTotalDonations);
                                            }
                                            
                                          }
                                        
                                
                                          
                                          $if = $con -> prepare("SELECT uploadedDocument FROM documentuploads WHERE fundraiserId = ? ORDER BY time_uploaded DESC");
                                          $if -> bindParam(1,$fId);
                                          $if -> execute();
                                          if($if -> execute() && $if -> rowCount() > 0) {
                                
                                            $i= $if -> fetchAll(PDO::FETCH_ASSOC);
                                            @$iid = @$i['uploadedDocument'];
                                
                                            foreach($i as $limg) {
                                              $imga = $limg['uploadedDocument'];
                                              $mig = "<ul><li>$youtubevideoembedlist<img src='$imga' class='img-tiny' onerror.this=src='images/9.png'/></li></ul>";
                                            }
                                             
                                          }

                                        }

                            ?>
                            <!--<div class="form-group text-center funds_btn mx-auto mt-5 mb-3 pb-2">-->
                            <!--    <a class="funds_btn mt-5 mx-auto text-center w100" style='width: 100%; cursor: pointer' rel='nofollow' style='cursor:pointer' data-toggle='modal' data-target='#manageF' name='$fundraiserId' aria-haspopup='true' aria-expanded='false' name="<?php echo @$fundrid;?>" value="<?php echo @$fundrT;?>">Preview Fundraiser</a>-->
                            <!--</div>-->

                            <div class="form-group prv text-center">
                                <a href='https://fundreza.com/next-step/step-f'>Continue Fundraiser</a>
                            </div>

                            <div class="mfu">
                                <div class="modal" id="manageF">
                                    <div class="close-now"><i class="fas fa-times" id="close" onclick = "closeM()"></i></div>
                                    <div class="modal-content">
                                        <div class='con' id='drpn'>
                                  
                                        <?php 
                                            require_once'dbh.php';
                                            $con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
                                            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                                                                          
                                        ?>

                            <!-- partial -->
                                <div class="container-fluid page-body-wrapper ">
                                    <div class="main-panel">
                                        <div class="content-wrapper">
                                            
                                            <div class="main-row">
                                                <h1 class="text-dark ttt" style="white-space: initial;"><?php echo @$fTitle; ?></h1>
                                                
                                                <div class="row">
                                                    <div class="col-7">
                                                        
                                                        <div style='position: relative'>
                                                          <?php 
                                                            echo "<div class='image-thumb'>$imgvidShow</div>";
                                                            echo "<div class='liuma bg-white mt-2' style='background: #ffffff !important;'><ul style='background: #ffffff !important;'><li class='listimg bg-white'>$youtubevideoembedlist</li></ul></div>";
                                                            foreach(@$i as $limg) {
                                                              $imga = $limg['uploadedDocument'];
                                                              echo $mig = "<div class='liuma bg-white mt-2' style='background: #ffffff !important;'><ul style='background: #ffffff !important;'><li class='listimg bg-white'><img src='$imga' class='img-tiny' onerror.this=src='images/9.png'/></li></ul></div>";
                                                            }
                                                            echo "<div class='end-float'></div>";
                                                          ?>
                                                          
                                                          <div class="tinylink"><?php echo "<a href='".@$shortUrl."'> <i class='fas fa-link'></i> ". @$shortUrl." </a>"; ?></div>
                                                          <div class="undefe">
                                                            <?php echo "<span class='ereferve'><i class='fas fa-user-tag'></i></span> $fFund";?>
                                                          </div>
                                                        </div>
                                                        <div class="bs-example">
                                                          <ul class="nav nav-tabs">
                                                            <li class="nav-item">
                                                              <a href="#home" class="nav-link active" data-toggle="tab">Content</a>
                                                            </li>
                                                            <li class="nav-item">
                                                              <?php 

                                                                $ufc = $con -> prepare("SELECT fundraiserUpdate FROM fundraiserupdate_table WHERE fundraiserId = ? ORDER BY timestatus DESC");
                                                                $ufc -> bindParam(1,$fId);
                                                                $ufc -> execute();
                                                                if($ufc -> execute() && $ufc -> rowCount() > 0) {
                                                                  $ucount = $ufc -> rowCount();
                                                                }else {
                                                                  $ucount = '0';
                                                                }
                                                              ?>
                                                              <a href="#updates" class="nav-link" data-toggle="tab">Updates <span class='counts'><?php echo @$ucount;?></span></a>
                                                            </li>
                                                            <li class="nav-item">
                                                              <a href="#comments" class="nav-link" data-toggle="tab">Comments <span class='counts'><?php $ucountc = new dbh(); $ucountc -> getTotalCommentsCount();?></span></a>
                                                            </li>
                                                          </ul>
                                                          <div class="tab-content">
                                                            <div class="tab-pane bg-white show active" id="home">
                                                              <h4 class="mt-2">Fundraiser content</h4>
                                                              <div class="vvvid">
                                                                <div class="fstory" id='short-st' style="white-space: iniial">
                                                                  <?php echo @$shortStory; ?> <span class="tot">...</span>
                                                                </div>
                                                                <div class="fstory full-story" id='full-st'>
                                                                  <?php 
                                                                    echo @$fStory; 

                                                                    foreach($i as $limga) {
                                                                      $imgf = $limga['uploadedDocument'];
                                                                      echo $miga = "<div class='listimga'><img src='$imgf' class='fida' onerror.this=src='images/9.png'/></div>";
                                                                    }
                                                                  ?> <span class="tot">...</span>
                                                                </div>
                                                              </div>
                                                        <div class="vvvid">
                                                            <div class="fstory" id='short-st'>
                                                                <?php echo @$shortStory; ?> <span class="tot">...</span>
                                                            </div>
                                                            <div class="fstory full-story" id='full-st'>
                                                                <?php echo @$fStory; ?> <span class="tot">...</span>
                                                            </div>
                                                            <div class="read">
                                                                <div class="readmor" id="rmore">Read more...</div>
                                                                <div class="readmor" id="rless">Read less...</div>	
                                                            </div>
                                                            <div class="vido">
                                                                <?php echo @$vframe; ?>
                                                            </div>
                                                        </div>
                                                        <div class="guranteenote">
                                                            <span><i class="fas fa-shield-alt"></i> Fundreza Guarrantee</span>
                                                            <div class="gnote">
                                                                Only donations on our platform are protected by Fundreza Guarrantee
                                                            </div>
                                                        </div>
                                                        <div class="updte">
                                                            <div class="upde">My rother has been released from thehospital</div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="col-55">
                                                        <div class="donate-det">
                                                          <div class="cbtc">
                                                              <div class="ibbtc"><div class="bgcj">Total Donations <span class="und"><strong><?php echo @$ffTotal; ?></strong></span></div></div>
                                                              <div class='float'></div>
                                                            </div>
                                                            <div class="bold">
                                                              <srtong><?php echo @$ffTotal; ?></strong> <span class="font-weigh-bold">raised of <strong><?php echo '$'.@$ffGoal; ?></strong> goal</span>
                                                              <div class="dpbar"></div>
                                                            </div>
                                                            <div class="ctx">
                                                              <div class="ibg"><div class="bgj"> <?php echo @$dBy; ?> <div class="und">donors</div></div></div>
                                                              <div class="ibg"><div class="bgj"><?php echo @$ffShares; ?> <div class="und">shares</div></div></div>
                                                              <div class="ibg"><div class="bgj"><?php echo @$ffFollowers; ?> <div class="und">followers</div></div></div>
                                                            </div>
                                                            <div class="cfbshare">
                                                              <div class="sharebtn"> <a href="<?php echo "https://fundreza.com/share/share-with-family-and-friends/$fId"?>" style="font-weight: bold;font-size: 16px;"><button style="font-weight: bold;font-size: 16px;"  id="shareNow"><i class="fas fa-share"></i> Share </button></a></div>
                                                              <div class="donatebtna"><a href="<?php echo "https://fundreza.com/d/$fiiid/$ftitled/$fbby"; ?>" style="font-weight: bold;font-size: 16px;"><button style="font-weight: bold;font-size: 16px;" id="donateNow"> <i class="fas fa-hand-holding-usd"></i> Donate </button></a></div>
                                                            </div>
                                                            <div class="ctxfd">

                                                              <?php 
                                                  
                                                                require_once'dbh.php';

                                                                $con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
                                                                $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                                                $chs = $con -> prepare("SELECT donatedBy,totaldonAmount,donation_time FROM donation_table WHERE fundraiserId =?");
                                                                $chs ->bindParam(1,$fiiid);
                                                                $chs -> execute();
                                                                if($chs -> execute()) {
                                                                  $rowas = $chs -> fetchAll(PDO::FETCH_ASSOC);
                                                                }
                                                              ?>

                                                              <?php $i = 1; ?>
                                                              <?php foreach ($rowas as $row): $time = $row['donation_time'];
                                                              $diff     = time() - $time;
                                                
                                                              // Time difference in seconds
                                                              $sec     = $diff;
                                                              
                                                              // Convert time difference in minutes
                                                              $min     = round($diff / 60 );
                                                              
                                                              // Convert time difference in hours
                                                              $hrs     = round($diff / 3600);
                                                              
                                                              // Convert time difference in days
                                                              $days     = round($diff / 86400 );
                                                              
                                                              // Convert time difference in weeks
                                                              $weeks     = round($diff / 604800);
                                                              
                                                              // Convert time difference in months
                                                              $mnths     = round($diff / 2600640 );
                                                              
                                                              // Convert time difference in years
                                                              $yrs     = round($diff / 31207680 );
                                                              
                                                              // Check for seconds
                                                              if($sec <= 60) {
                                                                $donationtime = "$sec seconds ago";
                                                              }
                                                              
                                                              // Check for minutes
                                                              else if($min <= 60) {
                                                                if($min==1) {
                                                                  $donationtime = "one minute ago";
                                                                }
                                                                else {
                                                                  $donationtime = "$min minutes ago";
                                                                }
                                                              }
                                                              
                                                              // Check for hours
                                                              else if($hrs <= 24) {
                                                                if($hrs == 1) { 
                                                                  $donationtime = "an hour ago";
                                                                }
                                                                else {
                                                                  $donationtime = "$hrs hours ago";
                                                                }
                                                              }
                                                              
                                                              // Check for days
                                                              else if($days <= 7) {
                                                                if($days == 1) {
                                                                  $donationtime = "Yesterday";
                                                                }
                                                                else {
                                                                  $donationtime = "$days days ago";
                                                                }
                                                              }
                                                              
                                                              // Check for weeks
                                                              else if($weeks <= 4.3) {
                                                                if($weeks == 1) {
                                                                  $donationtime = "a week ago";
                                                                }
                                                                else {
                                                                  $donationtime = "$weeks weeks ago";
                                                                }
                                                              }
                                                              
                                                              // Check for months
                                                              else if($mnths <= 12) {
                                                                if($mnths == 1) {
                                                                  $donationtime = "a month ago";
                                                                }
                                                                else {
                                                                  $donationtime = "$mnths months ago";
                                                                }
                                                              }
                                                              
                                                              // Check for years
                                                              else {
                                                                if($yrs == 1) {
                                                                  $donationtime = "one year ago";
                                                                }
                                                                else {
                                                                  $donationtime = "$yrs years ago";
                                                                }
                                                              }
                                                              ?>   
                                                                
                                                              <div class="ibge">
                                                                <div class="ereferv"><i class='fas fa-user-tag' style='color:#22a349;opacity:.6'></i></div> 
                                                                <div class="hyurf"> <?php echo @$row['donatedBy'];?> <div class="goed"><span class="fft"><?php echo '$'.@$row['totaldonAmount'];?></span><span class="ffd"><?php echo @$donationtime;?></span></div></div>
                                                              </div>
                                                              <?php $i++; ?>
                                                              <?php endforeach; ?>
                                                            </div>
                                                            <div class="donres">
                                                              <div class="ssl"><button><a href="">See all</a></button></div>
                                                              <div class="ssr"><button><a href=""><i class="far fa-star"></i> Top donations</a></button></div>
                                                              <div class="float"></div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>

                            <?php } if($fStory == '' && isset($fundraiserTy) && strip_tags($fundraiserTy) && $fundraiserTy == "individual"){?>
                            <h4 class="text-left mt-5 mb-2">Tell your story</h4>
                            <div class="form-group">
                                <label for="">Why are you fundraising? </label>
                                <div>
                                    <textarea name="fundraiserStory" id="storybody" cols="37" rows="10">
                                        <div class="below">
                        <ul>
                            <li>
                                <i class="fas fa-check"></i> Write your story in simple and easy to understand english 
                            </li>
                            <li> 
                                <i class="fas fa-check"></i> Please go straight to the point
                            </li>
                            <li>
                                <i class="fas fa-check"></i> Highlight reasons why you need this fundraising
                            </li>
                            <li>
                                <i class="fas fa-check"></i> Motivate your donors from your story
                            </li>
                        </ul>    
                    </div>
                    </textarea>
                                </div>
                                
                                <div class="hint">Give authentic and motivating points in your story</div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="funds_btn" name="submit">Update</button>
                            </div>
                            <?php } if($fStory == '' && isset($fundraiserTy) && strip_tags($fundraiserTy) && $fundraiserTy == "non-profit") {?>
                                <h4 class="text-left mt-5 mb-2">Tell your story</h4>
                            <div class="form-group">
                                <label for="">Why are you fundraising? </label>
                                <div>
                                    <textarea name="fundraiserStory" id="storybody" cols="37" rows="10">
                                    <div class="below">
                        <ul>
                            <li>
                                <i class="fas fa-check"></i> Write your story in simple and easy to understand english 
                            </li>
                            <li> 
                                <i class="fas fa-check"></i> Please go straight to the point
                            </li>
                            <li>
                                <i class="fas fa-check"></i> Highlight reasons why you need this fundraising
                            </li>
                            <li>
                                <i class="fas fa-check"></i> Motivate your donors from your story
                            </li>
                        </ul>    
                    </div>
                                    </textarea>
                                </div>
                                
                                <div class="hint">Give authentic and motivating points in your story</div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="funds_btn" name="submit">Update</button>
                            </div>
                            <?php } ?>
                        </form>
                    </div>
                </div>

                <div class="spt">
                    <div class="up"><img src="images/fsupport.png" alt="" class="sp-img"> <h4 class="con mt-2">Tip from Maria, our fundraising support expert</h4><div style="clear:both"></div></div>
                    <div class="below">
                        <ul>
                            <li>
                                <i class="fas fa-check"></i> Write your story in simple and easy to understand english 
                            </li>
                            <li>`   
                                <i class="fas fa-check"></i> Please go straight to the point
                            </li>
                            <li>
                                <i class="fas fa-check"></i> Highlight reasons why you need this fundraising
                            </li>
                            <li>
                                <i class="fas fa-check"></i> Motivate your donors from your story
                            </li>
                        </ul>    
                    </div>
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
      
      
      var prevF = document.getElementById("prevform");
      function preview() {
        prevF.onsubmit = function(event) {
            event.preventDefault();
        }
      var overlay = document.getElementById("overlay");
      var status = document.getElementById("status");
      var btn = document.getElementById("previ");
      var fid = btn.getAttribute("name");
      var fT = btn.getAttribute("value");
      
      if(fid !="" && fT != null) {
          
        //   status2.innerHTML = '....checking';
        //   status2.style.color = 'orange';
          var hr = new XMLHttpRequest();
          hr.open("POST","page.php",true);
          hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
          hr.onreadystatechange = function () {
              if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304) ) {
                  
                status.innerHTML = hr.response;
                  overlay.style.display = 'block';
              }
          }
          hr.send("fundraiserId="+fid+"&fundraiserTitle="+fT);
      }else {
          status2.style.color = 'orange';
          status2.innerHTML = 'name cannot be empty!!';
      }
      
      };

      function closeM() {
        closem = document.getElementById("close");
        closem.parentElement.parentElement.parentElement.style.display ='none';
        closem.parentElement.parentElement.style.display ='none';
        $('.modal-backdrop').remove();
        // window.location.reload(false);
    }


ClassicEditor.create(document.querySelector("#storybody"), {
    toolbar: [
        "heading",
        "|",
        "bold",
        "italic",
        "link",
        "bulletedList",
        "numberedList",
        "blockQuote"
    ],
    heading: {
        options: [
            { model: "paragraph", title: "Paragraph", class: "ck-heading_paragraph" },
            {
                model: "heading1",
                view: "h1",
                title: "Heading 1",
                class: "ck-heading_heading1"
            },
            {
                model: "heading2",
                view: "h2",
                title: "Heading 2",
                class: "ck-heading_heading2"
            }
        ]
    }
}).catch(error => {
    console.log(error);
});

    </script>
    </body>
</html>