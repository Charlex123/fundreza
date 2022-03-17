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

  <title> Bitcoin News Today  | Invest  </title>

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
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Bootstrap CSS-->
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
  <link rel="stylesheet" href="css/adminlte.min.css?n=1">
  <link rel="stylesheet" href="css/customs.css?n=1">
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
<body>
<?php
      require_once'config.php';
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
        <!-- Activate Account investment Modal Starts -->
        <div class="form-content mt-5">
              <div class="header text-center mx-auto mt-2">
                  <h5 class="title" id="exampleModalLabel">INVEST NOW TO EARN X5 </h5>
              </div>
              <div class="body">
                  
                <form action='' method='POST' class='upgrade-form bg-transparent' id="deposit_form">
                  
                <div class="form-group">
                  
                      <?php
                          if(isset($_GET['investment_package'])) {
                              $invt = $_GET['investment_package'];
                              $fed = str_replace('-',' ',$invt);
                              $cfed = ucwords($fed);
                              $ccfed = strip_tags($cfed);
                              echo "<div id='invest-select' value='$ccfed'></div>";
                          }
                          
                      ?>
                      <div class="select-package">Click on the drop down menu below to select the package you want to invest in</div>
                      <label id="reg-as" class="col-form-label font-weight-normal">Select Investment Package<span class="text-danger">*</span></label>
                      <select name='investmentPackage' id='investmentPackage' class="form-control investmentPack" onchange="selectInvestmentPackage('investmentPackage')">
                        
                        <option value=''> -Select Investement Package </option>
                        <?php if(isset($_GET['investment_package']) && $_GET['investment_package'] == "basic") {?>
                        <option value='Basic'> Basic Package (Amount $295)</option>
                        <?php }else if(isset($_GET['investment_package']) && $_GET['investment_package'] == "carbon") {?>
                        <option value='Carbon'> Carbon Package (Amount $590)</option>
                        <?php }else if(isset($_GET['investment_package']) && $_GET['investment_package'] == "fibre") {?>
                        <option value='Fibre'> Fibre Package (Amount $1,000)</option>
                        <?php }else if(isset($_GET['investment_package']) && $_GET['investment_package'] == "steel") {?>
                        <option value='Steel'> Steel Package (Amount $2,000)</option>
                        <?php }else if(isset($_GET['investment_package']) && $_GET['investment_package'] == "bronze") {?>
                        <option value='Bronze'> Bronze Package (Amount $5,000)</option>
                        <?php }else if(isset($_GET['investment_package']) && $_GET['investment_package'] == "silver") {?>
                        <option value='Silver'> Silver Package (Amount $20,000)</option>
                        <?php }else if(isset($_GET['investment_package']) && $_GET['investment_package'] == "gold") {?>
                        <option value='Gold'> Gold Package (Amount $50,000)</option>
                        <?php }else if(isset($_GET['investment_package']) && $_GET['investment_package'] == "vip") {?>
                        <option value='VIP'> VIP Package (Amount $100,000)</option>
                        <?php } else{?>
                        <option value='Basic'> Basic Package (Amount $295)</option>
                        <option value='Carbon'> Carbon Package (Amount $590)</option>
                        <option value='Fibre'> Fibre Package (Amount $1,000)</option>
                        <option value='Steel'> Steel Package (Amount $2,000)</option>
                        <option value='Bronze'> Bronze Package (Amount $5,000)</option>
                        <option value='Silver'> Silver Package (Amount $20,000)</option>
                        <option value='Gold'> Gold Package (Amount $50,000)</option>
                        <option value='VIP'> VIP Package (Amount $100,000)</option>
                        <?php }?>
                      </select>
                  <div class="col-md-12">
                    <small><div class="selectpackageAlert" id="selectpackageAlert"></div></small>
                  </div>
                </div>
                
                <div class="form-row inv-amount" id="inv-amount">
                  <div class="-p" id="basic-p">
                    <h4>Basic Package Features</h4>
                    <h5>You invest $295 to get <i class="fas fa-hand-point-down"></i></h5>
                    <ul class="listed-services" style="list-style:none;text-align:left">
                        <li><i class="fas fa-check-square"></i> You earn $62 - $71 profit every 3 - 5 days</li>
                        <li><i class="fas fa-check-square"></i> You earn $496 - $568 after 8 weeks</li>
                        <li><i class="fas fa-check-square"></i> PS: Your first profit of between $62 - $71 will arrive within 7 days and you can withdraw immediately</li>
                    </ul>
                  </div>

                  <div class="-p" id="carbon-p">
                    <h4>Carbon Package Features</h4>
                    <h5>You invest $590 to get <i class="fas fa-hand-point-down"></i></h5>
                    <ul class="listed-services" style="list-style:none;text-align:left">
                        <li><i class="fas fa-check-square"></i> You earn $139 - $155 profit every 3 - 5 days</li>
                        <li><i class="fas fa-check-square"></i> You earn $496 - $568 after 8 weeks</li>
                        <li><i class="fas fa-check-square"></i> PS: Your first profit of between $139 - $155 will arrive within 7 days and you can withdraw immediately</li>
                    </ul>
                  </div>

                  <div class="-p" id="fibre-p">
                    <h4>Fibre Package Features</h4>
                    <h5>You invest $1,000 to get <i class="fas fa-hand-point-down"></i></h5>
                    <ul class="listed-services" style="list-style:none;text-align:left">
                        <li><i class="fas fa-check-square"></i> You earn $258 - $280 profit every 3 - 5 days</li>
                        <li><i class="fas fa-check-square"></i> You earn $2,064 - $2,240 after 8 weeks</li>
                        <li><i class="fas fa-check-square"></i> PS: Your first profit of between $258 - $280 will arrive within 7 days and you can withdraw immediately</li>
                    </ul>
                  </div>

                  <div class="-p" id="steel-p">
                    <h4>Steel Package Features</h4>
                    <h5>You invest $2,000 to get <i class="fas fa-hand-point-down"></i></h5>
                    <ul class="listed-services" style="list-style:none;text-align:left">
                        <li><i class="fas fa-check-square"></i> You earn $479 - $515 profit every 3 - 5 days</li>
                        <li><i class="fas fa-check-square"></i> You earn $3,832 - $4,120 after 8 weeks</li>
                        <li><i class="fas fa-check-square"></i> PS: Your first profit of between $479 - $515 will arrive within 7 days and you can withdraw immediately</li>
                    </ul>
                  </div>

                  <div class="-p" id="bronze-p">
                    <h4>Bronze Package Features</h4>
                    <h5>You invest $5,000 to get <i class="fas fa-hand-point-down"></i></h5>
                    <ul class="listed-services" style="list-style:none;text-align:left">
                        <li><i class="fas fa-check-square"></i> You earn $1,135 - $1,470 profit every 3 - 5 days</li>
                        <li><i class="fas fa-check-square"></i> You earn $9,080 - $11,760 after 8 weeks</li>
                        <li><i class="fas fa-check-square"></i> PS: Your first profit of between $1,135 - $1,470 will arrive within 7 days and you can withdraw immediately</li>
                    </ul>
                  </div>

                  <div class="-p" id="silver-p">
                    <h4>Silver Package Features</h4>
                    <h5>You invest $20,000 to get <i class="fas fa-hand-point-down"></i></h5>
                    <ul class="listed-services" style="list-style:none;text-align:left">
                        <li><i class="fas fa-check-square"></i> You earn $5,370 - $7,040 profit every 3 - 5 days</li>
                        <li><i class="fas fa-check-square"></i> You earn $42,960 - $56,320 after 8 weeks</li>
                        <li><i class="fas fa-check-square"></i> PS: Your first profit of between $5,370 - $7,040 will arrive within 7 days and you can withdraw immediately</li>
                    </ul>
                  </div>

                  <div class="-p" id="gold-p">
                    <h4>Gold Package Features</h4>
                    <h5>You invest $50,000 to get <i class="fas fa-hand-point-down"></i></h5>
                    <ul class="listed-services" style="list-style:none;text-align:left">
                        <li><i class="fas fa-check-square"></i> You earn $16,450 - $19,720 profit every 3 - 5 days</li>
                        <li><i class="fas fa-check-square"></i> You earn $131,600 - $157,760 after 8 weeks</li>
                        <li><i class="fas fa-check-square"></i> PS: Your first profit of between $16,450 - $19,720 will arrive within 7 days and you can withdraw immediately</li>
                    </ul>
                  </div>

                  <div class="-p" id="vip-p">
                    <h4>VIP Package Features</h4>
                    <h5>You invest $100,000 to get <i class="fas fa-hand-point-down"></i></h5>
                    <ul class="listed-services" style="list-style:none;text-align:left">
                        <li><i class="fas fa-check-square"></i> You earn $35,500 - $39,700 profit every 3 - 5 days</li>
                        <li><i class="fas fa-check-square"></i> You earn $284,000 - $317,600 after 8 weeks</li>
                        <li><i class="fas fa-check-square"></i> PS: Your first profit of between $35,500 - $39,700 will arrive within 7 days and you can withdraw immediately</li>
                    </ul>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12">
                      <label for="" class="font-weight-normal">Investment Amount ($)<span class="text-danger">*</span></label>
                      <div class="" id="invamnt">
                          <input type="varchar" id="auth-amount" name="investmentAmount" readonly class="form-control">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <small><div class="text-center" id='amtAlert'></div></small>
                      <small><div class="text-center" id="amtminAlert"></div></small>
                      <small><div class="text-center" id="withAlert"></div></small>
                    </div>
                  </div>
                </div>
                
                <div class="form-group" id='bitcoin-invest' style="border: 1px solid #eeeaef;border-radius:4px;display:none;">
                  <div class="container pt-3 pb-3">
                    <div class="row">
                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6  need-help bct">
                          <a href="https://wa.me/message/C2ER5DVDVZDII1" target="_blank" class="funds_btn text-dark" rel="noopener noreferrer">Confused ðŸ¤” Click Here To Contact Support <i class="fas fa-question-circle"></i></a>
                      </div>
                      <div class="btcpay-serv col-xs-6 col-sm-6 col-md-6 col-lg-6 bct">
                        <a href="http://" target="_blank" rel="noopener noreferrer"><img src="images/btcpay.jpeg" alt="logo" class="btcpayserver"> Pay Using BTCPAYSERVER</a>  
                      </div>
                    </div>
                  </div>
                </div>

                <!-- <div class="form-group text-center mx-auto">
                  <div class="mb-5">
                    <button type="submit" class="btn"  onclick="InvestmentForm()"   id="funds_btn">
                      <i class="fas fa-hand-holding-usd"></i> Submit
                    </button>
                    <button class="btn reset btn-danger bg-danger" type="reset">Cancel</button>
                  </div>
                </div> -->

                    <!-- <div class="form-group text-center mt-5 mb-5">
                      <button id="updateP" type="submit" name="addmoreinvestOpt" class="btn btn-primary btnpmd" id='submit_account'>Add More investment Options</button>
                    </div> -->
                  </form>
              </div>
              
              </div>
                                    
          <!-- Activate Account investment Modal Ends -->

          <div class="container-fluid text-center pt-3 mt-5" style="position: relative;">
        <?php require_once'dbh.php';
              require_once'config.php';
              $checkin = $con->prepare("SELECT investmentId,investmentAmount,investmentCoin,growthRate,accumulatedgrowthRate,investmentStatus,investmentDate FROM investment_table WHERE clientEmail = ? ");
              $checkin -> bindParam(1,$email_of_user);
              if($checkin -> execute() && $checkin -> rowCount() > 0) {
                  //
                  }else {
                    echo "<a href='invest'><img src='images/btcnewsorg.jpg' alt='invest' class='img-call-to-action img-fluid rounded'><div class='call-to-action'><button class='funds_btn font-weight-bold'>Get Started Now <i class='fas fa-angle-right'></i></button></div></a>";
                  }
        ?>
          
          <div class="we-work text-center">
            <h4 class="text-center">
              We do the hard work, you earn the money
              <b>...Is that simple</b>
            </h4>
          
            <div>
              <h6 class="text-center"><strong>Invest and earn $200 every 3 - 5 days by leveraging the best professional traders from all over the world.</strong></h6>  
              
              <div class="container P-5 mt-5">
                        <div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
                            <div class="content-services faq-head mb-5">
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
              <a href="invest" class="text-decoration-none text-dark"><i class="fab fa-bitcoin fa-2x" style="color: orange !important"></i> <b>Get Started</b></a>
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

        <div>
          <div class="explain-d text-center">
            <h2>
                Our volatility investment Packages Full Details
            </h2>
            <div>
                  <h4><b> <?php echo 'Time now is '. date('Y-m-d',time());?> NB: Date of next investment round - 
                    <?php $tim = time(); $sevenDaysinsecs = 604800;
                            $sevenDayInterval = $tim + $sevenDaysinsecs;
                            $time = time();
                            if($time >= $sevenDayInterval) {
                                for($i = 0; $time >= $sevenDayInterval; $i++) {
                                   $sevenDays = $sevenDayInterval + $sevenDaysinsecs;
                                   echo date('Y-m-d',$sevenDays);
                                }
                            }
                ?>
                  </b></h4>
                <div class="col-md-12">
                <?php require_once'dbh.php';
                      require_once'config.php';
                      $checkin = $con->prepare("SELECT investmentId,investmentAmount,investmentPackage,profitAmount,investmentCoin,growthRate,accumulatedgrowthRate,investmentStatus,investmentDate FROM investment_table WHERE clientEmail = ? ORDER BY investmentDate DESC");
                      $checkin -> bindParam(1,$email_of_user);
                      if($checkin -> execute() && $checkin -> rowCount() > 0) {
                        
                        $row = $checkin -> fetch(PDO::FETCH_ASSOC);
                            
                        echo "<div class='container-fluid'>";
                        echo "<div class='text-center col-12 table-responsive'>";
                        echo "<table  class='table table-responsive text-left table-striped table-bordered table-sm' cellspacing='0' col='5' width='100%'>
                                <thead>
                                <tr>
                                  <th >
                                    INVESTMENT PACKAGE 
                                  </th>
                                  <th >
                                    INVESTMENT AMOUNT
                                  </th>
                                  <th >
                                    RECURRING PROFIT EVERY 3-5 DAYS
                                  </th>
                                  <th >
                                    TOTAL RETURNS AFTER 8 WEEKS
                                  </th>
                                  <th >
                                    INVEST NOW
                                  </th>
                                </tr>
                                </thead>";
                                
                                $invPack = $row['investmentPackage'];
                                $invAmount = $row['investmentAmount'];
                                $profAmount = $row['profitAmount'];
                                $recProfit = $profAmount * 8;
                                $invStatusd = "<a href='#' class='gsa bg-success'> Active </a>";
                                    
        
                                  if($invPack == "Basic") {
                                  echo "<tbody>
                                            <tr>
                                              <td>
                                                Basic
                                              </td>
                                              <td>
                                                $590
                                              </td>
                                              <td>
                                                $139 - $155
                                              </td>
                                              <td>
                                                $1,112 - $1,240
                                              </td>
                                              <td class='gs'>
                                                $invStatusd
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                CARBON
                                              </td>
                                              <td>
                                                $590
                                              </td>
                                              <td>
                                                $139 - $155
                                              </td>
                                              <td>
                                                $1,112 - $1,240
                                              </td>
                                              <td class='gs'>
                                                <a href='invest.php?investment_package=carbon' class='gsa'> Upgrade Now </a>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                FIBRE
                                              </td>
                                              <td>
                                                $1,000
                                              </td>
                                              <td>
                                                $258 - $280
                                              </td>
                                              <td>
                                                $2,064 - $2,240
                                              </td>
                                              <td class='gs'>
                                                <a href='invest.php?investment_package=fibre' class='gsa'> Upgrade Now </a>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                STEEL
                                              </td>
                                              <td>
                                                $2,000
                                              </td>
                                              <td>
                                                $479 - $515
                                              </td>
                                              <td>
                                                $3,832 - $4,120  
                                              </td>
                                              <td class='gs'>
                                                <a href='invest.php?investment_package=steel' class='gsa'> Upgrade Now </a>
                                              </td>
                                          </tr>
                                          <tr>
                                            <td>
                                              BRONZE
                                            </td>
                                            <td>
                                              $5,000
                                            </td>
                                            <td>
                                              $1,135 - $1,470
                                            </td>
                                            <td>
                                              $9,080- $11,760
                                            </td>
                                            <td class='gs'>
                                              <a href='invest.php?investment_package=bronze' class='gsa'> Upgrade Now </a>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td>
                                              SILVER
                                            </td>
                                            <td>
                                              $20,000
                                            </td>
                                            <td>
                                              $5,370 - $7,040
                                            </td>
                                            <td>
                                              $42,960 - $56,320
                                            </td>
                                            <td class='gs'>
                                              <a href='invest.php?investment_package=silver' class='gsa'> Upgrade Now </a>
                                            </td>
                                          </tr>
                                          <tr class='gold'>
                                            <td class='gold'>
                                              GOLD
                                            </td>
                                            <td class='gold'>
                                              $50,000
                                            </td>
                                            <td class='gold'>
                                              $16,450 - $19,720
                                            </td>
                                            <td class='gold'>
                                              $131,600 - $157,760
                                            </td>
                                            <td class='gs'>
                                              <a href='invest.php?investment_package=gold' class='gsa'> Upgrade Now </a>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td class='vip'>
                                              VIP
                                            </td>
                                            <td class='vip'>
                                              $100,000
                                            </td>
                                            <td class='vip'>
                                              $35,500 - $39,700
                                            </td>
                                            <td class='vip'>
                                              $284,000 - $317,600
                                            </td>
                                            <td class='gs'>
                                              <a href='invest.php?investment_package=vip' class='gsa'> Upgrade Now </a>
                                            </td>
                                          </tr>
                                      </tbody>";
                                    }
                                    else if($invPack == "Carbon") {
                                      echo "<tbody>
                                              <tr>
                                                  <td>
                                                    CARBON
                                                  </td>
                                                  <td>
                                                    $1,000
                                                  </td>
                                                  <td>
                                                    $258 - $280
                                                  </td>
                                                  <td>
                                                    $2,064 - $2,240
                                                  </td>
                                                  <td class='gs'>
                                                    $invStatusd
                                                  </td>
                                              </tr>
                                              <tr>
                                                  <td>
                                                    FIBRE
                                                  </td>
                                                  <td>
                                                    $1,000
                                                  </td>
                                                  <td>
                                                    $258 - $280
                                                  </td>
                                                  <td>
                                                    $2,064 - $2,240
                                                  </td>
                                                  <td class='gs'>
                                                    <a href='invest.php?investment_package=fibre' class='gsa'> Upgrade Now </a>
                                                  </td>
                                              </tr>
                                              <tr>
                                                  <td>
                                                    STEEL
                                                  </td>
                                                  <td>
                                                    $2,000
                                                  </td>
                                                  <td>
                                                    $479 - $515
                                                  </td>
                                                  <td>
                                                    $3,832 - $4,120  
                                                  </td>
                                                  <td class='gs'>
                                                    <a href='invest.php?investment_package=steel' class='gsa'> Upgrade Now </a>
                                                  </td>
                                              </tr>
                                              <tr>
                                                <td>
                                                  BRONZE
                                                </td>
                                                <td>
                                                  $5,000
                                                </td>
                                                <td>
                                                  $1,135 - $1,470
                                                </td>
                                                <td>
                                                  $9,080- $11,760
                                                </td>
                                                <td class='gs'>
                                                  <a href='invest.php?investment_package=bronze' class='gsa'> Upgrade Now </a>
                                                </td>
                                              </tr>
                                              <tr>
                                                <td>
                                                  SILVER
                                                </td>
                                                <td>
                                                  $20,000
                                                </td>
                                                <td>
                                                  $5,370 - $7,040
                                                </td>
                                                <td>
                                                  $42,960 - $56,320
                                                </td>
                                                <td class='gs'>
                                                  <a href='invest.php?investment_package=silver' class='gsa'> Upgrade Now </a>
                                                </td>
                                              </tr>
                                              <tr class='gold'>
                                                <td class='gold'>
                                                  GOLD
                                                </td>
                                                <td class='gold'>
                                                  $50,000
                                                </td>
                                                <td class='gold'>
                                                  $16,450 - $19,720
                                                </td>
                                                <td class='gold'>
                                                  $131,600 - $157,760
                                                </td>
                                                <td class='gs'>
                                                  <a href='invest.php?investment_package=gold' class='gsa'> Upgrade Now </a>
                                                </td>
                                              </tr>
                                              <tr>
                                                <td class='vip'>
                                                  VIP
                                                </td>
                                                <td class='vip'>
                                                  $100,000
                                                </td>
                                                <td class='vip'>
                                                  $35,500 - $39,700
                                                </td>
                                                <td class='vip'>
                                                  $284,000 - $317,600
                                                </td>
                                                <td class='gs'>
                                                  <a href='invest.php?investment_package=vip' class='gsa'> Upgrade Now </a>
                                                </td>
                                              </tr>
                                          </tbody>";
                                        }
                                    else if($invPack == "Fibre") {
                                      echo "<tbody>
                                          <tr>
                                              <td>
                                                FIBRE
                                              </td>
                                              <td>
                                                $1,000
                                              </td>
                                              <td>
                                                $258 - $280
                                              </td>
                                              <td>
                                                $2,064 - $2,240
                                              </td>
                                              <td class='gs'>
                                                $invStatusd
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                STEEL
                                              </td>
                                              <td>
                                                $2,000
                                              </td>
                                              <td>
                                                $479 - $515
                                              </td>
                                              <td>
                                                $3,832 - $4,120  
                                              </td>
                                              <td class='gs'>
                                                <a href='invest.php?investment_package=steel' class='gsa'> Upgrade Now </a>
                                              </td>
                                          </tr>
                                          <tr>
                                            <td>
                                              BRONZE
                                            </td>
                                            <td>
                                              $5,000
                                            </td>
                                            <td>
                                              $1,135 - $1,470
                                            </td>
                                            <td>
                                              $9,080- $11,760
                                            </td>
                                            <td class='gs'>
                                              <a href='invest.php?investment_package=bronze' class='gsa'> Upgrade Now </a>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td>
                                              SILVER
                                            </td>
                                            <td>
                                              $20,000
                                            </td>
                                            <td>
                                              $5,370 - $7,040
                                            </td>
                                            <td>
                                              $42,960 - $56,320
                                            </td>
                                            <td class='gs'>
                                              <a href='invest.php?investment_package=silver' class='gsa'> Upgrade Now </a>
                                            </td>
                                          </tr>
                                          <tr class='gold'>
                                            <td class='gold'>
                                              GOLD
                                            </td>
                                            <td class='gold'>
                                              $50,000
                                            </td>
                                            <td class='gold'>
                                              $16,450 - $19,720
                                            </td>
                                            <td class='gold'>
                                              $131,600 - $157,760
                                            </td>
                                            <td class='gs'>
                                              <a href='invest.php?investment_package=gold' class='gsa'> Upgrade Now </a>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td class='vip'>
                                              VIP
                                            </td>
                                            <td class='vip'>
                                              $100,000
                                            </td>
                                            <td class='vip'>
                                              $35,500 - $39,700
                                            </td>
                                            <td class='vip'>
                                              $284,000 - $317,600
                                            </td>
                                            <td class='gs'>
                                              <a href='invest.php?investment_package=vip' class='gsa'> Upgrade Now </a>
                                            </td>
                                          </tr>
                                      </tbody>";
                                    }
                                    else if($invPack == "Steel") {
                                      echo "<tbody>
                                          <tr>
                                              <td>
                                                STEEL
                                              </td>
                                              <td>
                                                $2,000
                                              </td>
                                              <td>
                                                $479 - $515
                                              </td>
                                              <td>
                                                $3,832 - $4,120  
                                              </td>
                                              <td class='gs'>
                                                $invStatusd
                                              </td>
                                          </tr>
                                          <tr>
                                            <td>
                                              BRONZE
                                            </td>
                                            <td>
                                              $5,000
                                            </td>
                                            <td>
                                              $1,135 - $1,470
                                            </td>
                                            <td>
                                              $9,080- $11,760
                                            </td>
                                            <td class='gs'> 
                                              <a href='invest.php?investment_package=bronze' class='gsa'> Upgrade Now </a>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td>
                                              SILVER
                                            </td>
                                            <td>
                                              $20,000
                                            </td>
                                            <td>
                                              $5,370 - $7,040
                                            </td>
                                            <td>
                                              $42,960 - $56,320
                                            </td>
                                            <td class='gs'>
                                              <a href='invest.php?investment_package=silver' class='gsa'> Upgrade Now </a>
                                            </td>
                                          </tr>
                                          <tr class='gold'>
                                            <td class='gold'>
                                              GOLD
                                            </td>
                                            <td class='gold'>
                                              $50,000
                                            </td>
                                            <td class='gold'>
                                              $16,450 - $19,720
                                            </td>
                                            <td class='gold'>
                                              $131,600 - $157,760
                                            </td>
                                            <td class='gs'>
                                              <a href='invest.php?investment_package=gold' class='gsa'> Upgrade Now </a>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td class='vip'>
                                              VIP
                                            </td>
                                            <td class='vip'>
                                              $100,000
                                            </td>
                                            <td class='vip'>
                                              $35,500 - $39,700
                                            </td>
                                            <td class='vip'>
                                              $284,000 - $317,600
                                            </td>
                                            <td class='gs'>
                                              <a href='invest.php?investment_package=vip' class='gsa'> Upgrade Now </a>
                                            </td>
                                          </tr>
                                      </tbody>";
                                    }
                                    else if($invPack == "Bronze") {
                                      echo "<tbody>
                                          <tr>
                                            <td>
                                              BRONZE
                                            </td>
                                            <td>
                                              $5,000
                                            </td>
                                            <td>
                                              $1,135 - $1,470
                                            </td>
                                            <td>
                                              $9,080- $11,760
                                            </td>
                                            <td class='gs'>
                                              $invStatus
                                            </td>
                                          </tr>
                                          <tr>
                                            <td>
                                              SILVER
                                            </td>
                                            <td>
                                              $20,000
                                            </td>
                                            <td>
                                              $5,370 - $7,040
                                            </td>
                                            <td>
                                              $42,960 - $56,320
                                            </td>
                                            <td class='gs'>
                                              <a href='invest.php?investment_package=silver' class='gsa'> Upgrade Now </a>
                                            </td>
                                          </tr>
                                          <tr class='gold'>
                                            <td class='gold'>
                                              GOLD
                                            </td>
                                            <td class='gold'>
                                              $50,000
                                            </td>
                                            <td class='gold'>
                                              $16,450 - $19,720
                                            </td>
                                            <td class='gold'>
                                              $131,600 - $157,760
                                            </td>
                                            <td class='gs'>
                                              <a href='invest.php?investment_package=gold' class='gsa'> Upgrade Now </a>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td class='vip'>
                                              VIP
                                            </td>
                                            <td class='vip'>
                                              $100,000
                                            </td>
                                            <td class='vip'>
                                              $35,500 - $39,700
                                            </td>
                                            <td class='vip'>
                                              $284,000 - $317,600
                                            </td>
                                            <td class='gs'>
                                              <a href='invest.php?investment_package=vip' class='gsa'> Upgrade Now </a>
                                            </td>
                                          </tr>
                                      </tbody>";
                                    }
                                    else if($invPack == "Silver") {
                                      echo "<tbody>
                                              <tr>
                                                <td>
                                                  SILVER
                                                </td>
                                                <td>
                                                  $20,000
                                                </td>
                                                <td>
                                                  $5,370 - $7,040
                                                </td>
                                                <td>
                                                  $42,960 - $56,320
                                                </td>
                                                <td class='gs'>
                                                  $invStatusd
                                                </td>
                                              </tr>
                                              <tr class='gold'>
                                                <td class='gold'>
                                                  GOLD
                                                </td>
                                                <td class='gold'>
                                                  $50,000
                                                </td>
                                                <td class='gold'>
                                                  $16,450 - $19,720
                                                </td>
                                                <td class='gold'>
                                                  $131,600 - $157,760
                                                </td>
                                                <td class='gs'> 
                                                  <a href='invest.php?investment_package=gold' class='gsa'> Upgrade Now </a>
                                                </td>
                                              </tr>
                                              <tr>
                                                <td class='vip'>
                                                  VIP
                                                </td>
                                                <td class='vip'>
                                                  $100,000
                                                </td>
                                                <td class='vip'>
                                                  $35,500 - $39,700
                                                </td>
                                                <td class='vip'>
                                                  $284,000 - $317,600
                                                </td>
                                                <td class='gs'>
                                                  <a href='invest.php?investment_package=vip' class='gsa'> Upgrade Now </a>
                                                </td>
                                              </tr>
                                          </tbody>";
                                    }
                                    else if($invPack == "Gold") {
                                      echo "<tbody>
                                              <tr class='gold'>
                                                <td class='gold'>
                                                  GOLD
                                                </td>
                                                <td class='gold'>
                                                  $50,000
                                                </td>
                                                <td class='gold'>
                                                  $16,450 - $19,720
                                                </td>
                                                <td class='gold'>
                                                  $131,600 - $157,760
                                                </td>
                                                <td class='gs'>
                                                  $invStatusd
                                                </td>
                                              </tr>
                                              <tr>
                                                <td class='vip'>
                                                  VIP
                                                </td>
                                                <td class='vip'>
                                                  $100,000
                                                </td>
                                                <td class='vip'>
                                                  $35,500 - $39,700
                                                </td>
                                                <td class='vip'>
                                                  $284,000 - $317,600
                                                </td>
                                                <td class='gs'>
                                                  <a href='invest.php?investment_package=vip' class='gsa'> Upgrade Now </a>
                                                </td>
                                              </tr>
                                          </tbody>";
                                    }
                                    else if($invPack == "VIP") {
                                      echo "<tbody>
                                              <tr>
                                                <td class='vip'>
                                                  VIP
                                                </td>
                                                <td class='vip'>
                                                  $100,000
                                                </td>
                                                <td class='vip'>
                                                  $35,500 - $39,700
                                                </td>
                                                <td class='vip'>
                                                  $284,000 - $317,600
                                                </td>
                                                <td class='gs'>
                                                  $invStatusd
                                                </td>
                                              </tr>
                                          </tbody>";
                                    }
                                    
                                
                            echo "</table>";
        
                        echo "</div>";
                        
                        echo "</div>";
                        
                          }else {
                         
                  ?>
                  <table  class='text-left table table-responsive table-striped table-sm' cellspacing='0'>
                      <thead class="">
                          <tr>
                            <th >
                              INVESTMENT PACKAGE 
                            </th>
                            <th >
                              INVESTMENT AMOUNT
                            </th>
                            <th >
                              RECURRING PROFIT EVERY 3-5 DAYS
                            </th>
                            <th >
                              TOTAL RETURNS AFTER 8 WEEKS
                            </th>
                            <th >
                              INVEST NOW
                            </th>
                          </tr>
                      </thead>
                                            <tbody>
                        <tr>
                            <td>
                              BASIC
                            </td>
                            <td>
                              $295
                            </td>
                            <td>
                              $62- $71
                            </td>
                            <td>
                              $496 - $568
                            </td>
                            <td class="gs">
                                <a href='invest.php?investment_package=basic' class='gsa'> Invest Now </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                              CARBON
                            </td>
                            <td>
                              $590
                            </td>
                            <td>
                              $139 - $155
                            </td>
                            <td>
                              $1,112 - $1,240
                            </td>
                            <td class="gs">
                                <a href='invest.php?investment_package=carbon' class='gsa'> Invest Now </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                              FIBRE
                            </td>
                            <td>
                              $1,000
                            </td>
                            <td>
                              $258 - $280
                            </td>
                            <td>
                              $2,064 - $2,240
                            </td>
                            <td class="gs">
                                <a href='invest.php?investment_package=fibre' class='gsa'> Invest Now </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                              STEEL
                            </td>
                            <td>
                              $2,000
                            </td>
                            <td>
                              $479 - $515
                            </td>
                            <td>
                              $3,832 - $4,120  
                            </td>
                            <td class="gs">
                                <a href='invest.php?investment_package=steel' class='gsa'> Invest Now </a>
                            </td>
                        </tr>
                        <tr>
                          <td>
                            BRONZE
                          </td>
                          <td>
                            $5,000
                          </td>
                          <td>
                            $1,135 - $1,470
                          </td>
                          <td>
                            $9,080- $11,760
                          </td>
                          <td class="gs">
                              <a href='invest.php?investment_package=bronze' class='gsa'> Invest Now </a>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            SILVER
                          </td>
                          <td>
                            $20,000
                          </td>
                          <td>
                            $5,370 - $7,040
                          </td>
                          <td>
                            $42,960 - $56,320
                          </td>
                          <td class="gs">
                              <a href='invest.php?investment_package=silver' class='gsa'> Invest Now </a>
                          </td>
                        </tr>
                        <tr class="gold">
                          <td class="gold">
                            GOLD
                          </td>
                          <td class="gold">
                            $50,000
                          </td>
                          <td class="gold">
                            $16,450 - $19,720
                          </td>
                          <td class="gold">
                            $131,600 - $157,760
                          </td>
                          <td class="gs">
                              <a href='invest.php?investment_package=gold' class='gsa'> Invest Now </a>
                          </td>
                        </tr>
                        <tr>
                          <td class="vip">
                            VIP
                          </td>
                          <td class="vip">
                            $100,000
                          </td>
                          <td class="vip">
                            $35,500 - $39,700
                          </td>
                          <td class="vip">
                            $284,000 - $317,600
                          </td>
                          <td class="gs">
                              <a href='invest.php?investment_package=vip' class='gsa'> Invest Now </a>
                          </td>
                        </tr>
                    </tbody>
                        
                </table>
                <?php }?>
              </div>
            </div>

              <h5>
                NB: You will notice that the packages from $10,000 earn higher profits than packages below $10,000.....this is because we reserve our best traders for investors that invest huge amounts this is because they help them earn more profits and the best traders want to earn the most commissions hereby they prefer to trade for people with huge capital.

                <br>
                Also note that you can upgrade your package anytime you want, hereby if you start with the $295 package, even if you have not earn your complete profit for 8 weeks, you can upgrade to the $1000, in this situation, the amount you earn per week will be upgraded from $62 - $71 every 3 - 5 days to $258 - $280 every 3 to 5 days. 
              </h5>

              <h2 class='mt-2 mb-2'>
                See real profit screenshots below
              </h2> 
          </div>
          
          <!-- Swiper -->
          <div class="swiper-container mt-2 mb-5 mySwiper">
            <div class="swiper-wrapper">
              <div class="swiper-slide"><img src="images/shot11.png" alt="" srcset="" class="shotset"></div>  
              <div class="swiper-slide"><img src="images/shot12.png" alt="" srcset="" class="shotset"></div>
              <div class="swiper-slide"><img src="images/shot1.jpg" alt="" srcset="" class="shotset"></div>
              <div class="swiper-slide"><img src="images/shot2.jpg" alt="" srcset="" class="shotset"></div>
              <div class="swiper-slide"><img src="images/shot3.jpg" alt="" srcset="" class="shotset"></div>
              <div class="swiper-slide"><img src="images/shot4.jpg" alt="" srcset="" class="shotset"></div>
              <div class="swiper-slide"><img src="images/shot5.jpg" alt="" srcset="" class="shotset"></div>
              <div class="swiper-slide"><img src="images/shot6.jpg" alt="" srcset="" class="shotset"></div>
              <div class="swiper-slide"><img src="images/shot7.jpg" alt="" srcset="" class="shotset"></div>
              <div class="swiper-slide"><img src="images/shot8.jpg" alt="" srcset="" class="shotset"></div>
              <div class="swiper-slide"><img src="images/shot9.jpg" alt="" srcset="" class="shotset"></div>
              <!-- <div class="swiper-slide"><img src="images/shot10.jpg" alt="" srcset="" class="shotset"></div> -->
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
          </div>
        </div>

            <!-- Bidding details -->
            
            <?php
            require_once'config.php';
            $inv = $con->prepare("SELECT investmentId,investmentAmount,investmentPackage,investmentCoin,growthRate,accumulatedgrowthRate,investmentStatus,profitAmount,amountEarned,withdrawalStatus,withdrawalTime FROM investment_table WHERE clientEmail = ? ");
            $inv -> bindParam(1,$email_of_user);
            if($inv -> execute() && $inv -> rowCount() > 0) {
              $in = $inv -> fetchAll(PDO::FETCH_ASSOC);
              
              echo "<div class='text-center col-12 table-responsive mt-5 mb-5 pt-2 pb-2'>";
              echo "<h4 class='text-center'>MY ACTIVE INVESTMENTS</h4>";
                echo "<table  class='table text-left table-responsive table-striped table-bordered table-sm' cellspacing='0' col='5' width='100%'>
                        <thead>
                        <tr>
                            <th class='th-xs'>Investment Id

                            </th>
                            <th class='th-xs'>Investment Package

                            </th>
                            <th class='th-xs'>Investment Amount

                            </th>
                            <th class='th-xs'>Investment Coin

                            </th>
                            <th class='th-xs'>Profit Amount

                            </th>
                            <th class='th-xs'>Amount Earned

                            </th>
                            <th class='th-xs'>Growth Rate(7 Days)

                            </th>
                            <th class='th-xs'>Accumulated Growth Rate(Days)

                            </th>
                            <th class='th-xs'>Status

                            </th>
                            <th class='th-xs'>Withdrawal Status

                            </th>
                            <th class='th-xs'>Withdrawal Time

                            </th>
                        </tr>
                        </thead>";
                foreach ($in as $key => $value) {
                    # code...
                    $auctAmt = $value['investmentAmount'];
                    $auctChannel = $value['investmentCoin'];
                    $invPack = $value['investmentPackage'];
                    $growthrate = $value['growthRate'].'%';
                    $accumulatedgR = $value['accumulatedgrowthRate'];
                    $aucStat = $value['investmentStatus'];
                    $profitAmt = $value['profitAmount'];
                    $aucStat = $value['investmentStatus'];
                    $amountEarned = $value['amountEarned'];
                    $auctId = $value['investmentId'];
                    $withdrawalStatus = $value['withdrawalStatus'];
                    $withdrawalTime = $value['withdrawalTime'];
                    $withTime = str_replace(" ","",$withdrawalTime); 

                    if($aucStat == 'Inactive') {
                      $auctStat = "<span class='p-2 bg-danger rounded'> $aucStat </span> <span class='info-box-text'><a rel='nofollow' style='cursor:pointer' class='text-decoration-none p-2 rounded text-normal m-1 bg-success' data-toggle='modal' data-target='#activateinvestment' aria-haspopup='true' aria-expanded='false'>Activate Now</a></span>";
                    }else {
                      $auctStat = "<span class='p-2 bg-success rounded'> $aucStat </span>";
                    }
                    $withdrawalStat = "<span class='p-2 bg-danger rounded'> $withdrawalStatus </span>";
                    $withdrawalTim = "<span class='p-2 bg-warning rounded'> $withTime </span>";
                    echo "<tbody>
                      <tr>
                          <td>$auctId</td>
                          <td>$invPack</td>
                          <td>$$auctAmt</td>
                          <td>$auctChannel</td>
                          <td>$$profitAmt</td>
                          <td>$$amountEarned</td>
                          <td>$growthrate</td>
                          <td>$$accumulatedgR</td>
                          <td>$auctStat</td>
                          <td>$withdrawalStat</td>
                          <td>$withdrawalTim</td>
                      </tr>
                  </tbody>";
                      }
          echo "</table>";
          echo "</div>";
         
        }
        else{
            echo "<div class='no-invest text-center pt-3 pb-3' id='no-invest' name='no-invest'><b>No Investment Record Found For You $n</b> <a href='invest' class='text-decoration-none p-2 rounded' target='_blank' style='color: orange'> Invest To Earn </a> </div>";
            $noinvestmentFound = "No Earnings Found <a href='invest' target='_blank' class='text-decoration-none p-2 rounded'> Invest To Earn </a>"; 
        }

        if(isset($Active) && $Active == 1 && $accinvestmentStatus == 'Inactive') {
          $noinvestmentFound = "No Earnings Found <a href='invest' target='_blank'> Invest To Earn </a>";
        }
          ?>

         <!-- Client Testimony Section -->
          <section class="client-testimony-section mt-5 mb-5">
                <div class="container-fluid testi">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2>What <b>our investors</b> are saying</h2>
                            <!-- testimony carousel bootstrap begins -->
                            <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="30000">
                                <!-- Carousel indicators -->
                                <ol class="carousel-indicators mb-5 pb-2">
                                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#myCarousel" data-slide-to="1"></li>
                                </ol>   
                                <!-- Wrapper for carousel items -->
                                <div class="carousel-inner mt-15 pb-15 pt-3">		
                                    <div class="carousel-item  active rounded">
                                        <div class="row rounded p-4">

                                            <div class="col-lg-6 col-md-12 text-white  ">
                                                <div class="spaced">
                                                  <div class="row">
                                                    <div class="img-box col-md-4">
                                                        <img src="images/avatar-3.jpg" class="img-fluid rounded-circle" alt="">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <p class="testimonial text-white"><i class="fas fa-quote-left"></i> At first when I started, I invested $295 and thought it was a risk because I wasn't sure of the outcome. Well it's definitely been a worthwhile risk because I currently earn recurring profits every week which I can withdraw and convert to dollars on coinbase. </p>
                                                        <p class="overview text-white">
                                                          <b>Adriana George</b>
                                                          <div class="cityd">Arizona, USA</div>
                                                        </p>
                                                        <div class="star-rating">
                                                            <ul class="list-inline">
                                                                <li class="list-inline-item"><i class="fa fa-star" style='color: orange'></i></li>
                                                                <li class="list-inline-item"><i class="fa fa-star" style='color: orange'></i></li>
                                                                <li class="list-inline-item"><i class="fa fa-star" style='color: orange'></i></li>
                                                                <li class="list-inline-item"><i class="fa fa-star" style='color: orange'></i></li>
                                                                <li class="list-inline-item"><i class="fa fa-star-half-alt" style='color: orange'></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                  </div>
                                                  
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12 text-white ">
                                                <div class="spaced">
                                                  <div class="row">
                                                    <div class="img-box col-md-4">
                                                        <img src="images/avatar-1.jpg" alt="" class="img-fluid rounded-circle">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <p class="testimonial text-white"><i class="fas fa-quote-left"></i> My only complaint is the blockchain fee they charge when they send my profit which usually comes to about 5-6% of my total profit, but this is clearly not their fault because blockchain fees are quite high. </p>
                                                        <p class="overview text-white"><b>John Holz</b> <div class="cityd"> Hamburg, Germany</div></p>
                                                        <div class="star-rating">
                                                            <ul class="list-inline">
                                                                <li class="list-inline-item"><i class="fa fa-star" style='color: orange'></i></li>
                                                                <li class="list-inline-item"><i class="fa fa-star" style='color: orange'></i></li>
                                                                <li class="list-inline-item"><i class="fa fa-star" style='color: orange'></i></li>
                                                                <li class="list-inline-item"><i class="fa fa-star-half-alt" style='color: orange'></i></li>
                                                                <li class="list-inline-item"><i class="far fa-star" style='color: orange'></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                  </div>
                                                  
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <div class="carousel-item rounded">
                                        <div class="row p-4 rounded">
                                            
                                            <div class="col-lg-6 col-md-12 text-white">
                                              <div class="spaced">
                                                <div class="row">
                                                  <div class="img-box col-md-4">
                                                      <img src="images/avatar-0.jpg"class='img-fluid rounded-circle'  alt="">
                                                  </div>
                                                  <div class="col-md-8">
                                                      <p class="testimonial text-white"><i class="fas fa-quote-left"></i> I've always wanted to invest 50% of my savings into something profitable, I finally found it.<br>My advice is for anyone coming in to join as soon as possible because months from now too many people will catch up with this trend and we might not be making these huge profits anymore. I missed out on bitcoin so I promised myself not to miss out anything this profitable ever in my life.
                                                        My retirement looks super sassy now because I have doubled my money ever since I started and I hope to make 5x of my initial investment of $20,000.</p>
                                                      <p class="overview text-white"><b>Paula Wilson</b> <div class="cityd"> New Orleans, USA</div></p>
                                                      <div class="star-rating">
                                                          <ul class="list-inline">
                                                              <li class="list-inline-item"><i class="fa fa-star" style="color: orange"></i></li>
                                                              <li class="list-inline-item"><i class="fa fa-star" style="color: orange"></i></li>
                                                              <li class="list-inline-item"><i class="fa fa-star" style="color: orange"></i></li>
                                                              <li class="list-inline-item"><i class="fa fa-star" style="color: orange"></i></li>
                                                              <li class="list-inline-item"><i class="fa fa-star-half-alt" style="color: orange"></i></li>
                                                          </ul>
                                                      </div>
                                                  </div>
                                                </div>
                                                
                                              </div>
                                            </div>

                                            <div class="col-lg-6 col-md-12 text-white">
                                              <div class="spaced">
                                                <div class="row">
                                                  <div class="img-box col-md-4">
                                                      <img src="images/avatar-4.jpg"class='img-fluid rounded-circle'  alt="">
                                                  </div>
                                                  <div class="col-md-8">
                                                      <p class="testimonial text-white"><i class="fas fa-quote-left"></i> Pro tip: If you want to make the most amount of profit from this platform, always tip their professional traders. This will encourage them to focus and put in their best on your trading account because I've noticed that ever since I started giving the traders worthwhile tips in the range of $400 to $500, my profit on the $50,000 gold package I chose has gone from $6000+ every 3 - 5 days to over $8,200+ every 3 - 5 days. Infact on my last withdrawal, I withdrew $8,357. I'm super excited.</p>
                                                      <p class="overview text-white"><b>Chris Jordan</b> <div class="cityd">United Kingdom</div> </p>
                                                      <div class="star-rating">
                                                          <ul class="list-inline">
                                                              <li class="list-inline-item"><i class="fa fa-star" style="color: orange"></i></li>
                                                              <li class="list-inline-item"><i class="fa fa-star" style="color: orange"></i></li>
                                                              <li class="list-inline-item"><i class="fa fa-star" style="color: orange"></i></li>
                                                              <li class="list-inline-item"><i class="fa fa-star" style="color: orange"></i></li>
                                                              <li class="list-inline-item"><i class="fa fa-star" style="color: orange"></i></li>
                                                          </ul>
                                                      </div>
                                                  </div>
                                                </div>
                                                
                                              </div>
                                            </div>

                                        </div>
                                        
                                    </div>
                                    		
                                </div>
                                <!-- Carousel controls -->
                                <a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                            <!-- bt carousel ends -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- Client testimony -->
       
        <!-- Main row -->
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->


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
    
    var swiper = new Swiper(".mySwiper", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "auto",
        coverflowEffect: {
          rotate: 50,
          stretch: 0,
          depth: 100,
          modifier: 1,
          slideShadows: true,
        },
		autoplay: {
			delay: 10000,
			disableOnInteraction: false,
		},
        pagination: {
          el: ".swiper-pagination",
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
<script src="javascript/front.js?n=1"></script>
<script src="javascript/home.js?n=1"></script>
<script src="javascript/invest.js?n=1"></script>
<script src="javascript/livechart.js?n=1"></script>

<!-- PAGE SCRIPTS -->
<script src="dist/js/pages/dashboard2.js"></script>
</body>
</html>
