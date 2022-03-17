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

  <title> Bitcoin News Today  | Investment History </title>

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
    <div>
        <?php 
          require_once'dbh.php';
          $aucthist = new dbh();
          $aucthist -> auctionHistory();
        ?>
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
<script src="javascript/invest.js"></script>
<script src="javascript/livechart.js"></script>

<!-- PAGE SCRIPTS -->
<script src="dist/js/pages/dashboard2.js"></script>
</body>
</html>
