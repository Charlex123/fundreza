<?php
ob_start();
session_start();
require_once'dbh.php';
require_once'config.php';
include'footer.php';
include'header.php';

@$_SESSION['currentpage'] = $_SERVER['REQUEST_URI'];
strip_tags(@$_SESSION['currentpage']);


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

  <title>  Fundreza.com  | No. 1 Fundraising Website To Raise Funds For Anything... </title>

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
  <link rel="stylesheet" href="css/customize.css?n=1">
  <link rel="stylesheet" href="css/pageloaders.css?n=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script lang="javascript" type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<!-- Font Awesome CSS-->
	<link rel="stylesheet" type='text/css' href="fontawesome/fontawesomefiles/css/fontawesome.min.css">
	<link rel="stylesheet" type='text/css' href="fontawesome/fontawesomefiles/css/all.min.css">
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<script lang="javascript" type="text/javascript" src="fontawesome/fontawesomefiles/js/fontawesome.min.js"></script>
	<script lang="javascript" type="text/javascript" src="fontawesome/fontawesomefiles/js/all.min.js"></script>
	<!-- inject:css -->
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-KTMVLGV');</script>
    <!-- End Google Tag Manager -->

  <style>
    .wrapper,.content-wrapperr,.content-header {
      width: 100%;
    }
    .ccwrap {
      width: 90%;margin: 3rem auto;padding: 3rem;
    }
    #loading
        {
            text-align:center; 
            background: url('images/loader.gif') no-repeat center; 
            height: 150px;
        }
        .list-group h3 {
          font-size: 14px;font-family: "Montserrat";margin-top: 1rem;
        }
        label {
          color: #545454;font-weight: normal;
        }
        .mfr-img {
    width: 100%;border-radius: 4px;height: 14rem;max-height: 14rem;
}
.oda-c {
    font-family: "Montserrat";margin-bottom: 1rem;
}
.mfr-img {
    width: 100%;border-radius: 4px;height: 12rem;max-height: 13rem;border-radius: 8px;
}
.defa {
    border-radius: 8px;
}
.mfrs {
    box-shadow: 1px 1px 1px 2px #f1f1f1;width: 100%;position: relative;border-radius: 8px;
}
.mfrsct {
    border-radius: 8px;
}
.mfrsc {
    padding: .5rem;
}
.mfrsc-in {
    text-align: left;text-align-last: left;margin: .3rem;
}
.dorna {
    margin: 1rem auto;position: relative;
}
.by-img {
    width:2rem;max-width: 3rem;max-height: 3rem;height: 2rem;border-radius: 50%;float: left;margin-left: 1rem;margin-right: .3rem;margin-top: -.3rem;
}
.fb-b {
    font-weight: bold;color: #22a349;
}
.icc {
    color: #22a349
}
.mfrsc-title {
    font-size: 14px;line-height: 18px;position: relative;background: transparent;margin: 1rem .6rem;font-weight: bold;
    font-family: "Roboto";color: #888868;text-align: left;
}
.mfrsc-title a{
    font-weight: normal;font-family: "Roboto";color: #525753;text-align: left;
}
.fulltitled {
    font-weight: normal;font-family: "Roboto";color: #525753;text-align: left;
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
    display: inline-block;font-size: 14px;font-style: italic;
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
    float: left;;font-style: normal;font-weight: lighter;
}
.p-con .amtt .amttotalc {
    float: right;color: #525753;
}
.progress {
    height: .4rem;
}
.progress-bar {
    background-color: #22a349;
}
.mf {
    text-align: center;font-size: 14px; font-weight: bold;margin: 1rem auto 0 auto;
    border-top: 1px solid #cccccc;padding-top: .5rem;
}
.mfu {
    position: relative;width: 100%;
}
.hover-d {
    position: absolute;top: 0;left: 0;right: 0;bottom: 0;width: 100%;height: 100%;display: none;
    background-color: #ffffff;z-index: 10;
}
.mfrs:hover > .hover-d, .defa:hover > .hover-d{
    display: block;
}
.hover-d .fulltitled {
    font-size: 20px;line-height: 20px;white-space: initial;text-align: left;margin: 2rem auto;
    font-weight: normal;font-family: "Roboto";color: #525753;
}
.hover-d .mfrsc-ft {
    white-space: initial;
}
.hover-d .f-st {
    font-size: 18px;white-space: initial;color: #303030;
}
.hover-d .button.nf {
    width: 100%;font-size: 22px;padding: 1rem 8rem;
}
.addert {
    width: 100%;margin: 3rem auto;text-align: center;
}
.addert .sdft {
    width: 45%;border-radius: 15px;float:left;background-color: #ffffff;padding: 2rem;
    font-size: 20px;margin: 1rem;box-shadow: 1px 1px 1px 2px #f1f1f1;
}
.addert .sdft a button {
    font-size: 22px;font-weight: normal;background: rgb(17, 139, 13);color: #ffffff;
    background: linear-gradient(180deg, rgb(5, 143, 24) 0%, rgb(5, 131, 21) 100%);
    border: none;padding: .4rem 1rem;border-radius: 8px;
}
.addert .dsc {
    float: right;border-radius: 15px;background-color: #ddf8f2;width: 45%;padding: 2rem;
    font-size: 20px;margin: 1rem;box-shadow: 1px 1px 1px 2px #ffffff;
}
.addert .dsc a button {
    font-size: 22px;font-weight: normal;background: #ffffff;color: #22a349;
    border: none;padding: .4rem 1rem;border-radius: 8px;
}
    /* .content-wrapper {
      width: 90% !important;position: relative;margin: 1rem auto;background: red;
    } */

    @media screen and (max-width: 991px){
      .ccwrap {
        width: 100%;margin: 0;padding: 0;
      } 
      .addert .sdft {
        width: 95%;float:none;padding: 1rem;
        font-size: 16px;margin: 2rem auto;box-shadow: 1px 1px 1px 2px #f1f1f1;
      }
      .addert .dsc {
        width: 95%;float:none;padding: 1rem;
        font-size: 16px;margin: 2rem auto;box-shadow: 1px 1px 1px 2px #f1f1f1;
      }
  }
  </style>
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KTMVLGV"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<!--<div class="overlay" id="overlay" onclick="remove()"></div>-->
<?php
      require_once'config.php';
      $country = $con-> prepare("SELECT userCountry,countryFlag,uname,invite_id FROM users WHERE id = ? ");
      $country -> bindParam(1,$user_data['id']);
      $nm = $con-> prepare("SELECT uname FROM users");
      $nm -> execute();
      // if($country -> execute()) {
      //     $flag = $country -> fetch(PDO::FETCH_ASSOC);
      //     $client_Country = $flag['userCountry'];
      //     $client_flag = $flag['countryFlag'];
      //     $clientfname = $flag['uname'];
      //     $client_Flag = 'images/pngflags/'.$client_flag;
      //     $newmembers = $nm -> rowCount();
      //     $n = $flag['uname'];
      //     $nr = $flag['invite_id'];
      //     if(isset($n)) {
      //         $med = $n;
      //     }else{
      //         $med = $nr;
      //     }
      //   }

        
  ?>

