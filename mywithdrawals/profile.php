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

  <title> Bitcoin News Today  | My Profile </title>

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
<body >
<?php
      require_once'config.php';
      $country = $con-> prepare("SELECT userCountry,countryFlag,uname FROM users WHERE id = ? ");
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
      <img src="images/bitcoin-btc-logo.png" alt="logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light text-white">BITCOIN NEWS TODAY</span>
    </a>

    <!-- Sidebar -->
    <div class="">
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
                  <i class='fas fa-dollar-sign text-dark'></i>
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
  </div>

<div class="wrapper" id="main">
  <!-- Navbar -->
  
  <nav class="navbar navbar-expand" style="width: 100%;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <span id="toggleSideBar" clas='ml-5' onclick="openNav()" role="button"><i class="fas fa-bars text-white"></i></span> <span id="closeSideBar" style="display: none;" onclick="closeNav()" role="button"><i class="fas fa-times text-white"></i></span>
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
        <a href="profile?client=$med" class="nav-link"> Personal Profile </a>
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapperr">

    <div class="content-header taxt-center mt-0">
      <!-- TradingView Widget BEGIN -->
    <div class="tradingview-widget-container pt-0" style="position:relative;">
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

        <!-- Info boxes -->
        <div class="row investors-counter">
          <div class="overlay"></div>
          <!-- nEW MEMBERS -->
          <div class="col-12 mt-5 mb-5 text-center">
            <div class="text-center">
              <i class="fas fa-users fa-3x"></i>

              <div class="info-box-content">
                <span class="info-box-text">NEW INVESTORS JOINED</span>
                <div>
                  <b class='invest-pt'> <span>69</span></b> 
                </div>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-3 bg-transparent">
            <div class="info-box mb-3 bg-transparent">
              
              <div class="mx-auto">
                <span class=""><i class="fas fa-hand-holding-usd bety"></i></span>
              </div>

              <div class="info-box-content">
                <span class="info-box-text"> TOTAL PAYOUT</span>
                <b class='invest-pt'> $<span id='payouts'>108,930</span></b>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
      
          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3 bg-transparent">
            <div class="info-box mb-3 bg-transparent">
              
            <div class="mx-auto">
              <span class=""><i class="fas fa-money-bill bety"></i></span>
            </div>

              <div class="info-box-content bg-transparent">
                <span class="info-box-text bg-transparent">WEEK PENDING PAYOUTS</span>
                <b class='invest-pt'> $<span id='pending-payouts'>51,955</span> </b>
                  
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3 bg-transparent">
            <div class="info-box mb-3 bg-transparent">
              <div class="mx-auto">
                <span class=""><i class="fas fa-piggy-bank bety"></i></span>
              </div>
              
              <div class="info-box-content bg-transparent">
                <span class="info-box-text bg-transparent">TOTAL INVESTMENT AMOUNT</span>
                <b class='invest-pt'> $<span id="totalinvest">204,785</span></b>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3 bg-transparent">
            <div class="info-box mb-3 bg-transparent">
  
              <div class="mx-auto">
                <span class=""><i class="fas fa-user-plus bety"></i></span>
              </div>
    
              <div class="info-box-content bg-transparent">
                <span class="info-box-text bg-transparent"> TOTAL INVESTORS </span>
                <b class='invest-pt'><span id="investorcount">216</span></b>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          
        </div>
        <!-- /.row -->

