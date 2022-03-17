<?php
ob_start();
session_start();
require_once'dbh.php';
require_once'config.php';

@$_SESSION['currentpage'] = $_SERVER['REQUEST_URI'];
strip_tags(@$_SESSION['currentpage']);

$user_data = @$_SESSION['user'];
$userid = $user_data['id'];
$name = @$user_data['Fname'];


// if(!isset($_SESSION['user'])) {
//     header('Location:');
//     exit();
// }else {
    $user_data = @$_SESSION['user'];
    $userid = @$user_data['id'];
    $name = @$user_data['uname'];
    $lname = @$user_data['Lname'];
    $clientCountry = @$user_data['userCountry'];
    $countryFlag = @$user_data['countryFlag'];
    $email_of_user = @$user_data['email'];
    $refid = @$user_data['invite_id'];

    ob_end_flush();
// }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
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
	<title> Waep.africa | Empowering Our African Youths </title>
    <!-- base:css -->
    <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
	<script lang="javascript" type="text/javascript" src="javascript/jquery-3.2.1.js"></script>
    <script lang="javascript" type="text/javascript" src="javascript/jquery.min.js"></script>
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
	<link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
    <!-- inject:css -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/customize.css">
    <style>
        @media screen and (max-width: 991px) {
            .page-body-wrapper {
            margin-top: 10.8rem
            }
        }
		@media screen and (max-width: 767px) {
            .page-body-wrapper {
            margin-top: 10.8rem
            }
        }
		@media screen and (max-width: 767px) {
            .page-body-wrapper {
            margin-top: 16.8rem
            }
        }
    </style>
    <!-- endinject -->
    <link rel="shortcut icon" href="images/favicon.png" />
  </head>
  <body>

  <?php
	require_once'config.php';
	$country = $con->prepare("SELECT userCountry,countryFlag,uname,invite_id FROM users WHERE id = ? ");
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
		$nr = $flag['invite_id'];

			if(isset($n)) {
				$med = $n;
			}else{
				$med = $nr;
			}
		}

		
	?>

  <!-- sidebar nav -->

  <?php 
    if(isset($userid)) {
		echo "<div id='mySidebar' class='sidebar'>
			<li class='nav-item'><a class='nav-link' href='profile?client=$med' target='_blank'> <i class='fas fa-user nav-icon'></i> ACCOUNT </a></li>
			<li class='nav-item'><a class='nav-link' href='profile?client=$med' target='_blank'> <i class='fas fa-user-edit nav-icon'></i> EDIT PROFILE </a></li>
			<li class='nav-item'><a class='nav-link' href='paymentdetails?client=$med' target='_blank'> <i class='fas fa-money-check-alt nav-icon'></i> RECEIVING DETAILS </a></li>
			<li class='nav-item'><a class='nav-link' href='refdetails?client=$med' target='_blank'> <i class='fas fa-users nav-icon'></i> MY FOLLOWERS </a></li>
			<li class='nav-item'><a class='nav-link' href='withdrawalhistory?client=$med' target='_blank'> <i class='fas fa-share nav-icon'></i> MY EMPOWERMENTS </a></li>
			</li> 
		</div>";
	}    else {
		echo "<div id='mySidebar' class='sidebar'>
			<li class='nav-item'><a class='nav-link' href='login' target='_blank'> <i class='fas fa-user nav-icon'></i> ACCOUNT </a></li>
			<li class='nav-item'><a class='nav-link' href='login' target='_blank'> <i class='fas fa-user-edit nav-icon'></i> EDIT PROFILE </a></li>
			<li class='nav-item'><a class='nav-link' href='login' target='_blank'> <i class='fas fa-money-check-alt nav-icon'></i> RECEIVING DETAILS </a></li>
			<li class='nav-item'><a class='nav-link' href='login' target='_blank'> <i class='fas fa-users nav-icon'></i> MY FOLLOWERS </a></li>
			<li class='nav-item'><a class='nav-link' href='login' target='_blank'> <i class='fas fa-share nav-icon'></i> MY EMPOWERMENTS </a></li>
			</li> 
		</div>";
	}
	
	?>

	<div id="main">
		<div class="container-scroller">
			<div class="pro-banner" id="pro-banner">
				<div class="card pro-banner-bg border-0 rounded-0">
					<div class="app-badge text-center">
						<div class="text-center">
							<p class="text-white text-center p-badge">Get the Experience In Our Apps</p>
							<div class="ap-badge text-center">
								<a href="#" target="_blank" class="btn"><img src="images/playstore-badge.png" alt="app badge" class="app-badges" srcset=""></a>
								<a href="#" target="_blank" class="btn"><img src="images/badge-download-on-the-app-store.svg" alt="app badge" class="app-badges" srcset=""></a>
							</div>
						</div>	
					</div>
					<div class="card-body py-3 px-4 d-flex align-items-center justify-content-between flex-wrap">
						<p class="mb-0 text-white font-weight-medium mb-2 mb-lg-0 mb-xl-0">Our site uses cookies to ensure your experience.</p>
						<div class="d-flex">
							<a href="#" target="_blank" class="btn btn-outline-light mr-2">Accept Cookies</a>
							<a href="#" target="_blank" class="btn btn-outline-light mr-2 bg-white text-dark">Decline</a>
							<button id="bannerClose" class="btn border-0 p-0">
								<i class="mdi mdi-close text-white"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
			<!-- partial:partials/_horizontal-navbar.html -->
			
		<div class="horizontal-menu">
			<nav class="navbar top-navbar col-lg-12 col-12 p-0">
				<div class="container-fluid">
					<div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
						<ul class="navbar-nav navbar-nav-left">
							<li class="nav-item ml-0 mr-5 d-lg-flex d-none">
								<a href="#" class="nav-link horizontal-nav-left-menu" id='toggleSideBar'><i class="mdi mdi-format-list-bulleted" onclick="openNav()"></i></a>
							</li>
							<li class="nav-item ml-0 mr-5 d-lg-flex d-none">
								<a href="#" class="nav-link horizontal-nav-left-menu" id='closeSideBar' onclick="closeNav()">&times;</a>
							</li>
							<li>
								<a class="navbar-brand brand-logo" href="index.php"><img src="images/waep-logo.png" alt="logo" style=''/></a>
							</li>
						</ul>
						
						<ul class="navbar-nav navbar-nav-right">
							<li class="nav-item dropdown">
								<a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
								<i class="mdi mdi-bell mx-0"></i>
								<span class="count"></span>
								</a>
								<div class="dropdown-menu dropdown-menu-right navbar-dropdown shadow-sm preview-list" aria-labelledby="notificationDropdown">
								<p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
								<a class="dropdown-item preview-item">
									<div class="preview-thumbnail">
										<div class="preview-icon bg-success">
										<i class="mdi mdi-information mx-0"></i>
										</div>
									</div>
									<div class="preview-item-content">
										<h6 class="preview-subject font-weight-normal">Application Error</h6>
										<p class="font-weight-light small-text mb-0 text-muted">
										Just now
										</p>
									</div>
								</a>
								<a class="dropdown-item preview-item">
									<div class="list-notifications"></div>
								</a>
								</div>
							</li>
							<li class="nav-item dropdown d-lg-flex">
								<button type="button" class="btn btn-inverse-primary btn-sm"> <a href="empower.php" id="nreportDropdown" target="_blank" class='btn-inverse-primary upload-talent'><i class="fas fa-share"></i> Get Empowered </a> </button>
							</li>
							<li class="nav-item nav-profile dropdown">
							<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
								<?php
									if(isset($userid)) {
										require_once'dbh.php'; $p_pix = new dbh(); echo "<span class='nav-profile-name'>". @$clientfname ."</span><span class='online-status'></span>"; $p_pix -> fetchUserProfilePics();
									
								?>
								<!-- <span class="nav-profile-name">Johnson</span>	  
								<img src="images/faces/face28.png" alt="profile" class="border-rounded rounded-circle"/> -->
								<?php } else {?>
								<img src="images/default_profilePic.png" alt="profile" class="border-rounded rounded-circle mypics"/>
								<?php }?>
							</a>
							<div class="dropdown-menu dropdown-menu-right navbar-dropdown shadow-sm" aria-labelledby="profileDropdown">
							<?php 
								if(isset($userid)) {
									echo "<a class='dropdown-item' href='profile?client=$med' target='_blank'> <i class='fas fa-upload seta mr-2'></i>
												<span class='u-settings'>Upload Profile Pics</span> </a>
										<a class='dropdown-item' href='profile?client=$med' target='_blank'> <i class='fas fa-user-edit seta mr-2'></i>
											<span class='u-settings'>Update Profile</span> </a>
											";
								}    else {
									echo "<a class='dropdown-item' href='login' target='_blank'> <i class='fas fa-upload seta mr-2'></i>
											<span class='u-settings'>Upload Profile Pics</span> </a>
											<a class='dropdown-item' href='login' target='_blank'> <i class='fas fa-user-edit seta mr-2'></i>
											<span class='u-settings'>Update Profile </span> </a>
											";
								}
										?>
								<a class="dropdown-item" href="logout">
									<i class="mdi mdi-logout"></i>
									<span class="u-settings">Logout</span>
								</a>
							</div>
							</li>
							
						</ul>
						
					</div>
					
				</div>
				<div class="toggle-icons" style="float: right">
				    <button class="navbar-toggler navbar-toggler-right d-lg-none" type="button" data-toggle="horizontal-menu-toggle">
						<span class="mdi mdi-menu bt-toggle-icons" id="bt-menu-show-icon" onclick="showbottomNav()"  style='color: #001737'></span><span class="mdi mdi-close  bt-toggle-icons" id="bt-menu-hide-icon" onclick="hidebottomNav()"  style='color: #001737'></span> <span class="mdi mdi-view-grid ml-3  bt-toggle-icons" id="bt-light-theme-icon" onclick="lightTheme()"  style='color: #001737'> <span class="mdi mdi-view-grid ml-3  bt-toggle-icons" id="bt-dark-theme-icon" onclick="darkTheme()"  style='color: #001737'>
					</button>
				</div>
				
			</nav>

			<!-- search bar -->
			<div class='search-cont'>
				<form action="searchresult.php" Method ="POST">
					<div class="input-group rounded">
						<input type="varchar" class="search-input-form form-control rounded" name="query" id="search-input" placeholder="search" aria-label="search" aria-describedby="search">
						<button type="submit" class="border-none" name="submit"><i class="mdi mdi-magnify"></i></button>
						<span class='filter'> <i class="fas fa-sort-amount-down" id=""  style='color: #001737'></i> FILTER </span>
					</div>
				</form>
				<div id="kkkk"></div>
				<!-- Section: Sidebar -->
				<section class="filter-panel">

					<!-- Section: Filters -->
					<section class="filt-panel">

					<h3>Filters</h3>

					<!-- Section: Condition -->
					<section class="mb-4">

						<h6 class="font-weight-bold mb-3">Filter By Upvotes </h6>

						<div class="form-check pl-0 mb-3">
						<input type="checkbox" class="form-check-input filled-in" id="new">
						<label class="form-check-label small text-capitalize card-link-secondary" for="new">0-100+</label>
						</div>
						<div class="form-check pl-0 mb-3">
						<input type="checkbox" class="form-check-input filled-in" id="used">
						<label class="form-check-label small text-capitalize card-link-secondary" for="used">100+ - 1000+</label>
						</div>
						<div class="form-check pl-0 mb-3">
						<input type="checkbox" class="form-check-input filled-in" id="collectible">
						<label class="form-check-label small text-capitalize card-link-secondary" for="collectible">1000+ - 1m+</label>
						</div>
						<div class="form-check pl-0 mb-1 pb-1">
						<input type="checkbox" class="form-check-input filled-in" id="renewed">
						<label class="form-check-label small text-capitalize card-link-secondary" for="renewed">Above 1m+</label>
						</div>

					</section>
					<!-- Section: Condition -->

					<!-- Section: Condition -->
					<section class="mb-4">

						<h6 class="font-weight-bold mb-3">Filter By Followers </h6>

						<div class="form-check pl-0 mb-3">
						<input type="checkbox" class="form-check-input filled-in" id="new">
						<label class="form-check-label small text-capitalize card-link-secondary" for="new">0-100+</label>
						</div>
						<div class="form-check pl-0 mb-3">
						<input type="checkbox" class="form-check-input filled-in" id="used">
						<label class="form-check-label small text-capitalize card-link-secondary" for="used">100+ - 1000+</label>
						</div>
						<div class="form-check pl-0 mb-3">
						<input type="checkbox" class="form-check-input filled-in" id="collectible">
						<label class="form-check-label small text-capitalize card-link-secondary" for="collectible">1000+ - 1m+</label>
						</div>
						<div class="form-check pl-0 mb-1 pb-1">
						<input type="checkbox" class="form-check-input filled-in" id="renewed">
						<label class="form-check-label small text-capitalize card-link-secondary" for="renewed">Above 1m+</label>
						</div>

					</section>
					<!-- Section: Condition -->

					<!-- Section: Condition -->
					<section class="mb-4">

						<h6 class="font-weight-bold mb-3">Filter By Likes </h6>

						<div class="form-check pl-0 mb-3">
						<input type="checkbox" class="form-check-input filled-in" id="new">
						<label class="form-check-label small text-capitalize card-link-secondary" for="new">0-100+</label>
						</div>
						<div class="form-check pl-0 mb-3">
						<input type="checkbox" class="form-check-input filled-in" id="used">
						<label class="form-check-label small text-capitalize card-link-secondary" for="used">100+ - 1000+</label>
						</div>
						<div class="form-check pl-0 mb-3">
						<input type="checkbox" class="form-check-input filled-in" id="collectible">
						<label class="form-check-label small text-capitalize card-link-secondary" for="collectible">1000+ - 1m+</label>
						</div>
						<div class="form-check pl-0 mb-1 pb-1">
						<input type="checkbox" class="form-check-input filled-in" id="renewed">
						<label class="form-check-label small text-capitalize card-link-secondary" for="renewed">Above 1m+</label>
						</div>

					</section>
					<!-- Section: Condition -->

					<!-- Section: Condition -->
					<section class="mb-4">

						<h6 class="font-weight-bold mb-3">Filter By Shares </h6>

						<div class="form-check pl-0 mb-3">
						<input type="checkbox" class="form-check-input filled-in" id="new">
						<label class="form-check-label small text-capitalize card-link-secondary" for="new">0-100+</label>
						</div>
						<div class="form-check pl-0 mb-3">
						<input type="checkbox" class="form-check-input filled-in" id="used">
						<label class="form-check-label small text-capitalize card-link-secondary" for="used">100+ - 1000+</label>
						</div>
						<div class="form-check pl-0 mb-3">
						<input type="checkbox" class="form-check-input filled-in" id="collectible">
						<label class="form-check-label small text-capitalize card-link-secondary" for="collectible">1000+ - 1m+</label>
						</div>
						<div class="form-check pl-0 mb-1 pb-1">
						<input type="checkbox" class="form-check-input filled-in" id="renewed">
						<label class="form-check-label small text-capitalize card-link-secondary" for="renewed">Above 1m+</label>
						</div>

					</section>
					<!-- Section: Condition -->

					<!-- Section: Condition -->
					<section class="mb-4">

						<h6 class="font-weight-bold mb-3">Filter By Views </h6>

						<div class="form-check pl-0 mb-3">
						<input type="checkbox" class="form-check-input filled-in" id="new">
						<label class="form-check-label small text-capitalize card-link-secondary" for="new">0-100+</label>
						</div>
						<div class="form-check pl-0 mb-3">
						<input type="checkbox" class="form-check-input filled-in" id="used">
						<label class="form-check-label small text-capitalize card-link-secondary" for="used">100+ - 1000+</label>
						</div>
						<div class="form-check pl-0 mb-3">
						<input type="checkbox" class="form-check-input filled-in" id="collectible">
						<label class="form-check-label small text-capitalize card-link-secondary" for="collectible">1000+ - 1m+</label>
						</div>
						<div class="form-check pl-0 mb-1 pb-1">
						<input type="checkbox" class="form-check-input filled-in" id="renewed">
						<label class="form-check-label small text-capitalize card-link-secondary" for="renewed">Above 1m+</label>
						</div>

					</section>
					<!-- Section: Condition -->

					<!-- Section: Condition -->
					<section class="mb-4">

						<h6 class="font-weight-bold mb-3">Filter By Empower Type </h6>

						<div class="form-check pl-0 mb-3">
						<input type="checkbox" class="form-check-input filled-in" id="new">
						<label class="form-check-label small text-capitalize card-link-secondary" for="new"> Talent </label>
						</div>
						<div class="form-check pl-0 mb-3">
						<input type="checkbox" class="form-check-input filled-in" id="used">
						<label class="form-check-label small text-capitalize card-link-secondary" for="used"> Business </label>
						</div>
						<div class="form-check pl-0 mb-3">
						<input type="checkbox" class="form-check-input filled-in" id="collectible">
						<label class="form-check-label small text-capitalize card-link-secondary" for="collectible"> Idea </label>
						</div>

					</section>
					<!-- Section: Condition -->

					
					</section>
					<!-- Section: Filters -->

				</section>
				<!-- Section: Sidebar -->
				
				</div>
				<!-- marquee -->
				<div id="tickerwrap">
					<marquee id="ticker" vspace="30">
						<?php @session_start(); require_once'dbh.php'; $object1 = new dbh(); $object1 -> marqueeTicker();?>
					</marquee>
				</div>
				<!-- marquee -->
			<nav class="bottom-navbar" id="bt-nav">
				<div class="container">
					<ul class="nav page-navigation">
						
						<?php 
						if(isset($userid)) {
							echo "<li class='nav-item'><a class='nav-link' href='profile?client=$med' target='_blank'> <i class='fas fa-user nav-icon'></i> ACCOUNT </a></li>
								    <li class='nav-item'><a class='nav-link' href='profile?client=$med' target='_blank'> <i class='fas fa-user-edit nav-icon'></i> EDIT PROFILE </a></li>
								    <li class='nav-item'><a class='nav-link' href='paymentdetails?client=$med' target='_blank'> <i class='fas fa-money-check-alt nav-icon'></i> RECEIVING DETAILS </a></li>
								    <li class='nav-item'><a class='nav-link' href='refdetails?client=$med' target='_blank'> <i class='fas fa-users nav-icon'></i> MY FOLLOWERS </a></li>
								    <li class='nav-item'><a class='nav-link' href='withdrawalhistory?client=$med' target='_blank'> <i class='fas fa-share nav-icon'></i> MY EMPOWERMENTS </a></li>
								</li>";
						}    else {
							echo "<li class='nav-item'><a class='nav-link' href='login' target='_blank'> <i class='fas fa-user nav-icon'></i> ACCOUNT </a></li>
								    <li class='nav-item'><a class='nav-link' href='login' target='_blank'> <i class='fas fa-user-edit nav-icon'></i> EDIT PROFILE </a></li>
								    <li class='nav-item'><a class='nav-link' href='login' target='_blank'> <i class='fas fa-money-check-alt nav-icon'></i> RECEIVING DETAILS </a></li>
								    <li class='nav-item'><a class='nav-link' href='login' target='_blank'> <i class='fas fa-users nav-icon'></i> MY FOLLOWERS </a></li>
								    <li class='nav-item'><a class='nav-link' href='login' target='_blank'> <i class='fas fa-share nav-icon'></i> MY EMPOWERMENTS </a></li>
								</li>";
						}
						
						?>
					</ul>
				</div>
			</nav>
		</div>
    	<!-- partial -->
		
		<!-- partial -->
			<div class="container-fluid page-body-wrapper">
				<div class="main-panel">
					<div class="content-wrapper">
						
						<div class="how-it-works">

							<!-- Horizontal scroll div for top ranking -->
							<div class="top-ranking-horizontal-flow">
								<h1> <i class="fas fa-chart-line"></i> Most Trending </h1>
								<div class="scrolling-wrapper">
								
									<?php @session_start(); require_once'dbh.php'; $toprankkinglistings = new dbh(); $toprankkinglistings -> toprankingListings();?>
								</div>
							</div>
							<!-- Horizontal scroll div ends here -->

							
						</div>

						<!-- Horizontal scroll div -->
						<div class="horizontal-flow">
							<h1> <i class="fas fa-clock"></i> Most Recent </h1>
							<div class="scrolling-wrapper">
								<?php @session_start(); require_once'dbh.php'; $mostrecentLists = new dbh(); $mostrecentLists -> mostrecentLists();?>
							</div>
						</div>
						<!-- Horizontal scroll div ends here -->

						<div class="row main-row">
						
							<div class="col-md-9 how-it-works-2 grid-margin stretch-card rounded-0">
								<div class="left-main">
								<!-- emplist from database -->
									<div class="list-all">
                                        <h1 style="color: orange">Search Results </h1>
										<!--php search results show-->
        
                                        <div class='_search _results'>

                                        <?php
                                        @session_start();
                                        require_once'dbh.php';
                                        require_once'config.php';
                                        if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit']) && isset($_POST['query'])) {
    
                                            echo $query_search = strip_tags($_POST['query']);
                                            $obj = new dbh();
                                            $obj -> searchResult();
                                        }
                                        ?>
                                        </div>
                                        <div class='clear float'></div>

                                        <!-- end of search results return-->
									</div>
								</div>
							</div>
							
							<div class="col-md-3 top-ranks bg-white">
								<div class="right-col-bg text-center ">
									<div class="ca">
										<!-- <img src="images/dashboard/face29.png" alt="">   -->
										<h1 class="mb-3">
											<span style='color: orange'> <i class="fas fa-chart-line"></i> TRENDING ACTIVITIES </span> 
										</h1>
										<?php @session_start(); require_once'dbh.php'; $object1 = new dbh(); $object1 -> topFollowers();?>

										<?php @session_start(); require_once'dbh.php'; $object1 = new dbh(); $object1 -> showrecentActivities();?>
									</div>
								</div>
							</div>
						</div>

					</div>
					<!-- content-wrapper ends -->
					<!-- partial:partials/_footer.html -->
					
					<!--// Footer Widget//-->
					<div class="footer-widget">
					<!-- Footer  -->
					
					<!--// Footer CopyRights //-->
						<footer class="footer-main">
							<div class="pro-banner banner-mob pt-0 mt-0" id="pro-banner">
								<div class="card pro-banner-bg border-0 rounded-0">
									<div class="app-badge text-center">
										<div class="text-center">
											<p class="text-white text-center p-badge">Get the Experience In Our Apps</p>
											<div class="ap-badge text-center">
												<a href="#" target="_blank" class="btn"><img src="images/playstore-badge.png" alt="app badge" class="app-badges" srcset=""></a>
												<a href="#" target="_blank" class="btn"><img src="images/badge-download-on-the-app-store.svg" alt="app badge" class="app-badges" srcset=""></a>
											</div>
										</div>	
									</div>
									<div class="card-body py-3 px-4 d-flex align-items-center justify-content-between flex-wrap">
										<p class="mb-0 text-white font-weight-medium mb-2 mb-lg-0 mb-xl-0">Our site uses cookies to ensure your experience.</p>
										<div class="d-flex">
											<a href="#" target="_blank" class="btn btn-outline-light mr-2">Accept Cookies</a>
											<a href="#" target="_blank" class="btn btn-outline-light mr-2 bg-white text-dark">Decline</a>
											<button id="bannerClose" class="btn border-0 p-0">
												<i class="mdi mdi-close text-white"></i>
											</button>
										</div>
									</div>
								</div>
							</div>

							<div class="sponsors mobile text-center">
								<h2 class="sponsored-by">Sponsors </h2>
								<div class='inner-temps'>
									<img src="images/derry-health-logon.png" alt=""> <div class="inner-text"> <small> <b>Derry Health Foundations</b></small>  </div>
								</div>
								<div class='inner-temps'>
									<img src="images/zetranet-logon.png" alt=""> <div class="inner-text">  <small> <b>Zetranet Solutions Ltd</b></small> </div>
								</div>
								<div class='inner-temps'>
									<img src="images/Zenith-Bank-logo.png" alt=""> <div class="inner-text"> <small><b>Zenith Bank</b> </small> </div>
								</div>
								<div class='inner-temps'>
									<img src="images/gtbank-logo-trans.png" alt=""> <div class="inner-text"> <small><b>GT Bank</b> </small> </div>
								</div>
							</div>

							<div class="col-12 footer-intro mt-5 mb-5 pt-3 pb-3">
								<div class="footer-head">
									<div class="container">
										<div class="row">
											<div class="col-md-4 mt-5">
												<h2> <i class="fas fa-satellite-dish"></i> About </h2>
												<div class=""></div>
												<div class="clear-fix" style='clear: both'></div>
												<p>
													We are West Africa Empowerment Program <a href='waep.africa'>(waep.africa)</a>, our vision is to create a platform that will actually empower our African youths finacially to build their Africa Dream. Enough of this <span class="brain-drain"> Poverty and Hardship </span> ravaging our dear continent because of lack of financial support for our youths. We believe that our African Youths have enough potential but with little or no support, which led our company to create a platform where we can support our <span class="industrious">industrious</span>
													african youths.
												</p>
											</div>

											<div class="col-md-4 mt-5">
												<h2> <i class="fas fa-home"></i> COMPANY</h2>
												<div class="clear-fix" style='clear: both'></div>
												<ul>
													<li class='list-item'>
														<a href="">Home</a>
													</li>
													<li class='list-item'>
														<a href="about" target="_blank">About Us</a>
													</li>
													<li class='list-item'>
														<a href="terms" target="_blank">Terms</a>
													</li>
													<li class='list-item'>
														<a href="privacy" target="_blank">Privacy Policy</a>
													</li>
													<li class='list-item'>
														<a href="createaccount" target="_blank">Get Started</a>
													</li>
													<!--//  <li>
														<a href="terms">Terms & Conditions</a>
													</li> //-->
												</ul>
											</div>

											<div class="col-md-4 mt-5">
												<h2><i class="fa fa-info-circle"></i>&nbsp; QUICK CONTACT </h2>
												<!-- <div class=""></div> -->
												<div class="clear-fix" style='clear: both'></div>
												<div class="footer-form">
													<form onsubmit="return false;" id="Contact_form" enctype="multipart/form-data" method="post">
														
													
														<div class="col-12">
															<div class="form-row">
																<div class="col-sm-6">
																	<div class="form-group">
																		<input class="form-control " name="email" id="email" placeholder="Your Email" value="" type="text">
																	</div>
																</div>
																
																<div class="col-sm-6">
																	<div class="form-group">
																		<input class="form-control " name="subject" id="subject" placeholder="Subject" value="" type="text">
																	</div>
																</div>
																</div>
															</div>
															
															<div class="col-sm-12">
																<div class="form-group">
																	<textarea class="form-control " cols="80" name="message" id="message" placeholder="Your Message" rows="8"></textarea>
																</div>
															</div>
													
														
															<div class="col-sm-12">
																<!-- <div id="status" class="alert-success p-2 m-2 rounded"></div> -->
															</div>
															<div class="col-sm-12">
																<div class="form-btn">
																	<button class="btn pull-right" id="contact_Btn"
																		data-animation="animated fadeInRight" onclick="ContactMessage()" >
																		<i class='fas fa-paper-plane'></i> Send Message
																	</button>
																</div>
															</div>
													</form>
												</div>
											</div>
										</div>
									
									</div>
								</div>
							</div>

							
							<div class="container text-center mt-5 pt-3 mb-3 mx-auto copywright">
								<div class="">
									<span>
										<a href="terms" target="_blank" class="mr-3 pr-3">Terms of Service</a>
									</span>
									<span>
										<a href="privacy" target="_blank" class="">Privacy Policy</a>
									</span>
								</div>

								<div class="text-center mx-auto">
									<div class="text-center">Copyright © 2021 - Waep.africa - All Rights Reserved</div>
								</div>
							</div>

						</footer>
					</div>
					<!-- partial -->
				</div>
				<!-- main-panel ends -->
			</div>
			<!-- page-body-wrapper ends -->
		</div>
			<!-- container-scroller -->
		<!-- base:js -->
    <!-- endinject -->
    <!-- plugin js for this page -->
    <!-- Custom js for this page-->
	<script src="javascript/front.js"></script>
	<script src="javascript/interactions.js"></script>
    <script src="js/dashboard.js"></script>
		<script type="text/javascript">
			
			var slideIndex = 1;
			showSlides(slideIndex);

			function plusSlides(n) {
			showSlides(slideIndex += n);
			}

			function currentSlide(n) {
			showSlides(slideIndex = n);
			}

			function showSlides(n) {
			var i;
			var slides = document.getElementsByClassName("mySlides");
			var dots = document.getElementsByClassName("dot");
			if (n > slides.length) {slideIndex = 1}    
			if (n < 1) {slideIndex = slides.length}
			for (i = 0; i < slides.length; i++) {
				slides[i].style.display = "none";  
			}
			for (i = 0; i < dots.length; i++) {
				dots[i].className = dots[i].className.replace(" active", "");
			}
			slides[slideIndex-1].style.display = "block";  
			dots[slideIndex-1].className += " active";
			}




			// Pixel_3a_API_30_x86
			// C:\Users\Chioma\.android\avd\Pixel_3a_API_30_x86.avd
			// Nexus_S_API_30
			// C:\Users\Chioma\.android\avd\Nexus_S_API_30.avd
		</script>
	</div>
  </body>
</html>