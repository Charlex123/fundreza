<?php
ob_start();
session_start();
require_once'../dbh.php';
require_once'../config.php';

@$_SESSION['currentpage'] = $_SERVER['REQUEST_URI'];
strip_tags(@$_SESSION['currentpage']);

$user_data = @$_SESSION['user'];
$userid = $user_data['id'];
$name = @$user_data['fname'];


if(!isset($_SESSION['user'])) {
    header('Location:login');
    exit();
}else {
    $user_data = @$_SESSION['user'];
    $userid = $user_data['id'];
    $name = @$user_data['uname'];
    $lname = @$user_data['full_name'];
    $clientCountry = @$user_data['userCountry'];
    $countryFlag = @$user_data['countryFlag'];
    $email_of_user = @$user_data['email'];
    $investment_type = @$user_data['investment_type'];

    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    if($page == 0) {
        $page = 1;
    }
    $limit = 10;
    $start = ($page - 1) * $limit;
    $con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;", $serverusername, $serverpassword);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // $xxxx = $con->prepare("SELECT id,email_of_ad_poster,category FROM items_childrentable LIMIT $start,$limit");
    // $xxxx -> execute();
    // if($xxxx -> execute()) {
    //     $ccal = $xxxx -> fetchAll(PDO::FETCH_ASSOC);
        
    // }


    // $xxxxd = $con->prepare("SELECT count(id) AS id FROM items_childrentable");
    // $xxxxd -> execute();
    // if($xxxxd -> execute()) {
    //     $count = $xxxxd -> fetchAll(PDO::FETCH_ASSOC);
    //     $totalcount = $count[0]['id'];
    //     $pages = ceil($totalcount / $limit); 
    //     $Previous = $page - 1;
    //     $Next = $page + 1;
    // }
    ob_end_flush();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title> Bitcoin News Today  | My Account </title>

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
  <!-- theme stylesheet-->
  <!-- <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet"> -->
  <!-- Favicon-->
  <link rel="shortcut icon" href="../images/btclogo.png">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script lang="javascript" type="text/javascript" src="../javascript/jquery-3.2.1.js"></script>
  <script lang="javascript" type="text/javascript" src="../javascript/jquery.min.js"></script>
  <!-- Bootstrap CSS-->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <script lang="javascript" type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
  
  <!-- Font Awesome CSS-->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css" integrity="sha512-OdEXQYCOldjqUEsuMKsZRj93Ht23QRlhIb8E/X0sbwZhme8eUw6g8q7AdxGJKakcBbv7+/PX0Gc2btf7Ru8cZA==" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/regular.min.css" integrity="sha512-Nqct4Jg8iYwFRs/C34hjAF5og5HONE2mrrUV1JZUswB+YU7vYSPyIjGMq+EAQYDmOsMuO9VIhKpRUa7GjRKVlg==" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css" integrity="sha512-jQqzj2vHVxA/yCojT8pVZjKGOe9UmoYvnOuM/2sQ110vxiajBU+4WkyRs1ODMmd4AfntwUEV4J+VfM6DkfjLRg==" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/svg-with-js.min.css" integrity="sha512-W3ZfgmZ5g1rCPFiCbOb+tn7g7sQWOQCB1AkDqrBG1Yp3iDjY9KYFh/k1AWxrt85LX5BRazEAuv+5DV2YZwghag==" crossorigin="anonymous" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" integrity="sha512-RXf+QSDCUQs5uwRKaDoXt55jygZZm2V++WUZduaU/Ui/9EGp3f/2KZVahFZBKGH0s774sd3HmrhUy+SgOFQLVQ==" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/brands.min.css" integrity="sha512-apX8rFN/KxJW8rniQbkvzrshQ3KvyEH+4szT3Sno5svdr6E/CP0QE862yEeLBMUnCqLko8QaugGkzvWS7uNfFQ==" crossorigin="anonymous" />	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css" />
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="../css/adminlte.min.css?n=1">
  <link rel="stylesheet" href="../css/customs.css?n=1">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	<script lang="javascript" type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
	<!-- Font Awesome CSS-->
	<link rel="stylesheet" type='text/css' href="../fontawesome/fontawesomefiles/css/fontawesome.min.css">
	<link rel="stylesheet" type='text/css' href="../fontawesome/fontawesomefiles/css/all.min.css">
	<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
	<script lang="javascript" type="text/javascript" src="../fontawesome/fontawesomefiles/js/fontawesome.min.js"></script>
	<script lang="javascript" type="text/javascript" src="../fontawesome/fontawesomefiles/js/all.min.js"></script>
	<!-- inject:css -->
  
  <style>
    .inner {
    display: inline-block;width: 100%;padding-left: 0;margin-left: 0;padding-right: 0;margin-right: 0;
    }
    .inner .col-inn {
        display: inline-block;padding: 0;margin: 0;width: 48%;
    }
    .inner .col-inn#ffn {
        margin-left: 0;margin-right: 1%;
    }
    .inner .col-inn#lln {
        margin-right: 0;margin-left: 1%;
    }
    /* .content-wrapper {
      width: 90% !important;position: relative;margin: 1rem auto;background: red;
    } */
  </style>