<div class="wrapper" id="main">
  <?php echo @$header;?>

  
   <!-- pageloader  -->
  <div id="progress" class="waiting"></div>
  <!-- pageloader ends -->
  
<!-- header -->
<div class="headerc">

<div class="hd-left ml-15" style="width: 100%">
    <div class="inner-header-img">
          <img src="images/searche.png" class="hd-bgim" style="width: 20rem;float: left" alt="">
    </div>
    <div class="rdff" style="width: 80%;margin-top: 8rem">
      <h1 class="hdh1">Browse Fundraisers</h1>
      <div class="end-float"></div>
    </div>
    <div class="dtxt">Search fundraisers you may like</div>
  </div>
  


<!--Waves Container-->
  <div>
      <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
      viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
          <defs>
          <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
          </defs>
          <g class="parallax">
          <use xlink:href="#gentle-wave" x="48" y="0" fill="#22a349" />
          <use xlink:href="#gentle-wave" x="48" y="3" fill="#22a349" />
          <use xlink:href="#gentle-wave" x="48" y="5" fill="#22a349" />
          <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
          </g>
      </svg>
  </div>
  <!--Waves end-->

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

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapperr">

        <div class="search-f" id="search">
            <form action="" Method ="POST">
              <div class="">
                <input type="varchar" class="form-control " name="query" id="search-input" placeholder="search fundraiser by name or category" aria-label="search" aria-describedby="search">
                <button type="submit" class="border-none" name="submit"><i class="fas fa-search"></i></button>
              </div>
            </form> 
            <div id="kkkk"></div>
        </div>

        <div class="content-header taxt-center mt-0 pt-2">

        <!-- TradingView Widget BEGIN -->
            <div class="ccwrap">
                <h1 class="mx-auto p-2 m-2 text-success text-center">Browse All Fundraisers</h1>
                <div class="row ">
                    <div class="col-md-3">                				
                        <div class="list-group">
                            <h3>Fundraiser Type</h3>
                            <div style="">
                            <?php

                            $query = "SELECT DISTINCT(fundraiserType) FROM fundraiser_table WHERE fundraiserStatus = 'Active' ORDER BY fundraiserId DESC";
                            $statement = $con->prepare($query);
                            $statement->execute();
                            $result = $statement->fetchAll();
                            foreach($result as $row)
                            {
                            ?>
                            <div class="list-group-item checkbox">
                                <label class='font-weight-normal'><input type="checkbox" class="common_selector fundraiserType font-weight-lighter" value="<?php echo ucwords($row['fundraiserType']); ?>"  > <?php echo ucwords($row['fundraiserType']); ?></label>
                            </div>
                            <?php
                            }

                            ?>
                            </div>
                        </div>

                        <div class="list-group">
                            <h3>Category</h3>
                            <?php

                            $query = "SELECT DISTINCT(fundraiserCategory) FROM fundraiser_table WHERE fundraiserStatus = 'Active' ORDER BY fundraiserId DESC";
                            $statement = $con->prepare($query);
                            $statement->execute();
                            $result = $statement->fetchAll();
                            foreach($result as $row)
                            {
                            ?>
                            <div class="list-group-item checkbox">
                                <label class='font-weight-normal'><input type="checkbox" class="common_selector fundraiserCategory text-gray" value="<?php echo $row['fundraiserCategory']; ?>" > <?php echo $row['fundraiserCategory']; ?> </label>
                            </div>
                            <?php    
                            }

                            ?>
                        </div>
                        
                        <!-- <div class="list-group">
                            <h3>Internal Storage</h3>
                            <?php
                            // $query = "SELECT DISTINCT(product_storage) FROM product WHERE product_status = '1' ORDER BY product_storage DESC";
                            // $statement = $con->prepare($query);
                            // $statement->execute();
                            // $result = $statement->fetchAll();
                            // foreach($result as $row)
                            // {
                            ?>
                            <div class="list-group-item checkbox">
                                <label><input type="checkbox" class="common_selector storage" value="<?php #echo $row['product_storage']; ?>"  > <?php #echo $row['product_storage']; ?> GB</label>
                            </div>
                            <?php
                            // }
                            ?>	
                        </div> -->
                    </div>

                    <div class="col-md-9 mt-1">
                        <div class="row filter_data">

                        </div>
                    </div>
                </div>

            </div>
        
        <script>
        $(document).ready(function(){

            filter_data();

            function filter_data()
            {
                $('.filter_data').html('<div id="loading" style="" ></div>');
                var action = 'fetch_data';
                var fType = get_filter('fundraiserType');
                var fCategory = get_filter('fundraiserCategory');
                $.ajax({
                    url:"fetch_data.php",
                    method:"POST",
                    data:{action:action,fundraiserType:fType, fundraiserCategory:fCategory},
                    success:function(data){
                        $('.filter_data').html(data);
                    }
                });
            }

            function get_filter(class_name)
            {
                var filter = [];
                $('.'+class_name+':checked').each(function(){
                    filter.push($(this).val());
                });
                return filter;
            }

            $('.common_selector').click(function(){
                filter_data();
            });


        });
        </script>


    </div>
  </div>
  <!-- /.content-wrapper -->



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
