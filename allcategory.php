<?php
ob_start();
session_start();
require_once'dbh.php';
require_once'config.php';
include'footer.php';
include'header.php';

@$_SESSION['currentpage'] = $_SERVER['REQUEST_URI'];
strip_tags(@$_SESSION['currentpage']);

$user_data = @$_SESSION['user'];
$userid = @$user_data['id'];
$name = @$user_data['fname'];


$user_data = @$_SESSION['user'];
$userid = @$user_data['id'];
$name = @$user_data['uname'];
$lname = @$user_data['full_name'];
$clientCountry = @$user_data['userCountry'];
$countryFlag = @$user_data['countryFlag'];
$email_of_user = @$user_data['email'];


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

?>
<!DOCTYPE html>
<html lang="en">
<head>
<base href="https://fundreza.com/">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title> Start Fundraising | Fundreza.com </title>

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
  <link rel="shortcut icon" href="images/favicon.png">

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
  <link rel="stylesheet" href="css/adminlte.min.css?n=1">
  <link rel="stylesheet" href="css/customs.css?n=1">
  <link rel="stylesheet" href="css/pageloaders.css?n=1">
  <link rel="stylesheet" href="css/customize.css?n=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script lang="javascript" type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<!-- Font Awesome CSS-->
	<link rel="stylesheet" type='text/css' href="fontawesome/fontawesomefiles/css/fontawesome.min.css">
	<link rel="stylesheet" type='text/css' href="fontawesome/fontawesomefiles/css/all.min.css">
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<script lang="javascript" type="text/javascript" src="fontawesome/fontawesomefiles/js/fontawesome.min.js"></script>
	<script lang="javascript" type="text/javascript" src="fontawesome/fontawesomefiles/js/all.min.js"></script>
	<!-- inject:css -->
  
  <style>

body {
  margin: 0;
  background: #ffffff;
  text-align: center;
  font-family: sans-serif;
  color: #fefefe;
}
    .header {
      position:relative;
      text-align:center;
      background: #aff7b7;
      color:white;
    }
    .logo {
      width:50px;
      fill:white;
      padding-right:15px;
      display:inline-block;
      vertical-align: middle;
    }

    .inner-header {
      height:65vh;
      width:100%;
      margin: 0;
      padding: 0;
    }
.p-con {
    width: 100%;
}
.p-con .amtt {
    font-weight: bold;margin-bottom: .2rem;
}
.p-con .amtt .amtraisedc {
    float: left;;font-style: normal;font-weight: lighter;color: #545454;
}
.p-con .amtt .amttotalc {
    float: right;color: #525753;
}
.progress {
    height: .4rem;background-color: #eaeaea;
}
.progress-bar {
    background-color: transparent;
}
    /* .flex { Flexbox for containers
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
    } */

    .waves {
      position:relative;
      width: 100%;
      height:15vh;
      margin-bottom:-7px; /*Fix for safari gap*/
      min-height:100px;
      max-height:150px;
    }

    .content {
      position:relative;
      height:20vh;
      text-align:center;
      background-color: white;
    }

    /* Animation */

    .parallax > use {
      animation: move-forever 25s cubic-bezier(.55,.5,.45,.5)     infinite;
    }
    .parallax > use:nth-child(1) {
      animation-delay: -2s;
      animation-duration: 7s;
    }
    .parallax > use:nth-child(2) {
      animation-delay: -3s;
      animation-duration: 10s;
    }
    .parallax > use:nth-child(3) {
      animation-delay: -4s;
      animation-duration: 13s;
    }
    .parallax > use:nth-child(4) {
      animation-delay: -5s;
      animation-duration: 20s;
    }
    @keyframes move-forever {
      0% {
      transform: translate3d(-90px,0,0);
      }
      100% { 
        transform: translate3d(85px,0,0);
      }
    }
    .oda-c {
    font-family: "Montserrat";margin-bottom: 1rem;
}
.gallery-row{
  display:flex;
  display:-webkit-flex;
  flex-flow:row nowrap;
}

