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
$email = @$user_data['email'];


$page = isset($_GET['page']) ? $_GET['page'] : 1;
if($page == 0) {
    $page = 1;
}
$limit = 10;
$start = ($page - 1) * $limit;
$con = new PDO("mysql:host=$serverhost;dbname=coinauct_db;", $serverusername, $serverpassword);
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
  <meta charset="utf-8">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">	
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<meta name="author" content="Coin Auction Pro">
	<meta property="og:url"  content="https://coinauctionpro.com/" />
	<meta property="og:type" content="Coin Auction Pro" />		
	<meta property="og:image" content="images/icon.png" />
	<meta property="og:title" content="Coin Auction Pro" />
	<meta property="og:description" content="Bid, Stake And Earn More Crypto" />
	<meta name="keywords" content="bitcoin, blockchain, bitfury, coinauctionpro.com" />
	<meta name="description" content="Bid, Stake And Earn More Crypto" /> 
        
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title> Share Your Testimonials | Coin Auction Pro </title>
  <!-- Google Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Josefin Sans' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Acme' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=PT Sans' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Exo' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Permanent Marker' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Cookie' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Antic' rel='stylesheet'>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
  <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>

  <!-- <link rel="stylesheet" type='text/css' href="css/bootstrap.min.css"> -->
  <link rel="shortcut icon" href="images/icon.png" />
  <script lang="javascript" type="text/javascript" src="javascript/jquery-3.2.1.js"></script>
  <script lang="javascript" type="text/javascript" src="javascript/jquery.min.js"></script>

  <!-- Bootstrap + Fontawesome Css Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type='text/css' href="fontawesome/fontawesomefiles/css/all.min.css">
  <script lang="javascript" type="text/javascript" src="fontawesome/fontawesomefiles/js/fontawesome.min.js"></script>
  <script lang="javascript" type="text/javascript" src="fontawesome/fontawesomefiles/js/all.min.js"></script>
  <script lang="javascript" type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
 
  <!--// Style Sheet //-->
	<link href="css/main.css" rel="stylesheet">
  <style>
      /*Now the CSS*/
      /*Now the CSS*/
      * {margin: 0; padding: 0;}
      .paginate {
    margin: auto;text-align: center;margin: 0 auto;
}
.paginate li {
    padding: .2rem .6rem .2rem .6rem;margin: auto .6rem auto .6rem;border:1px solid rgb(172, 172, 204);
    border-radius: 20px;list-style: none;
}
.paginate li.inactivener {
    background: #6bbcf1;
}
.paginate li.inner {
    border: 1px solid rgb(172, 172, 204);margin: auto .4rem auto .4rem;width: 2rem;
    border-radius: 50%;padding: .2rem .2rem .2rem .2rem;
}
.paginate li a  {
    text-decoration: none;color: blue;
}
.headContainer {
  position: relative;
  background-color: rgb(253, 253, 253);height: inherit;
  margin: 0;padding: 0;margin-bottom:3rem;padding-bottom:3rem;
}
.head-overlay {
  background-color: #000000;margin:0;padding:0;top:0;bottom:0;
     right:0;left:0;opacity: .9;position:absolute;z-index:0;
}
.head-img-overlay {
  background: #000000;margin:0;padding:0;top:0;bottom:0;
     right:0;left:0;position:absolute;z-index:0;
}
  .top-first {
      position: absolute;
      top: 0;
      left: 15%;
      /* transform: translate(-50%,0); */ 
      overflow: visible;
      z-index: 2;
      
  }
  .dfa-co {
      font-size: larger;color: rgba(16, 45, 175, 0.945);
  }
  h1.earn-crypt{
    margin-left:8rem;margin-top: 6rem;
  }
  h2.inv {
    margin-top:5rem;
  }
  .top-first .dfa-btn {
      text-align: center;
      font-family: 'Ubuntu';
      font-size: 16px;
      padding: .8rem;
      line-height: 20px;
      margin: 0;
      border-radius: 70px;
      font-style: normal;
      font-weight: bold;
      background-color: rgb(31, 3, 189);
      color: rgba(12, 46, 194, 0.918); 
  }
  .fa-hand-holding-usd {
    color: rgb(31, 3, 189);
  }
  .main-container {
    height:inherit;margin-top:auto;
  }
  .launch-intro {
    margin-top: 3rem;padding-bottom: 10rem;padding-top: 3rem;paddin
  }
  h2 {
    margin: 3rem auto 2rem auto;
  }
  .dfa-token-if {
    z-index: 20;margin-top: 12rem;
  }
  .dfa-token-if .btn,.free-dca .btn {
    padding: .4rem;z-index:10;
  }
  .dfa-token-if .free-dca .btn {
    padding: .4rem;
  }
  .in-vest {
    margin: 1rem 2rem;
  }
  .fa-check-cycle {
    color:  rgb(118, 174, 248);
  }
 .aff-ref {
   background: rgba(240, 162, 255);margin-bottom:2rem;padding-bottom:1rem;
 }
  .affiliate-net, .affiliate-net h1 {
    color: rgba(58, 90, 233, 0.849);
    z-index: 10;
    margin-top: 2rem;padding-top:2rem;
}
.affiliate-net h2 {
    color: rgba(50, 46, 250, 0.904);
}
.team2 {
  z-index: 10;
}
.refer-desc .container-fluid .card .card-body {
  background: transparent;
}
.refer-desc h1 {
  font-family: 'Josefin Sans';font-weight: bold;
}
.refer-desc h3 {
  font-family: 'Montserrat';
}
.refer-desc .spacered {
  box-shadow: 2px 2px 2px 2px #f1f1f1;
  border-radius: 8px;margin: 1rem;padding: .3rem;
  background: #ffffff;
}
.refer-desc button.btn {
  padding:2rem auto;
  margin:1rem auto;
}
.refer-desc button.btn a{
  color: #ffffff;text-decoration:none;font-weight:bolder;
}
.refer-desc button.btn a:hover,.refer-desc .fa-angle-double-right:hover {
  color: rgb(144, 251, 255);
}
.breakdown {
  margin-bottom:2rem;padding-bottom:1rem;
}
.breakdown h1,.breakdown h2 {
  margin-top:2rem;padding-top:1rem;font-family:'Roboto';
  font-weight:bold;color: #868686; 
}
.breakdown h3 {
 font-family: 'Montserrat';font-size:22px;
}
.breakdown ul li {
  list-style: none;font-family: 'Montserrat';
  margin:1rem;
}
.breakdown button.btn {
  padding:2rem auto;
  margin:1rem auto;
}
.breakdown button.btn a{
  color: #ffffff;text-decoration:none;font-weight:bolder;
}
.custom-shape-divider-top-1606299043 {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    overflow: hidden;
    line-height: 0;
    transform: rotate(180deg);
}