</head>
<body>

<?php
      require_once'../config.php';
      $country = $con-> prepare("SELECT userCountry,countryFlag,uname,invite_id FROM users WHERE id = ? ");
      $country -> bindParam(1,$user_data['id']);
      $nm = $con-> prepare("SELECT uname FROM users");
      $nm -> execute();
      if($country -> execute()) {
          $flag = $country -> fetch(PDO::FETCH_ASSOC);
          $client_Country = $flag['userCountry'];
          $client_flag = $flag['countryFlag'];
          $clientfname = $flag['uname'];
          $client_Flag = 'images/pngflags/'.$client_flag;
          $newmembers = $nm -> rowCount();
          $n = $flag['uname'];
          $nr = $flag['invite_id'];
          if(isset($n)) {
              $med = $n;
          }else{
              $med = $nr;
          }
        }

        
  ?>

<!-- Main Sidebar Container -->
<div class="sidebar" id="mySidebar">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="images/favicon.png" alt="logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">HELPFUNDME</span>
    </a>

    <!-- Sidebar -->
    <div class="">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <?php require_once'../dbh.php'; $p_pix = new dbh(); $p_pix -> fetchUserProfilePics(); ?>
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo @$clientfname?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php 
            
          echo "<li class='nav-item'>
                  <a class='nav-link' href='dashboard.php?client=$med' target='_blank'>
                   <i class='fas fa-tachometer-alt nav-icon icc'></i> DASHBOARD 
                  </a>
                </li>";
          echo "<li class='nav-item has-treeview menu-open'>
            <ul class='nav nav-treeview'>
              <li class='nav-item'>
                <a href='../choose-type.php' target='_blank' class='nav-link nf text-white font-weight-bold'>
                  <i class='fas fa-dollar-sign'></i>
                  Start A New Fundraiser
                </a>
              </li>
              <li class='nav-item'>
                <form action='' method='post'>
                  <button type='submit' name='myFundraisers' class='nav-btn border-0 pr-5 pl-3 text-left'> <i class='fas fa-donate'></i> Your Fundraisers </button>
                </form>
              </li>
            </ul>
          </li>
          <li class='nav-item ml-2'>
            <form action='' method='post'>
              <button type='submit' name='shareFundraisers' class='border-0 bg-transparent ml-2'> <i class='fas fa-share nav-icon icc'></i> SHARE </button>
            </form>
          </li>
          <li class='nav-item'><a class='nav-link' href='profile-details.php?client=$med' target='_blank'> <i class='fas fa-user nav-icon icc'></i> PERSONAL PROFILE </a></li>
          <li class='nav-item'><a class='nav-link' href='../mywithdrawals/setwithdrawal.php' target='_blank'> <i class='fas fa-credit-card nav-icon icc'></i> REQUEST WITHDRAWAL </a></li>
          <li class='nav-item'><a class='nav-link' href='../mywithdrawals/withdrawalhistory.php?client=$med' target='_blank'> <i class='fas fa-clock nav-icon icc'></i> WITHDRAWAL HISTORY </a></li>
          </li>";
          ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </div>

