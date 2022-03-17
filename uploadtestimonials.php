<?php
ob_start();
session_start();
require_once'dbh.php';
require_once'config.php';

@$_SESSION['currentpage'] = $_SERVER['REQUEST_URI'];
strip_tags(@$_SESSION['currentpage']);

$user_data = @$_SESSION['user'];
$userid = $user_data['id'];
$name = @$user_data['uname'];


if(!isset($_SESSION['user'])) {
    header('Location:');
    exit();
}else {
    $user_data = @$_SESSION['user'];
    $userid = $user_data['id'];
    $name = @$user_data['uname'];
    $lname = @$user_data['full_name'];
    $clientCountry = @$user_data['userCountry'];
    $countryFlag = @$user_data['countryFlag'];
    $email_of_user = @$user_data['email'];
    $auction_type = @$user_data['auction_type'];
    $refid = @$user_data['ref_id'];

    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    if($page == 0) {
        $page = 1;
    }
    $limit = 10;
    $start = ($page - 1) * $limit;
    $con = new PDO("mysql:host=$serverhost;dbname=coinauct_db;", $serverusername, $serverpassword);
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

  <title> Coin Auction Pro  | My Testimonies </title>

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
  <link rel="stylesheet" href="https://localhost/coinauctionpro/css/fontastic.css">
  <!-- Google fonts - Poppins -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
  <!-- theme stylesheet-->
  <!-- <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet"> -->
  <!-- Favicon-->
  <link rel="shortcut icon" href="https://localhost/coinauctionpro/images/icon.png">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://localhost/coinauctionpro/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="https://localhost/coinauctionpro/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://localhost/coinauctionpro/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script lang="javascript" type="text/javascript" src="https://localhost/coinauctionpro/javascript/jquery-3.2.1.js"></script>
  <script lang="javascript" type="text/javascript" src="https://localhost/coinauctionpro/javascript/jquery.min.js"></script>
  <!-- Bootstrap CSS-->
  <link rel="stylesheet" href="https://localhost/coinauctionpro/bootstrap/css/bootstrap.min.css">
  <script lang="javascript" type="text/javascript" src="https://localhost/coinauctionpro/bootstrap/js/bootstrap.min.js"></script>
  <!-- Font Awesome CSS-->
  <link rel="stylesheet" type='text/css' href="https://localhost/coinauctionpro/fontawesome/fontawesomefiles/css/fontawesome.min.css">
  <link rel="stylesheet" type='text/css' href="https://localhost/coinauctionpro/fontawesome/fontawesomefiles/css/all.min.css">
  <link rel="stylesheet" href="https://localhost/coinauctionpro/font-awesome/css/font-awesome.min.css">
  <script lang="javascript" type="text/javascript" src="https://localhost/coinauctionpro/fontawesome/fontawesomefiles/js/fontawesome.min.js"></script>
  <script lang="javascript" type="text/javascript" src="https://localhost/coinauctionpro/fontawesome/fontawesomefiles/js/all.min.js"></script>
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="https://localhost/coinauctionpro/css/customs.css">
  <style>
    .testimony-file {
        width: 100%;height: 20rem;margin: 1rem;padding:1rem auto 1rem auto;
        /* max-width:30rem; */
    }
    iframe {
        border: 1px solid #f1f1f1;
    }
    .testimony-user {
      margin-top: -1rem;padding-bottom: 2rem;
    }
    @media screen and (min-width:1068px) and (max-width: 1268px) {
      .testimony-file {
        height: 15rem;
        /* max-width:30rem; */
    }
}

@media screen and (min-width:768px) and (max-width: 1068px) {
  .testimony-file {
        height: 25rem;
        /* max-width:30rem; */
    }
}


@media screen and (min-width:567px) and (max-width: 768px) {
  .testimony-file {
        height: 30rem;margin: 3% auto;padding: 1% auto;
        /* max-width:30rem; */
    }
}

@media screen and (min-width:420px) and (max-width: 567px) {
  .testimony-file {
        margin: 3% auto;padding: 1% auto;
        /* max-width:30rem; */
    }
}

@media screen and (max-width:420px) {
  .testimony-file {
        margin: 3% auto;padding: 1% auto;
        /* max-width:30rem; */
    }
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
      $country = $con->prepare("SELECT userCountry,countryFlag,uname,ref_id FROM users WHERE id = ? ");
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
          $nr = $flag['ref_id'];

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
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="nav-menu list-unstyled ml-auto d-flex flex-md-row align-items-md-center">
      <!-- Client Profile pics-->
      <li class="nav-item d-flex align-items-center"><div class='client'><?php require_once'dbh.php'; $p_pix = new dbh(); $p_pix -> fetchUserProfilePics(); ?> <span> <?php echo @$clientfname?></span></div></li>
      <!-- Client Country-->
      <li class="nav-item d-flex align-items-center"> 
        <div class='client country'><?php echo "<img src='$client_Flag' altcountry class='img-fluid rounded-circle flag'> <div><small> $client_Country </small></div>"; ?></div>
      </li>
      <!-- Messages                        -->
      <li class="nav-item dropdown"> <a id="messages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="far fa-envelope"></i><span class="badge bg-orange badge-corner">10</span></a>
        <ul aria-labelledby="notifications" class="dropdown-menu">
          <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
              <div class="msg-profile"> <img src="https://localhost/coinauctionpro/images/avatar-1.jpg" alt="..." class="img-fluid rounded-circle"></div>
              <div class="msg-body">
                <h3 class="h5">Jason Doe</h3><span>Sent You Message</span>
              </div></a></li>
          <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
              <div class="msg-profile"> <img src="https://localhost/coinauctionpro/images/avatar-2.jpg" alt="..." class="img-fluid rounded-circle"></div>
              <div class="msg-body">
                <h3 class="h5">Frank Williams</h3><span>Sent You Message</span>
              </div></a></li>
          <li><a rel="nofollow" href="#" class="dropdown-item d-flex"> 
              <div class="msg-profile"> <img src="https://localhost/coinauctionpro/images/avatar-3.jpg" alt="..." class="img-fluid rounded-circle"></div>
              <div class="msg-body">
                <h3 class="h5">Ashley Wood</h3><span>Sent You Message</span>
              </div></a></li>
          <li><a rel="nofollow" href="#" class="dropdown-item all-notifications text-center"> <strong>Read all messages   </strong></a></li>
        </ul>
      </li>
      <!-- Languages dropdown    -->
      <li class="nav-item dropdown"><a id="settings" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link language dropdown-toggle"><i class="fas fa-user-cog"></i> <small class="d-none d-sm-inline-block">Settings</small></a>
        <ul aria-labelledby="languages" class="dropdown-menu"> </li>
          <?php if(isset($_SESSION['currentpage']) && $_SESSION['currentpage'] == "coinauctionpro.com/profile?client=Charles") {?>
          <li><a rel="nofollow" style='cursor:pointer' data-toggle='modal' data-target='#editProfile' aria-haspopup='true' aria-expanded='false' class="text-decoration-none rounded text-white bg-primary p-2 m-2"> <i class="fas fa-user"></i> <span class="d-none d-sm-inline-block">Update Profile</span> </a></li>
          <?php }else {
            echo "<li><a rel='nofollow' style='cursor:pointer' href='profile?client=$med' target='_blank' class='text-decoration-none rounded text-white bg-primary p-2 m-2'> <i class='fas fa-user'></i> <span class='d-none d-sm-inline-block'>Update Profile</span> </a></li>";
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
      <img src="https://localhost/coinauctionpro/images/icon.png" alt="Coin Auction Pro Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light text-white">COIN AUCTION PRO</span>
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
                  <a class='nav-link text-white' href='dashboard?client=$med' target='_blank'>
                   <i class='fas fa-tachometer-alt nav-icon'></i> DASHBOARD 
                  </a>
                </li>";
          echo "<li class='nav-item has-treeview menu-open'>
            <a href='#' class='nav-link active '>
              <i class='nav-icon fas fa-funnel-dollar'></i>
              <p>
                STAKES
                <i class='right fas fa-angle-left'></i>
              </p>
            </a>
            <ul class='nav nav-treeview'>
              <li class='nav-item'>
                <a href='stakehistory?client=$med' target='_blank' class='nav-link active'>
                  <i class='far fa-clock'></i>
                  <p>STAKE HISTORY</p>
                </a>
              </li>
              <li class='nav-item'>
                <a href='stake?client=$med' target='_blank' class='nav-link'>
                  <i class='fas fa-dollar-sign'></i>
                  <p>BID STAKE</p>
                </a>
              </li>
            </ul>
          </li>
          <li class='nav-item'><a class='nav-link text-white' href='profile?client=$med' target='_blank'> <i class='fas fa-user nav-icon'></i> ACCOUNT PROFILE </a></li>
          <li class='nav-item'><a class='nav-link text-white' href='paymentdetails?client=$med' target='_blank'> <i class='fas fa-money-check-alt nav-icon'></i> PAYMENT DETAILS </a></li>
          <li class='nav-item'><a class='nav-link text-white' href='refdetails?client=$med' target='_blank'> <i class='fas fa-users nav-icon'></i> REFERRAL DETAILS </a></li>
          <li class='nav-item'><a class='nav-link text-white' href='withdrawfunds?client=$med' target='_blank'> <i class='fas fa-credit-card nav-icon'></i> WITHDRAW FUNDS </a></li>
          <li class='nav-item'><a class='nav-link text-white' href='withdrawalhistory?client=$med' target='_blank'> <i class='fas fa-clock nav-icon'></i> WITHDRAWAL HISTORY </a></li>
          <li class='nav-item'><a class='nav-link text-white' href='uploadtestimonials?client=$med' target='_blank'> <i class='fas fa-level-up-alt nav-icon'></i> UPLOAD TESTIMONIES </a></li>
          <li class='nav-item'><a class='nav-link text-white' href='testimonials' target='_blank'> <i class='fas fa-laugh-beam nav-icon'></i> TESTIMONIES </a></li>
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
    <!-- Content Header (Page header) -->
    <?php
            require_once'config.php';
            $inv = $con->prepare("SELECT SUM(auctionAmount) AS auctionAmount,auctionChannel,SUM(growthRate) AS growthRate,auctionStatus FROM auction_table WHERE clientEmail = ?");
            $inv -> bindParam(1,$email_of_user);
            $inv -> execute();
            $auct = $con->prepare("SELECT bidLevel,accountLevel,pointReceived,active FROM users WHERE email = ?");
            $auct -> bindParam(1,$email_of_user);
            $auct -> execute();
            
            $in = $inv -> fetch(PDO::FETCH_ASSOC);
            $result = $auct -> fetch(PDO::FETCH_ASSOC);
            
            $bidLevel = $result['bidLevel'];
            $accLevel = $result['accountLevel'];
            $Active = $result['active'];
            $pointReceived = $result['pointReceived'];

            $checkStake = $inv -> rowCount();
            $accstakeStatus = $in['auctionStatus'];

            if($checkStake == 0) {
              $upgradeAcc = "<i class='fas fa-chart-line'></i> <span class='info-box-text'><a rel='nofollow' style='cursor:pointer' href='stake' class='text-white text-decoration-none' aria-expanded='false'>STAKE NOW TO EARN</a></span>";
            }elseif($checkStake > 0 && $accstakeStatus == 'Inactive') {
              $upgradeAcc = "<i class='fas fa-coins'></i> <span class='info-box-text'><a rel='nofollow' style='cursor:pointer' href='stake' class='text-white text-decoration-none' aria-expanded='false'>REDEEM OUTSTANDING STAKE TO EARN</a></span>";
            }else if($accLevel == 'Platinum') {
              $upgradeAcc = "<i class='fas fa-trophy'></i> <span class='info-box-text'>PLATINUM LEADER</span>";
            }else {
              $upgradeAcc = "<i class='fas fa-shopping-cart'></i>
              <span class='info-box-text'><a rel='nofollow' style='cursor:pointer' data-toggle='modal' data-target='#addMoreInvestOptions' aria-haspopup='true' aria-expanded='false'>UPGRADE ACCOUNT</a></span>";
            }

            if($inv -> execute() && $inv -> rowCount() > 0) {
                // foreach ($in as $key => $value) {
                    # code...
                    $auctAmt = $in['auctionAmount'];
                    $auctChannel = $in['auctionChannel'];
                    $growthrate = $in['growthRate'].'% Daily';
                    
                // }

              }else {
                    $auctAmt = 0;
                    $auctChannel = "None";
                    $growthrate = "None";
              }
      ?>
    <div class="content-header taxt-center mt-5">
      <!-- TradingView Widget BEGIN -->
    <div class="tradingview-widget-container pt-1">
      <script type="text/javascript" src="https://widget.coinlore.com/widgets/ticker-widget.js"></script><div class="coinlore-priceticker-widget" data-mcurrency="usd" data-bcolor="#fff" data-scolor="#333" data-ccolor="#428bca" data-pcolor="#428bca"></div>
    </div>
    <!-- TradingView Widget END -->
      <div class="container-fluid text-center pt-3 mt-5">
      <small class="tite text-center mt-5 pt-3"><cite>Welcome once again</cite> <strong><?php echo @$lname?> <i class='fas fa-handshake'></i> </strong></small>
        <?php 
              echo "<div>My Ref Link: <a class='nav-link' style='color:blue' href='https://coinauctionpro.com/createaccount?ref=$nr' target='_blank'> https://coinauctionpro.com/createaccount?ref=$nr </a></div>";
                if(isset($Active) && $Active == 0) {?>
              <div class='alert-success pt-2 pb-2 pr-2 pl-2 mt-3 mb-3 eligible'> You have not completed your account activation and hence has limited access to our features, follow the steps sent to your email during to complete your account activation process<span class='close-alert pr-2' style='cursor:pointer'>&times;</span></div>
          <?php }else if(isset($Active) && $Active == 1 && $accstakeStatus == 'Inactive'){?>
              <div class='alert-success pt-2 pb-2 pr-2 pl-2 mt-3 mb-3 eligible'> Your Account Is Dormant, <a href="stake" class="text-decoration-none text-white bg-primary p-2 m-2"> Stake Now </a> To Activate Your Account And Start Earning<span class='close-alert pr-2' style='cursor:pointer'>&times;</span></div>
          <?php }else if(isset($Active) && $Active == 1 && $accstakeStatus == 'Active'){?>
            <!-- <div class='alert-success pt-2 pb-2 pr-2 pl-2 mt-3 mb-3 eligible'> Your Account Is Dormant, <a href="stake" class="text-decoration-none text-white bg-primary p-2 m-2"> Stake Now </a> To Activate Your Account And Start Earning<span class='close-alert pr-2' style='cursor:pointer'>&times;</span></div> -->
          <?php } ?>
      </div><!-- /.container-fluid -->
      <div class="we-work text-center">
        We do the hard work, you earn the money
        <b>...Is that simple</b>
        <div>
          <strong>Our cutting edge software <i class="fas fa-rocket"></i> gives us advantage in crypto ecosystem and you in turn earn from our hard work</strong>  
        </div>
        <div class="btc-more-e">
          <img src="https://localhost/coinauctionpro/images/coin-logos/bitcoin-btc-logo.png" alt="bitcoin more" class='btc-more'><b>Invest And Earn More Crypto Today</b>
        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Info boxes -->
        <div class="row">

        <!-- nEW MEMBERS -->
        <div class="col-12 mt-5 mb-5 text-center">
            <div class="text-center">
              <i class="fas fa-users fa-3x"></i>

              <div class="info-box-content">
                <span class="info-box-text">NEW MEMBERS JOINED</span>
                <div>
                  <b class='invest-pt'><?php echo @$newmembers?></b> 
                </div>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          
          
            <div class="container mt-2 mb-5 text-center">
              <div class="row">
                
                <div class="col-md-3">
                  <div class="bid-level pt-2 pb-2 text-center">
                    <i class="fas fa-rocket"></i>
                    <span class="info-box-text">STAKE PACKAGE</span>
                    <div><b class='invest-pt'><?php echo $bidLevel;?></b></div>
                  </div>
                </div> 

                <div class="col-md-3">
                  <div class="bid-level pt-2 pb-2 text-center">
                    <i class="fas fa-level-up-alt"></i>
                    <span class="info-box-text">ACCOUNT LEVEL</span>
                    <div><b class='invest-pt'><?php echo $accLevel;?></b></div>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="bid-level pt-2 pb-2 text-center">
                    <i class="fas fa-hand-holding-usd"></i>
                    <span class="info-box-text">POINT RECEIVED (PR) </span>
                    <div><b class='invest-pt'><?php echo $pointReceived;?></b></div>
                  </div>
                </div> 

                <div class="col-md-3">
                  <div class="bid-level pt-2 pb-2 text-center">
                    <?php echo @$upgradeAcc;?>
                  </div>
                </div> 

              </div>
            </div>
          <!-- /.col -->
      
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-1 elevation-1"><i class="fas fa-dollar-sign"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">TOTAL STAKE AMOUNT</span>
                <b class='invest-pt'><?php echo @$auctAmt?></b>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
      
          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-2 elevation-1"><i class="fas fa-money-bill"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">STAKING COIN</span>
                <b class='invest-pt'><?php 
                  echo @$auctChannel
                ?></b>
                  
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-3 elevation-1"><i class="fas fa-chart-line"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">TOTAL PERCENTAGE STAKE GROWTH</span>
                <b class='invest-pt'><?php echo $growthrate;?></b>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          
        </div>
        <!-- /.row -->

        <!-- Upload testimonies starts -->

        <div class="testimonial-upload-form mx-auto pt-3 mt-5">
            <div class="modal-body w-75 mx-auto">

            <?php
            require_once'config.php';
            require_once'dbh.php';

            if((isset($_FILES['testimony']) && isset($_POST['submit']) && $_FILES['testimony']["name"] != "" && isset($_FILES['testimony']["name"]))) {
                
                
                $filename = $_FILES['testimony']["name"];
                $type = $_FILES['testimony']["type"];
                $_SESSION['type'] = $type;
                $filesize = $_FILES['testimony']['size'];
                $source =  $_FILES['testimony']['tmp_name'];
                $path_to_file_directory = "testimonies/";
                $destination = $path_to_file_directory.$filename;
                $uploadOk = "";
                $fileError = "";
                
            if($filesize > 50000000) {
                $fileError = "File size too big, images should be less than 50MB";
                $uploadOk = 0;
            }
            if(!preg_match('/[.](jpg)|(gif)|(jpeg)|(png)|(PNG)$/', $filename)) {
                $fileError = "image must be a jpg, gif, jpeg or png format";
                $uploadOk = 0;
            }
            else if(!preg_match('/[.](mp4)|(mov)|(web)|(hd)$/', $filename)) {
                $fileError = "Video must be a mov, mp4 or web format";
                $uploadOk = 0;
            }
            
            if($uploadOk == "" && $fileError == ""){
                
                $path_to_file_directory = 'testimonies/';
                // $path_to_thumbnail_directory = 'testimonies_thumbnails/';

                $source = $_FILES['testimony']['tmp_name'];
                $target = $path_to_file_directory.$filename;

                move_uploaded_file($source,$target);

            // if(preg_match('/[.]jpg$/', $filename)) {
            //     $im = imagecreatefromjpeg($path_to_file_directory.$filename);
            // }else if(preg_match('/[.]jpeg$/', $filename)) {
            //     $im = imagecreatefromjpeg($path_to_file_directory.$filename);
            // }else if (preg_match('/[.]gif$/', $filename)) {
            //     $im = imagecreatefromgif($path_to_file_directory.$filename);
            // }else if (preg_match('/[.]png$/', $filename)) {
            //     $im = imagecreatefrompng($path_to_file_directory.$filename);
            // }

            // $ox = imagesx($im);
            // $oy = imagesy($im);

            // $nx = $image_final_width;
            // $ny = $image_final_height;

            // $nm = imagecreatetruecolor($nx,$ny);

            // imagecopyresized($nm, $im, 0,0,0,0, $nx,$ny,$ox,$oy);

            }
                
            if(!file_exists($path_to_file_directory)) {

                if(mkdir($path_to_file_directory,0777)) {
                    // imagejpeg($nm,$path_to_file_directory.$filename);
                    $testimony = $path_to_file_directory.$filename;

                    $con = new PDO("mysql:host=$serverhost;dbname=coinauct_db;" , $serverusername, $serverpassword);
                    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $select = $con -> prepare("SELECT * FROM testimonies WHERE testimony = ? AND email = ?");
                    $select -> bindParam(1,$testimony);
                    $select -> bindParam(2,$email_of_user);
                    if($select -> execute() && $select -> rowCount() > 0 ) {
                        
                        }else {
                            $insetThumb = $con -> prepare("INSERT INTO testimonies (testimony,uname,email) VALUES (?,?,?)");
                            $insetThumb -> bindParam(1,$testimony);
                            $insetThumb -> bindParam(2,$name);
                            $insetThumb -> bindParam(3,$email_of_user);
                            $insetThumb -> execute();
                            echo "<div class='alert-success'> Testimony Upload Successful </div>";
                            exit();
                            }
                        }
                    
                }else {
                    // imagejpeg($nm, $path_to_file_directory.$filename);

                    $testimony = $path_to_file_directory.$filename;

                    $con = new PDO("mysql:host=$serverhost;dbname=coinauct_db;" , $serverusername, $serverpassword);
                    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $select = $con -> prepare("SELECT * FROM testimonies WHERE testimony = ? AND email = ?");
                    $select -> bindParam(1,$testimony);
                    $select -> bindParam(2,$email_of_user);
                    if($select -> execute() && $select -> rowCount() > 0 ) {
                        echo "<div class='alert-success'> You have upload this file before </div>";
                        }else {
                            $insetThumb = $con -> prepare("INSERT INTO testimonies (testimony,uname,email) VALUES (?,?,?)");
                            $insetThumb -> bindParam(1,$testimony);
                            $insetThumb -> bindParam(2,$name);
                            $insetThumb -> bindParam(3,$email_of_user);
                            $insetThumb -> execute();
                            echo "<div class='alert-success'> Testimony Upload Successful </div>";
                            }

                    }
                        
            }else{
            $fileError = 'Select File First';

            }

            ?>

            
                <form action='' method='POST' class='testimony-upload-form' id="testimony-upload-form" enctype="multipart/form-data">
                    
                    <div class="form-group">
                      <h4 class='text-center text-white bg-primary rounded'> Upload Images and Videos Recordings Of Your Earnings With Coin Auction Pro </h4>
                    </div>

                    <div class="alert-success">
                      <?php echo @$fileError; ?>
                    </div>
                    <div class="input-group mb-1 pb-1">
                    <!-- <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                    </div> -->
                      <div class="form-group">
                          <span id='status'></span>
                      </div>
                      
                      <div class="custom-file">
                          <input type="file" class="custom-file-input" name="testimony" id="testimony-upload-btn" onclick="uploadTestimony('testimony-upload-btn')"
                          aria-describedby="inputGroupFileAddon01">
                          <label class="custom-file-label" for="inputGroupFile01" id="selected-file">Choose file</label>
                      </div>
                    </div>
                    
                    <div class="form-group text-center mx-auto">
                      <div class="mb-5">
                          <button type="submit" class="btn btn-primary" name="submit" id="">
                          <i class="fas fa-level-up-alt"></i> Upload Testimony 
                          </button>
                          <button class="btn reset" type="reset">Cancel</button>
                      </div>
                    </div>

                    <!-- <div class="form-group text-center mt-5 mb-5">
                    <button id="updateP" type="submit" name="addmoreinvestOpt" class="btn btn-primary btnpmd" id='submit_account'>Add More auction Options</button>
                    </div> -->
                </form>

            </div>

            <?php
            require_once'config.php';
            $inv = $con->prepare("SELECT testimony FROM testimonies WHERE email = ? ");
            $inv -> bindParam(1,$email_of_user);
            $paginate = $con->prepare("SELECT count(id) AS id FROM testimonies WHERE email = ?");
            $paginate -> bindParam(1,$email_of_user);
            $paginate -> execute();   
            
            if($inv -> execute() && $inv -> rowCount() > 0) {
                $in = $inv -> fetchAll(PDO::FETCH_ASSOC);
                $allowed_imgtype = array('jpeg','jpg','png','gif');
                $allowed_vidtype = array('mp4','mov','web','hd');

                $countd = $paginate -> fetchAll(PDO::FETCH_ASSOC);
                $totalcountd = $countd[0]['id'];
                $pages = ceil($totalcountd / $limit); 
                $Previous = $page - 1;
                $Next = $page + 1;

                echo "<h3 class='p-3 m-2 mx-auto text-center'>MY TESTIMONIES</h3>";
                echo "<div>
                        <div class='row'>";
                  
                foreach($in as $n) {
                    $cname = ucfirst($name);
                    $testimonies = $n['testimony'];
                    $explodeFile = explode('.',$testimonies);
                    $fileType = $explodeFile[1];
                    if (in_array($fileType,$allowed_imgtype)) {
                        $testimoniesd = "<img src='$testimonies' alt='testimony image' class='rounded testimony-file'> 
                        <div class='col-12 text-center text-secondary testimony-user'> Testimony by:  <span class='font-weight-bold'>$cname</span></div>";
                        $_SESSION['thumb'] = $testimonies;
                    }
                    
                    if(in_array($fileType,$allowed_vidtype)) {
                    
                    $testimoniesd = "<iframe id='player' src=".$testimonies." class='text-center testimony-file rounded' preload='none' controls playsinline >
                                      </iframe>
                                      <div class='col-12 text-center text-secondary testimony-user'> Video testimony by:  <span class='font-weight-bold'>$cname</span></div>
                                      ";
                    }
                    echo "<div class='col-xs-12 col-sm-12 col-md-6 col-lg-4'>
                            $testimoniesd
                          </div>";
          
                }
                echo "</div>
                    </div>";    

                echo "<div class='row text-center col-12 paginate-add'>
                    <div class='col-12 text-center paginate'>
                        <nav aria-label='Page navigation'>
                            <ul class='pagination text-center' style='list-style:none;'>";
                        if($page > 1) {
                            echo "<li class='active'>
                                    <a href='uploadtestimonials?page=$Previous' aria-label='Previous'>
                                        <span aria-hidden='true'>
                                            &laquo; Previous                        
                                        </span>
                                    </a>
                                </li>";
                                }       
                        
                                for($i = 1; $i <= $pages; $i++) {
                                    echo "<li class='inner'><a href='uploadtestimonials?page=$i'>$i</a></li>";
                                }
                        if($page > 1) {
                            echo "<li>
                                    <a href='uploadtestimonials?page=$Next' aria-label='Next'>
                                        <span aria-hidden='true'>
                                            Next &raquo;                        
                                        </span>
                                    </a>
                                </li>";
                        }
                            echo "
                            </ul>
                        </nav>
                    </div>
                </div>";

            }else {
                echo "<div class='alert-success'> You Have Not Uploaded Any Testimony!</div>";
            }
          ?>
        </div>

        <!-- Upload testimonies end -->


            <!-- Bidding details -->

            <?php
            require_once'config.php';
            $inv = $con->prepare("SELECT auctionId,auctionAmount,auction_type,auctionChannel,growthRate,accumulatedgrowthRate,auctionStatus FROM auction_table WHERE clientEmail = ? ");
            $inv -> bindParam(1,$email_of_user);
            if($inv -> execute() && $inv -> rowCount() > 0) {
              $in = $inv -> fetchAll(PDO::FETCH_ASSOC);
              
              echo "<div class='text-center col-12 table-responsive mt-5 mb-5 pt-2 pb-2'>";
                echo "<table  class='table text-left table-responsive table-striped table-bordered table-sm' cellspacing='0' col='5' width='100%'>
                        <thead>
                        <tr>
                            <th class='th-xs'>Bid Id

                            </th>
                            <th class='th-xs'>Bid Amount

                            </th>
                            <th class='th-xs'>Bidding Coin

                            </th>
                            <th class='th-xs'>Bidding Type

                            </th>
                            <th class='th-xs'>Growth Rate(% Daily)

                            </th>
                            <th class='th-xs'>Accumulated Growth Rate(Days)

                            </th>
                            <th class='th-xs'>Status

                            </th>
                        </tr>
                        </thead>";
                foreach ($in as $key => $value) {
                    # code...
                    $auctAmt = $value['auctionAmount'];
                    $auctChannel = $value['auctionChannel'];
                    $growthrate = $value['growthRate'].'%';
                    $auctionTyp = $value['auction_type'];
                    $accumulatedgR = $value['accumulatedgrowthRate'];
                    $aucStat = $value['auctionStatus'];
                    $auctId = $value['auctionId'];

                    if($aucStat == 'Inactive') {
                      $auctStat = "<span class='p-2 bg-danger rounded'> $aucStat </span> <span class='info-box-text'><a rel='nofollow' style='cursor:pointer' class='text-decoration-none p-2 rounded text-normal m-1 bg-success' data-toggle='modal' data-target='#activateStake' aria-haspopup='true' aria-expanded='false'>Activate Now</a></span>";
                    }else {
                      $auctStat = "<span class='p-2 bg-success rounded'> $aucStat </span>";
                    }

                    echo "<tbody>
                      <tr>
                          <td>$auctId</td>
                          <td>$auctAmt</td>
                          <td>$auctChannel</td>
                          <td>$auctionTyp</td>
                          <td>$growthrate</td>
                          <td>$accumulatedgR</td>
                          <td>$auctStat</td>
                      </tr>
                  </tbody>";
                      }
          echo "</table>";
          echo "</div>";
         
        }
        else{
            echo "<div class='no-invest text-center pt-3 pb-3' id='no-invest' name='no-invest'><b>No Stake Record Found</b> <a href='stake' class='text-decoration-none p-2 rounded bg-primary' target='_blank'> Stake To Earn </a> </div>";
            $noStakeFound = "No Earnings Found <a href='stake' target='_blank' class='text-decoration-none p-2 rounded bg-primary'> Stake To Earn </a>"; 
        }

        if(isset($Active) && $Active == 1 && $accstakeStatus == 'Inactive') {
          $noStakeFound = "No Earnings Found <a href='stake' target='_blank'> Stake To Earn </a>";
        }
          ?>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Earning Report</h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <p class="text-center">
                      <strong>My Bid Earnings Graph</strong>
                    </p>

                    <div id="chart-container">
                        <canvas id="myChart"></canvas>
                        <div class="col-md-12 text-center p-2 m-3 no-earnings">
                          <strong><?php echo @$noStakeFound; ?></strong>
                        </div>
                    </div>
                    <!-- /.chart-responsive -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        




        <!-- Activate Account Stake Modal Starts -->

                                    
        <div class="modal fade" id="activateStake" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
              <div class="modal-header text-center mx-auto">
                  <h5 class="modal-title" id="exampleModalLabel">ACTIVATE ACCOUNT</h5>
                  <button type="button" class="close text-right" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  
                <form action='' method='POST' class='upgrade-form' id="deposit_form">
                  
                <div class="form-group">
                    <label id="reg-as" class="col-form-label">Select Account Activation Package<span class="text-danger">*</span></label>
                    <select name='bid_type' id='auction-type' class="form-control bidType">
                      <option value=''> -Select Activation Level- </option>
                      <option value='Starter'> Starter ($500-$1000)</option>
                      <option value='Elite'> Elite ($500-$1000)</option>
                      <option value='Prime'> Prime ($1000-$10,000)</option>
                      <option value='Pro'> Pro ($10,000-$100,000)</option>
                    </select>
                    <div class="col-md-12">
                      <small>
                        <div class="selectpackageAlert" id="selectpackageAlert"></div>
                      </small>
                    </div>
                </div>    
                      
                <div class='form-group' >
                  <label id="reg-as" class="col-form-label">Select Activation Life Cycle<span class="text-danger">*</span></label>
                    <select name='biddingCycle' id='bidCycle' class="form-control" onmouseout="selectbidCycle('bidCycle')" required>
                        <option class='optin' value=''> Select Activation Life Cycle </option>
                        <option class='optin' value='6 Months'>6 Months (10% Additional Profit Bonus + Capital)</option>
                        <option class='optin' value='1 Year'> 1 Year (30% Additional Profit Bonus + Capital)</option>
                    </select>
                    <div class="selectbidcycle" id='selectbidcycleAlert'></div>
                </div>
                    
                <div class="form-row">
                  <div class="row">
                    <div class="form-group col-md-7 col-sm-7 col-xs-7">
                      <label  for="fund_method" class="text-left">
                            <strong>Activation Amount<span class="text-danger">*</span></strong>
                      </label>
                      <div class="">
                          <input name="auctionAmount" id="auctionAmount" onblur="InvestComut()" placeholder="e.g 10000" value="" size="10" type="number" class="form-control" 
                          required />
                      </div>
                    </div>
                    <div class="form-group col-md-5 col-sm-5 col-xs-5">
                      <label for="inputState">Transaction Fee(3%)</label>
                      <input type="text" class="form-control pb-2" id='trx-fee' name="transaction-fee" class="form-control">
                    </div>
                    <div class="col-md-12">
                      <small><div class="text-center" id='amtAlert'></div></small>
                      <small><div class="text-center" id="amtminAlert"></div></small>
                      <small><div class="text-center" id="withAlert"></div></small>
                    </div>
                  </div>
                </div>
                    

                <div class="form-group">
                      <label  for="" class="text-left">
                            <strong>Choose Activation Coin<span class="text-danger">*</span></strong>
                      </label>
                      <select name="fund_method" id="auctionChannel" name="auctionChannel"  class="form-control" onclick="selectInvestChannel('auctionChannel')" required >
                          <option class='optin' value="" selected>- Select -</option>
                          <option class='optin' value="Bitcoin">Bitcoin</option>
                          <option class='optin' value="Ethereum">Ethereum</option>
                          <option class='optin' value="Tron">Tron</option>
                          <option class='optin' value="Ripples">Ripples</option>
                      </select>
                  </div>

                <div class="form-group" id='bitcoin-invest' style="border: 1px solid #eeeaef;border-radius:4px;display:none;">
                  <div class="container pt-3 pb-3">
                    <h6 class="text-center mx-auto">Send <span class="coinAmt"></span> Bitcoin To The Bitcoin Wallet Below <br><small>We Confirm Your Stake Within 1-3 Hours</small></h6>
                    <label for="btc-pay" class="col-form-label"><small>Make Sure You Have Sent Your Bitcoin Before Clicking Stake Package  Button To Submit (After Which You Send Payment Screenshots to <a href='#' class='support-email'> support@coinauctionpro.com </a> For Confirmations)</small></label>
                    <div class="row">
                        <div class="col-md-10">
                        <input type="text" class="form-control pb-2" id='btc-address' class="wallet-address" name="wallet-address" value="bc1q8ceqxqwdhl784y4rq4g9ejcx72w8r38hgszygh">
                        </div>
                        <div class="col-md-2 copy">
                          <i class="far fa-copy"></i> <small class='copied'>Copy</small> 
                        </div>
                    </div>
                    <!-- <h6 class="mt-2 pt-1">Copy Our Company Bitcoin Wallet Address Below And Send The Equivalent Of Your Stake Amount To It</h6> -->
                    
                  </div>
                </div>

                <div class="form-group" id='ethereum-invest' style="border: 1px solid #eeeaef;border-radius:4px;display:none;">
                  <div class="container pt-3 pb-3">
                    <h6 class="text-center mx-auto">Send <span class="coinAmt"></span> Ethereum To The Etherum Wallet Below<br><small> We Confirm Your Stake Within 1-3 Hours</small></h6>
                    <label for="btc-pay" class="col-form-label"><small>Make Sure You Have Sent Your Ethereum Before Clicking Stake Package Button To Submit (After Which You Send Payment Screenshots to <a href='#' class='support-email'> support@coinauctionpro.com </a> For Confirmations)</small></label>
                    <div class="row">
                        <div class="col-md-10">
                          <input type="text" class="form-control pb-2" id='eth-address' name="wallet-address" class="wallet-address" value="0x345DdB0e965733e3e625F7F9dca8c6Beedbb8C67">
                        </div>
                        <div class="col-md-2 copy">
                          <i class="far fa-copy"></i> <small class='copied'>Copy</small>
                        </div>
                    </div>
                    <!-- <h6 class="mt-2 pt-1">Copy Our Company Ethereum Wallet Address Below And Send The Equivalent Of Your Stake Amount To It</h6> -->
                  </div>
                </div>

                <div class="form-group" id='Tron-invest' style="border: 1px solid #eeeaef;border-radius:4px;display:none;">
                  <div class="container pt-3 pb-3">
                    <h6 class="text-center mx-auto">Send <span class="coinAmt"></span> Tron To The Tron Wallet Below<br><small>We Confirm Your Ugprade Within 1-3 Hours</small></h6>
                    <label for="btc-pay" class="col-form-label"><small>Make Sure You Have Sent Your Tron Before Clicking Stake Package Button To Submit (After Which You Send Payment Screenshots to <a href='#' class='support-email'> support@coinauctionpro.com </a> For Confirmations)</small></label>
                    <div class="row">
                        <div class="col-md-10">
                          <input type="text" class="form-control pb-2" id='trx-address' class="wallet-address" name="wallet-address" value="TAQ29shyddcyY5NLQDMFLnLLCk6c25J6G2">
                        </div>
                        <div class="col-md-2 copy">
                          <i class="far fa-copy"></i> <small class='copied'>Copy</small>
                        </div>
                    </div>
                    <!-- <h6 class="mt-2 pt-1">Copy Our Company Tron Wallet Address Below And Send The Equivalent Of Your Stake Amount To It</h6> -->
                  </div>
                </div>

                <div class="form-group" id='Ripples-invest' style="border: 1px solid #eeeaef;border-radius:4px;display:none;">
                  <div class="container pt-3 pb-3">
                    <h6 class="text-center mx-auto">Send <span class="coinAmt"></span> Ripples To The Ripples Wallet Below<br><small>We Confirm Your Stake Within 1-3 Hours</small></h6>
                    <label for="btc-pay" class="col-form-label"><small>Make Sure You Have Sent Your Ripples Before Clicking Stake Package Button To Submit (After Which You Send Payment Screenshots to <a href='#' class='support-email'> support@coinauctionpro.com </a> For Confirmations)</small></label>
                    <div class="row">
                        <div class="col-md-10">
                          <input type="text" class="form-control pb-2" id='rpx-address' name="wallet-address" class="wallet-address" value="TAQ29shyddcyY5NLQDMFLnLLCk6c25J6G2">
                        </div>
                        <div class="col-md-2 copy">
                          <i class="far fa-copy"></i> <small class='copied'>Copy</small>
                        </div>
                    </div>
                    <!-- <h6 class="mt-2 pt-1">Copy Our Company Tron Wallet Address Below And Send The Equivalent Of Your Stake Amount To It</h6> -->
                  </div>
                </div>

                <div class="form-group text-center mx-auto">
                  <div class="mb-5">
                    <button type="submit" class="btn btn-primary"  onclick="depositFunds()"   id="funds_btn">
                      <i class="fas fa-level-up-alt"></i> Activate Now
                    </button>
                    <button class="btn reset" type="reset">Cancel</button>
                  </div>
                </div>

                    <!-- <div class="form-group text-center mt-5 mb-5">
                      <button id="updateP" type="submit" name="addmoreinvestOpt" class="btn btn-primary btnpmd" id='submit_account'>Add More auction Options</button>
                    </div> -->
                  </form>
              </div>
              
              </div>
            </div>
          </div>
          <!-- Activate Account Stake Modal Ends -->




         <!-- add more/change auction options php -->

                                    
         <div class="modal fade" id="addMoreInvestOptions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
              <div class="modal-header text-center mx-auto">
                  <h5 class="modal-title" id="exampleModalLabel">UPGRADE PACKAGE</h5>
                  <button type="button" class="close text-right" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  
                <form action='' method='POST' class='upgrade-form' id="deposit_form">
                  
                <div class="form-group">
                  <?php
                          if(isset($bidLevel) && $bidLevel == 'Starter') { 
                      ?>
                      <label id="reg-as" class="col-form-label">Select Upgrade Package<span class="text-danger">*</span></label>
                      <select name='bid_type' id='auction-type' class="form-control bidType">
                        <option value=''> -Select Upgrade Level- </option>
                        <option value='Elite'> Elite ($500-$1000)</option>
                        <option value='Prime'> Prime ($1000-$10,000)</option>
                        <option value='Pro'> Pro ($10,000-$100,000)</option>
                      </select>
                        
                      <?php } else if(isset($bidLevel) && $bidLevel == 'Elite'){ ?>
                      <label id="reg-as" class="col-form-label">Select Upgrade Package<span class="text-danger">*</span></label>
                      <select name='bid_type' id='auction-type' class="form-control bidType">
                          <option value=''> -Select Upgrade Level- </option>
                          <option value='Prime'> Prime ($1000-$10,000)</option>
                          <option value='Pro'> Pro ($10,000-$100,000)</option>
                      </select>

                      <?php } else if(isset($bidLevel) && $bidLevel == 'Prime'){ ?>
                      <label id="reg-as" class="col-form-label">Select Upgrade Package<span class="text-danger">*</span></label>
                      <select name='bid_type' id='auction-type' class="form-control bidType">
                          <option value=''> -Select Upgrade Level- </option>
                          <option value='Pro'> Pro ($10,000-$100,000)</option>
                      </select>

                      <?php } else if(isset($bidLevel) && $bidLevel == 'Pro'){ ?>
                      <div><strong>Maximum Level Reached</strong></div>
                  <?php }?>
                  <div class="col-md-12">
                    <small><div class="selectpackageAlert" id="selectpackageAlert"></div></small>
                  </div>
                </div>
                
                <div class='form-group' >
                  <label id="reg-as" class="col-form-label">Select Upgrade Life Cycle<span class="text-danger">*</span></label>
                    <select name='biddingCycle' id='bidCycle' class="form-control bidCycle" onmouseout="selectbidCycle('bidCycle')" required>
                        <option class='optin' value='6 Months'>6 Months (10% Additional Profit Bonus + Capital)</option>
                        <option class='optin' value='1 Year'> 1 Year (30% Additional Profit Bonus + Capital)</option>
                    </select>
                    <div class="selectbidcycle" id='selectbidcycleAlert'></div>
                </div>
                    
                <div class="form-row">
                  <div class="row">
                    <div class="form-group col-md-7 col-sm-7 col-xs-7">
                      <label  for="fund_method" class="text-left">
                            <strong>Upgrade Amount<span class="text-danger">*</span></strong>
                      </label>
                      <div class="">
                          <input name="auctionAmount" id="auctionAmount" onblur="InvestComut()" placeholder="e.g 10000" value="" size="10" type="number" class="form-control" 
                          required />
                      </div>
                    </div>
                    <div class="form-group col-md-5 col-sm-5 col-xs-5">
                      <label for="inputState">Transaction Fee(3%)</label>
                      <input type="text" class="form-control pb-2" id='trx-fee' name="transaction-fee" class="form-control">
                    </div>
                    <div class="col-md-12">
                      <small><div class="text-center" id='amtAlert'></div></small>
                      <small><div class="text-center" id="amtminAlert"></div></small>
                      <small><div class="text-center" id="withAlert"></div></small>
                    </div>
                  </div>
                </div>
                    

                <div class="form-group">
                      <label  for="" class="text-left">
                            <strong>Choose Upgrade Coin<span class="text-danger">*</span></strong>
                      </label>
                      <select name="fund_method" id="auctionChannel" name="auctionChannel"  class="form-control" onclick="selectInvestChannel('auctionChannel')" required >
                          <option class='optin' value="" selected>- Select -</option>
                          <option class='optin' value="Bitcoin">Bitcoin</option>
                          <option class='optin' value="Ethereum">Ethereum</option>
                          <option class='optin' value="Tron">Tron</option>
                          <option class='optin' value="Ripples">Ripples</option>
                      </select>
                  </div>

                <div class="form-group" id='bitcoin-invest' style="border: 1px solid #eeeaef;border-radius:4px;display:none;">
                  <div class="container pt-3 pb-3">
                    <h6 class="text-center mx-auto">Send <span class="coinAmt"></span> Bitcoin To The Bitcoin Wallet Below <br><small>We Confirm Your Upgrade Within 1-3 Hours</small></h6>
                    <label for="btc-pay" class="col-form-label"><small>Make Sure You Have Sent Your Bitcoin Before Clicking Upgrade Package  Button To Submit (After Which You Send Payment Screenshots to <a href='#' class='support-email'> support@coinauctionpro.com </a> For Confirmations)</small></label>
                    <div class="row">
                        <div class="col-md-10">
                        <input type="text" class="form-control pb-2" id='btc-address' class="wallet-address" name="wallet-address" value="bc1q8ceqxqwdhl784y4rq4g9ejcx72w8r38hgszygh">
                        </div>
                        <div class="col-md-2 copy">
                          <i class="far fa-copy"></i> <small class='copied'>Copy</small> 
                        </div>
                    </div>
                    <!-- <h6 class="mt-2 pt-1">Copy Our Company Bitcoin Wallet Address Below And Send The Equivalent Of Your Upgrade Amount To It</h6> -->
                    
                  </div>
                </div>

                <div class="form-group" id='ethereum-invest' style="border: 1px solid #eeeaef;border-radius:4px;display:none;">
                  <div class="container pt-3 pb-3">
                    <h6 class="text-center mx-auto">Send <span class="coinAmt"></span> Ethereum To The Etherum Wallet Below<br><small> We Confirm Your Upgrade Within 1-3 Hours</small></h6>
                    <label for="btc-pay" class="col-form-label"><small>Make Sure You Have Sent Your Ethereum Before Clicking Upgrade Package Button To Submit (After Which You Send Payment Screenshots to <a href='#' class='support-email'> support@coinauctionpro.com </a> For Confirmations)</small></label>
                    <div class="row">
                        <div class="col-md-10">
                          <input type="text" class="form-control pb-2" id='eth-address' name="wallet-address" class="wallet-address" value="0x345DdB0e965733e3e625F7F9dca8c6Beedbb8C67">
                        </div>
                        <div class="col-md-2 copy">
                          <i class="far fa-copy"></i> <small class='copied'>Copy</small>
                        </div>
                    </div>
                    <!-- <h6 class="mt-2 pt-1">Copy Our Company Ethereum Wallet Address Below And Send The Equivalent Of Your Upgrade Amount To It</h6> -->
                  </div>
                </div>

                <div class="form-group" id='Tron-invest' style="border: 1px solid #eeeaef;border-radius:4px;display:none;">
                  <div class="container pt-3 pb-3">
                    <h6 class="text-center mx-auto">Send <span class="coinAmt"></span> Tron To The Tron Wallet Below<br><small>We Confirm Your Ugprade Within 1-3 Hours</small></h6>
                    <label for="btc-pay" class="col-form-label"><small>Make Sure You Have Sent Your Tron Before Clicking Upgrade Package Button To Submit (After Which You Send Payment Screenshots to <a href='#' class='support-email'> support@coinauctionpro.com </a> For Confirmations)</small></label>
                    <div class="row">
                        <div class="col-md-10">
                          <input type="text" class="form-control pb-2" id='trx-address' class="wallet-address" name="wallet-address" value="TAQ29shyddcyY5NLQDMFLnLLCk6c25J6G2">
                        </div>
                        <div class="col-md-2 copy">
                          <i class="far fa-copy"></i> <small class='copied'>Copy</small>
                        </div>
                    </div>
                    <!-- <h6 class="mt-2 pt-1">Copy Our Company Tron Wallet Address Below And Send The Equivalent Of Your Upgrade Amount To It</h6> -->
                  </div>
                </div>

                <div class="form-group" id='Ripples-invest' style="border: 1px solid #eeeaef;border-radius:4px;display:none;">
                  <div class="container pt-3 pb-3">
                    <h6 class="text-center mx-auto">Send <span class="coinAmt"></span> Ripples To The Ripples Wallet Below<br><small>We Confirm Your Upgrade Within 1-3 Hours</small></h6>
                    <label for="btc-pay" class="col-form-label"><small>Make Sure You Have Sent Your Ripples Before Clicking Upgrade Package Button To Submit (After Which You Send Payment Screenshots to <a href='#' class='support-email'> support@coinauctionpro.com </a> For Confirmations)</small></label>
                    <div class="row">
                        <div class="col-md-10">
                          <input type="text" class="form-control pb-2" id='rpx-address' name="wallet-address" class="wallet-address" value="TAQ29shyddcyY5NLQDMFLnLLCk6c25J6G2">
                        </div>
                        <div class="col-md-2 copy">
                          <i class="far fa-copy"></i> <small class='copied'>Copy</small>
                        </div>
                    </div>
                    <!-- <h6 class="mt-2 pt-1">Copy Our Company Tron Wallet Address Below And Send The Equivalent Of Your Upgrade Amount To It</h6> -->
                  </div>
                </div>

                <div class="form-group text-center mx-auto">
                  <div class="mb-5">
                    <button type="submit" class="btn btn-primary"  onclick="upgradeForm()"   id="funds_btn">
                      <i class="fas fa-level-up-alt"></i> Upgrade Now
                    </button>
                    <button class="btn reset" type="reset">Cancel</button>
                  </div>
                </div>

                    <!-- <div class="form-group text-center mt-5 mb-5">
                      <button id="updateP" type="submit" name="addmoreinvestOpt" class="btn btn-primary btnpmd" id='submit_account'>Add More auction Options</button>
                    </div> -->
                  </form>
              </div>
              
              </div>
            </div>
          </div>
          <!-- Add More Invest Options Modal Ends -->
        
       <!-- Crypto Widget -->
      <div class="crypto-widget">
        <div class="col-12">
          <h4 class='text-center'> BITCOIN CHART TODAY</h4>
          <div style="height:560px; background-color: #FFFFFF; overflow:hidden; box-sizing: border-box; border: 1px solid #56667F; border-radius: 4px; text-align: right; line-height:14px; font-size: 12px; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #56667F;padding:1px;padding: 0px; margin: 0px; width: 100%;"><div style="height:540px; padding:0px; margin:0px; width: 100%;"><iframe src="https://widget.coinlib.io/widget?type=chart&theme=light&coin_id=859&pref_coin_id=1505" width="100%" height="536px" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0" border="0" style="border:0;margin:0;padding:0;line-height:14px;"></iframe></div><div style="color: #FFFFFF; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing: border-box; padding: 2px 6px; width: 100%; font-family: Verdana, Tahoma, Arial, sans-serif;"><a href="https://coinlib.io" target="_blank" style="font-weight: 500; color: #FFFFFF; text-decoration:none; font-size:11px">Cryptocurrency Prices</a>&nbsp;by Coinlib</div></div>
        </div>

        <div class="col-12">
          <h4 class='text-center'>CRYPTO WATCH TODAY </h4>
          <div style="height:433px; background-color: #FFFFFF; overflow:hidden; box-sizing: border-box; border: 1px solid #56667F; border-radius: 4px; text-align: right; line-height:14px; font-size: 12px; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #56667F; padding: 0px; margin: 0px; width: 100%;"><div style="height:413px; padding:0px; margin:0px; width: 100%;"><iframe src="https://widget.coinlib.io/widget?type=full_v2&theme=light&cnt=6&pref_coin_id=1505&graph=yes" width="100%" height="409px" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0" border="0" style="border:0;margin:0;padding:0;"></iframe></div><div style="color: #FFFFFF; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing: border-box; padding: 2px 6px; width: 100%; font-family: Verdana, Tahoma, Arial, sans-serif;"><a href="https://coinlib.io" target="_blank" style="font-weight: 500; color: #FFFFFF; text-decoration:none; font-size:11px">Cryptocurrency Prices</a>&nbsp;by Coinlib</div></div>
        </div>
      </div>
        
      

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
    <strong>Copyright &copy; 2020 Coin Auction Pro. </strong>
    All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="https://localhost/coinauctionpro/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="https://localhost/coinauctionpro/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="https://localhost/coinauctionpro/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="https://localhost/coinauctionpro/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="https://localhost/coinauctionpro/dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="https://localhost/coinauctionpro/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="https://localhost/coinauctionpro/plugins/raphael/raphael.min.js"></script>
<script src="https://localhost/coinauctionpro/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="https://localhost/coinauctionpro/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- JavaScript files-->
<script lang="javascript" type="text/javascript" src="https://localhost/coinauctionpro/javascript/jquery.min.js"></script>
<script src="https://localhost/coinauctionpro/javascript/popper.js/umd/popper.min.js"> </script>
<script lang="javascript" type="text/javascript" src="https://localhost/coinauctionpro/bootstrap/js/bootstrap.min.js"></script>
<script src="https://localhost/coinauctionpro/javascript/jquery.cookie/jquery.cookie.js"> </script>
<script src="https://localhost/coinauctionpro/javascript/jquery-validation/jquery.validate.min.js"></script>
<script src="https://localhost/coinauctionpro/javascript/charts-custom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.js"></script>
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
<script src="https://localhost/coinauctionpro/javascript/front.js"></script>
<script src="https://localhost/coinauctionpro/javascript/invest.js"></script>
<script src="https://localhost/coinauctionpro/javascript/livechart.js"></script>

<!-- PAGE SCRIPTS -->
<script src="https://localhost/coinauctionpro/dist/js/pages/dashboard2.js"></script>
</body>
</html>