.gallery-row-scroll{
  display:flex;
  display:-webkit-flex;
  overflow-x:hidden;
  -webkit-overflow-scrolling: touch;
  -ms-flex-flow: row nowrap;
  flex-flow: row nowrap;
  -webkit-flex-flow: row nowrap;

}

.gallery-row-scroll > *{
  margin: 0 0.1em;
  -webkit-flex:0 0 auto;
}

.gallery-row-scroll > :first-child{
  margin-left: 0;
}

.gallery-row-scroll > :last-child{
  margin-right: 0;
}

.gallery-row img{
  display:block;
  -webkit-touch-callout: none; /* iOS Safari */
  -webkit-user-select: none;   /* Chrome/Safari/Opera */
  -khtml-user-select: none;    /* Konqueror */
  -moz-user-select: none;      /* Firefox */
  -ms-user-select: none;       /* Internet Explorer/Edge */
  user-select: none;
  margin: 2rem;
  border-radius: 8px;
}
/*
html.touchevents .gallery-row svg{
  display:none;
}
*/

.gallery-row svg{
  background-color: none;
  width:10%;
  max-width:50px;
  min-width:20px;
  color: red;
  opacity:0.75;
  cursor:pointer;
}

.gallery-row svg:hover{
  background-color:none;
  opacity:1;
cursor:pointer;
}

.gallery-row .arrow.right{
  right:0;
}

.gallery-row.large img{
  height:200px;
  width:20rem;margin: 2rem;
}

.gallery-row.small img{
  height:150px;margin: 2rem;
  width:15rem;
}
h3 {
 font-family: 'Patua One', cursive;
 font-weight: 400;
 font-size: 1.4em;
 line-height: 1.4em;
 color: #fff
}
.container {
 box-sizing: content-box;
 max-width: 1000px;
 margin-left: auto;
 margin-right: auto;
 padding-left: 15px;
 padding-right: 15px;
 padding-top: 40px;
 padding-bottom: 40px;
}
.indentity {
 margin: 0!important
}
figure.testimonial {
 position: relative;
 float: left;
 overflow: hidden;
 margin: 10px 1%;
 padding: 0 20px;
 text-align: left;
 box-shadow: none !important;
}
figure.testimonial * {
 -webkit-box-sizing: border-box;
 box-sizing: border-box;
 -webkit-transition: all 0.35s cubic-bezier(0.25, 0.5, 0.5, 0.9);
 transition: all 0.35s cubic-bezier(0.25, 0.5, 0.5, 0.9);
}
figure.testimonial img {
 max-width: 100%;
 vertical-align: middle;
 height: 90px;
 width: 90px;
 border-radius: 50%;
 margin: 40px 0 0 10px;
}
figure.testimonial blockquote {
 background-color: #fff;
 display: block;
 font-size: 16px;
 font-weight: 400;
 line-height: 1.5em;
 margin: 0;
 padding: 25px 50px 30px;
 position: relative;
}
figure.testimonial blockquote:before, figure.testimonial blockquote:after {
 content: "\201C";
 position: absolute;
 color: #ff5057;
 font-size: 50px;
 font-style: normal;
}
figure.testimonial blockquote:before {
 top: 25px;
 left: 20px;
}
figure.testimonial blockquote:after {
 content: "\201D";
 right: 20px;
 bottom: 0;
}
figure.testimonial .btn {
 top: 100%;
 width: 0;
 height: 0;
 border-left: 0 solid transparent;
 border-right: 25px solid transparent;
 border-top: 25px solid #fff;
 margin: 0;
 position: absolute;
}
figure.testimonial .peopl {
 position: absolute;
 bottom: 45px;
 padding: 0 10px 0 120px;
 margin: 0;
 color: #ffffff;
 -webkit-transform: translateY(50%);
 transform: translateY(50%);
}
figure.testimonial .peopl h3 {
 opacity: 0.9;
 margin: 0;
}
.slick-slider {
 position: relative;
 display: block;
 box-sizing: border-box;
 user-select: none;
 -webkit-touch-callout: none;
 -khtml-user-select: none;
 -ms-touch-action: pan-y;
 touch-action: pan-y;
 -webkit-tap-highlight-color: transparent;
}
.slick-list {
 position: relative;
 display: block;
 overflow: hidden;
 margin: 0;
 padding: 0;
}
.slick-list:focus {
 outline: none;
}
.slick-list.dragging {
 cursor: pointer;
 cursor: hand;
}
.slick-slider .slick-track, .slick-slider .slick-list {
 transform: translate3d(0, 0, 0);
}
.slick-track {
 position: relative;
 top: 0;
 left: 0;
 display: block;
}
.slick-track:before, .slick-track:after {
 display: table;
 content: '';
}
.slick-track:after {
 clear: both;
}
.slick-loading .slick-track {
 visibility: hidden;
}
.slick-slide {
 display: none;
 float: left;
 height: 100%;
 min-height: 1px;
}
.slick-slide img {
 display: block;
}
.slick-slide.slick-loading img {
 display: none;
}
.slick-slide.dragging img {
 pointer-events: none;
}
.slick-initialized .slick-slide {
 display: block;
}
.slick-loading .slick-slide {
 visibility: hidden;
}
.slick-vertical .slick-slide {
 display: block;
 height: auto;
 border: 1px solid transparent;
}
.slick-btn.slick-hidden {
 display: none;
}
 
