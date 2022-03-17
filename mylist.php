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


// if(!isset($_SESSION['user'])) {
//     header('Location:');
//     exit();
// }else {
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
	<title>Empower Africa | Reviving Our Dear Continent Once Again </title>
    <!-- base:css -->
    <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
	<!-- End plugin css for this page -->
	<script lang="javascript" type="text/javascript" src="javascript/jquery-3.2.1.js"></script>
    <script lang="javascript" type="text/javascript" src="javascript/jquery.min.js"></script>
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
	<link rel="stylesheet" href="css/comments.css">
	<link rel="stylesheet" href="css/myempowerpage.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="images/favicon.png" />
  </head>
  <body>

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

  <!-- sidebar nav -->

  <?php 
            
	echo "<div id='mySidebar' class='sidebar'>
			<li class='nav-item'><a class='nav-link' href='dashboard?client=$med' target='_blank'> <i class='fas fa-user nav-icon'></i> ACCOUNT </a></li>
			<li class='nav-item'><a class='nav-link' href='empower.php?client=$med' target='_blank'> <i class='fas fa-user nav-icon'></i> GET EMPOWERED </a></li>
			<li class='nav-item'><a class='nav-link' href='myshares?client=$med' target='_blank'> <i class='fas fa-user nav-icon'></i> MY SHARES </a></li>
			<li class='nav-item'><a class='nav-link' href='profile?client=$med' target='_blank'> <i class='fas fa-user nav-icon'></i> EDIT PROFILE </a></li>
			<li class='nav-item'><a class='nav-link' href='paymentdetails?client=$med' target='_blank'> <i class='fas fa-money-check-alt nav-icon'></i> PAYMENT DETAILS </a></li>
			<li class='nav-item'><a class='nav-link' href='refdetails?client=$med' target='_blank'> <i class='fas fa-users nav-icon'></i> MY FOLLOWERS </a></li>
			<li class='nav-item'><a class='nav-link' href='withdrawalhistory?client=$med' target='_blank'> <i class='fas fa-share nav-icon'></i> MY SHARES </a></li>
		</div>";
	?>


	<div id="main">
		<div class="container-scroller">
			<div class="pro-banner" id="pro-banner">
				<div class="card pro-banner-bg border-0 rounded-0">
					<div class="app-badge text-center">
						<div class="text-center">
							<p class="text-white text-center p-badge">Get the Experience In Our Apps</p>
							<div class="ap-badge text-center">
								<a href="https://github.com/Bootstrapdash/Kapella-Free-Bootstrap-Admin-Template" target="_blank" class="btn"><img src="images/playstore-badge.png" alt="app badge" class="app-badges" srcset=""></a>
								<a href="http://www.bootstrapdash.com/demo/kapella/template/" target="_blank" class="btn"><img src="images/badge-download-on-the-app-store.svg" alt="app badge" class="app-badges" srcset=""></a>
							</div>
						</div>	
					</div>
					<div class="card-body py-3 px-4 d-flex align-items-center justify-content-between flex-wrap">
						<p class="mb-0 text-white font-weight-medium mb-2 mb-lg-0 mb-xl-0">Our site uses cookies to ensure your experience.</p>
						<div class="d-flex">
							<a href="https://github.com/Bootstrapdash/Kapella-Free-Bootstrap-Admin-Template" target="_blank" class="btn btn-outline-light mr-2">Accept Cookies</a>
							<a href="http://www.bootstrapdash.com/demo/kapella/template/" target="_blank" class="btn btn-outline-light mr-2 bg-white text-dark">Decline</a>
							<button id="bannerClose" class="btn border-0 p-0">
								<i class="mdi mdi-close text-white"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
			<!-- partial:partials/_horizontal-navbar.html -->
			<div id="tickerwrap">
				<marquee id="ticker" vspace="30">
					Fight Against Unemployment In West Africa 
				</marquee>
			</div>
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
						<li class="nav-item dropdown">
							<a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
							<i class="mdi mdi-bell mx-0"></i>
							<span class="count">2</span>
							</a>
							<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
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
								<div class="preview-thumbnail">
									<div class="preview-icon bg-warning">
									<i class="mdi mdi-settings mx-0"></i>
									</div>
								</div>
								<div class="preview-item-content">
									<h6 class="preview-subject font-weight-normal">Settings</h6>
									<p class="font-weight-light small-text mb-0 text-muted">
									Private message
									</p>
								</div>
							</a>
							<a class="dropdown-item preview-item">
								<div class="preview-thumbnail">
									<div class="preview-icon bg-info">
									<i class="mdi mdi-account-box mx-0"></i>
									</div>
								</div>
								<div class="preview-item-content">
									<h6 class="preview-subject font-weight-normal">New user registration</h6>
									<p class="font-weight-light small-text mb-0 text-muted">
									2 days ago
									</p>
								</div>
							</a>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-toggle="dropdown">
							<i class="mdi mdi-email mx-0"></i>
							<span class="count">4</span>
							</a>
							<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
							<p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
							<a class="dropdown-item preview-item">
								<div class="preview-thumbnail">
									<img src="images/faces/face4.jpg" alt="image" class="profile-pic">
								</div>
								<div class="preview-item-content flex-grow">
									<h6 class="preview-subject ellipsis font-weight-normal">David Grey
									</h6>
									<p class="font-weight-light small-text text-muted mb-0">
									The meeting is cancelled
									</p>
								</div>
							</a>
							<a class="dropdown-item preview-item">
								<div class="preview-thumbnail">
									<img src="images/faces/face2.jpg" alt="image" class="profile-pic">
								</div>
								<div class="preview-item-content flex-grow">
									<h6 class="preview-subject ellipsis font-weight-normal">Tim Cook
									</h6>
									<p class="font-weight-light small-text text-muted mb-0">
									New product launch
									</p>
								</div>
							</a>
							<a class="dropdown-item preview-item">
								<div class="preview-thumbnail">
									<img src="images/faces/face3.jpg" alt="image" class="profile-pic">
								</div>
								<div class="preview-item-content flex-grow">
									<h6 class="preview-subject ellipsis font-weight-normal"> Johnson
									</h6>
									<p class="font-weight-light small-text text-muted mb-0">
									Upcoming board meeting
									</p>
								</div>
							</a>
							</div>
						</li>
						<!-- <li class="nav-item dropdown">
							<a href="#" class="nav-link count-indicator "><i class="mdi mdi-message-reply-text"></i></a>
						</li> -->
						<li class="nav-item nav-search d-none d-lg-block ml-3 border-rounded">
							<div class="input-group border-rounded bg-white">
								<div class="input-group-prepend border-rounded">
								<span class="input-group-text" id="search">
									<i class="mdi mdi-magnify"></i>
								</span>
								</div>
								<input type="text" class="form-control" placeholder="search" aria-label="search" aria-describedby="search">
							</div>
						</li>	
						</ul>
						<!-- <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
							<a class="navbar-brand brand-logo" href="index.html"><img src="images/logo.svg" alt="logo"/></a>
							<a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo"/></a>
						</div> -->
						<ul class="navbar-nav navbar-nav-right">
							<li class="nav-item dropdown d-lg-flex d-none">
							<a class="dropdown-toggle show-dropdown-arrow btn btn-inverse-primary btn-sm" id="nreportDropdown" href="#" data-toggle="dropdown">
							View My Idea
							</a>
							<div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="nreportDropdown">
								<p class="mb-0 font-weight-medium float-left dropdown-header">View My Idea</p>
								<a class="dropdown-item">
									<i class="mdi mdi-file-pdf text-primary"></i>
									Pdf
								</a>
								<a class="dropdown-item">
									<i class="mdi mdi-file-excel text-primary"></i>
									Exel
								</a>
							</div>
							</li>
							<!-- <li class="nav-item dropdown d-lg-flex d-none">
							<button type="button" class="btn btn-inverse-primary btn-sm"><i class="fas fa-user-cog"></i> Settings</button>
							</li> -->
							
							<li class="nav-item dropdown  d-lg-flex d-none">
							<button type="button" class="btn btn-inverse-primary btn-sm"> <a href="empower.php" id="nreportDropdown" target="_blank" class='btn-inverse-primary upload-talent'><i class="fas fa-share"></i> Get Empowered </a> </button>
							</li>
							<li class="nav-item nav-profile dropdown text-white">
							<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
								<?php
									if(isset($user_data)) {
										require_once'dbh.php'; $p_pix = new dbh(); echo "<span class='nav-profile-name'>". @$clientfname ."</span><span class='online-status'></span>"; $p_pix -> fetchUserProfilePics();
									
								?>
								<!-- <span class="nav-profile-name">Johnson</span>	  
								<img src="images/faces/face28.png" alt="profile" class="border-rounded rounded-circle"/> -->
								<?php } else {?>
								<span class="nav-profile-name">Johnson</span>	  
								<img src="images/faces/face28.png" alt="profile" class="border-rounded rounded-circle"/>
								<?php }?>
							</a>
							<div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
								<a class="dropdown-item">
									<i class="mdi mdi-settings"></i>
									Settings
								</a>
								<a class="dropdown-item">
									<i class="mdi mdi-logout"></i>
									Logout
								</a>
							</div>
							</li>
						</ul>
						<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
						<span class="mdi mdi-menu"></span>
						</button>
					</div>
				</div>
			</nav>

		</div>

		
		<!-- partial -->
			<div class="container-fluid page-body-wrapper">
				<div class="main-panel">
					<div class="content-wrapper">
						<!-- <div class="container-fluid col-12 first-heading">
							 <div class="drop-container">
								<div class="drop"></div>
							</div> 
						</div> -->

						<div class="how-it-works">

						</div>

						<!-- Horizontal scroll div -->
						<div class="horizontal-flow pb-5">
							<h1>Most Recent Listing </h1>
							<div class="scrolling-wrapper">
								<?php @session_start(); require_once'dbh.php'; $mostrecentLists = new dbh(); $mostrecentLists -> mostrecentLists();?>
								<div class="card"><h2>Card</h2><img class="" src="images/online-registration-concept.png" alt="First slide"></div>
								<div class="card"><h2>Card</h2><img class="" src="images/online-registration-concept.png" alt="First slide"></div>
								<div class="card"><h2>Card</h2><img class="" src="images/online-registration-concept.png" alt="First slide"></div>
								<div class="card"><h2>Card</h2><img class="" src="images/online-registration-concept.png" alt="First slide"></div>
								<div class="card"><h2>Card</h2><img class="" src="images/online-registration-concept.png" alt="First slide"></div>
								<div class="card"><h2>Card</h2><img class="" src="images/online-registration-concept.png" alt="First slide"></div>
								<div class="card"><h2>Card</h2><img class="" src="images/online-registration-concept.png" alt="First slide"></div>
								<div class="card"><h2>Card</h2><img class="" src="images/online-registration-concept.png" alt="First slide"></div>
								<div class="card"><h2>Card</h2><img class="" src="images/online-registration-concept.png" alt="First slide"></div>
							</div>
						</div>
						<!-- Horizontal scroll div ends here -->

						<div class="row main-row pb-5 mb-5 ml-2 p">
						
							<div class="col-sm-9">
								<div class="wrap bg-white text-dark">
									<div class="empower-me-container">
							<!-- row start -->
							<div class="user-empowerlist">
								<div class='user-emplist'>
									My Shares
								</div>
								<?php @session_start(); require_once'dbh.php'; $userempList = new dbh(); $userempList -> usersempowerList();?>
							</div>
						<!-- /.row ends -->
						</div>

					</div>								
				</div>

      <div class="col-sm-3">
        <div class="user-bio bg-white text-dark">
          <h3 class="bio-intro">
            Here is a little bio of myself
          </h3>
          <?php @session_start(); require_once'dbh.php'; $bio = new dbh(); $bio -> userBio();?>
          <p>Help John Achieve his dream by supporting his dream financially. Lets build the africa of our dream by </p>
          <div class="donat-btn text-center">
            <div class="user-up">
              <blockquote>
                <i class="fas fa-quote-left"></i> <?php echo @$clientfname;?> has proven that he is resourceful, talented, hard working and enterprenueral. With a little drop in the ocean we can help <?php echo @$clientfname;?> build a sustaining <?php $emptype = new dbh(); $emptype -> empowerType(); #echo $msg; ?> that will create 
                employment opportunities for our teaming African population and help prevent depression and social vices of our dear African Youths <i class="fas fa-quote-right"></i>
              </blockquote>	
            </div>
            <button>Donate To <?php echo @$clientfname;?> <?php $emptype = new dbh(); $emptype -> empowerType(); #echo $msg; ?></button>
            <div class="received-donations">
            (<small><em>Donations Received For</em></small> <?php require_once'dbh.php'; echo "<span class='user-name'>". @$clientfname ."</span>";?>: <span class="total-donations-received">
              <span class="t-doantions"> <?php @session_start(); require_once'dbh.php'; $donate = new dbh(); $donate -> totalDonations();?></span>	
            </span>)
            </div> 

            <div class="lift-up">
              No donation is too small to give, little by little we lift our african youths from poverty and unemployment
            </div>

            <div class="donate-warning">
              <div class="no-wrap-warn"><div class="mv-lft"><i class="fas fa-exclamation-triangle"></i></div> <div class="warn">All Donations Are Recorded And Displayed On This Page</div></div>  
              <div class="end-float"></div>
            </div> 
              
            <div class="our-vision">
              <span class="vision">Our Vision</span> 
              <p>
                To create a platform that will actually empower our African youths finacially to build their Africa Dream. Enough of these Europe and America <span class="brain-drain"> Brain Drain Syndrome</span> ravaging our dear continent because of lack of financial support for our youths. We believe that our African Youths have enough potential but with little or no support, which led our company to create a platform where we can support our <span class="industrious">industrious</span>
                african youths.
              </p> 
            </div> 
          </div>
          
        </div>
      </div>
      
    </div>

  </div>

      <!-- content-wrapper ends -->
      <!-- partial:partials/_footer.html -->
      <footer class="footer">
      <div class="footer-wrap">
        <h4>
          Empower africa goals is to empower as many african youths and enterpreneurs, revive the africa economy and help africans create employment opportunities for fellow africans.
        </h4>
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
          <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Empowerafrica.com 2021 | All Rights Reserved</span>
        </div>
      </div>
      </footer>
          <!-- partial -->
    </div>
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
    <!-- <script src="vendors/chart.js/Chart.min.js"></script>
    <script src="vendors/progressbar.js/progressbar.min.js"></script>
      <script src="vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js"></script>
      <script src="vendors/justgage/raphael-2.1.4.min.js"></script>
      <script src="vendors/justgage/justgage.js"></script> -->
    <!-- Custom js for this page-->
    <script src="javascript/interactions.js"></script>
    <script src="javascript/comments.js"></script>
    <script src="js/dashboard.js"></script>
    <!-- End custom js for this page-->
    <script type="text/javascript">

      /* Set the width of the sidebar to 250px and the left margin of the page content to 250px */
      
      /* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
      function openNav() {
        document.getElementById("mySidebar").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
        document.getElementById("toggleSideBar").style.display = 'none';
        document.getElementById("closeSideBar").style.display = 'block';
      }

      function closeNav() {
        document.getElementById("mySidebar").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
        document.getElementById("closeSideBar").style.display = 'none';
        document.getElementById("toggleSideBar").style.display = 'block';
      }

      // Pixel_3a_API_30_x86
      // C:\Users\Chioma\.android\avd\Pixel_3a_API_30_x86.avd
      // Nexus_S_API_30
      // C:\Users\Chioma\.android\avd\Nexus_S_API_30.avd
    </script>
    </div>
  </body>
</html>

