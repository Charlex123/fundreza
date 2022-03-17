<?php
ob_start();
session_start();
require_once'dbh.php';
require_once'config.php';

@$_SESSION['currentpage'] = $_SERVER['REQUEST_URI'];
strip_tags(@$_SESSION['currentpage']);

$user_data = @$_SESSION['user'];
$userid = $user_data['id'];
$name = @$user_data['fname'];


if(!isset($_SESSION['user'])) {
    header('Location:login');
    exit();
}else if(isset($_SESSION['user'])) {
  $con = new PDO("mysql:host=$serverhost;dbname=bitcsvxl_213;", $serverusername, $serverpassword);
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $rw = $con->prepare("SELECT id,email_of_ad_poster,category FROM items_childrentable LIMIT $start,$limit");
  $rw -> execute();
  if($rw -> execute()) {
      $w = $rw -> fetchAll(PDO::FETCH_ASSOC);
      
  }

}else{
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
    $con = new PDO("mysql:host=$serverhost;dbname=bitcsvxl_213;", $serverusername, $serverpassword);
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
  <link rel="shortcut icon" href="images/btclogo.png">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script lang="javascript" type="text/javascript" src="javascript/jquery-3.2.1.js"></script>
  <script lang="javascript" type="text/javascript" src="javascript/jquery.min.js"></script>
  <!-- Bootstrap CSS-->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script lang="javascript" type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
  <!-- Font Awesome CSS-->
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

<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="css/adminlte.min.css">
  <link rel="stylesheet" href="css/customs.css">
  <style>
    
    .swiper-container {
      width: 100%;
      height: 100%;
      background-color: #ffffff;
    }

    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;
      padding: 1rem;
      /* Center slide text vertically */
      display: -webkit-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      -webkit-justify-content: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      -webkit-align-items: center;
      align-items: center;
    }
    .swiper-slide .shotset {
      width: 100%;max-height: 25rem;height: 25rem;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand">
    <!-- Left navbar links -->
    <?php
      require_once'config.php';
      $country = $con->prepare("SELECT userCountry,countryFlag,uname FROM users WHERE id = ? ");
      $country -> bindParam(1,$user_data['id']);
      $nm = $con->prepare("SELECT uname FROM users");
      $nm -> execute();
      if($country -> execute()) {
          $flag = $country -> fetch(PDO::FETCH_ASSOC);
          $client_Country = $flag['userCountry'];
          $client_flag = $flag['countryFlag'];
          $clientfname = $flag['uname'];
          $client_Flag = 'images/pngflags/'.$client_flag;
          $newmembers = $nm -> rowCount();
          $n = $flag['uname'];
          if(isset($n)) {
              $med = $n;
          }else{
              $med = $nr;
          }
        }

        
      ?>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="home" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="invest" class="nav-link">Invest</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Assets</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="nav-menu list-unstyled ml-auto d-flex flex-md-row align-items-md-center">
      <!-- Client Profile pics-->
      <li class="nav-item d-flex align-items-center"><div class='client'><?php require_once'dbh.php'; $p_pix = new dbh(); $p_pix -> fetchUserProfilePics(); ?> <span> <?php echo @$clientfname?></span></div></li>
      <!-- Client Country-->
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link"> Personal Profile </a>
      </li>
      <!-- Languages dropdown    -->
      <li class="nav-item dropdown"><a id="settings" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link language dropdown-toggle"><i class="fas fa-user-cog"></i> <small class="d-none d-sm-inline-block">Settings</small></a>
        <ul aria-labelledby="languages" class="dropdown-menu"> </li>
          <?php if(isset($_SESSION['currentpage']) && $_SESSION['currentpage'] == "bitcoinnewstoday.org/profile?client=Charles") {?>
          <li><a rel="nofollow" style='cursor:pointer' data-toggle='modal' data-target='#editProfile' aria-haspopup='true' aria-expanded='false' class="text-decoration-none rounded text-white p-2 m-2"> <i class="fas fa-user"></i> <span class="d-none d-sm-inline-block">Update Profile</span> </a></li>
          <?php }else {
            echo "<li><a rel='nofollow' style='cursor:pointer' href='profile?client=$med' target='_blank' class='text-decoration-none rounded p-2 m-2'> <i class='fas fa-user'></i> <span class='d-none d-sm-inline-block'>Update Profile</span> </a></li>";
          }
            ?>  
            <!-- Logout    -->
          <li><a href="logout"  aria-haspopup='true' aria-expanded='false' class="dropdown-item logout"> <i class="fas fa-sign-out-alt"></i> <span class="d-none d-sm-inline-block">Logout</span></a></li>
        </ul>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="images/bitcoin-btc-logo.png" alt="logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light text-white">BITCOIN NEWS TODAY</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex text-white">
        <div class="image">
        <?php require_once'dbh.php'; $p_pix = new dbh(); $p_pix -> fetchUserProfilePics(); ?>
        </div>
        <div class="info">
          <a href="#" class="d-block text-white"><?php echo @$clientfname?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php 
            
          echo "<li class='nav-item'>
                  <a class='nav-link' href='dashboard?client=$med' target='_blank'>
                   <i class='fas fa-tachometer-alt nav-icon'></i> DASHBOARD 
                  </a>
                </li>";
          echo "<li class='nav-item has-treeview menu-open'>
            <ul class='nav nav-treeview'>
              <li class='nav-item'>
                <a href='invest?client=$med' target='_blank' class='nav-link active'>
                  <i class='fas fa-dollar-sign'></i>
                  INVEST
                </a>
              </li>
              <li class='nav-item'>
                <a href='investmenthistory?client=$med' target='_blank' class='nav-link'>
                  <i class='far fa-clock nav-icon'></i>
                  INVESTMENT HISTORY
                </a>
              </li>
            </ul>
          </li>
          <li class='nav-item'><a class='nav-link' href='profile?client=$med' target='_blank'> <i class='fab fa-bitcoin nav-icon'></i> HOW TO BUY BITCOIN </a></li>
          <li class='nav-item'><a class='nav-link' href='paymentdetails?client=$med' target='_blank'> <i class='fab fa-bitcoin nav-icon'></i> HOW TO SEND BITCOIN </a></li>
          <li class='nav-item'><a class='nav-link' href='profile?client=$med' target='_blank'> <i class='fas fa-user nav-icon'></i> PERSONAL PROFILE </a></li>
          <li class='nav-item'><a class='nav-link' href='paymentdetails?client=$med' target='_blank'> <i class='fas fa-money-check-alt nav-icon'></i> PAYMENT DETAILS </a></li>
          <li class='nav-item'><a class='nav-link' href='withdrawfunds?client=$med' target='_blank'> <i class='fas fa-credit-card nav-icon'></i> WITHDRAW FUNDS </a></li>
          <li class='nav-item'><a class='nav-link' href='withdrawalhistory?client=$med' target='_blank'> <i class='fas fa-clock nav-icon'></i> WITHDRAWAL HISTORY </a></li>
          </li>";
          ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <div class="content-header taxt-center mt-5">
      <!-- TradingView Widget BEGIN -->
    <div class="tradingview-widget-container pt-1">
      <script type="text/javascript" src="https://widget.coinlore.com/widgets/ticker-widget.js"></script><div class="coinlore-priceticker-widget" data-mcurrency="usd" data-bcolor="#fff" data-scolor="#333" data-ccolor="#428bca" data-pcolor="#428bca"></div>
    </div>
    <!-- TradingView Widget END -->
      
    <!-- /.content-header -->

    <?php require_once'config.php';
            $inv = $con->prepare("SELECT investmentId,investmentAmount,investmentCoin,growthRate,accumulatedgrowthRate,investmentStatus FROM investment_table WHERE clientEmail = ? ");
            $inv -> bindParam(1,$email_of_user);
            if($inv -> execute()) {
              $in = $inv -> fetch(PDO::FETCH_ASSOC);
              $invAmt = $in['investmentAmount'];
              $growthrate = $in['growthRate'];
              
            }
      
    ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Info boxes -->
        <div class="row mt-5">

          <div class="col-12 col-sm-6 col-md-4 bg-transparent">
            <div class="info-box mb-3 bg-transparent">
              <span class="info-box-icon bg-1 elevation-1"><i class="fas fa-dollar-sign text-dark"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">MY INVESTMEST AMOUNT</span>
                <b class='invest-pt'><?php echo @$invAmt?></b>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
      
          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-4 bg-transparent">
            <div class="info-box mb-3 bg-transparent">
              <span class="info-box-icon bg-2 elevation-1"><i class="fas fa-money-bill text-dark"></i></span>

              <div class="info-box-content bg-transparent">
                <span class="info-box-text bg-transparent">MY INVESTMENT COIN</span>
                <b class='invest-pt'> BITCOIN </b>
                  
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-4 bg-transparent">
            <div class="info-box mb-3 bg-transparent">
              <span class="info-box-icon bg-3 elevation-1"><i class="fas fa-chart-line text-dark"></i></span>

              <div class="info-box-content bg-transparent">
                <span class="info-box-text bg-transparent">MY TOTAL PERCENTAGE GROWTH</span>
                <b class='invest-pt'><?php echo $growthrate;?></b>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          
        </div>
        <!-- /.row -->

        <div class="container-fluid text-center pt-3 mt-5" style="position: relative;">
          <a href="invest"><img src="images/btcnewsorg.jpg" alt="invest" class="img-call-to-action img-fluid rounded"><div class="call-to-action"><button class='funds_btn font-weight-bold'>Get Started Now <i class="fas fa-angle-right"></i></button></div></a>
          <div class="we-work text-center">
            <h3 class="text-center">
              We do the hard work, you earn the money
              <b>...Is that simple</b>
            </h3>
          
            <div>
              <h4 class="text-center"><strong>Invest and earn $200 every 3 - 5 days by leveraging the best professional traders from all over the world.</strong></h4>  
              
              <div class="container P-5 mt-5">
                        <div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
                            <div class="content-services faq-head">
                                <h2>Frequently Asked Questions And Answers</h2>
                            </div>
                            <!--// Small Services //-->

                            <div class="services-accordion text-left">
                                <div class="panel-group" id="accordion">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle text-left "
                                                >How does it work?</a>
                                                <div class="text-right text-gray toggle-faq" style="margin-top:-1.6rem;color:#8a8a8a;"><i class="fas fa-angle-down"></i></div>
                                            </h4>
                                        </div>
                                        <div class="panel-collapse collapse" id="collapseOne">
                                            <div class="panel-body">
                                                <p>
                                                  Bitcoinnewstoday.org offers investors the opportunity to profit from the effort of professional currency traders in countries such as Singapore, India, Vietnam and Malaysia. 
                                                  These traders work remotely from the comfort of their home but they work for you.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle text-left " >
                                                  How do they work for you?
                                                </a>
                                                <div class="text-right text-gray toggle-faq" style="margin-top:-1.6rem;color:#8a8a8a;"><i class="fas fa-angle-down"></i></div>
                                            </h4>
                                        </div>
                                        <div class="panel-collapse collapse" id="collapseThree">
                                            <div class="panel-body">
                                              hey help you trade currency with the money you invest and earn you profits on a weekly basis. These traders have huge experience and expertise in currency trading hereby losses are reduced to a bearest minimum, and profits are maximized. 
                                              We understand that using the biggest well known traders in the world will cost a lot of money and unnecessary charges, over the past few years we have hunted for good currency traders worldwide and we have been able to find a few that can help you earn huge profits regardless of whether market is in bear mode or bull mode.
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle text-left ">What do the traders benefit?</a>
                                                <div class="text-right text-gray toggle-faq" style="margin-top:-1.6rem;color:#8a8a8a;"><i class="fas fa-angle-down"></i></div>
                                            </h4>
                                        </div>
                                        <div class="panel-collapse collapse" id="collapseFour">
                                            <div class="panel-body">
                                              We give all our traders 15% of the profit they make and we take 5% of your profit as well.
                                              <b>Example</b> If you invest $500, in the situation you will be earning about $100 every 3 days, The trader takes $15 for every $100 profit you earn and we take $5 as well. 
                                              Hereby, the higher amount invested, the higher you get back in profit.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle text-left " >What is the probability that I will not lose my money?</a>
                                                <div class="text-right text-gray toggle-faq" style="margin-top:-1.6rem;color:#8a8a8a;"><i class="fas fa-angle-down"></i></div>
                                            </h4>
                                        </div>
                                        <div class="panel-collapse collapse" id="collapseFive">
                                            <div class="panel-body">
                                              These traders have huge expertise in the trading, hereby the probability of them making port trades is very low. They make profits 85% of the time as seen in the screenshots above, we also have a policy that states that any trader who losses more than 80% of investors capital is automatically ousted from the system and his trades are automatically closed. Hereby, your capital can only ever be reduced to 80% of the initial amount. Hereby if you invest $1000, the maximum your capital can reduce to is $800.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle text-left ">
                                                  What if the traders withdraw my money?
                                                </a>
                                                <div class="text-right text-gray toggle-faq" style="margin-top:-1.6rem;color:#8a8a8a;"><i class="fas fa-angle-down"></i></div>
                                            </h4>
                                        </div>
                                        <div class="panel-collapse collapse" id="collapseSix">
                                            <div class="panel-body">
                                              These traders only have access to your account on a currency trading level, meaning that they can only trade from our portal hereby, they place trades themselves but they don’t have access to the money. Only we have access to your trading capital  and your profits are paid back weekly.
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle text-left ">Why are the profits every 3 - 5 days, can’t your traders make profit everyday?</a>
                                                <div class="text-right text-gray toggle-faq" style="margin-top:-1.6rem;color:#8a8a8a;"><i class="fas fa-angle-down"></i></div>
                                            </h4>
                                        </div>
                                        <div class="panel-collapse collapse" id="collapseSeven">
                                            <div class="panel-body">
                                              Our traders watch the market closely and only place trades when they see good opportunities that are 95% most likely to make profit. Our traders trade the sniper way not the machine gun way, this is important because this secures your profits ensures your money is safe from losses.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle text-left ">How to get started?</a>
                                                <div class="text-right text-gray toggle-faq" style="margin-top:-1.6rem;color:#8a8a8a;"><i class="fas fa-angle-down"></i></div>
                                            </h4>
                                        </div>
                                        <div class="panel-collapse collapse" id="collapseEight">
                                            <div class="panel-body">
                                              Click the link to go the investment page <a href="invest" class="inv-link text-decoration-none"> Invest Now </a>
                                              <ul>
                                                <li>
                                                  Send bitcoin to the bitcoin address provided on the investment page.
                                                </li>
                                                <li>
                                                  Once bitcoin is sent, contact customer care team about your payment by clicking here (link to my WhatsApp number).
                                                </li>
                                                <li>
                                                  Within 24 hours the paid amount will reflect in your dashboard, ensure to keep to password and username to your account secret because you will need it to make withdrawals.
                                                </li>
                                              </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle text-left " >
                                                  Don’t know how to buy bitcoin?
                                                </a>
                                                <div class="text-right text-gray toggle-faq" style="margin-top:-1.6rem;color:#8a8a8a;"><i class="fas fa-angle-down"></i></div>
                                            </h4>
                                        </div>
                                        <div class="panel-collapse collapse" id="collapseNine">
                                            <div class="panel-body">
                                              Check the video below to learn how to buy bitcoin on coin base
                                              <iframe width="560" height="315" src="https://www.youtube.com/embed/G90yqthZHkg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle text-left ">Don’t know how to send bitcoin?</a>
                                                <div class="text-right text-gray toggle-faq" style="margin-top:-1.6rem;color:#8a8a8a;"><i class="fas fa-angle-down"></i></div>
                                            </h4>
                                        </div>
                                        <div class="panel-collapse collapse" id="collapseTen">
                                            <div class="panel-body">
                                              Check the video below to learn how to send bitcoin on coin base
                                                <iframe width="560" height="315" src="https://www.youtube.com/embed/KrIt7AeB_II" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--// Sidebar //-->
                </div>
              
            </div>
            
            <h4 class="btc-more-e">
              <a href="invest" class="text-decoration-none text-dark"><i class="fab fa-bitcoin fa-2x" style="color: orange !important"></i> <b>Invest And Earn More Crypto Today</b></a>
            </h4>
          </div>
            
        </div>

	<!-- edit profile -->
  <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="h4">Withdraw Funds</h3>
              </div>
              <div class="card-body no-padding">
              <?php 
                    require_once('dbh.php');
                    require_once('config.php');

                    $invTyp = $con -> prepare("SELECT DISTINCT auction_type,auctionAmount,totalEarning,auctionDate FROM auction_table WHERE clientEmail = ?");
                    $invTyp -> bindParam(1,$email);
                    if($invTyp -> execute() && $invTyp -> rowCount() > 0) {
                        $invT = $invTyp -> fetchAll(PDO::FETCH_ASSOC);
                        // <!-- Withdrawal Form Start -->

                    echo "<div class='auction-deposit-form'>
                            <form action='' method='POST' class='' id='withdrawal_form'>
                                <h1 class='mt-5 mb-2 text-center mx-auto'> <i class='fas fa-credit-card'></i> Withdraw Your Earnings</h1>

                                  
                                <div class='form-group'>
                                    <label  for='fund_method' class='text-left'>
                                          <strong>Select auction Type to Withdraw From <span class='text-danger'>*</span></strong>
                                    </label>";

                                    foreach($invT as $item) {
                                      $investTypes = $item['auction_type'];
                                    
                                      $Earnings = $item['totalEarning'];
                                  $invAmt = $item['auctionAmount'];
                                    $investDate = $item['auctionDate'];
                                    $onemonthDate = ($investDate + 2678400);
                                  if($Earnings === $invAmt) {
                                      $totalEarnings = 0;
                                      $formattedEarning = $totalEarnings; 
                                  }else {
                                      $totalEarnings = $Earnings;
                                      $formattedEarning = $totalEarnings;
                                  }
                                      $curType = $item['auction_'];

                                      if($curType == 'Pounds') {
                                        $curSymbol = "<i class='fas fa-pound-sign'></i>";
                                      }elseif($curType == 'Dollar') {
                                        $curSymbol = "<i class='fas fa-dollar-sign'></i>";
                                      }elseif($curType == 'Euro') {
                                        $curSymbol = "<i class='fas fa-euro-sign'></i>";
                                      }

                                      echo "<ul>
                                              <li>
                                                  <div class='rate-follow'> <i class='fas fa-chart-bar'></i> $investTypes  <span id='$invAmt'></span><span class='earnings' value='$totalEarnings' name='$onemonthDate' id='$investDate'> Earnings : $curSymbol$formattedEarning </span> <input type='radio' name='auction_type' value='$investTypes' class='form-checkbox' id='withdraw_button'></div>
                                                  <input type='text' name='auction_currency' id='auction_currency' value='$curType' hidden>
                                                  <span class='checkmark'></span> 
                                              </li>    
                                          </ul>";
                                      }
                                echo "</div>";

                                echo "<h4 class='text-center mb-5' id='no-earnings-found'></h4>";

                                echo "<div id='withdraw-container'>";
                                echo "<div class='form-group'>
                                        <label  for='fund_method' class='text-left'>
                                              <strong>Withdrawal Amount<span class='text-danger'>*</span></strong>
                                        </label>
                                        <div class=''>
                                            <input name='withdrawalAmount' id='withdrawalAmount' onblur='withdrawComut()' placeholder='e.g 10000' value='' size='10' type='number' class='form-control' 
                                            required />
                                        </div>
                                        <div><small>In Pounds(£)</small></div>
                                        <div class='text-center' id='amtAlert'></div>
                                        <div class='text-center' id='amtminAlert'></div>
                                        <div class='text-center' id='withAlert'></div>
                                    </div>

                                    <div class='form-group'>
                                        <label  for=' class='text-left'>
                                              <strong>Choose Withdrawal Channel<span class='text-danger'>*</span></strong>
                                        </label>
                                        <select name='fund_method' id='withdrawalChannel' name='withdrawalChannel' onclick='selectWithdrawalChannel()' class='form-control' required >
                                            <option value='' selected>- Select -</option>
                                            <option value='Bitcoin'>Bitcoin</option>
                                            <option value='Ethereum'>Ethereum</option>
                                            <option value='Litecoin'>Litecoin</option>
                                            <option value='Bank Wire'>Bank Wire / Transfer</option>
                                        </select>
                                    </div>

                                    <div class='form-group' id='bitcoin-withdrawal' style='border: 1px solid #eeeaef;border-radius:4px;display:none;'>
                                    <div class='container pt-3 pb-3'>
                                      <h6 class='text-center mx-auto'>Send Your auction To Our Company Bitcoin Wallet <br><small>We Confirm Your auction Within 1-3 Hours</small></h6>
                                      <label for='btc-pay' class='col-form-label'><strong>Invest</strong></label>
                                      <input type='text' class='form-control pb-2' id='wallet-address' name='wallet-address' value='' placeholder='enter wallet address'/>
      
                                      <h6>You Will Receive Your Withdrawal Within 1-3 Hours</h6>
                                    </div>
                                  </div>
      
                                  <div class='form-group' id='ethereum-withdrawal' style='border: 1px solid #eeeaef;border-radius:4px;display:none;'>
                                    <div class='container pt-3 pb-3'>
                                      <h6 class='text-center mx-auto'>Send Your Withdrawal Etherum Wallet <br><small>We Confirm Your Withdrawal Within 1-3 Hours</small></h6>
                                      <label for='btc-pay' class='col-form-label'><strong>Withdraw</strong></label>
                                      <input type='text' class='form-control pb-2' id='wallet-address' name='wallet-address' value='473ygjhgyddffwTR537FHYrfyt7653dgu7rdr'>
                                      <h6>You Will Receive Your Withdrawal Within 1-3 Hours</h6>
                                    </div>
                                  </div>
      
                                  <div class='form-group' id='litecoin-withdrawal' style='border: 1px solid #eeeaef;border-radius:4px;display:none;'>
                                    <div class='container pt-3 pb-3'>
                                      <h6 class='text-center mx-auto'>Send Your Withdrawal Litecoin Wallet <br><small>We Confirm Your Withdrawal Within 1-3 Hours</small></h6>
                                      <label for='btc-pay' class='col-form-label><strong>Withdraw</strong></label>
                                      <input type='text' class='form-control pb-2' id='wallet-address' name='wallet-address' value='473ygjhgyddffwTR537FHYrfyt7653dgu7rdr'>
                                      <h6>You Will Receive Your Withdrawal Within 1-3 Hourstes</h6>
                                    </div>
                                  </div>
                                      
                                  <div class='form-group' id='bank-wire-withdrawal' style='border: 1px solid #eeeaef;border-radius:4px;display:none;'>
                                    <div class='container pt-3 pb-3'>
                                      <h6 class='text-left mx-auto'>Bank Wire/Transfer Is Only Available For Withdrawal Above £50,000 Were We Have One On One auction Conversation With You</h6>
                                    </div>
                                  </div>
      
                                  <div class='form-group' id='bank-wire-withdrawal-50000plus' style='border: 1px solid #eeeaef;border-radius:4px;display:none;'>
                                    <div class='container pt-3 pb-3'>
                                      <h6 class='text-left mx-auto'>Submit Your Withdrawal Request Below And Our Withdrawal Team Will Contact You For auction Details</h6>
                                    </div>
                                  </div>
                                
                                  <div class='form-group'>
                                      <label  for=' class='text-left'>
                                            <strong>Reason for Withdrawal<span class='text-danger'>*</span></strong>
                                      </label>
                                      <select name='fund_method' id='withdrawalReason' name='withdrawalReason'  class='form-control' required >
                                          <option value='' selected>- Select -</option>
                                          <option value='urgently need money'>I urgently Need Money</option>
                                          <option value='dont like your service'>Don't Like Your Service</option>
                                          <option value='no reason'>Others</option>
                                          <option value='no reason'>No Reason</option>
                                      </select>
                                  </div>

                                  <div class='form-group text-center mx-auto'>
                                    <div class='mb-5'>
                                      <button type='submit' class='btn btn-primary' name='submitWithdrawal' onclick='preventSubmit()'>
                                          <i class='fas fa-paper-plane'></i>&nbsp; Submit Request
                                      </button>
                                      <button class='btn btn-success' type='reset'>Cancel</button>
                                    </div>
                                  </div>
                                
                                </div>

                              </form>
                            </div>";
                            
                        }else {
                          echo "<div class='no-withdrawal text-center mb-5 mt-2 pb-3 pt-2'>
                                  <h2 class='no-invest' id='no-invest' name='no-invest'>No Bid Found<h2>
                                  <strong> Place A Bid To Be Able To Withdrawal </strong>
                                </div>";
                      }
                      ?>

                      <div class="withdrawhistory pt-5 pb-5">
                        <?php
                          require_once'dbh.php';require_once'config.php';
                          $withdhist = new dbh(); $withdhist -> withdrawalHistory();
                        ?>
                      </div>
              </div>
            </div>
          </div>
		<!-- edit profile ends -->
        <!-- Main row -->
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->


  <!-- Main Footer -->
  <footer class="main-footer">
    Copyright &copy; 2020 Bitcoinnewstoday.org. 
    All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- JavaScript files-->
<script lang="javascript" type="text/javascript" src="javascript/jquery.min.js"></script>
<script src="javascript/popper.js/umd/popper.min.js"> </script>
<script lang="javascript" type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script src="javascript/jquery.cookie/jquery.cookie.js"> </script>
<script src="javascript/jquery-validation/jquery.validate.min.js"></script>
<script src="javascript/charts-custom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"></script>
<!-- Initialize Swiper -->
<script>
    
    var swiper = new Swiper('.swiper-container', {
      slidesPerView: 3,
      spaceBetween: 30,
      slidesPerGroup: 3,
      loop: true,
      loopFillGroupWithBlank: true,
      autoplay: {
        delay: 10000,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  </script>
<!-- Main File-->
<script lang="javascript" type="text/javascript">
    $(document).ready(function () {
    $('#dtBasicExample').DataTable();
    $('.dataTables_length').addClass('bs-select');
  });

//   function copyTextToClipboard(text) {
//     var textArea = document.createElement("textarea");
  
//     //
//     // *** This styling is an extra step which is likely not required. ***
//     //
//     // Why is it here? To ensure:
//     // 1. the element is able to have focus and selection.
//     // 2. if element was to flash render it has minimal visual impact.
//     // 3. less flakyness with selection and copying which **might** occur if
//     //    the textarea element is not visible.
//     //
//     // The likelihood is the element won't even render, not even a
//     // flash, so some of these are just precautions. However in
//     // Internet Explorer the element is visible whilst the popup
//     // box asking the user for permission for the web page to
//     // copy to the clipboard.
//     //
  
//     // Place in top-left corner of screen regardless of scroll position.
//     textArea.style.position = 'fixed';
//     textArea.style.top = 0;
//     textArea.style.left = 0;
  
//     // Ensure it has a small width and height. Setting to 1px / 1em
//     // doesn't work as this gives a negative w/h on some browsers.
//     textArea.style.width = '2em';
//     textArea.style.height = '2em';
  
//     // We don't need padding, reducing the size if it does flash render.
//     textArea.style.padding = 0;
  
//     // Clean up any borders.
//     textArea.style.border = 'none';
//     textArea.style.outline = 'none';
//     textArea.style.boxShadow = 'none';
  
//     // Avoid flash of white box if rendered for any reason.
//     textArea.style.background = 'transparent';
  
  
//     textArea.value = text;
  
//     document.body.appendChild(textArea);
//     textArea.focus();
//     textArea.select();
  
//     try {
//       var successful = document.execCommand('copy');
//       var msg = successful ? 'successful' : 'unsuccessful';
//       console.log('Copying text command was ' + msg);
//     } catch (err) {
//       console.log('Oops, unable to copy');
//     }
  
//     document.body.removeChild(textArea);
//   }
  
  
//   var copyWalletAddress = document.querySelectorAll('.wallet-address');
//   var copyButton = document.querySelector('.copied');
  
// //   for(i=0; i<= copyButton.length; i++) {
// //         var clicked = copyButton[i];
// //         clicked.onclick = function() {
// //             var textToCopy = copyWalletAddress.value;
// //             copyButton.innerHTML = 'Copied';
// //             alert(textToCopy);
// //             copyTextToClipboard(textToCopy);
// //         }
// //   }
//   copyButton.addEventListener('click', function(event) {
//       var textToCopy = this.parentElement.parentElement.firstElementChild.firstElementChild.value;
//       copyButton.innerHTML = 'Copied';
//       alert(textToCopy);
//     copyTextToClipboard(textToCopy);
//   });
</script>
<script src="javascript/front.js"></script>
<script src="javascript/home.js"></script>
<script src="javascript/invest.js"></script>
<script src="javascript/livechart.js"></script>

<!-- PAGE SCRIPTS -->
<script src="dist/js/pages/dashboard2.js"></script>
</body>
</html>