.slick-prev, .slick-next {
 font-size: 0;
 line-height: 0;
 position: absolute;
 top: 40%;
 display: block;
 width: 20px;
 height: 20px;
 padding: 0;
 transform: translate(0, -50%);
 cursor: pointer;
 color: transparent;
 border: none;
 outline: none;
 background: transparent;
}
.slick-prev:hover, .slick-prev:focus, .slick-next:hover, .slick-next:focus {
 color: transparent;
 outline: none;
 background: transparent;
}
.slick-prev:hover:before, .slick-prev:focus:before, .slick-next:hover:before, .slick-next:focus:before {
 opacity: 1;
}
.slick-prev:before, .slick-next:before {
 font-family: "FontAwesome";
 font-size: 40px;
 line-height: 1;
 opacity: .75;
 color: white;
 -webkit-font-smoothing: antialiased;
 -moz-osx-font-smoothing: grayscale;
}
.slick-prev {
 left: -40px;
}
.slick-prev:before {
 content: "";
}
.slick-next {
 right: -40px;
}
.slick-next:before {
 content: "";
}
    /* external css: flickity.css */

    /*Shrinking for mobile*/
    @media (max-width: 768px) {
      .waves {
        height:40px;
        min-height:40px;
      }
      .content {
        height:30vh;
      }
  }      /* .content-wrapper {
      width: 90% !important;position: relative;margin: 1rem auto;background: red;
    } */
  </style>
</head>
<body class="bg-white">
<!--<div class="overlay" id="overlay"></div>-->
<?php
      require_once'config.php';
      $country = $con-> prepare("SELECT userCountry,countryFlag,uname,invite_id FROM users WHERE id = ? ");
      $country -> bindParam(1,$user_data['id']);
      $nm = $con-> prepare("SELECT uname FROM users");
      $nm -> execute();
      if($country -> execute()) {
          $flag = $country -> fetch(PDO::FETCH_ASSOC);
          $client_Country = @$flag['userCountry'];
          $client_flag = @$flag['countryFlag'];
          $clientfname = @$flag['uname'];
          @$client_Flag = 'images/pngflags/'.$client_flag;
          $newmembers = $nm -> rowCount();
          $n = @$flag['uname'];
          $nr = @$flag['invite_id'];
          if(isset($n)) {
              $med = $n;
          }else{
              $med = $nr;
          }
        }

        
  ?>