.custom-shape-divider-top-1606299043 svg {
    position: relative;
    display: block;
    width: calc(300% + 1.3px);
    height: 500px;
}

.custom-shape-divider-top-1606299042 {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    overflow: hidden;
    line-height: 0;
    transform: rotate(180deg);
}

.custom-shape-divider-top-1606299042 svg {
    position: relative;
    display: block;
    width: calc(300% + 1.3px);
    height: 500px;
}

.custom-shape-divider-top-1606299043 .shape-fill {
    fill: #FFFFFF;
}
.custom-shape-divider-top-1606299042 .shape-fill {
    fill: #FFFFFF;
}
.custom-shape-divider-top-1606302953 {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    overflow: hidden;
    line-height: 0;
}

.custom-shape-divider-top-1606302953 svg {
    position: relative;z-index: 0;
    display: block;
    width: calc(100% + 1.3px);
    height: 500px;
}

.custom-shape-divider-top-1606302953 .shape-fill {
    fill: #a8cdfc;
}
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
<body>
<div class="wrapper">
  <header>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-md">
        <a class="navbar-brand" href="#"><img src="images/icon.png" class="logon"></a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-align-justify navbar-toggler-icon text-white" id="navbar-toggler-ic"></i>
        </button>
        
        <div class="collapse navbar-collapse nav-menu flex-md-row align-items-right" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto justify-content-end">
              <li class="nav-item active">
                  <a class="nav-link" href="#">Home</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#bidCoin">Stake Now</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="./affiliates" id="navbarDropdownMenuLink"> Affiliates </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="./marketplace">Market Place</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="./coinexchange">Coin Exchange</a>
              </li>
              <li class="nav-item client-area">
                  <a class="nav-link" target="_blank" href="./login">&nbsp;&nbsp;<i class="fas fa-user"></i> Client Area &nbsp;&nbsp;</a>
              </li>
            </ul>
        </div>
    </nav>
    <!-- /.navbar -->
  </header>

  
  
    <!-- Main body container -->
    <div class="container-fluid p-0 align-items-center main-container">
      
      <!-- Spread the word and get instant $400 -->
      <section class="container-fluid pt-15 mt-10 aff-ref">
        <div class="row">
          <div class="col-md-6 affiliate-net">
            <div class="container-fluid">
              <h1> SHARE YOUR TESTIMONIES </h1>
              <h2 style=''>Upload videos and <span class="text-bold">images</span> of your testimonies</h2>
            </div>
          </div>
          
          <div class="col-md-6 text-center img-center">
            <img id="" src="images/happy3.png" alt="coin auction pro" class="img-fluid team2 responsive left rounded-circle">
          </div>
        </div>

        <div class="custom-shape-divider-top-1606299042">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M600,112.77C268.63,112.77,0,65.52,0,7.23V120H1200V7.23C1200,65.52,931.37,112.77,600,112.77Z" class="shape-fill"></path>
            </svg>
        </div>
      </section>
      
      <section class='refer-desc'>
        <div class="container text-center">
          <h1 class="text-primary">Share Your Testimonies <i class="fas fa-share-square"></i></h1>
          <h3 class='text-secondary'>Share and upload your testimonial videos and images to keep encouraging us to serve you more
          </h3>
          <div class="social-share">
            <a href="https://facebook.com" target="_blank"> <i class="fab fa-facebook-square fa-2x"></i></a> <a href="https://twitter.com" target="_blank"> <i class="fab fa-twitter-square fa-2x text-info"></i></a> <a href="https://instagram.com" target="_blank"> <i class="fab fa-instagram fa-2x text-danger"></i></a> <a href="https://youtube.com" target="_blank"> <i class="fab fa-youtube fa-2x text-danger"></i></a> </div>
        </div>
      </section>
      <!--      <section class="crypto-widget">-->

      <section class="testimonial-upload-form mx-auto">
        <div class="modal-body w-75 mx-auto">

        <?php
          require_once'config.php';
          $country = $con->prepare("SELECT uname,ref_id FROM users WHERE id = ? ");
          $country -> bindParam(1,$user_data['id']);
          if($country -> execute()) {
              $flag = $country -> fetch(PDO::FETCH_ASSOC);
              $clientfname = $flag['uname'];
              $n = $flag['uname'];
              $nr = $flag['ref_id'];

              if(isset($n)) {
                  $med = $n;
              }else{
                  $med = $nr;
              }

              if(isset($user_data) && isset($email)) {
                  $uploadlink = "<a class='nav-link text-white' href='uploadtestimonials?client=$med' target='_blank'> <i class='fas fa-level-up-alt nav-icon'></i> UPLOAD TESTIMONIES </a>";
              }else {
                $uploadlink = "<a class='nav-link text-white' href='login' target='_blank'> <i class='fas fa-user nav-icon'></i> LOGIN TO UPLOAD TESTIMONIES </a>";
              }
              
          }

        
      ?>
           
          <div class="form-group text-center mx-auto">
            <div class="mb-5">
              <button type="submit" class="btn btn-primary"  id="funds_btn">
                <?php echo @$uploadlink; ?>
              </button>
            </div>
          </div>

        </div>
  
      </section>
        
      <!-- Spread the word and get instant $400 -->
      <section class="container-fluid pt-15 mt-10 aff-ref">
        <div class="row">
          <div class="col-md-6 affiliate-net">
            <div class="container-fluid">
              <h1> GET REWARD FOR YOUR HARDWORK <i class="fa fa-trophy"></i></h1>
              <h2 style=''>Organize Your <span class="text-bold">Presentation</span> And Receive Instant $100</h2>
            </div>
            <div class="col-md-4">
              <button class="btn bg-primary"><i class="fa fa-angle-double-right text-white"></i> <a href="topleaders" target="_blank"> GET STARTED</a></button>
            </div>
          </div>
          
          <div class="col-md-6 text-center img-center">
            <img id="" src="images/ref.png" alt="coin auction pro" class="img-fluid team2 responsive left rounded-circle">
          </div>
        </div>

        <div class="custom-shape-divider-top-1606299043">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M600,112.77C268.63,112.77,0,65.52,0,7.23V120H1200V7.23C1200,65.52,931.37,112.77,600,112.77Z" class="shape-fill"></path>
            </svg>
        </div>
      </section>

      <!-- breakdown -->
      <!-- breakdown -->
      <section class="breakdown">
        <div class="container text-center">
          <h1 class="text-primary">Our Affiliate Earning Structure <img src="images/feature.svg" alt=""></h1>
          <h3>We beleive that every successful business needs people to grow and multiply and as a result we are willing to share a huge chunk of our revenue with our leaders</h3>
          <div class="team-work">
            <div class="row">
              <div class="col-md-6 text-left">
                <h2>FOR ALL MEMBERS</h2>
                <ul>
                  <li>
                    <i class="fas fa-check-circle text-primary recycle-inner"></i> You get 10% per your recruit stake(investment) amount
                  </li>
                  <li>
                    <i class="fas fa-check-circle text-primary recycle-inner"></i> You get 2% of any activity done by your recruit
                  </li>
                </ul>
              </div>
              <div class="col-md-6 text-left">
                <h2>FOR LEADERS</h2>
                  <ul>
                    <li>
                      <i class="fas fa-check-circle text-primary recycle-inner"></i> You get instant $100 per successful seminar with your team (Show us proof at least 10 sign ups through your seminar and get your instant $100) including other benefits that follow
                    </li>
                    <li>
                      <i class="fas fa-check-circle text-primary recycle-inner"></i> You have an unending pool of $1,000 (we will keep adding to your pool) which we will be remitting to you on a continual basis per successful recruit
                    </li>
                    <li>
                      <i class="fas fa-check-circle text-primary recycle-inner"></i> Receive Periodic Cash Incentives($,500, $1,000, $2,500 and more) For Qualifying To Specific  Package Levels
                    </li>
                    <li>
                      <i class="fas fa-check-circle text-primary recycle-inner"></i> You get 10% per your recruit stake(investment) amount
                    </li>
                    <li>
                      <i class="fas fa-check-circle text-primary recycle-inner"></i> You get 2% of any activity done by your recruit
                    </li>
                  </ul>
                  <div class="col-md-12">
                    <button class="btn bg-primary"><i class="fa fa-angle-double-right text-white"></i> <a href="topleaders" target="_blank"> SIGN UP AS A LEADER</a></button>
                  </div>
              </div>
            </div>
            
          </div>
        </div>
      </section>


      <section class="user-testimonies">
          <h3 class='text-info text-center'> TESTIMONIES </h3>
          <div class="col-12">
          <?php
            require_once'config.php';
            require_once'dbh.php';

            $inv = $con->prepare("SELECT testimony FROM testimonies");
            $paginate = $con->prepare("SELECT count(id) AS id FROM testimonies");
            $paginate -> execute();   
            $inv -> execute();
            if($inv -> execute() && $inv -> rowCount() > 0) {
                $in = $inv -> fetchAll(PDO::FETCH_ASSOC);
                $allowed_imgtype = array('jpeg','jpg','png','gif');
                $allowed_vidtype = array('mp4','mov','web','hd');

                $countd = $paginate -> fetchAll(PDO::FETCH_ASSOC);
                $totalcountd = $countd[0]['id'];
                $pages = ceil($totalcountd / $limit); 
                $Previous = $page - 1;
                $Next = $page + 1;

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
                                    <a href='testimonials?page=$Previous' aria-label='Previous'>
                                        <span aria-hidden='true'>
                                            &laquo; Previous                        
                                        </span>
                                    </a>
                                </li>";
                                }       
                        
                                for($i = 1; $i <= $pages; $i++) {
                                    echo "<li class='inner'><a href='testimonials?page=$i'>$i</a></li>";
                                }
                        if($page > 1) {
                            echo "<li>
                                    <a href='testimonials?page=$Next' aria-label='Next'>
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

            }
              ?>
          </div>
      </section>
    </div>
    <!-- Main body container ends -->

  </div> 
  <!-- Wrapper ends here -->

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5ebbe3628ee2956d73a0b8dc/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

<!-- Main File-->
<script src="javascript/front.js"></script>
<script src="javascript/home.js"></script>
</body>
</html>