<div class="wrapper" id="main">
  <!-- Navbar -->
  
  <nav class="navbar navbar-expand" style="width: 100%;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item mr-4">
        <span id="toggleSideBar" clas='ml-5 text-dark' onclick="openNav()" role="button"><i class="fas fa-bars text-dark"></i></span> <span id="closeSideBar" style="display: none;" onclick="closeNav()" role="button"><i class="fas fa-times text-dark"></i></span>
      </li>
      <a href=""> <img src="../images/favicon.png" alt="" class="nav-logo"> </a>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../account/dashboard.php" class="nav-link nf"><i class="fas fa-angle-left"></i> Back to dashboard</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="nav-menu list-unstyled ml-auto d-flex flex-md-row align-items-md-center">
      <li class="nav-item d-none d-sm-inline-block">
        <form action="" method="post">
          <button type="submit" name="requestWithdrawal" class="bg-transparent border-0"> <i class='fas fa-credit-card'></i> Withdrawal </button>
        </form>
      </li>  
      <!-- Languages dropdown    -->
      <li class="nav-item dropdown"><a id="settings" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link language"><span class=''><?php require_once'../dbh.php'; $p_pix = new dbh(); $p_pix -> fetchUserProfilePics(); ?> <span> <?php echo @$clientfname?></span></span><i class='fas fa-angle-down'></i></a> 
        <div class="dropdown-m">
          <ul aria-labelledby="languages" class="dropdown-menu"> </li>
            <?php if(isset($_SESSION['currentpage']) && $_SESSION['currentpage'] == "../account/dashboard.php?client=69456") {?>
              <li>
                        <a class='text-decoration-none rounded text-white'> 
                          <form action='' method='post'>
                            <button type='submit' name='myFundraisers' class='nav-btn m-2 border-0 pr-5 pl-3 text-left' style='white-space: nowrap'> <i class='fas fa-donate'></i> Your Fundraisers </button>
                          </form> 
                        </a>
                    </li>
        
                    <li><a href='' class='text-decoration-none rounded text-dark p-2 m-2'> <i class='fas fa-hand-holding-usd icc'></i> <span class='d-none d-sm-inline-block'>Donations You Have Made</span> </a></li>
                    <li><a href='../choose-type.php' class='text-decoration-none rounded text-white nf p-2 m-2'> <i class='fas fa-dollar-sign icc text-white'></i> <span class='d-none d-sm-inline-block'>Start A New fundraiser</span> </a></li>
                    
                    <li><a href='../account/profile-details.php' class='text-decoration-none rounded text-dark p-2 m-2'> <i class='fas fa-user icc'></i> <span class='d-none d-sm-inline-block'>Account Profile</span> </a></li>
                    <li><a href='../account/kyc-documents.php' class='text-decoration-none rounded text-dark p-2 m-2'> <i class='fas fa-user icc'></i> <span class='d-none d-sm-inline-block'> Upload Id Documents</span> </a></li>
                    <li><a href='../help/support.php' class='text-decoration-none rounded text-dark p-2 m-2'> <i class='fas fa-question icc'></i> <span class='d-none d-sm-inline-block'>Support </span> </a></li>
            <?php }else {
              echo "<li>
                        <a class='text-decoration-none rounded text-white'> 
                          <form action='' method='post'>
                            <button type='submit' name='myFundraisers' class='nav-btn m-2 border-0 pr-5 pl-3 text-left' style='white-space: nowrap'> <i class='fas fa-donate'></i> Your Fundraisers </button>
                          </form> 
                        </a>
                    </li>
        
                    <li><a href='' class='text-decoration-none rounded text-dark p-2 m-2'> <i class='fas fa-hand-holding-usd icc'></i> <span class='d-none d-sm-inline-block'>Donations You Have Made</span> </a></li>
                    <li><a href='../choose-type.php' class='text-decoration-none rounded text-white nf p-2 m-2'> <i class='fas fa-dollar-sign icc text-white'></i> <span class='d-none d-sm-inline-block'>Start A New fundraiser</span> </a></li>
                    
                    <li><a href='../account/profile-details.php' class='text-decoration-none rounded text-dark p-2 m-2'> <i class='fas fa-user icc'></i> <span class='d-none d-sm-inline-block'>Account Profile</span> </a></li>
                    <li><a href='../account/kyc-documents.php' class='text-decoration-none rounded text-dark p-2 m-2'> <i class='fas fa-user icc'></i> <span class='d-none d-sm-inline-block'> Upload Id Documents</span> </a></li>
                    <li><a href='../help/support.php' class='text-decoration-none rounded text-dark p-2 m-2'> <i class='fas fa-question icc'></i> <span class='d-none d-sm-inline-block'>Support </span> </a></li>
                  ";
            }
              ?>  
              <!-- Logout    -->
            <li><a href="../logout"  aria-haspopup='true' aria-expanded='false' class="dropdown-item logout"> <i class="fas fa-sign-out-alt"></i> <span class="d-none d-sm-inline-block">Logout</span></a></li>
          </ul>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapperr">

    <div class="content-header taxt-center mt-0">
      <!-- TradingView Widget BEGIN -->
    <div class="tradingview-widget-container pt-0" style="position:relative;">
      <marquee>
          <ul>
              </ul>
      </marquee>
    </div>
    
    <!-- TradingView Widget END -->
      
      
    <!-- /.content-header -->
    <div class="wrapper-c">
      <?php require_once'../config.php';
            require_once'../dbh.php';
            $con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $ch = $con -> prepare("SELECT * FROM fundraiser_table WHERE fundraiserEmail = ? ORDER BY dateSubmitted DESC");
            $ch ->bindParam(1,$Email);
            $ch -> execute();

            if($ch -> execute() && $ch -> rowCount() > 0) {
              $s = $ch -> fetch(PDO::FETCH_ASSOC);
              @$fId = $s['fundraiserId'];
              @$fTitle = $s['fundraiserTitle'];
              @$fType = $s['fundraiserType'];
              @$fFor = $s['fundraiserFor'];
              @$fBy = $s['fundraiserBy'];
              @$fStory = $s['fundraiserStory'];
              @$fCateg = $s['fundraiserCategory'];
              @$fThumb = $s['fundraiserThumbnail'];
              @$fGoal = $s['fundraiserGoal'];
              $fDonations = $s['fundraiserdonationsReceived'];
              $fSupportTip = $s['supportTipReceived'];
              $fTotalDonations = $s['totaldonationsReceived'];
              $fbtcDonations = $s['bitcoinDonation'];
              $fbtcTotalDonations = $s['totalBitcoinDonations'];
              @$fStatus = $s['fundraiserStatus'];
              @$fShares = $s['totalShares'];
              @$fViews = $s['totalViews'];
              @$fLikes = $s['totalLikes'];
              @$fFollowers = $s['totalFollowers'];
              @$dateSub = $s['dateSubmitted'];
              @$flUrl = $s['longString'];

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

              $shortUrl = "https://fundraiser.com/$fId";
              $longUrl = "https://fundraiser.com/$fId/$ftitled/$flUrl";
              if($fDonations == "" || $fDonations == null) {
                $fiat = '$0';
              }else {
                $fiat = '$'.$fDonations;
              }if($fbtcDonations == "" || $fbtcDonations == null) {
                $btc = '$0';
              }else {
                $btc = '$'.$fbtcDonations;
              }if($fTotalDonations == "" || $fTotalDonations == null) {
                echo $fTotal = '$0';
              }else {
                echo $fTotal = '$'.$fTotalDonations;
              }
              
            }

            $dType = "video";
            $vf = $con -> prepare("SELECT uploadedDocument FROM documentuploads WHERE fundraiserId = ? AND documentType = ? ORDER BY time_uploaded DESC");
            $vf -> bindParam(1,$fId);
            $vf -> bindParam(2,$dType);
            $vf -> execute();
            if($vf -> execute() && $vf -> rowCount() > 0) {

              $v= $vf -> fetch(PDO::FETCH_ASSOC);
              @$vid = $v['uploadedDocument'];

              $vframe = "<video src='$vid' controls></video>";
            }else if(isset($_GET['fundraiserId'])) {
              $fid = htmlspecialchars($_GET['fundraiserId']);
              $ch = $con -> prepare("SELECT * FROM fundraiser_table WHERE fundraiserId = ?");
              $ch ->bindParam(1,$fid);
              $ch -> execute();
    
              if($ch -> execute() && $ch -> rowCount() > 0) {
                $s = $ch -> fetch(PDO::FETCH_ASSOC);
                @$fId = $s['fundraiserId'];
                @$fTitle = $s['fundraiserTitle'];
                @$fType = $s['fundraiserType'];
                @$fFor = $s['fundraiserFor'];
                @$fBy = $s['fundraiserBy'];
                @$fStory = $s['fundraiserStory'];
                @$fCateg = $s['fundraiserCategory'];
                @$fThumb = $s['fundraiserThumbnail'];
                @$fGoal = $s['fundraiserGoal'];
                $fDonations = $s['fundraiserdonationsReceived'];
                $fSupportTip = $s['supportTipReceived'];
                $fTotalDonations = $s['totaldonationsReceived'];
                $fbtcDonations = $s['bitcoinDonation'];
                $fbtcTotalDonations = $s['totalBitcoinDonations'];
                @$fStatus = $s['fundraiserStatus'];
                @$fShares = $s['totalShares'];
                @$fViews = $s['totalViews'];
                @$fLikes = $s['totalLikes'];
                @$fFollowers = $s['totalFollowers'];
                @$dateSub = $s['dateSubmitted'];
                @$flUrl = $s['longString'];
    
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
    
                $shortUrl = "https://fundraiser.com/$fId";
                $longUrl = "https://fundraiser.com/$fId/$ftitled/$flUrl";
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
                }else {
                  $fTotal = '$'.$fTotalDonations;
                }
                
              }
              
              $dType = "video";
              $vf = $con -> prepare("SELECT uploadedDocument FROM documentuploads WHERE fundraiserId = ? AND documentType = ? ORDER BY time_uploaded DESC");
              $vf -> bindParam(1,$fId);
              $vf -> bindParam(2,$dType);
              $vf -> execute();
              if($vf -> execute() && $vf -> rowCount() > 0) {
    
                $v= $vf -> fetch(PDO::FETCH_ASSOC);
                @$vid = $v['uploadedDocument'];
    
                $vframe = "<video src='$vid' controls></video>";
              }
            }
      ?>

      <div class="sfund">
        <div class="row text-center rowcc">
          <div class="col-md-3">
            <a class="nfu1" href="../choose-type.php"><i class="fas fa-dollar-sign"></i> Start A New Fundraiser</a>
          </div>

          <div class="col-md-3">
            <form action="../account/dashboard.php" method="post">
              <button type="submit" name="myFundraisers" class="nfu2"> <i class="fas fa-donate"></i> Your Fundraisers </button>
            </form>  
          </div>

          <div class="col-md-3 fru">
            <form action="../account/dashboard.php" method="post">
              <button type="submit" name="shareFundraisers" class="nfu3"> <i class="fas fa-share"></i> Share </button>
            </form>
            <div class="fup">Share your fundraiser to increase donations</div>
          </div>

          <div class="col-md-3 fru">
            <form action="setwithdrawal.php" method="post">
              <button type="submit" name="requestWithdrawal" class="nfu4"> <i class='fas fa-credit-card'></i> Request Withdrawal </button>
            </form>
            <div class="fup">Set up your withdrawal method</div>
          </div>


        </div>
      </div>

            <?php if(isset($_POST['setWithd2'])) {?>
              <div class="w-f">

                  <div class="cet"><h4>Connect bank account</h4></div>

                  <form action="verify-bank-info.php" method="POST" class="form-validate text-center">
                      
                  <div class="bnk-info">Bank Information</div>
                      <div class="form-group">
                          <label for="">Routing number</label>
                          <input id="fname" type="text" name="Fname" required placeholder="Enter your first name" value="<?php echo @$_POST['Fname']?>" class="form-control">
                      </div>

                      <div class="form-group">
                          <label for="">Account number</label>
                          <input id="fname" type="text" name="Fname" required placeholder="Enter your first name" value="<?php echo @$_POST['Fname']?>" class="form-control">
                      </div>

                      <div class="form-group">
                          <label for="">Bank name</label>
                          <input id="fname" type="text" name="Fname" required placeholder="Enter your first name" value="<?php echo @$_POST['Fname']?>" class="form-control">
                      </div>

                      <div class="form-group">
                          <label for="">Account type</label>
                          <select name='investment_currency' id='investment-cur' class="form-control">
                              <option value=''> -Select account type- </option>
                              <option value='Pounds'> Savings Account</option>
                              <option value='Dollar'> Checking Account</option>
                              <option value='Euro'> Corporate Account</option>
                              <option value='Euro'> Money Market Account</option>
                              <option value='Euro'> Fixed Deposit</option>
                          </select>
                      </div>

                      <div class="form-group">
                          <label for="">Bank Country</label>
                          <input id="fname" type="text" name="Fname" required placeholder="Enter your first name" value="<?php echo @$_POST['Fname']?>" class="form-control">
                      </div>

                      <div class="divide text-left">
                          Account Owner Information
                      </div>

                      <div class="form-group">
                          <label for="">First name</label>
                          <input id="fname" type="text" name="Fname" required placeholder="Enter your first name" value="<?php echo @$_POST['Fname']?>" class="form-control">
                      </div>

                      <div class="form-group">
                          <label for="">Last name</label>
                          <input id="fname" type="text" name="Fname" required placeholder="Enter your first name" value="<?php echo @$_POST['Fname']?>" class="form-control">
                      </div>

                      <div class="form-group">
                          <label for="">Street address</label>
                          <input id="fname" type="text" name="Fname" required placeholder="Enter your first name" value="<?php echo @$_POST['Fname']?>" class="form-control">
                      </div>

                      <div class="form-group">
                          <label for="">City</label>
                          <input id="fname" type="text" name="Fname" required placeholder="Enter your first name" value="<?php echo @$_POST['Fname']?>" class="form-control">
                      </div>

                      <div class="form-group inner">
                        <div class="col-inn" id="ffn">
                          <label for="">State </label>
                          <input id="fname" type="text" name="Fname" required placeholder="Enter your first name" value="<?php echo @$_POST['Fname']?>" class="form-control">
                        </div>
                        <div class="col-inn" id="lln">
                          <label for="">Zip code</label>
                          <input id="lname" type="text" name="Lname" required placeholder="enter your last name" value="<?php echo @$_POST['Lname']?>" class="form-control">
                        </div>
                      </div>

                      <div class="form-group">
                          <label for=""> Country </label>
                          <select name='investment_currency' id='investment-cur' class="form-control">
                              <option value=''> -Select account type- </option>
                              <option value='Pounds'> Savings Account</option>
                              <option value='Dollar'> Checking Account</option>
                              <option value='Euro'> Corporate Account</option>
                              <option value='Euro'> Money Market Account</option>
                              <option value='Euro'> Fixed Deposit</option>
                          </select>
                      </div>

                      <div style='clear:both'></div>
                      <div class="form-group mx-auto text-center">
                        <button id="register" type="submit" name="verifyBank" class="nf font-weight-normal mx-auto" id='submit_account'>Connect</button>
                        <div><em>Your banking details will never be shared with any third party</em></div>
                      </div>

                      <div class="sml">
                        <div class="gbk">
                          <a href=""><small><i class="fas fa-question-circle"></i> <b>Need Help?</b></small></a>
                        </div>
                        <div class="gbk">
                          <a href="withdraw-type"> Go back</a>
                        </div>
                        <div class="gbk">
                          <button type="reset" class="nav-btn text-white w100"> cancel </button>
                        </div>
                      </div>

                  </form>
              </div>
            <?php }?>
            
      <div class="mfr">
            <?php require_once'../dbh.php';require_once'../config.php';
              if(isset($_POST['myFundraisers'])) {
                $mfr = new dbh(); $mfr -> myFundraisers();
              }
            ?>
      </div>

      
      <div class="mfr">
            <?php require_once'../dbh.php';require_once'../config.php';
              if(isset($_POST['delFundraiser'])) {
                $fif = $_POST['delFundraiser'];
                $con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
                $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $dl = $con -> prepare("DELETE FROM fundraiser_table WHERE fundraiserId = ? ");
                $dl ->bindParam(1,$fif);
                $dl -> execute();
                if($dl -> execute() ) {

                }
              }
            ?>
      </div>

      <div class="mfr">
            <?php require_once'../dbh.php';require_once'../config.php';
              if(isset($_POST['shareFundraisers'])) {
                $mfr = new dbh(); $mfr -> shareFundraisers();
              }
            ?>
      </div>

      <div class="mfr">
            <?php require_once'../dbh.php';require_once'../config.php';
              if(isset($_POST['requestWithdrawal'])) {
                $con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
                $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $chk = $con -> prepare("SELECT * FROM donation_table WHERE fundraiserEmail = ? ");
                $chk ->bindParam(1,$email_of_user);
                $chk -> execute();

                if($chk -> execute() && $chk -> rowCount() > 0) {
                
            ?>
            <div class="no-d text-center">
                  You don't have any donations yet 
                  <form action="" method="post">
                    <button type="submit" name="shareFundraisers" class=""> <i class="fas fa-share"></i> Share  To Get Your First Donation </button>
                  </form>
                  <div class="shnd"> You need to receive at least one donation to set up your withdrawal method</div>
            </div>
            <?php } if($chk -> execute() ){?>

              <div class="w-intro-head">
                <div class="pt-af wt">
                  Total funds raised (after <a href="">fees</a>)
                  <div class="tf"><?php echo @$fTotal;?></div>
                </div>
                <div class="set-w wt">
                  <form action="withdrawal-type.php" method="POST">
                    <button type="submit" name="setWidth" class="nf"> <i class='fas fa-credit-card'></i> Set Up Withdrawal Method</button>
                  </form>
                </div><div class="end-float"></div>
              </div>

              <div class="w-r">
                <div class="cet"><h4>Please review these guidelines:</h4></div>
                <ul>
                  <li>
                      <i class="fas fa-check"></i> You must set up your widthdrawal within 30 days of receiving your first donation or your donation will be paused
                  </li>
                  <li>
                      <i class="fas fa-check"></i> If you do not set up widthdrawal within 90 days of receiving your first donation, <span class="font-weight-bold">all donations will be refunded</span>
                  </li>
                  <li>
                      <i class="fas fa-check"></i> Setting up your withdrawals will not pause or end your campaign. Your fundraiser campaign will continue to receive donations
                  </li>
                  <li>
                      <i class="fas fa-check"></i> Withdrawals to a bank account may take up to 5 - 10 business days after set up.
                  </li>
                  <li>
                      <i class="fas fa-check"></i> Need someone to withdraw for you, no problems, just grant them access in your next step by selecting <span class="font-weight-bold">someone</span> 
                  </li>
                </ul>
              
                <div class="sml">
                  <div class="gbk">
                    <a href=""><small><i class="fas fa-question-circle"></i> <b>Need Help?</b></small></a>
                  </div>
                  <div class="gbk">
                    <a href="withdrawal-type.php"> Go back</a>
                  </div>
                  <div class="gbk">
                    <button type="reset" class="nav-btn text-white w100"> cancel </button>
                  </div>
                </div>
                
              </div>

              
            <?php  } }?>
      </div>


      <div class="mfu">
        <div class="modal" id="manageF">
            <div class="close-now"><i class="fas fa-times" id="close" onclick = "closeM()"></i></div>
            <div class="modal-content">
              <h4>Manage Fundraiser</h4>
              <div class='con' id='drpn'></div>
            </div>
        </div>
      </div>

      <div class="mfu">
        <div class="modal" id="upF">
              <div class="modal-content">
                <h4>Update Fundraiser Progress</h4>
                <form action="" method="POST" id="prvsub">
                  <div class="form-group" id="form-g">
                    <label for="">Progress report <i class="fas fa-question-circle"></i> <div class="tooltipa"> Name of the person you are fundraising for!, enter your name if you are fundraisng for yourself</div></label>
                    <textarea name="fUpdate" id="textarea"  cols="30" rows="10" maxlength="350" class="form-control" placeholder="enter fundraiser progress report"></textarea>
                    <span class="err" id="err"></span>
                  </div>
                  <div class="form-group">
                    <div class="eas">
                      <input type="checkbox" name="" id=""> Send update to donors
                    </div>
                    <div class="eas">
                      <input type="checkbox" name="" id=""> Send update to everyone
                    </div>
                    <div class="eas">
                      <input type="checkbox" name="" id=""> Send update only to followers
                    </div>
                  </div>
                  <input name="submit" class="mx-auto text-center nav-btn w75 sbn" id="preSub" value="submit" onclick="prevSubmit()">
                </form>
              </div>
        </div>
      </div>

    </div>
  </div>
  <!-- /.content-wrapper -->



  <!-- Main Footer -->
  <!--// Footer Widget//-->
	<div class="footer-widget">
      <!-- Footer  -->
      
      <!--// Footer CopyRights //-->
      <footer class="footer-main">
          
          <div class="col-12 footer-intro mt-2 mb-5 pt-2 pb-3">
            <div class="footer-head">
              <div class="container">
                <div class="row">
                  
                  <div class="col-md-3 mt-5">
                      <img src="../images/favicon.png" alt="" class="footer-logo">
                      <div class="">
                        <p>
                          Helpfundme platform enables anyone to raise funds for their urgent needs
                        </p>
                      </div>
                  </div>


                  <div class="col-md-3 mt-5">
                    <h2> <i class="fas fa-donate"></i> FUNDRAISE FOR </h2>
                    <div class=""></div>
                    <div class="clear-fix" style='clear: both'></div>
                    <ul>
                      <li class='list-item'>
                        <a href="how-btc-works">Political Campaign</a>
                      </li>
                      <li class='list-item'>
                        <a href="my-btc-story" target="_blank">Medical Bills</a>
                      </li>
                      <li>
                        <a href="terms">Business</a>
                      </li> 
                      <li>
                        <a href="terms">Talent & Idea</a>
                      </li> 
                      <li>
                        <a href="terms">Education</a>
                      </li> 
                      <li>
                        <a href="terms">Rents & Bills</a>
                      </li> 
                      <li>
                        <a href="terms">Nonprofit & Charity</a>
                      </li> 
                      <li>
                        <a href="terms">Arts, Music & Film</a>
                      </li> 
                      <li>
                        <a href="terms">Travel</a>
                      </li> 
                      <li>
                        <a href="terms">Accidents & Emergency</a>
                      </li>
                      <li>
                        <a href="terms">Covid-19 Funds</a>
                      </li> 
                    </ul>
                  </div>

                  <div class="col-md-3 mt-5">
                    <h2> <i class="fas fa-book-reader"></i> MORE INFO</h2>
                    <div class="clear-fix" style='clear: both'></div>
                    <ul>
                      <li class='list-item'>
                        <a href="">How Helpfundme Works</a>
                      </li>
                      <li class='list-item'>
                        <a href="createaccount" target="_blank">Why Helpfundme</a>
                      </li>
                      <li class='list-item'>
                        <a href="createaccount" target="_blank">Blogs</a>
                      </li>
                      <li class='list-item'>
                        <a href="createaccount" target="_blank">Withdrawals</a>
                      </li>
                      <li class='list-item'>
                        <a href="createaccount" target="_blank">Frequently Asked Questions</a>
                      </li>
                      <!--//  <li>
                        <a href="terms">Terms & Conditions</a>
                      </li> //-->
                    </ul>
                  </div>

                  <div class="col-md-3 mt-5">
                    <h2> <i class="fas fa-info-circle"></i> REACH OUT</h2>
                    <div class="clear-fix" style='clear: both'></div>
                    <ul>
                      <li class='list-item'>
                        <a href=""> <i class="fas fa-phone"></i> Speak with us</a>
                      </li>
                      <li class='list-item'>
                        <a href="createaccount" target="_blank"><i class="fas fa-envelope"></i> Contact us</a>
                      </li>
                      <li class='list-item'>
                        <a href="createaccount" target="_blank"> <i class="fas fa-question"></i> Help Center</a>
                      </li>
                      <li class='list-item'>
                        <a href="createaccount" target="_blank"> <i class="fas fa-link"></i> About</a>
                      </li>
                      <li class='list-item'>
                        <a href="createaccount" target="_blank"> <i class="fas fa-link"></i> Helpfundme Community</a>
                      </li>
                    </ul>
                  </div>
                </div>
              
              </div>
            </div>
          </div>

          
          <div class="container text-center mt-5 pt-3 mb-3 mx-auto copywright">
            <div class="foot-sh">
              <div class="socials"><a href="https://facebook.com"><i class="fab fa-facebook fa-2x"></i></a> <a href="https://youtube.com"><i class="fab fa-youtube fa-2x"></i></a> <a href="https://instagram.com"><i class="fab fa-instagram fa-2x"></i></a> <a href="https://twitter.com"><i class="fab fa-twitter fa-2x"></i></a> <a href="https://wa.me"><i class="fab fa-whatsapp fa-2x"></i></a></div>
            </div>
            <div class="terms">
              <ul>
                <li>
                  <a href="terms">Terms</a>
                </li>
                <li>
                  <a href="pirvacy-policy">Privacy Policy</a>
                </li>
              </ul>
            </div>
            <div class="text-center mx-auto">
              <div class="text-center">Copyright ©2021 Helpfundme.org - All Rights Reserved</div>
            </div>
          </div>

        </footer>
      </div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="../dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="../../plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="../plugins/raphael/raphael.min.js"></script>
<script src="../plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- JavaScript files-->
<script lang="javascript" type="text/javascript" src="../javascript/jquery.min.js"></script>
<script src="../javascript/popper.js/umd/popper.min.js"> </script>
<script lang="javascript" type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../javascript/jquery.cookie/jquery.cookie.js"> </script>
<script src="../javascript/jquery-validation/jquery.validate.min.js"></script>
<script src="../javascript/charts-custom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"></script>
<!-- Initialize Swiper -->
<script type="text/javascript">

</script>
<!-- <script src="javascript/front.js?n=1"></script>
<script src="javascript/home.js?n=1"></script> -->
<script src="../javascript/dashboard.js?n=1"></script>
<script src="../javascript/front.js?n=1"></script>
<!-- <script src="javascript/livechart.js"></script> -->

<!-- PAGE SCRIPTS -->
<script src="../dist/js/pages/dashboard2.js"></script>
</body>
</html>