<div class="wrapper" id="main">
  <?php echo @$header;?>


    <!-- pageloader  -->
  <div id="progress" class="waiting"></div>
  <!-- pageloader ends -->

  <!-- header -->
  <div class="headerc mt-5 pt-5 mb-5 pb-5">

        <div class="fr-cat mt-5 mb-5 pt-5 pb-5 m-3">
          <h1>Fundraising Categories</h1>
          <p>
            People around the world are raising money for what they are passionate about.
          </p>
        </div>
        
        <div class="search-f" id="search">
            <form action="" Method ="POST">
              <div class="">
                <input type="varchar" class="form-control " name="query" id="search-input" placeholder="search fundraiser by name or category" aria-label="search" aria-describedby="search">
                <button type="submit" class="border-none" name="submit"><i class="fas fa-search"></i></button>
              </div>
            </form> 
            <div id="kkkk"></div>
        </div>

  </div>
  <!--Header ends-->

  <div class="section-tf">
        
    <!-- top fundraisers starts -->
  <?php 
      require_once'dbh.php';
      require_once'config.php';
      $con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
      $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = $con -> prepare("SELECT images,category FROM fundraisercategories LIMIT 8");
      $sql -> execute();
      if($sql -> rowCount() > 0) {
      $rows = $sql -> fetchALL(PDO::FETCH_ASSOC);

    ?>
    <div class="container-">
        <div class="trn">
         <a data-gfm-analytics-element="btn_breadcrumb_back" data-area="blog"
                href="<?php echo "https://fundreza.com/"?>"
                class="icon-link medium-gray" property="item" typeof="WebPage">
                  <span property="name" style="box-shadow: 1px 1px 1px 2px #f1f1f1;color: #22a349;padding: .6rem;border-radius: 6px;">
                      <div class="fa fa-angle-left text-bold mr-small"></div> Home                       
                    </span>
              </a>
        </div>

      <div class="trn font-weight-bold text-dark"><?php echo 'Fundraising Categories';?></div>
      <div class="d-inner row">
      <?php
  
  foreach($rows as $row) {
        $fcatImage = $row['images'];
        $fcat = $row['category'];
        $fccate = str_replace(" ","-",$fcat);
        $fccat = strtolower($fccate);
        echo "<div id='' class='col-lg-4 col-sm-6 '>
                    <div class='funda text-center' style='height: 280px;'>
                        <div class='mb-3 position-relative'>
                            <div class='badge text-white badge-'></div>
                            <a target='_blank' href='https://fundreza.com/category/$fccat' style='text-decoration:none;'>
                                <img src='$fcatImage' name='thumbsvid' alt='thumbnail image' class='mfr-img' style=''>
                            </a>
                            
                            <div class='f-con text-dark font-weight-bold p-3' style='font-family: 'PT Sans';font-weight: bold;font-size: 14px'>
                              $fcat
                            </div>
                        </div>
                    </div>
              </div>";

  }
      ?>
      </div>
    </div>
    <?php } else {?>
        <div class="nof text-dark">
            <h3 class='p-3 pt-5' style="font-family: 'PT Sans';color: #545454"> <span style="padding: .6rem;box-shadow: 2px 2px 2px 3px #f1f1f1">No <span style="color: #22a349"><?php echo @$cc = ucwords($cat);?></span> fundraiser's found?</span></h3>

            <div class="st-f mt-2">
                <div class="stn">
                <div class="rdy">Ready to raise <span style='color:#22a349;font-weight:bold;font-family: "PT Sans";'><?php echo @$cat;?></span> funds?</div>
                <a href="https://fundreza.com/redirect"><button class='nf'> <i class="fas fa-donate"></i> Start a new fundraiser</button></a>
                </div>
                <div class="stn">
                <a href=""><button class='nwe'><i class="fas fa-headset"></i> Talk With Us</button></a>
                </div>
            </div>
        </div>
    <?php }?>
    </div>
  <!-- top fundraisers -->


  <!-- category fundraisers -->

</div>
<!-- section hiw ends -->