<!-- edit profile -->
<div class="card rounded-0 bg-transparent" >
			<!-- edit profile -->
			<!-- Recent Updates -->
			<div class="">
				<div class="">
				<div class="">
					<h3 class="h4" style="color: rgb(255, 230, 0) !important">Update Profile</h3>
				</div>
				<div class="card-body no-padding">
					<!-- edit profile php code -->
					
					<?php
						@session_start();
						error_reporting(E_ALL);
						ini_set('display_errors','1');
						require_once'dbh.php';
						require_once'config.php';
						require_once'ranStrGen.php';
						// require_once'mailer.php';

						if((isset($_POST['Fname']) && isset($_POST['Lname']) && isset($_POST['phonenumber'])) || (isset($_POST['Fname']) && isset($_POST['Lname']))  || (isset($_POST['phonenumber'])) ) {
							
							$Lname = isset($_POST['Lname']) ? $_POST['Lname'] : false;
							$Fname = isset($_POST['Fname']) ? $_POST['Fname'] : false;
							// $clientState = isset($_POST['clienState']) ? $_POST['clientState'] : false;
							// $clientCity = isset($_POST['clientCity']) ? $_POST['clientCity'] : false;
							// $clientZipCode = isset($_POST['clientZipCode']) ? $_POST['clientZipCode'] : false;
							// $clientAddress = isset($_POST['clientAddress']) ? $_POST['clientAddress'] : false;
							$error_name = "";
							$error_phonenumber = "";
							$phonenumber = isset($_POST['phonenumber'])? $_POST['phonenumber'] : false;
						
							if($phonenumber =="") {
									$error_phonenumber = 'phonenumber empty!!';
									
								}else if($phonenumber != strip_tags($_POST['phonenumber'])) {
									$error_phonenumber = "invalid phonenumber";
									
								}else if(!preg_match("/^[ +0-9]*$/",$phonenumber) && !ctype_digit($phonenumber)) {
									$error_phonenumber = 'only numbers required!';
									
								}

								if(strlen($Fname) < 3 || strlen($Fname) > 80) {
								$error_name = 'Name must be between 3 - 80 characters';
								
							}elseif(!preg_match("/^[a-z A-Z0-9.]*$/",$Fname) && strip_tags($Fname)) {
								$error_name = 'invalid, name must be alphanumerics with no special characters';
								
							}
							if(strlen($Lname) < 3 || strlen($Lname) > 80) {
								$error_name = 'Name must be between 3 - 80 characters';
								
							}elseif(!preg_match("/^[a-z A-Z0-9.]*$/",$Lname) && strip_tags($Lname)) {
								$error_name = 'invalid, name must be alphanumerics with no special characters';
								
							}
								// $clientAddress = strip_tags($_POST['clientAddress']);
								// $clientCity = strip_tags($_POST['clientCity']);
								// $clientState = strip_tags($_POST['clientState']);
								// $clientZipCode = strip_tags($_POST['clientZipCode']);

								if(isset($Fname) && $error_name == "" ) {
								
								$upd = $con -> prepare("UPDATE users SET  Fname = ?, Lname = ? WHERE email = ?");
								$upd->bindParam(1,$Fname,PDO::PARAM_STR);
								$upd->bindParam(2,$Lname,PDO::PARAM_STR);
								$upd->bindParam(3,$email_of_user,PDO::PARAM_STR);
								if($upd -> execute()) {
									echo "<div class='alert-success text-center'> Name Update Successful
										<span class='close-now text-right'>&times;</span></div>";
								}
								}

								if(isset($phonenumber) && $error_phonenumber == "" ) {
								
								$update = $con -> prepare("UPDATE users SET phonenumber = ? WHERE email = ?");
								$update->bindParam(1,$phonenumber,PDO::PARAM_STR);
								$update->bindParam(2,$email_of_user,PDO::PARAM_STR);
								$update -> execute();
								if($update -> execute()) {
									echo "<div class='alert-success text-center'>
											Phone Number Update Success
										<span class='close-err text-right'>&times;</span></div>";
								}
								}

								if(isset($clientAddress)) {
								
									$update1 = $con -> prepare("UPDATE users SET userAddress = ?,userCity = ?, userState= ?,userZipCode = ? WHERE id= ? AND email = ?");
									$update1->bindParam(1,$clientAddress,PDO::PARAM_STR);
									$update1->bindParam(2,$clientCity,PDO::PARAM_STR);
									$update1->bindParam(3,$clientState,PDO::PARAM_STR);
									$update1->bindParam(4,$clientZipCode,PDO::PARAM_STR);
									$update1->bindParam(5,$userid);
									$update1->bindParam(6,$clientemail,PDO::PARAM_STR);
									if($update1 -> execute()) {
								
									}
								}
								
						}
						
						?>
					<!-- profile edit php -->
					<div class="update-profile text-center">
					<a rel='nofollow' style='cursor:pointer' data-toggle='modal' data-target='#editProfile' aria-haspopup='true' aria-expanded='false' class="text-decoration-none rounded p-2 m-2 prof-update" style='font-weight: bold;color: orange;background-color: orange'>EDIT/UPDATE PROFILE</a>
					</div>
				</div>
				</div>
			</div>
			
			<div class="text-center upload-pics">   
				<form action='' method='POST' id="talent-submit-form" enctype="multipart/form-data">
					<div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false">
						<div id="drag_upload_file">
							<p>
								<?php require_once'dbh.php'; $changepics = new dbh(); $changepics -> fetchUserProfilePics();?> 
								<input type="button" value="Change Profile Pics" name="uploadDocuments" class="btn funds_btn" onclick="file_explorer();">
							</p>
							<input type="file" id="selectfile" name="uploadpics" hidden>
						</div>
					</div>
					<progress id='upload-progress-bar' value='0' max='100'></progress>
					<h3 id='status'></h3>
					<p id='loaded-n-total'></p>
				</form>
			</div>
			<!-- Recent profile details -->
			<div class="mt-5">
				<div class="">
				<div class="up-profile">
					<h3 class="h4" style='color: orange'>Profile Details</h3>
				</div>
				<div class="card-body no-padding">
				<!-- profile details -->
					<section class="dashboard-counts no-padding-bottom mb-5">
						<div class="container-fluid">
							<div class="row has-shadow">
							<?php
								require_once'config.php';
								$userDet = $con->prepare("SELECT uname,Fname,Lname,phonenumber,email FROM users WHERE email = ? ");
								$userDet -> bindParam(1,$email_of_user);
								// $sql = $con -> prepare("SELECT sponsoredByEmail FROM referrer_table WHERE referredEmail = ?");
								// $sql -> bindParam(1,$email_of_user);
								// $sql -> execute();
								$userDet -> execute();
								if($userDet -> execute()) {
									$det = $userDet -> fetch(PDO::FETCH_ASSOC);
									
									// $ref = $sql -> fetch(PDO::FETCH_ASSOC);
									$uname = $det['uname'];
									$fname = @$det['Fname'];
									$lname = @$det['Lname'];
									// $Lname = $det['lname'];
									$phone_number = @$det['phonenumber'];
									$uEmail = $det['email'];
									if(isset($fname) && isset($lname)) {
									$flname = $fname.' '.$lname;
									}else {
									$flname = $uname;
									}

									if(isset($fname) && $fname != null && isset($lname) && $lname != null) {
									$flname = $fname.' '.$lname;
									}else {
									$flname = $uname;
									}

									if(isset($phone_number) ) {
									$phonenumber =  $phone_number;
									}else {
									$phonenumber = 'Add Phonenumber';
									}
									
									
								}
								?>
								<div class="item d-flex align-items-center">
									<div class="col-12">
										<ul class="profile-list">
											<li style='list-style:none;font-size: 14px'>
												<div class='user-p text-gray'><i class='fas fa-user'></i> Name: <span class='o-user-p'><?php echo @$title.' '. @$flname?></span></div>
											</li>
											<li style='list-style:none;font-size: 14px'>
												<div class='user-p text-gray'><i class='far fa-envelope'></i> Email: <span class='o-user-p'><?php echo @$uEmail;?></span></div>
											</li>
											<li style='list-style:none;font-size: 14px'>
												<div class='user-p text-gray'><i class='fas fa-phone'></i> Phone: <span class='o-user-p'><?php echo @$phonenumber;?></span></div>
											</li>
											<!-- <?php #echo @$phonenumber;?> -->
											<li style='list-style:none;font-size: 14px'>
												<div class='user-p text-gray'><i class='fas fa-question-circle'></i> Account Status: <span class='o-user-p'><?php echo @$accStat;?></span></div>
											</li>
											<li style='list-style:none;font-size: 14px'>
												<div class='user-p text-gray'><i class='fas fa-flag'></i> Country: <?php echo "<img src='$client_Flag' altcountry class='img-fluid rounded-circle flag'> <span class='o-user-p'><small>$client_Country </small></span>"; ?></div>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</section>
					<!-- profile details ends here -->
				</div>
				</div>
			</div>

			<!-- Edit Profile Modal -->

	<div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-center" style="color: orange" id="exampleModalLabel">Update Profile</h5>
				<button type="button" class="close text-right" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action=''method='POST'>
					
					<div class="form-group">
						<label for="recipient-name" class="col-form-label text-gray">First Name:</label>
						<input type="text" class="form-control" id="recipient-name" name='Fname' placeholder='enter new first name'>
					</div>
					<div class="form-group">
						<label for="recipient-name" class="col-form-label text-gray">Last Name:</label>
						<input type="text" class="form-control" id="recipient-name" name='Lname' placeholder='enter new last name'>
					</div>
					<div class='pt-2 pb-2 text-center'><small>Phone Number Update Is Optional</small></div>
					<div class="form-group">
						<label for="recipient-name" class="col-form-label text-gray">Phonenumber:</label>
						<input type="varchar" class="form-control" id="recipient-name" name='phonenumber' placeholder='+xxx475438495'>
						<small>No Space required</small>
					</div>
					<div class="form-group text-center mt-5 mb-5">
					<button id="updateP" type="submit" name="submit_account" class="funds_btn" id='submit_account'>Update Profile</button>
					<button id="" type="reset" name="" class="funds_btn text-danger" id='submit_account'> Cancel </button>
					</div>
				</form>
			</div>
			
			</div>
		</div>
		</div>
		<!-- Edit Profile Modal Ends -->
		</div>
		<!-- edit profile ends -->
        <!-- Main row -->
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="bg-dark text-center p-5">
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
