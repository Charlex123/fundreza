<?php
ob_start();
session_start();
require_once'dbh.php';
require_once'config.php';

@$_SESSION['currentpage'] = $_SERVER['REQUEST_URI'];
htmlentities(strip_tags(@$_SESSION['currentpage']));

$user_data = @$_SESSION['user'];
$userid = $user_data['id'];
$name = @$user_data['fname'];


if(!isset($_SESSION['user'])) {
    header('Location:home');
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

  <title> Coin Auction Pro  | My Referral Details </title>

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
  <!-- Bootstrap CSS-->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script lang="javascript" type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
  <!-- Font Awesome CSS-->
  <link rel="stylesheet" type='text/css' href="fontawesome/fontawesomefiles/css/fontawesome.min.css">
  <link rel="stylesheet" type='text/css' href="fontawesome/fontawesomefiles/css/all.min.css">
  <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
  <script lang="javascript" type="text/javascript" src="fontawesome/fontawesomefiles/js/fontawesome.min.js"></script>
  <script lang="javascript" type="text/javascript" src="fontawesome/fontawesomefiles/js/all.min.js"></script>
  <!-- Fontastic Custom icon font-->
  <link rel="stylesheet" href="css/fontastic.css">
  <!-- Google fonts - Poppins -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
  <!-- theme stylesheet-->
  <!-- <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet"> -->
  <!-- Favicon-->
  <link rel="shortcut icon" href="images/icon.png">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="css/customs.css">
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

        <div class="row">
            <div class='ref _det' onclick = 'showrefDet()'>
                <?php require_once'dbh.php';require_once'config.php'; $refdet = new dbh(); $refdet -> getReferrer()?>
            </div>
        </div>
        <!-- /.row -->

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
                      <strong>My Bid Auction Earnings Graph</strong>
                    </p>

                    <div id="chart-container">
                        <canvas id="myChart"></canvas>
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
        
        
       <!-- Crypto Widget -->
      <section class="crypto-widget">
        <div class="col-12">
          <h4 class='text-center'> BITCOIN CHART TODAY</h4>
          <div style="height:560px; background-color: #FFFFFF; overflow:hidden; box-sizing: border-box; border: 1px solid #56667F; border-radius: 4px; text-align: right; line-height:14px; font-size: 12px; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #56667F;padding:1px;padding: 0px; margin: 0px; width: 100%;"><div style="height:540px; padding:0px; margin:0px; width: 100%;"><iframe src="https://widget.coinlib.io/widget?type=chart&theme=light&coin_id=859&pref_coin_id=1505" width="100%" height="536px" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0" border="0" style="border:0;margin:0;padding:0;line-height:14px;"></iframe></div><div style="color: #FFFFFF; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing: border-box; padding: 2px 6px; width: 100%; font-family: Verdana, Tahoma, Arial, sans-serif;"><a href="https://coinlib.io" target="_blank" style="font-weight: 500; color: #FFFFFF; text-decoration:none; font-size:11px">Cryptocurrency Prices</a>&nbsp;by Coinlib</div></div>
        </div>

        <div class="col-12">
          <h4 class='text-center'>CRYPTO WATCH TODAY </h4>
          <div style="height:433px; background-color: #FFFFFF; overflow:hidden; box-sizing: border-box; border: 1px solid #56667F; border-radius: 4px; text-align: right; line-height:14px; font-size: 12px; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #56667F; padding: 0px; margin: 0px; width: 100%;"><div style="height:413px; padding:0px; margin:0px; width: 100%;"><iframe src="https://widget.coinlib.io/widget?type=full_v2&theme=light&cnt=6&pref_coin_id=1505&graph=yes" width="100%" height="409px" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0" border="0" style="border:0;margin:0;padding:0;"></iframe></div><div style="color: #FFFFFF; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing: border-box; padding: 2px 6px; width: 100%; font-family: Verdana, Tahoma, Arial, sans-serif;"><a href="https://coinlib.io" target="_blank" style="font-weight: 500; color: #FFFFFF; text-decoration:none; font-size:11px">Cryptocurrency Prices</a>&nbsp;by Coinlib</div></div>
        </div>
      </section>
        
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
        
          <!-- Recent Updates -->
          <div class="col-md-6">
                  <div class="recent-updates card">
                    
                    <div class="card-header">
                      <h3 class="h4">Recent Updates</h3>
                    </div>
                    <div class="card-body no-padding">
                      <?php 
                        require_once'dbh.php';
                        require_once'config.php';
                        $up= new dbh(); $up-> showrecentUpdates();
                      ?>
                    </div>
                  </div>
                </div>
                
                <!-- Recent Activities -->
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="h4">Recent Activities</h3>
                    </div>
                    <div class="card-body no-padding">
                    <?php 
                        require_once'dbh.php';
                        require_once'config.php';
                        $up= new dbh(); $up-> showrecentActivities();
                      ?>
                    </div>
                  </div>
                </div>
        </div>
        <!-- /.row -->
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
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- JavaScript files-->
<script lang="javascript" type="text/javascript" src="javascript/jquery.min.js"></script>
<script src="javascript/popper.js/umd/popper.min.js"> </script>
<script lang="javascript" type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script src="javascript/jquery.cookie/jquery.cookie.js"> </script>
<script src="javascript/chart.js/Chart.min.js"></script>
<script src="javascript/jquery-validation/jquery.validate.min.js"></script>
<script src="javascript/charts-home.js"></script>
<script src="javascript/charts-custom.js"></script>
<!-- Main File-->
<script lang="javascript" type="text/javascript">
    $(document).ready(function () {
    $('#dtBasicExample').DataTable();
    $('.dataTables_length').addClass('bs-select');
  });
</script>
<script src="javascript/front.js"></script>
<script src="javascript/invest.js"></script>
<script src="javascript/livechart.js"></script>

<!-- PAGE SCRIPTS -->
<script src="dist/js/pages/dashboard2.js"></script>
</body>
</html>