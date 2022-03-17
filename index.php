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

?>

<!DOCTYPE html>
<html lang="en">
<head>
<base href="https://fundreza.com/">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <meta name="author" content="fundreza.com" />
  <meta name="description"
    content="Fundreza.com is an Online fundraising platform and Website used to raise funds for Social, Charity, Movies, Music, Personal and Creative causes. Visit us online!" />
  <meta name="keywords" content="crowdfunding, fundraising website, fundraising, crowdfunding website, fundraiser, crowdsourcing" />
  <meta name="robots" content="index, follow" />
  <meta name="msvalidate.01" content="2519DB0D326847F7B80A3F3DC90A4972" />
  <!-- FB TAGS -->
  <meta property="og:locale" content="en_US" />
  <meta property="og:site_name" content="fundreza.com">
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://www.fundreza.com" />
  <meta property="og:title" content="Fundreza.com  | No. 1 Fundraising Website To Raise Funds For Anything..." />
  <meta property="og:description" content="No 1 most trusted and visited fundrasing platform that helps you raise funds for personal needs, charitable causes and creative ideas." />
  <!-- TWITTER TAGS -->
  <meta name="twitter:title" content="Fundreza.com  | No. 1 Fundraising Website To Raise Funds For Anything..." />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:site" content="@fundreza.com" />
  <meta name="twitter:creator" content="@fundreza.com"/>
  <meta name="twitter:description" content="No 1 most trusted and visited crowdfunding platform that helps you raise funds for personal needs, charitable causes and creative ideas." />
  
  <title> Fundreza.com  | No. 1 Fundraising Website To Raise Funds For Anything...</title>

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
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
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
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" fa/>
<link
      rel="stylesheet"
      href="https://unpkg.com/swiper/swiper-bundle.min.css"
    />
  <!-- Custom stylesheet - for your changes-->
  <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KTMVLGV');</script>
<!-- End Google Tag Manager -->
  <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/6144407325797d7a89ff6eca/1ffp9nhpv';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
s1.style.top = '80%';
s0.style.top = '80%';
})();
</script>
<!--End of Tawk.to Script-->
  <link rel="stylesheet" href="css/page.css?n=1">
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
  height:100px;
  width:7rem;margin: 1rem;
}

