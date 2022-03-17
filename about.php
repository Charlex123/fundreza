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
<html dir="ltr" lang="en-US">
<head>
  <meta charset="utf-8" />
  <!-- v20287 -->

  <title>Contact | Fundreza Help Center</title>

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
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <!-- Custom stylesheet - for your changes-->
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
<!------ Include the above in your HEAD tag ---------->
  <style>
    body {
      font-family: "PT Sans";
    }
  </style>
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TDTFTZ');</script>
<!-- End Google Tag Manager -->

<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet" type="text/css">

<script defer src="https://use.fontawesome.com/releases/v5.2.0/js/all.js" integrity="sha384-4oV5EgaV02iISL2ban6c/RmotsABqE4yZxZLcYMAdG7FAPsyHYAPpywE9PJo+Khy" crossorigin="anonymous"></script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  
</head>
<body class="">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TDTFTZ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<svg style="display: none;" xmlns="http://www.w3.org/2000/svg">
  
</svg>



<?php echo @$header;?>

  <main role="main">
      <style>
        h1,h2,h3 {
          margin:0 0 35px 0;
          font-family: 'PT Sans';
          text-transform: uppercase;
          letter-spacing:1px;
        }

        p{
          margin:0 0 25px;
          font-size:18px;
          line-height:1.6em;
        }
        a{
          color:#26a5d3;
        }
        a:hover,a:focus{
          text-decoration:none;
          color:#26a5d3;
        }

        #contact{
          background:#ffffff;
          color:#545454;
          padding-bottom:80px;
        }

        textarea.form-control{
            height:100px;
        }
      </style>
      <div class="homepage-container mt-5 p-5">
        <div class="content-section solid-line hero">
          <div class="grid-container">
            <div class="grid-x align-center">
              <div class="cell large-6 homepage-hero-inner">
                <h1 class="heading-1 text-center weight-700">How can we help?</h1>
              </div>
            </div>
          </div>
        </div>
        <div class="content-section popular-articles-selector-container">
          
          <div class="row">
            <div class="col-md-8">
              <section id="contact" class="content-section text-center">
                <div class="contact-section">
                    <div class="container">
                      <h2>Contact Us</h2>
                      <p>Feel free to shout us by feeling the contact form or visiting our social network sites like Fackebook,Whatsapp,Twitter.</p>
                      <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                          <form method="POST" class="form-horizontal" id="c_form">
                            <div class="form-group">
                              <label class="text-left" for="exampleInputName2">Name</label>
                              <input type="text" class="form-control" id="name" placeholder="Jane Doe">
                            </div>
                            <div class="form-group">
                              <label class="text-left" for="exampleInputEmail2">Email</label>
                              <input type="email" class="form-control" id="email" placeholder="jane.doe@example.com">
                            </div>
							<div class="form-group">
                              <label class="text-left" for="exampleInputName2">Name</label>
                              <input type="text" class="form-control" id="subject" placeholder="subject">
                            </div>
                            <div class="form-group ">
                              <label class="text-left" for="exampleInputText">Your Message</label>
                            <textarea  class="form-control" placeholder="Description" id="message"></textarea> 
                            </div>
                            <button type="" class="btn btn-default" onclick="ContactMessage()" style="color: #22a349">Send Message</button>
							<div id="status"></div>
                          </form>

                          <hr>
                            <h3>Our Social Sites</h3>
                          <ul class="list-inline banner-social-buttons">
                            <li class="d-inline"><a href="#" class="btn btn-default btn-lg"><i class="fab fa-twitter"></i> <span class="network-name">Twitter</span></a></li>
                            <li class="d-inline"><a href="#" class="btn btn-default btn-lg"><i class="fab fa-facebook text-primary"></i> <span class="network-name">Facebook</span></a></li>
                            <li class="d-inline"><a href="#" class="btn btn-default btn-lg"><i class="fab fa-youtube text-danger"></i> <span class="network-name">Youtube</span></a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                </div>
              </section>
            </div>
            <div class="col-md-4">
              
            </div>
          </div>
        </div>
      </div>
  </main>

  <?php echo @$footer;?>


<!-- <script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=50876317-ea73-449a-a84c-fdd437994f46"> </script> -->

<script type="text/javascript">
   function ContactMessage() {
         _("c_form").onsubmit = function(event) {
             event.preventDefault();
         }
     
         var status = document.getElementById("status");
         var sub = _("subject").value;
         var message = _("message").value;
         var name = _("name").value;
         var email = _("email").value;
         
         if(sub != "" &&  message != "" && email != "") {
     
             var hr = new XMLHttpRequest();
             hr.open("POST","contact_messages.php",true);
             hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
             hr.onreadystatechange = function () {
                 if((hr.readyState == 4) && (hr.status == 200 || hr.status == 304)) {
                     status.style.display = 'block';
                     status.style.color = '#22a349';
                     status.style.fontSize = "14"+"px";
                     status.innerHTML = hr.response;
                     }
             }
             hr.send("clientName="+name+"clientSubject="+sub+"&clientEmail="+email+"&clientMessage="+message);
     
         }   
     
     }

</script>


</body>
</html> 