<!-- What you can raise funds for -->
<div class="whfm pt-3 mt-2 bg-light">
      <h1  style="color: #22a349; margin: 1rem auto;font-family: 'PT Sans';font-weight: bold;text-align: center">Why Fundreza ?</h1>
      <div class="rowas">
        <div class="drit">
          <img src="images/worldm.png" alt="">
          <div class="ina">
            Worldwide Leadership
            <p class="ria">
                GoFundMe is trusted around the world for its simple, reliable fundraising platform.
            </p>
          </div>
        </div>
        <div class="drit">
          <img src="images/money.png" alt="">
          <div class="ina">
              Numerous Donation Channels
            <p class="ria">
                Receive donations via all popular payment modes and withdraw with ease
            </p>
          </div>
        </div>
        <div class="drit">
          <img src="images/usercog.png" alt="">
          <div class="ina">
            Simplified Setup
            <p class="ria">
              You can personalize and share your HelpFundMe in just a few minutes.
            </p>
          </div>
        </div>
        <div class="drit">
          <img src="images/protection.png" alt="">
          <div class="ina">
              Secure
            <p class="ria">
                Our Trust & Safety team works around the clock to protect against fraud. 
            </p>
          </div>
        </div>
        <div class=" drit">
          <img src="images/moile.png" alt="">
          <div class="ina">
              Mobile App
            <p class="ria">
              The GoFundMe app makes it simple to launch and manage your fundraiser on the go.
            </p>
          </div>
        </div>
        <div class="drit">
          <img src="images/social.png" alt="">
          <div class="ina">
              Social Reach
            <p class="ria">
                Harness the power of social media to spread your story and get more support.
            </p>
          </div>
        </div>
        <div class="drit">
          <img src="images/donation-channel.png" alt="">
          <div class="ina">
              International Payments
            <p class="ria">
                International Payment Support
            </p>
          </div>
        </div>
        <div class=" drit">
          <img src="images/chat.png" alt="">
          <div class="ina">
              24/7 Expert Advice
            <p class="ria">
                Our best-in-class Customer Happiness agents will answer your questions, day or night.
            </p>
          </div>
        </div>
      </div>
      <div class="st-f mt-2">
          <div class="stn">
          <div class="rdy">Ready to raise <span style='color:#22a349;font-weight:bold;font-family: "PT Sans";'><?php echo @$cat;?></span> funds?</div>
          <a href="https://fundreza.com/redirect"><button class='nf'> <i class="fas fa-donate"></i> Start a new fundraiser</button></a>
          </div>
          <div class="stn">
          <a href=""><button class='nwe'><i class="fas fa-headset"></i> Talk With Us</button></a>
          </div>
      </div>
    </div>
<!-- What you can raise funds for -->

<!-- Success stories -->
<div class="s-stories">
    <!-- whatsapp facebook chat -->
<div class="w-f-c mt-0 pt-0 mb-0 pb-0 bg-white">
    <div class="stn">
       <i class="fas fa-question-circle"></i> Have any questions for us? Chat with our team on Facebook or WhatsApp now.
    </div>
    <div class="stn">
      <a href=""><button class='f-chat'><i class="fab fa-facebook-square text-white"></i> Chat With Us</button></a> <a href=""><button class='w-chat'><i class="fab fa-whatsapp"></i> Chat With Us</button></a>
    </div>