.gallery-row.small img{
  height:100px;margin: 1rem;
  width:7rem;
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
.swiper {
    width: 100%;
    padding-top: 50px;
    padding-bottom: 50px;
  }

  .swiper-slide {
    background-position: center;
    background-size: cover;
    width: 300px;
    height: 200px;
    margin: 1rem;
  }

  .swiper-slide img {
    display: block;
    width: 100%;
    border-radius: 8px;
    margin: 1rem;
}
.mfrsc-ft {
    position: absolute;top: 0;white-space: nowrap;box-shadow: 1px 1px 1px 2px #f1f1f1;border-radius: 4px;
    padding: .3rem 1rem;z-index: 9;font-stretch: ultra-condensed;padding-left: 0;display: none;
    background-color: #ffffff;font-family: "Roboto";text-align: left;
}
.mfrsc-title:hover .mfrsc-ft{
    display: block;
}
.mfrsc-td,.mfrsc-dona {
    display: inline-block;font-size: 14px;
}
.mfrscc {
    display: inline-block;text-align: justify;text-align-last: justify;width: 100%;
}
.mfrsc-time {
    display: inline-block;font-size: 14px;font-style: italic;color: #545454;
}
.mfrsc-eyev {
    display: inline-block;font-size: 20px;
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
<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KTMVLGV"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<!-- Messenger Chat Plugin Code -->
    <div id="fb-root"></div>

    <!-- Your Chat Plugin code -->
    <!--<div id="fb-customer-chat" class="fb-customerchat">-->
    <!--</div>-->

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "109806204855958");
      chatbox.setAttribute("attribution", "install_email");
      chatbox.setAttribute("attribution_version", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v13.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
    
    <!-- Messenger Chat Plugin Code -->
    <div id="fb-root"></div>
<div class="overlayy" id="overlayy" onclick="remove()"></div>
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
  <?php echo @$header?>

  <!-- pageloader  -->
  <div id="progress" class="waiting"></div>
  <!-- pageloader ends -->

  <div class="header">
    <!--Content before waves-->
    <div class="hd-left">
      <div class="rdff">
        <h1 class="hdh1">Help make someone smile today</h1>
        <img src="images/giv.png" alt="" class="msh">
        <div class="end-float"></div>
      </div>
      <div class="dtxt">A little step at a time, we impact our world</div>
    </div>
    <div class="inner-header-img">
          <!-- <img src="images/smile2.jpg" class="hd-bgim" alt=""> -->
          <img src="images/smile3.webp" class="hd-bgim" alt="">
          <img src="images/smile5.jpg" class="hd-bgim" alt="">
          <img src="images/smile4.jpg" class="hd-bgim" alt="">
          <img src="images/smile1.webp" class="hd-bgim" alt="">
    </div>

<!--Waves Container-->
    <div>
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
        viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
            <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="parallax">
            <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7)" />
            <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
            <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
            <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
            </g>
        </svg>
    </div>
    <!--Waves end-->

    <div class="search-f" id="search">
        <form action="" Method ="POST" id="formps">
          <div class="">
            <input type="varchar" class="form-control " name="query" id="search-input" placeholder="search fundraiser by name or category" aria-label="search" aria-describedby="search" onkeyup="checkSearch()">
            <button type="submit" class="border-none" name="submit"><i class="fas fa-search"></i></button>
          </div>
        </form> 
        <div id="kkkk" style="background-color: #ffffff;width: 100%"></div>
    </div>

  </div>
  <!--Header ends-->

 <!-- <div class="head-contact" id="head-contact-c">-->
      <!--<div class="contact-overlay"></div>-->
 <!--     <div id="close-c-us" onclick="removecontactForm()">&times</div>-->
 <!--     <div class="head-c bg-white" style="background: #ffffff;background-color: #ffffff;opacity: 1;">-->
 <!--         <div class="stn" style="background: #ffffff;background-color: #ffffff;opacity: 1;">-->
 <!--           <div class="rdy">Ready to raise funds?</div>-->
 <!--           <a href="https://fundreza.com/redirect" class="text-white"><button class='nf text-white font-weight-normal'> <i class="fas fa-donate"></i> Start A New Fundraiser</button></a>-->
 <!--         </div>-->
 <!--         <div class="stn">-->
 <!--           <a href="https://contact.fundreza.com/"><button class='nwe'><i class="fas fa-headset"></i> Talk With Us</button></a>-->
 <!--         </div>-->
 <!--     </div>-->
        
 <!--     <form action="" method="post" id="" style="background: #ffffff;background-color: #ffffff;opacity: 1;">-->
 <!--         <div class=" border-0 rounded-0 mt-2 pt-2" style="background: #ffffff;background-color: #ffffff;opacity: 1;">-->
 <!--             <div class="card-header p-0">-->
 <!--                 <div class="text-white text-center py-1" style="background-color: #22a349">-->
 <!--                     <h6><i class="fa fa-envelope text-white"></i> Start Fundraising Now</h6>-->
 <!--                 </div>-->
 <!--             </div>-->
 <!--             <div class="card-body p-0">-->

                  <!--Body-->
 <!--                 <div class="form-group">-->
 <!--                     <div class="input-group mb-2">-->
 <!--                         <div class="input-group-prepend">-->
 <!--                             <div class="input-group-text" style="background-color: #22a349"><i class="fa fa-user text-white"></i></div>-->
 <!--                         </div>-->
 <!--                         <input type="text" class="form-control" id="donname" name="donname" placeholder="Your Name" required>-->
 <!--                     </div>-->
 <!--                 </div>-->
 <!--                 <div class="form-group">-->
 <!--                     <div class="input-group mb-2">-->
 <!--                         <div class="input-group-prepend">-->
 <!--                             <div class="input-group-text" style="background-color: #22a349" style="background-color: #22a349"><i class="fa fa-envelope text-white"></i></div>-->
 <!--                         </div>-->
 <!--                         <input type="email" class="form-control" id="donemail" name="donemail" placeholder="your email" required>-->
 <!--                     </div>-->
 <!--                 </div>-->

 <!--                 <div class="form-group">-->
 <!--                     <div class="input-group mb-2">-->
 <!--                         <div class="input-group-prepend">-->
 <!--                             <div class="input-group-text" style="background-color: #22a349"><i class="fa fa-comment text-white"></i></div>-->
 <!--                         </div>-->
 <!--                         <textarea class="form-control" placeholder="Message" name="donmessage" id="donmessage" required></textarea>-->
 <!--                     </div>-->
 <!--                 </div>-->

 <!--                 <div class="text-center">-->
 <!--                     <button type="submit" value="Enviar" class="btn btn-md btn-block rounded-0 py-2 text-white" style="background-color: #22a349" onclick="sendFMessage()"> <i class="fas fa-paper-plane"></i> Get Started </button>-->
 <!--                 </div>-->
 <!--             </div>-->

 <!--         </div>-->
 <!--     </form>-->
 <!--</div>-->

  <div class="section-tf">
<!-- top fundraisers starts -->
  <?php 
      require_once'dbh.php';
      require_once'config.php';
      $fstat = 'Active';
      $con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
      $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = $con -> prepare("SELECT DISTINCT fundraiser_table.fundraiserStory,fundraiser_table.donationsReceived,fundraiser_table.totaldonationsReceived,
      fundraiser_table.totalDonations,fundraiser_table.fundraiserId,fundraiser_table.fundraiserThumbnail,fundraiser_table.fundraiserTitle,
      fundraiser_table.fundraiserCategory,fundraiser_table.fundraiserGoal,fundraiser_table.fundraiserBy,donation_table.donation_time,
      fundraiser_table.dateSubmitted,COUNT(donation_table.donatedBy) AS donorsCount FROM fundraiser_table 
      LEFT JOIN donation_table ON fundraiser_table.fundraiserId = donation_table.fundraiserId WHERE fundraiser_table.fundraiserThumbnail <> '' 
      AND fundraiser_table.fundraiserStatus = ? GROUP BY fundraiser_table.fundraiserId ORDER BY fundraiser_table.dateSubmitted AND donation_table.donation_time DESC LIMIT 3");
      $sql -> bindParam(1,$fstat);
      $sql -> execute();
      $rows = $sql -> fetchALL(PDO::FETCH_ASSOC);

    ?>
    <div class="container-">
      <div class="trn"><i class="far fa-star" style="color: #22a349"></i> Top fundraisers</div>
      <div class="d-inner row">
      <?php
  
  foreach($rows as $row) {
    $fundraiseredB = ucwords($row['fundraiserBy']);
        $fundraiserBy = str_replace(" ",'-',$fundraiseredB);
        $title = ucwords($row['fundraiserTitle']);
        $fStory = $row['fundraiserStory'];
        $ldtime = $row['donation_time'];
        $fstory = substr($fStory,0,120);
        $ftitle = substr($title,0,30).'...';
        $titled = str_replace(" ",'-',$title);
        $fgg = $row['fundraiserGoal'];
        $donationcount = $row['donorsCount'];
        $fundraiserId = $row['fundraiserId'];
        $dona = $row['totaldonationsReceived'];
        $dona = $row['totaldonationsReceived'];
        $dR = $row['donationsReceived'];
        // $likes = $row['totalLikes'];
        // $shares = $row['totalShares'];
        // $upvotes = $row['totalupVotes'];
        $fundraiserThumbnail = $row['fundraiserThumbnail'];
        $time = $row['donation_time'];
        $categ = $row['fundraiserCategory'];
        $category = str_replace("-"," ", $categ);


        $fg = number_format($fgg);
        $testdona = number_format($dona);
        if($dona == null || $dona == "") {
            $dona = '0';
        }else {
            $dona = $dona; 
        }
        
        $diff     = time() - $time;
        
        // Time difference in seconds
        $sec     = $diff;
        
        // Convert time difference in minutes
        $min     = round($diff / 60 );
        
        // Convert time difference in hours
        $hrs     = round($diff / 3600);
        
        // Convert time difference in days
        $days     = round($diff / 86400 );
        
        // Convert time difference in weeks
        $weeks     = round($diff / 604800);
        
        // Convert time difference in months
        $mnths     = round($diff / 2600640 );
        
        // Convert time difference in years
        $yrs     = round($diff / 31207680 );
        
        // Check for seconds
        if($sec <= 60) {
            $fundraisertime = "$sec seconds ago";
        }
        
        // Check for minutes
        else if($min <= 60) {
            if($min==1) {
                $fundraisertime = "one minute ago";
            }
            else {
                $fundraisertime = "$min minutes ago";
            }
        }
        
        // Check for hours
        else if($hrs <= 24) {
            if($hrs == 1) { 
                $fundraisertime = "an hour ago";
            }
            else {
                $fundraisertime = "$hrs hours ago";
            }
        }
        
        // Check for days
        else if($days <= 7) {
            if($days == 1) {
                $fundraisertime = "Yesterday";
            }
            else {
                $fundraisertime = "$days days ago";
            }
        }
        
        // Check for weeks
        else if($weeks <= 4.3) {
            if($weeks == 1) {
                $fundraisertime = "a week ago";
            }
            else {
                $fundraisertime = "$weeks weeks ago";
            }
        }
        
        // Check for months
        else if($mnths <= 12) {
            if($mnths == 1) {
                $fundraisertime = "a month ago";
            }
            else {
                $fundraisertime = "$mnths months ago";
            }
        }
        
        // Check for years
        else {
            if($yrs == 1) {
                $fundraisertime = "one year ago";
            }
            else {
                $fundraisertime = "$yrs years ago";
            }
        }
            
        // first strip any formatting;
        $dona = (0+str_replace(",","",$dona));
        
        // is this a number?
        if(!is_numeric($dona)) return false;
        
        // now filter it;
        if($dona>1000000000000) {
            $testdona = round(($dona/1000000000000),1).' trillion';
        }
        else if($dona>1000000000) {
            $testdona = round(($dona/1000000000),1).' billion';
        } 
        else if($dona>1000000) {
            $testdona = round(($dona/1000000),1).' million';
        }
        else if($dona>1000) {
            $testdona = round(($dona/1000),1).' thousand';
        }else {
            $testdona = number_format($dona);
        }
        
        echo "<div id='' class='col-lg-4 col-sm-6 '>
                    <div class='funda text-center'>
                        <div class='mb-3 position-relative'>
                            <div class='badge text-white badge-'></div>
                            <a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;'>
                                <img src='$fundraiserThumbnail' name='thumbsvid' alt='thumbnail image' value='$fundraiserId' class='mfr-imga'>
                            </a>
                            
                            <div class='f-con'>
                                <div class='dorna text-left'>
                                    <div class='drin'><img src='$fundraiserThumbnail' style='' class='by-img'><div class='fb-b'>$fundraiseredB</div></div>
                                </div>
                                <div class='mfrsc-title bg-white'>
                                    <a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;' class=''>
                                        <div class='fulltitled p-1'> $ftitle <div class='mfrsc-ft'>$title</div></div> 
                                    </a>
                                </div>
                                
                                <div class='mfrsc-in text-dark' style='position: relative'> 
                                    <div class='mfrsc-td'> $fstory </div>
                                </div>
    
                                <div class='p-con  mb-3 mt-3'>
                                    <div class='amtt'>
                                        <div class='amtraisedc'>$<span class='amtraised' name='$dona'>$testdona</span> raised of</div> 
                                        <div class='amttotalc'>$<span class='amttotal' name='$fgg'>$fg</span></div>
                                    </div><div class='end-float'></div>
                                    <div class='progress'>
                                        <div class='progress-bar' aria-valuemin='0' aria-valuemax='100' style=''>
                                    </div>
                                </div>
    
                                <div class='mfrscc pt-0 pb-2 pl-1'> <div class='mfrsc-time'> Last donation received: $fundraisertime </div> <div class='mfrsc-eyev icc'><i class='far fa-heart'></i> $donationcount</div> </div>
                            </div>
                        </div>
                            
                            <div class='funda-overlay'>
                                <ul class='mb-0'>
                                    <div class='dorna'>
                                        <div class='drin'><img src='$fundraiserThumbnail' style='' class='by-img'><div class='text-left fb-b'>$fundraiseredB</div></div>
                                    </div>
                                    
                                    <div class='mfrsc-title bg-white'>
                                        <a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;' class=''>
                                            <div class='fulltitled p-1'> $ftitle <div class='mfrsc-ft'>$title</div></div> 
                                        </a>
                                    </div>
                                    
                                    <div class='f-st mb-5 text-dark'>
                                        <div class='m-2'> $fstory</div>
                                        <a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;color: #22a349;' class=''><small class='readmor m-2' id='rmore'><em>Read more...</em></small></a>
                                    </div>
    
                                    <div class='p-con  mb-3 mt-3'>
                                        <div class='amtt'>
                                            <div class='amtraisedc'>$<span class='amtraised' name='$dona'>$testdona</span> raised of</div> 
                                            <div class='amttotalc'>$<span class='amttotal' name='$fgg'>$fg</span></div>
                                        </div><div class='end-float'></div>
                                        <div class='progress'>
                                            <div class='progress-bar' aria-valuemin='0' aria-valuemax='100' style=''>
                                        </div>
                                    </div>
    
                                    <div class='mfrscc pt-0 pb-2 pl-1'> <div class='mfrsc-time'> Last donation received: $fundraisertime </div> <div class='mfrsc-eyev icc'><i class='far fa-heart'></i> $donationcount</div> </div>
                                    
                                
                                <div class='mfd border-0'>
                                    <div class='mf text-center mx-auto mt-1 pt-4 border-0'><a target='_blank' href='p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;' class='nf text-white'> <i class='fas fa-donate'></i> Donate To This Campaign </a></form></div>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>";

  }
      ?>
                <div class="end-float"></div>
      </div>

      <div class="a-l mt-3 mb-3 pb-5">
        <a href="https://fundreza.com/all/browse/fundraisers">See More... <i class="fas fa-angle-right"></i></a>
      </div>
    </div>
  <!-- top fundraisers -->

</div>
<!-- section hiw ends -->


<!-- how it works starts -->

<div class="hiw bg-white" id="howitworks">
    <h1>
      How it works
    </h1>
    
    <div class="conten">
      <img src="images/sac-separator.webp" alt="" class="hiw-img">
      <div class="ri">
          <div class="r1">
            <div class="r1-h">
                <strong> 
                    Start your fundraiserIt’ll take only 2 minutes.
                </strong>
                <p>
                    Just tell us a few details about you and the ones you are raising funds for.
                </p>
            </div>
          </div>
          <div class="r2">
            <div class="r1-h">
                <strong>
                    Share your fundraiser
                </strong>
                <p>
                    All you need to do is share the fundraiser with your friends and family. In no time, support will start pouring in.
                </p>
            </div>
          </div>
          <div class="r3">
            <div class="r1-h">
                <strong>
                    Instantly Withdraw Funds
                </strong>
                <p>
                    The funds raised can be withdrawn without any hassle directly to your bank account.
                </p>
            </div>
          </div>
          <div class="text-center mx-auto p-2 mt-12 mb-4">
              <h2 class="jumbotron mt-4 text-success">Take Us Anywhere You Go</h2>
              <p class="text-left lead">Download our mobile app on any device you use on the App Store or Google Playstore</p>
              <div class="row mx-auto text-center pt-2 mt-4">
              <div class="col-xs-6 mx-auto text-center"><img src="images/comingsoontoplaystore.svg" style="width: 150px;" class="img-fluid"> </div>
              <div class="col-sx-6 mx-auto text-center ml-4"><img src="images/cominsoonappstore.svg" style="width: 150px;" class="img-fluid"> </div>
              </div>
          </div>
      </div>
    </div>
    
    <div class="sc-r">
        <img src="images/fundbg.png" style="width: 100%;" class="homeadbg">
    </div>
    <div class="end-float"></div>
    

    <div class="st-f">
      <div class="stn">
        <div class="rdy">Ready to raise funds?</div>
        <a href="https://fundreza.com/redirect"><button class='nf'> <i class="fas fa-donate"></i> Start a new fundraiser</button></a>
      </div>
      <div class="stn">
        <a href=""><button class='nwe'><i class="fas fa-headset"></i> Talk With Us</button></a>
      </div>
    </div>
</div>

<!-- how it works ends -->


<!-- whatsapp facebook chat -->
<div class="w-f-c mt-0 pt-0 mb-0 pb-0 bg-white">
    <div class="stn">
       <i class="fas fa-question-circle"></i> Have any questions for us? Chat with our team on Facebook or Message now.
    </div>
    <div class="stn">
      <a href="https://m.me/fundreza"><button class='f-chat'><i class="fab fa-facebook-square text-white"></i> Chat With Us</button></a> <a href="https://m.me/fundreza"><button class='w-chat'><i class="fab fa-facebook-messenger"></i> Chat With Us</button></a>
    </div>
</div>
<!-- whatsapp facebook chat ends-->

<!-- What you can raise funds for -->
<?php 
				
        require_once'dbh.php';

        $con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $chs = $con -> prepare("SELECT * FROM fundraisercategories ");
        $chs -> execute();

        if($chs -> execute()) {
            $rowas = $chs -> fetchAll(PDO::FETCH_ASSOC);
        }
            ?>
                    
    <div class="wycrf">
      <h1 classs="pt-5" style="color: #22a349; margin: 1rem auto;font-family: 'PT Sans';font-weight: bold;text-align: center">What you can raise funds for!</h1>
      <div class="row mx-auto text-center">
        <?php $i = 1; ?>
        <?php foreach ($rowas as $row): $cate= $row['category']; $categ = str_replace(" ","-",$cate); $catego = strtolower($categ)?>   
            <div class="drt">
                <a href='<?php echo "https://fundreza.com/category/$catego"?>' class="hela">
                    <div class="bg-grn rounded">
                        <div style="background-color: #22a349">
                          <div id="cio"></div>
                            <img src="<?php echo $row['images']; ?>" alt="" class="f-categ-img">
                        </div> 
                    </div>
                    <div class="ina" style="color: #22a349">
                        <?php echo @$row['category'];?>
                        <p class="ria text-dark">
                        <?php echo @$row['header1'];?>
                        </p>
                    </div>
                </a>
            </div>
        <?php $i++; ?>
        <?php endforeach; ?>
      </div>
    </div>
<!-- What you can raise funds for -->
<div class="yml pt-2 pb-2 mt-3 mb-3">
    <div class="f-lov">
        <?php require_once'dbh.php';
            $od = new dbh(); $od -> fundraiserstolove();
        ?>
        <div class="a-l mt-3 mb-3 pb-5">
        <a href="https://fundreza.com/all/browse/fundraisers" style="color: #22a349;font-weight: normal;">See More Favorite Fundraisers... <i class="fas fa-angle-right"></i></a>
      </div>
    </div>
</div>

<!-- What you can raise funds for -->
<div class="whfm pt-3 mt-2" id="whyfundreza">
      <h1 class="" style="color: #22a349; margin: 1rem auto;font-family: 'PT Sans';font-weight: bold;text-align: center">Why Fundreza?</h1>
      <div class="rowas">
        <div class="drit">
          <img src="images/worldm.png" alt="">
          <div class="ina">
            Worldwide Leadership
            <p class="ria">
                Fundreza is trusted around the world for its simple, reliable fundraising platform.
            </p>
          </div>
        </div>
        <div class="drit">
          <img src="images/money.png" alt="">
          <div class="ina">
              Donation Channels
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
              You can personalize and share your Fundreza in just a few minutes.
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
              Fundreza app makes it simple to launch and manage your fundraiser on the go.
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
              Int'l Payments
            <p class="ria">
                International Payment Support that allows anyone from any country to access funds
            </p>
          </div>
        </div>
        <div class=" drit">
          <img src="images/chat.png" alt="">
          <div class="ina">
              24/7 Support
            <p class="ria">
                Our best-in-class Customer Happiness agents will answer your questions, day or night.
            </p>
          </div>
        </div>
      </div>
    </div>
<!-- What you can raise funds for -->

<!-- Success stories -->
<div class="s-stories">
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

    <h1 style="color: #22a349; margin: 1rem auto;font-family: 'PT Sans';font-weight: bold;text-align: center">Success Stories</h1>
        
    <div class="s-wrapper text-dark" id="wrapper">
        <div class="arrows prev"></div>
        <?php $i = 1; ?>
        <?php foreach ($rowf as $row): @$bdy = substr($row['storyBody'],0,80).'...'; $simg = 'https://stories.fundreza.com/'.$row['images'];?>
        <div class="m-slide">
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

<!-- partnars starts  -->
  <div class="partnas">

      <h1> Featured Partners</h1>
      <svg style="background-color:#aaa;" width="0" height="0">
        <defs>
          <path id="scrollArrow" d="M -20,0 L 20 -50, 10 0, 20 50 Z"/>
        </defs>
    <!--
        <g transform="translate(60,60)">
          <use xlink:href="#scrollArrow" />
          <circle cx="0" cy="0" r="4" fill="red"/>
        </g>
        <rect width="100" height="100" x="10" y="10" stroke="#fff" fill="none" stroke-width="2"/> -->
      </svg>

      <!-- Swiper -->
    <div class="swiper mySwiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <img src="https://swiperjs.com/demos/images/nature-1.jpg" />
        </div>
        <div class="swiper-slide">
          <img src="https://swiperjs.com/demos/images/nature-2.jpg" />
        </div>
        <div class="swiper-slide">
          <img src="https://swiperjs.com/demos/images/nature-3.jpg" />
        </div>
        <div class="swiper-slide">
          <img src="https://swiperjs.com/demos/images/nature-4.jpg" />
        </div>
        <div class="swiper-slide">
          <img src="https://swiperjs.com/demos/images/nature-5.jpg" />
        </div>
        <div class="swiper-slide">
          <img src="https://swiperjs.com/demos/images/nature-6.jpg" />
        </div>
        <div class="swiper-slide">
          <img src="https://swiperjs.com/demos/images/nature-7.jpg" />
        </div>
        <div class="swiper-slide">
          <img src="https://swiperjs.com/demos/images/nature-8.jpg" />
        </div>
        <div class="swiper-slide">
          <img src="https://swiperjs.com/demos/images/nature-9.jpg" />
        </div>
      </div>
      <div class="swiper-pagination"></div>
    </div>
<!-- partnars starts  -->

<?php echo $footer;?>
<div class='footer-btn'><a href='https://fundreza.com/redirect' ><i class="fas fa-donate"></i> Start A Fundraiser</a></div>
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
<!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
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
var swiper = new Swiper(".mySwiper", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: false,
        slidesPerView: "auto",
        coverflowEffect: {
          rotate: 60,
          stretch: 0,
          depth: 100,
          modifier: 1,
          slideShadows: false,
        },
        pagination: {
          el: ".swiper-pagination",
        },
      }); 
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
<!-- <script src="javascript/front.js?n=1"></script> -->
<script src="javascript/donate.js?n=1"></script> 
<script src="javascript/dashboard.js?n=1"></script>
<script src="javascript/front.js?n=1"></script>
<script src="javascript/progressloaders.js?n=1"></script>
<!-- <script src="javascript/livechart.js"></script> -->

<!-- PAGE SCRIPTS -->
<script src="dist/js/pages/dashboard2.js"></script>
</body>
</html>