</div>
<!-- whatsapp facebook chat ends-->
    <?php 
				
      require_once'dbh.php';
      require_once'config.php';
      $con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
      $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $chf = $con -> prepare("SELECT * FROM stories LIMIT 5");
      $chf -> execute();

      if($chf -> execute()) {
          $rowf = $chf -> fetchAll(PDO::FETCH_ASSOC);
      }
    ?>

    <h1 style="color: #22a349; margin: 1rem auto;font-family: 'PT Sans';font-weight: bold">Success Stories</h1>
        
    <div class="s-wrapper text-dark" id="wrapper">
        <div class="arrows prev"></div>
        <?php $i = 1; ?>
        <?php foreach ($rowf as $row): @$bdy = substr($row['storyBody'],0,80).'...'; $simg = 'https://stories.fundreza.com/'.$row['images'];?>
        <div class="m-slide" style="width: 100%">
            <img src="<?php echo $simg?>" alt="">
            <div class="ina">
                <span class='pipa'><?php echo @$row['storyTitle']; @$title = str_replace(' ','-',$row['storyTitle']); @$stBy = str_replace(' ','-',$row['storyBy']);?></span>
                <p class="ria">
                    <?php echo @$bdy;?>
                    <a href="<?php echo "https://stories.fundreza.com/stories/$title/$stBy"?>"><button class='nwe'> See more <i class="fas fa-angle-right"></i></button></a>
                </p>
            </div>
        </div>
        <?php $i++; ?>
        <?php endforeach; ?>
        <div class="arrows next"></div>
    </div>

    <div class="st-f mt-5">
        <div class="stn">
          <div class="rdy">Ready to raise funds?</div>
          <a href="https://fundreza.com/redirect"><button class='nf'> <i class="fas fa-donate"></i> Start a new fundraiser</button></a>
        </div>
        <div class="stn">
          <a href=""><button class='nwe'><i class="fas fa-headset"></i> Talk With Us</button></a>
        </div>
    </div>
</div><div class="end-float"></div>
<!-- Success stories -->



<?php echo @$footer;?>
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
<script type="text/javascript">
// $('input').on('change', function() {
//   $('body').toggleClass('blue');
// });

/* Code By Webdevtrick ( https://webdevtrick.com ) */
$(document).ready(function () {
	$('.testiSlide').slick({
		slidesToShow: 2,
		slidesToScroll: 1,
		autoplay: true,
		autoplaySpeed: 1500,
		responsive: [{
			breakpoint: 850,
			settings: {
				slidesToShow: 1,
				slidesToScroll: 1,
				infinite: true,
			}
		}]
	});
});

const SimpleSlider = (function ($) {

// initialize "global" variables
let slider = {},
  $container,
  $slides,
  $prev,
  $next,
  $dots;

// set slider config defaults
slider.config = {
  slideDuration: 5000,
  auto: true,
  containerSelector: '#simpleSlider',
  slideSelector: '.m-slide',
  prevArrowSelector: '.prev',
  nextArrowSelector: '.next',
  dotsSelector: '.dot'
};

// initialize slider with config
slider.init = config => {
  // if config provided, merge it with default config
  if (config && typeof(config) == 'object') {
    $.extend(slider.config, config);
  }
  // get slider element
  $container = $(slider.config.containerSelector);
  // get slides
  $slides = $container.find(slider.config.slideSelector);
  // get prev button element
  $prev = $(slider.config.prevArrowSelector);
  // get next button element
  $next = $(slider.config.nextArrowSelector);
  // get dots container element
  $dots = $(slider.config.dotsSelector);
  // hook up prev button
  $prev.click(slider.prev);
  // hook up next button
  $next.click(slider.next);
  // hook up dots nav
  $dots.each( (i, dot) => {
    $(dot).click( () => {
      slider.setSlideByIndex($dots.index(dot));
    });
  });
  // activate first slide
  $($slides[0]).addClass('activeText');
  // activate first dot
  $($dots[0]).addClass('active');
  // Slide Automatically or Nah...
  if (slider.config.auto) autoNext();
};

// Slide Automatically
// private function
function autoNext() {
  setInterval(slider.next, slider.config.slideDuration);
}

// Navigate to next slide
// public method
slider.next = () => {
  // get active slide
  const activeSlide = $slides.filter('.activeText');
  // get active dot
  const activeDot = $dots.filter('.active');
  // get current index
  const currentIndex = $slides.index(activeSlide);
  // remove active class from active slide
  activeSlide.removeClass('activeText');
  activeDot.removeClass('active');
  // apply activeText class to next slide
  // if on last slide
  if (currentIndex === $slides.length -  1) {
    // make first slide active
    $($slides[0]).addClass('activeText');
    // make first dot active
    $($dots[0]).addClass('active');
  } else {
    // make next slide active
    $($slides[currentIndex + 1]).addClass('activeText');
    // make next slide dot
    $($dots[currentIndex + 1]).addClass('active');
  }
};

// Navigate to previous slide
slider.prev = () => {
  // get active slide
  const activeSlide = $slides.filter('.activeText');
  // get active dot
  const activeDot = $dots.filter('.active');
  // get current index
  const currentIndex = $slides.index(activeSlide);
  // remove active class from active slide
  activeSlide.removeClass('activeText');
  activeDot.removeClass('active');
  // apply activeText class to next slide
  // handle when next slide is first slide
  if (currentIndex === 0) {
    // make last slide active
    $slides[$slides.length - 1].classList.add('activeText');
    // make last dot active
    $dots[$dots.length - 1].classList.add('active');
  } else {
    // make prev slide active
    $($slides[currentIndex - 1]).addClass('activeText');
    // make prev dot active
    $($dots[currentIndex - 1]).addClass('active');
  }
};

// Navigate to slide by index
slider.setSlideByIndex = index => {
  // get active slide
  const activeSlide = $slides.filter('.activeText');
  // get active dot
  const activeDot = $dots.filter('.active');
  // remove active class from active slide & dot
  activeSlide.removeClass('activeText');
  activeDot.removeClass('active');
  // make slide at given index active
  $($slides[index]).addClass('activeText');
  // make slide at given index active
  $($dots[index]).addClass('active');
};

// return the slider object with public methods
return slider;
}(jQuery)); //pass in any needed global variables


// This can also be placed in the HTML file inside a script tag. 
// Doesn't seem to want to work that way in Codepen
SimpleSlider.init({
  containerSelector: "#wrapper", //default: "#simpleSlider"
  auto: false //default: true
});

var scroller = document.querySelector('.gallery-row-scroll');
var leftArrow = document.getElementById('leftArrow');

var direction = 0;
var active = false;
var max = 10;
var Vx = 0;
var x = 0.0;
var prevTime = 0;
var f = 0.2;
var prevScroll = 0;

function physics(time) {
  // Measure how much time has passed
  var diffTime = time - prevTime;
  if (!active) {
    diffTime = 80;
    active = true;
  }
  prevTime = time;

  // Give power to the scrolling

  console.log(diffTime);

  Vx = (direction * max * f + Vx * (1-f)) * (diffTime / 20);

  x += Vx;
  var thisScroll = scroller.scrollLeft;
  var nextScroll = Math.floor(thisScroll + Vx);

  if (Math.abs(Vx) > 0.5 && nextScroll !== prevScroll) {
    scroller.scrollLeft = nextScroll;
    requestAnimationFrame(physics);
  } else {
    Vx = 0;
    active = false;
  }
  prevScroll = nextScroll;
}

leftArrow.addEventListener('mousedown', function () {
  direction = -1;
  if (!active) {
    requestAnimationFrame(physics);
  }
});

leftArrow.addEventListener('mouseup', function () {
  direction = 0;
});

rightArrow.addEventListener('mousedown', function () {
  direction = 1;
  if (!active) {
    requestAnimationFrame(physics);
  }
});
rightArrow.addEventListener('mouseup', function(event){
  direction = 0;
});

</script>
<!-- <script src="javascript/front.js?n=1"></script>
<script src="javascript/home.js?n=1"></script> -->
<script src="javascript/dashboard.js?n=1"></script>
<script src="javascript/front.js?n=1"></script>
<script src="javascript/progressloaders.js?n=1"></script>
<!-- <script src="javascript/livechart.js"></script> -->

<!-- PAGE SCRIPTS -->
<script src="dist/js/pages/dashboard2.js"></script>
</body>
</html>
