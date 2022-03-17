<?php
ob_start();
session_start();
ini_set('display_errors','1');
require_once'dbh.php';
require_once'config.php';
require_once'ranStrGen.php';
require_once'mailer.php';


@$user_data = @$_SESSION['user'];
@$userid = @$user_data['id'];
@$email_of_user = @$user_data['email'];
@$fnamee = @$user_data['Fname'];
@$lnamee = @$user_data['Lname'];

@$Email = $_SESSION['Email'];
@$Lname = $_SESSION['Lname'];
// $emailcode = $_SESSION['emailCode'];
@$emailUname = $_SESSION['emailUname'];
@$fundraiserType = $_SESSION['fundraiserType'];

if(isset($_SESSION['Email'])) {
    $uploadedBY = $emailUname. ' ' .$Lname;
    @$fundraiserType = $_SESSION['fundraiserType'];
  }else if($user_data['email']) {
    @$uploadedBY = $fnamee. ' ' .$lnamee;
    @$fundraiserType = strip_tags($_GET['fundraiserType']);
  }else {
      header("location:https://my.fundreza.com/login");
      exit();
  }
if((isset($_FILES['file']) && $_FILES['file'] != "")) {
    
    $uploadedBY = $emailUname. ' ' . $Lname;
    $filename = $_FILES['file']["name"];
    $type = $_FILES['file']["type"];
    $filesize = $_FILES['file']['size'];
    $source = $_FILES['file']['tmp_name'];
    $path_to_file_directory = 'uploadedDocuments';
    $err = "";
    $arr_file_types = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg'];
 

    if (!(in_array($_FILES['file']['type'], $arr_file_types))) {
        $err = "Document type not supported";
        exit();
    }

    // get size of image
    $imgSize = getimagesize($filename);

    if($filesize > 10000000) {
        $err = "Document must be smaller than 10 MB";
        exit();
    }
    $documenturl = 'uploadedDocuments/'. time() . '_' . $filename;
    
    $documenturlstrReplace = str_replace(" ", "_", $documenturl);
    move_uploaded_file($_FILES['file']['tmp_name'], $documenturlstrReplace);
    
    $image_files = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg'];
    
    if (in_array($_FILES['file']['type'], $image_files)) {
        $docType = 'image';
    }

    
    if(isset($_SESSION['Email'])) {
        $eemail = $_SESSION['Email'];
        $uploadedBY = $_SESSION['Email'];
      }else if(isset($user_data['email'])) {
        $eemail = $user_data['email'];
        $uploadedBY = $user_data['email'];
      }

    $timestatus = time();
    $documentId = rand();

    $che = $con -> prepare("SELECT fundraiserId FROM fundraiser_table WHERE fundraiserEmail = ? ORDER BY dateSubmitted DESC");
    $che ->bindParam(1,$eemail);
    $che -> execute();
    $c = $che -> fetch(PDO::FETCH_ASSOC);
    $fundraiserId = $c['fundraiserId'];

    $con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $select = $con -> prepare("SELECT uploadedDocument FROM documentuploads WHERE uploadedDocument = ? ORDER BY time_uploaded DESC");
    $select -> bindParam(1,$documenturlstrReplace);
    $select -> execute();
    $sel = $con -> prepare("SELECT uploadedDocument FROM documentuploads WHERE fundraiserId = ? ORDER BY time_uploaded DESC");
    $sel -> bindParam(1,$fundraiserId);
    $sel -> execute();
    if($select -> execute() && $select -> rowCount() > 0 && $se -> rowCount() <= 8) {
        // echo 'upload successful';
        }if($sel -> rowCount() > 8) {
            $err = 'Max image uploaded of 3 reached';
        }else {
            $uploadDoc = $con -> prepare("INSERT INTO documentuploads (fundraiserId,documentId,uploadedDocument,documentType,fileType,uploadedBy,time_uploaded) VALUES (?,?,?,?,?,?,?)");
            $uploadDoc -> bindParam(1,$fundraiserId);
            $uploadDoc -> bindParam(2,$documentId);
            $uploadDoc -> bindParam(3,$documenturlstrReplace);
            $uploadDoc -> bindParam(4,$docType);
            $uploadDoc -> bindParam(5,$type);
            $uploadDoc -> bindParam(6,$uploadedBY);
            $uploadDoc -> bindParam(7,$timestatus);
            $uploadDoc -> execute();

            $documenturlstrReplace;

            $_SESSION['image'] = $documenturlstrReplace;

            $upd = $con -> prepare("UPDATE fundraiser_table SET fundraiserThumbnail = ? WHERE fundraiserId = ? ");
            $upd -> bindParam(1,$documenturlstrReplace);
            $upd -> bindParam(2,$fundraiserId);
            $upd -> execute();

            // getfundraisereduploadsEmail($email,$fundraiserType,$fundraiserTitle,$name);
            $err = "<div class='alert-success p-2 m-3 rounded'> Documents Upload Successful <span class='close-err'>&times;</span> </div>";
            $documentType = 'image';
            $selectimg = $con -> prepare("SELECT fundraiserThumbnail FROM fundraiser_table WHERE fundraiserId = ? ORDER BY dateSubmitted DESC");
            $selectimg -> bindParam(1,$fundraiserId);
            if($selectimg -> execute() && $selectimg -> rowCount() > 0 ) {
                
                $doc_ext = $selectimg -> fetch(PDO::FETCH_ASSOC);
                $imgDoc = $doc_ext['fundraiserThumbnail'];
                $imgThumb = "<div class='select-thumbnail'><img src='$imgDoc' alt='fundraiser cover photo' onerror=this.src='images/9.png' onerror=this.src='images/9.png' class='fundraiser-thumbnail'></div>";
                    
            }
        }
}
ob_clean();?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <base href="https://fundreza.com/">
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
	<title>Fundreza.com | Start a fundraiser </title>
    <!-- base:css -->
    <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
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
    <!-- inject:css -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/customize.css">
  <link rel="stylesheet" href="css/login_style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="images/favicon.png" />
    <style>
    header {
        border-bottom: 1px solid #f1f1f1;height: 4rem;
    }
    header img {
        margin: .4rem;
    }
        .full-height {
            width: 35%;margin: 5rem auto;position: relative;
        }
        h4 {
          font-weight: 600;color: #444444;font-size: 14px;margin-bottom: .4rem;
        }
        p {
          font-size: 14px;text-align: left;
        }
        a,a:hover {
          text-decoration: none;color: #545454;
        }
        .col-xv {
          border: 1px solid #f1f1f1;border-radius: 4px;margin: 2rem auto;width: 30%;
          box-shadow: 1px 2px 2px 1px #f1f1f1;
        }
        .cvc {
          display: inline-block;
        }
        .col-xv img{
          float: left;border-radius: 50%;width: 4rem;
        }
        .col-xv .bvc {

        }
        .col-xv h4 {
          margin-top: 1rem;margin-bottom: 1rem;text-align: left;
        }.inner {
            display: inline-block;width: 100%;padding-left: 0;margin-left: 0;padding-right: 0;margin-right: 0;
            margin-top: 0;white-space: nowrap;
        }
        .inner .col-inn {
            display: inline-block;padding: 0;margin: 0;
        }
        .inner .col-inn#ffn {
            margin-left: 0;margin-right: 1%;width: 10%;white-space: nowrap;margin-top: 0;float: left;
        }
        .inner .col-inn#lln {
            margin-right: 0;margin-left: 4%;width: 80%;
        }
        .hideP {
            float: right;margin: -1.8rem .4rem auto auto;color: #22a349;
        }
        .pbar4 {
            width: 20%;height: 3px;margin: 2%;display: inline-block;
        }
        .pbar5 {
            width: 15%;height: 3px;margin: 2%;display: inline-block;
        }
        #pbar1 {
          background-color: #22a349;
        }
        #pbar1 {
            background-color: #22a349;
        }
        
        #pbar2 {
            background-color: #22a349;
        }
        
        #pbar3 {
            background-color: #22a349;
        }
        .hint {
          font-size: 13px;color: #22a349;margin-top:.5rem;white-space: initial;
          word-wrap: break-word;
        }
        label {
            white-space: initial;
        }
        ul {
            margin: 0 !important;
        }
        ul li {
            float: none;white-space: initial;text-align: left;font-size: 13px;
            list-style: none;margin-left: 0 !important;
        }
        .fa-check {
            color: #22a349;
        }
        .spt {
            position: absolute;top: 30%;left: 100%;right: 10%;width: 100%;box-shadow: 1px 2px 2px 2px #f1f1f1;
            border-radius: 4px;padding: .5rem;
        }
        .spt img {
            float: left;width: 2rem;border-radius: 50%;margin: -.4rem .4rem;
        }
        .spt .below {
            border-top: 1px solid #eaeaea;padding-top: 1rem;margin-top: 1rem; 
            font-size: 13px;white-space: initial;
        }
        #drop_file_zone {
            background-color: #f1f1f1;
            border: #999 1px dashed;
            border-radius: 4px;
            width: 100%;
            height: 150px;
            margin: 2rem auto;
            padding: 8px;
            font-size: 18px;
        }
        #drag_upload_file {
            width:50%;
            margin:10% auto;
        }
        #drag_upload_file p {
            text-align: center;color: gray;
        }
        #drag_upload_file #selectfile {
            display: none;
        }
        #loaded-n-total,#status {
            color: gray;
        }
        .svg-animate {
            position: relative;height: 120px;width: 100%;
            display: block;
        }
        .arrows {
            width: 60px;
            height: 72px;
            position: absolute;
            left: 50%;
            margin-left: -30px;
            bottom: 20px;
        }

        .arrows path {
            stroke: #2994D1;
            fill: transparent;
            stroke-width: 1px;	
            animation: arrow 2s infinite;
            -webkit-animation: arrow 2s infinite; 
        }

        @keyframes arrow
        {
        0% {opacity:0}
        40% {opacity:1}
        80% {opacity:0}
        100% {opacity:0}
        }

        @-webkit-keyframes arrow /*Safari and Chrome*/
        {
        0% {opacity:0}
        40% {opacity:1}
        80% {opacity:0}
        100% {opacity:0}
        }

        .arrows path.a1 {
            animation-delay:-1s;
            -webkit-animation-delay:-1s; /* Safari 和 Chrome */
        }

        .arrows path.a2 {
            animation-delay:-0.5s;
            -webkit-animation-delay:-0.5s; /* Safari 和 Chrome */
        }

        .arrows path.a3 {	
            animation-delay:0s;
            -webkit-animation-delay:0s; /* Safari 和 Chrome */
        }
        .or {
            margin: auto;font-size: 20px;text-align: center;
        }
        .vidlinktop {
            width: 100%;margin: auto;text-align: center;
        }
        .imgthumb {
            width: 100%;position: relative;
        }
        .imgthumb .fundraiser-thumbnail {
            width: 100%;margin: 1rem auto .4rem auto;border-radius: 4px;height: 15rem;max-height: 15rem;
        }
        .max-imgup {
            margin: 3rem auto 0 auto;text-align: center;background-color: gray;color: #ffffff;padding: .5rem;
        }
        .imgxc {
            width: 100%;margin: 0 auto;
        }
        .imgxc button {
            width: 100%;border: none;background: none;cursor: pointer;font-size: 13px;color: #545454;
        }
        .imgxc .imgtc {
            float: left;
        }
        .imgxc .imgtd {
            float: right;
        }
        .f-pix {
            color: #545454;margin: 2rem 0 -1rem 0;position: absolute;top: 3%;left: 1rem;
            background-color: #ffffff;color: #545454;padding: .3rem;border-radius: 4px;
            font-size: 12px;
        }
        .next-p {
            margin: 1rem auto;text-align: center;background: gray;width: 100%;
        }
        .next-p button {
            width: 100%;margin: .5rem auto;background: gray;border: none;
        }
        .next-p button a {
            color: #ffffff;padding: .5rem;
            border-radius: 4px;color: #ffffff;
        }
        .prv {
            width: 100%;color: #ffffff;background-color: #025faa;text-align: center;
            padding: .4rem;border: none;border-radius: 4px;margin-top: 1rem;
        }
        .prv a {
            border: none;box-shadow: none;color: #ffffff;padding: .4rem;
        }
        .prv a:hover {
            color: #ffffff;
        }
        .fa-paperclip {
            cursor: pointer;
        }
        .fn {
            width: 100%;text-align: center;text-align: justify;text-align-last: justify;
            border-bottom: 2px dashed #cccccc;padding-bottom: 2rem;
        }
        .fnp {
            display: inline-block;width: 50%;margin-right: .8rem;
        }
        .fnv {
            display: inline-block;width: 40%;margin-left: .6rem;
            background-color: #f1f1f1;
            border: #999 1px dashed;
            border-radius: 4px;
            height: 150px;
            margin: 0 auto;
            padding: 8px;
            font-size: 18px;
        }
        .fn p {
            text-align: center;
        }
        .fnv #adv {
            width:50%;
            margin:30% auto;
        }
        .fnv .fa-youtube {
            color: red;
        }
        .fa-paperclip {
            color: #025faa;
        }
        .orf {
            margin: -1.52rem auto;text-align: center;font-weight: bold;
            color: #545454;background-color: #ffffff;padding: 1rem;
            width: fit-content;
        }
        .choose {
            margin: 2rem auto; font-weight: bold;text-align: center;
        }
        .choose .cnp {
            text-align: justify;text-align-last: justify;width: 100%;
        }
        .choose button {
            border: none;margin: 3rem auto;width: 45%;
        }
        .choose button .np-cov {
            width: 100%;
        }
        @media screen and (max-width:967px) {
          
        .full-height {
          width: 80%;
        }
      }
        @media screen and (max-width:767px) {
          .full-height {
          width: 90%;
        }
      }
    </style>
    <body class="bg-white">
        <div class="container-scroller bg-white">
            <header><a href="home"><img src="images/fundrezalogo.png" alt="" class="fundrais"></a></header>
    
            <div class="full-height bg-white">
                <!-- ./authfy-panel-left -->
                <div class="form-group inner">
                    <div class="col-inn" id="ffn">
                    <?php echo "<a href='https://fundreza.com/funding/set/fundraising-goal/$fundraiserType'><i class='fas fa-angle-left'></i> Back</a>"; ?>
                    </div>
                    <div class="col-inn" id="lln">
                        <?php $fundraiserTy = @$_GET['fundraiserType'];  if(isset($fundraiserTy) && strip_tags($fundraiserTy) && $fundraiserTy == "individual") {?>
                        <h4>Step 3 of 4</h4>
                        <div class="progressbar"><div class="pbar4" id="pbar1"></div><div class="pbar4" id="pbar2"></div><div class="pbar4" id="pbar3"></div><div class="pbar4" ></div></div>
                        <h4 class="text-left mt-5 mb-2">Add a cover photo or video</h4>
                        <?php $fundraiserTy = @$_GET['fundraiserType']; } else if(isset($fundraiserTy) && strip_tags($fundraiserTy) && $fundraiserTy == "non-profit") {?>
                            <h4>Step 3 of 5</h4>
                        <div class="progressbar"><div class="pbar5" id="pbar1"></div><div class="pbar5" id="pbar2"></div><div class="pbar5" id="pbar3"></div><div class="pbar5"></div><div class="pbar5"></div></div>
                        <h4 class="text-left mt-5 mb-2">Add a cover photo or video</h4>
                        <?php }?>

                        <div class="errmessage"><?php echo @$err;?></div>
                        <form method="POST">
                            <div class="form-group">
                            <div class="hint">A high-quality photos or video will help tell your story and build trust with donors</div>

                            <div class="imgthumb">
                                <?php 
                                    ob_start();
                                    require_once'dbh.php';

                                    
                                    if(isset($_SESSION['Email'])) {
                                        $eemail = $_SESSION['Email'];
                                        $uploadedBY = $_SESSION['Email'];
                                      }else if(isset($user_data['email'])) {
                                        $eemail = $user_data['email'];
                                        $uploadedBY = $user_data['email'];
                                      }

                                      
                                    $con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
                                    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    $ch = $con -> prepare("SELECT fundraiserId FROM fundraiser_table WHERE fundraiserEmail = ? ORDER BY dateSubmitted DESC");
                                    $ch ->bindParam(1,$eemail);
                                    $ch -> execute();
                                    $s = $ch -> fetch(PDO::FETCH_ASSOC);
                                    @$fundraisaId = $s['fundraiserId'];

                                    $_SESSION['fundraiserId'] = $fundraisaId;
                                    
                                    $selectim = $con -> prepare("SELECT fundraiserThumbnail FROM fundraiser_table WHERE fundraiserId = ? ORDER BY dateSubmitted DESC");
                                    $selectim -> bindParam(1,$fundraisaId);
                                    $selectim -> execute();
                                    
                                    $se = $con -> prepare("SELECT uploadedDocument FROM documentuploads WHERE fundraiserId = ? ORDER BY time_uploaded DESC");
                                    $se -> bindParam(1,$fundraisaId);
                                    $se -> execute();
                                    $dc = $se -> fetch(PDO::FETCH_ASSOC);
                                    $dimg = $selectim -> fetch(PDO::FETCH_ASSOC);
                                        
                                    @$imgDo = $dimg['fundraiserThumbnail'];
                                    $fundraiserTy = @$_GET['fundraiserType'];
                                    
                                    if(isset($fundraiserTy) && strip_tags($fundraiserTy) && $fundraiserTy == "individual") {

                                        if(isset($_POST['delete']) && isset($_POST['deletecover'])) {
                                            $imgDod = isset($_POST['delete']) ? $_POST['delete'] : false;

                                            $del = $con -> prepare("DELETE FROM documentuploads WHERE fundraiserId = ? AND uploadedDocument = ? ORDER BY time_uploaded DESC");
                                            $del -> bindParam(1,$fundraisaId);
                                            $del -> bindParam(2,$imgDod);
                                            $del -> execute();
                                            if($del -> execute()) {

                                              $seel = $con -> prepare("SELECT uploadedDocument FROM documentuploads WHERE fundraiserId = ? ORDER BY time_uploaded DESC LIMIT 1");
                                              $seel -> bindParam(1,$fundraisaId);
                                              $seel -> execute();
                                              if($seel -> execute()) {
                                                $cf = $seel -> fetch(PDO::FETCH_ASSOC);
                                                $fcthumb = $cf['uploadedDocument'];
                                                $fundraisaId;
                                                $queryy = $con->prepare("UPDATE fundraiser_table SET fundraiserThumbnail = ? WHERE fundraiserId = ? ORDER BY dateSubmitted DESC LIMIT 1");
                                                $queryy ->bindParam(1, $fcthumb);
                                                $queryy ->bindParam(2, $fundraisaId);
                                                $queryy ->execute();
                                                if($queryy -> execute()) {
                                                  // $serv = $_SERVER['PHP_SELF'];
                                                  header("location:https://fundreza.com/add-media/setup/addpicture-video/$fundraiserType/$fundraisaId");
                                                }
                                              }

                                            }
                                        }

                                        if($se -> execute() && $se -> rowCount() > 0) {
                                          echo $imgThum = "<div class='imgthumb'><div class='f-pix'>fundraiser cover photo</div><img src='$imgDo' alt='fundraiser cover photo' onerror=this.src='images/9.png' class='fundraiser-thumbnail border-rounded'><div class='imgxc'><div class='imgtc'><button><i class='fas fa-edit'></i> Edit </button></div><div class='imgtd'><form action='' method='POST'><input type='varchar' name='delete' value='$imgDo' hidden><button type='submit' name='deletecover' class='trash'><i class='fas fa-trash-alt'></i> Delete</button></div></div></div><div style='clear:both'></div>";
                                        }
                                        if($selectim -> execute() && $selectim -> rowCount() > 0 && $se -> rowCount() > 0 && $se -> rowCount() < 8 ) {
                                            ob_end_flush();
                                    ?>
                            </div>
                            
                            <div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false">
                                <div id="drag_upload_file" class="mx-auto text-center">
                                    <p>Drop pictures</p>
                                    <p>Or</p>
                                    <p class="mx-auto text-center"><i class="fas fa-paperclip fa-2x"  onclick="file_explorer();"></i></p>
                                    <input type="file" id="selectfile" name="uploadDocuments">
                                </div>
                                <progress id='upload-progress-bar' value='0' max='100'></progress>
                                <h3 id='status'></h3>
                                <p id='loaded-n-total'></p>
                            </div>
                            <br>
                            <div class="or">If you have video, upload it here</div>
                            <div class="svg-animate" id="svg-down-arrow">
                                <svg class="arrows">
                                    <path class="a1" d="M0 0 L30 32 L60 0"></path>
                                    <path class="a2" d="M0 20 L30 52 L60 20"></path>
                                    <path class="a3" d="M0 40 L30 72 L60 40"></path>
                                </svg>
                            </div>

                            <div class="vidlinktop">
                                <button type="button" class="funds_btn" data-toggle="modal" data-target="#youtubevidlink1">Upload Video</button>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="youtubevidlink1" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title mx-auto text-center" style="color: #22a349" id="exampleModalLabel">Add Fundraiser Youtube Link</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <form action="" method="POST" id="vidLink">
                                          <div class="form-group">
                                            <label for="">Enter Youtube Video Link</label>
                                            <input type="text" name="fundaId" class="form-control" id="fundaId" value="<?php echo @$fundraisaId?>" hidden>
                                            <input type="text" name="youtubeLink" class="form-control" id="youtubeLink" value="<?php echo @$_POST['youtubeLink']?>" required>
                                          </div>
                                        </form>
                                      </div>
                                      <div class="mx-auto text-center mt-3 mb-3 p-2">
                                            <button type="button" class="btn btn-danger font-weight-normal mr-3" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn text-white font-weight-normal border-0 ml-3" name="submit" style="background-color: #22a349" onclick="addYoutubeVideoLink()">Submit</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!-- Modal ends -->

                            <div class="prv">
                            <?php echo "<a href='https://fundreza.com/fundraiser-story/tell-your-story/$fundraiserType' class='prv'> Next <i class='fas fa-angle-right'></i></a>";?> 
                            </div>
                            <?php } if($se -> execute() && $se -> rowCount() >= 8){ ?>
                                <div class="max-imgup mx-auto" >
                                    Maximum pictures upload of 3 reached
                                </div>
                            <?php } else if($selectim -> execute() && $se -> rowCount() == 0){ ?>
                                
                                <div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false">
                                    <div id="drag_upload_file" class="mx-auto text-center">
                                        <p>Drop pictures</p>
                                        <p>Or</p>
                                        <p class="mx-auto text-center"><i class="fas fa-paperclip fa-2x"  onclick="file_explorer();"></i></p>
                                        <input type="file" id="selectfile" name="uploadDocuments">
                                    </div>
                                    <progress id='upload-progress-bar' value='0' max='100'></progress>
                                    <h3 id='status'></h3>
                                    <p id='loaded-n-total'></p>
                                </div>

                                <br>
                                <div class="or">If you have video, upload it here</div>
                                <div class="svg-animate" id="svg-down-arrow">
                                    <svg class="arrows">
                                        <path class="a1" d="M0 0 L30 32 L60 0"></path>
                                        <path class="a2" d="M0 20 L30 52 L60 20"></path>
                                        <path class="a3" d="M0 40 L30 72 L60 40"></path>
                                    </svg>
                                </div>

                                <div class="vidlinktop">
                                    <button type="button" class="funds_btn"  data-toggle="modal" data-target="#youtubevidlink2">Upload Video</button>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="youtubevidlink2" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title mx-auto text-center" style="color: #22a349" id="exampleModalLabel">Add Fundraiser Youtube Link</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <form action="" method="POST" id="">
                                          <div class="form-group">
                                            <label for="">Enter Youtube Video Link</label>
                                            <input type="text" name="fundaId" class="form-control" id="fundaId" value="<?php echo @$fundraisaId?>" hidden>
                                            <input type="text" name="youtubeLink" class="form-control" id="youtubeLink" value="<?php echo @$_POST['youtubeLink']?>" required>
                                          </div>
                                        </form>
                                      </div>
                                      <div class="mx-auto text-center mt-3 mb-3 p-2">
                                            <button type="button" class="btn btn-danger font-weight-normal mr-3" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn text-white font-weight-normal border-0 ml-3" name="submit" style="background-color: #22a349" onclick="addYoutubeVideoLink()">Submit</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!-- Modal ends -->

                                <div class="prv">
                                <?php echo "<a href='https://fundreza.com/fundraiser-story/tell-your-story/$fundraiserType' class='prv'> Next <i class='fas fa-angle-right'></i></a>";?> 
                                </div>
                                <!-- adding cover photo for non profits -->

                            <?php } }else if(isset($fundraiserTy) && strip_tags($fundraiserTy) && $fundraiserTy == "non-profit") {
                                
                                        if(isset($_POST['delete']) && isset($_POST['deletecover'])) {
                                            $imgDod = isset($_POST['delete']) ? $_POST['delete'] : false;

                                            $del = $con -> prepare("DELETE FROM documentuploads WHERE fundraiserId = ? AND uploadedDocument = ? ORDER BY time_uploaded DESC");
                                            $del -> bindParam(1,$fundraisaId);
                                            $del -> bindParam(2,$imgDod);
                                            $del -> execute();
                                            if($del -> execute()) {

                                              $seel = $con -> prepare("SELECT uploadedDocument FROM documentuploads WHERE fundraiserId = ? ORDER BY time_uploaded DESC LIMIT 1");
                                              $seel -> bindParam(1,$fundraisaId);
                                              $seel -> execute();
                                              if($seel -> execute()) {
                                                $cf = $seel -> fetch(PDO::FETCH_ASSOC);
                                                $fcthumb = $cf['uploadedDocument'];
                                                $fundraisaId;
                                                $queryy = $con->prepare("UPDATE fundraiser_table SET fundraiserThumbnail = ? WHERE fundraiserId = ? ORDER BY dateSubmitted DESC LIMIT 1");
                                                $queryy ->bindParam(1, $fcthumb);
                                                $queryy ->bindParam(2, $fundraisaId);
                                                $queryy ->execute();
                                                if($queryy -> execute()) {
                                                  // $serv = $_SERVER['PHP_SELF'];
                                                  header("location:https://fundreza.com/add-media/setup/addpicture-video/$fundraiserType/$fundraisaId");
                                                }
                                              }

                                            }
                                        }

                                        if($se -> execute() && $se -> rowCount() > 0) {
                                            echo $imgThum = "<div class='imgthumb'><div class='f-pix'>fundraiser cover photo</div><img src='$imgDo' alt='fundraiser cover photo' onerror=this.src='images/9.png' class='fundraiser-thumbnail border-rounded'><div class='imgxc'><div class='imgtc'><button><i class='fas fa-edit'></i> Edit </button></div><div class='imgtd'><form action='' method='POST'><input type='varchar' name='delete' value='$imgDo' hidden><button type='submit' name='deletecover' class='trash'><i class='fas fa-trash-alt'></i> Delete</button></div></div></div><div style='clear:both'></div>";
                                        }
                                
                                ?>

                                <div class="fn">
                                    <div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false" style="width: 50%" class="fnp">
                                        <div id="drag_upload_file" class="mx-auto text-center">
                                            <p>Drop picture</p>
                                            <p class="text-center mx-auto">Or</p>
                                            <p class="mx-auto text-center"><i class="fas fa-paperclip fa-2x mx-auto text-center"  onclick="file_explorer();"></i></p>
                                            <input type="file" id="selectfile" name="uploadDocuments">
                                        </div>
                                        <progress id='upload-progress-bar' value='0' max='100'></progress>
                                        <h3 id='status'></h3>
                                        <p id='loaded-n-total'></p>
                                    </div>
                                    <div class="fnv">
                                          <div id="adv" class="mx-auto text-center">
                                              <p class="text-center mx-auto">Add YouTube Video</p>
                                              <button type="button" class="funds_btn bg-none"  data-toggle="modal" data-target="#youtubevidlink3"><i class="fab fa-youtube fa-2x mx-auto text-center" ></i></button>
                                          </div>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="youtubevidlink3" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title mx-auto text-center" style="color: #22a349" id="exampleModalLabel">Add Fundraiser Youtube Link</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <form action="" method="POST" id="">
                                              <div class="form-group">
                                                <label for="">Enter Youtube Video Link</label>
                                                <input type="text" name="fundaId" class="form-control" id="fundaId" value="<?php echo @$fundraisaId?>" hidden>
                                                <input type="text" name="youtubeLink" class="form-control" id="youtubeLink" value="<?php echo @$_POST['youtubeLink']?>" required>
                                              </div>
                                            </form>
                                          </div>
                                          <div class="mx-auto text-center mt-3 mb-3 p-2">
                                            <button type="button" class="btn btn-danger font-weight-normal mr-3" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn text-white font-weight-normal border-0 ml-3" name="submit" style="background-color: #22a349" onclick="addYoutubeVideoLink()">Submit</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- Modal ends -->
                                    
                                </div>
                                <div class="orf">Or</div>

                                <div class="choose">
                                    <div class="mb-3 pb-2">Choose cover image below</div>

                                    <?php
                                        require_once'dbh.php';
                                        require_once'config.php';
                                        $fnnt = 'non-profit';
                                        $selectimn = $con -> prepare("SELECT fundraiserThumbnail FROM fundraiser_table WHERE fundraiserType = ? AND ( fundraiserThumbnail <> null || fundraiserThumbnail <> '') ORDER BY dateSubmitted DESC");
                                        $selectimn -> bindParam(1,$fnnt);
                                        $selectimn -> execute();
                                        if($selectimn -> execute() && $selectimn -> rowCount() > 0) {
                                            $pm = $selectimn -> fetchAll(PDO::FETCH_ASSOC);
                                        }

                                        if(isset($_POST['npCover']) && isset($_POST['submit'])) {

                                          $fnpCover = $_POST['npCover'];

                                          $seels = $con -> prepare("SELECT * FROM documentuploads WHERE uploadedDocument = ?");
                                          $seels -> bindParam(1,$fnpCover);
                                          $seels -> execute();
                                          if($seels -> execute() && $seels -> rowCount() >0) {
                                            $fcp = $seels -> fetch(PDO::FETCH_ASSOC);
                                            $docId = $fcp['documentId'];
                                            $docf = $fcp['uploadedDocument'];
                                            $docT = $fcp['documentType'];
                                            $fT = $fcp['fileType'];
                                            $upBy = $fcp['uploadedBy'];
                                            $tU = $fcp['time_uploaded'];

                                            $uploadD = $con -> prepare("INSERT INTO documentuploads (fundraiserId,documentId,uploadedDocument,documentType,fileType,uploadedBy,time_uploaded) VALUES (?,?,?,?,?,?,?)");
                                            $uploadD -> bindParam(1,$fundraisaId);
                                            $uploadD -> bindParam(2,$docId);
                                            $uploadD -> bindParam(3,$docf);
                                            $uploadD -> bindParam(4,$docT);
                                            $uploadD -> bindParam(5,$fT);
                                            $uploadD -> bindParam(6,$upBy);
                                            $uploadD -> bindParam(7,$tU);
                                            if($uploadD -> execute()) {
                                              $queryy = $con->prepare("UPDATE fundraiser_table SET fundraiserThumbnail = ? WHERE fundraiserEmail = ? ORDER BY dateSubmitted DESC LIMIT 1");
                                              $queryy ->bindParam(1, $fnpCover);
                                              $queryy ->bindParam(2, $eemail);
                                              $queryy ->execute();
                                              if($queryy -> execute()) {
                                                echo "<div class='text-center text-white p-2' style='background-color: #22a349;width: 100%; margin: 2rem auto;font-weight: lighter'>Cover Photo Successfully Selected</div>";
                                              }
                                            }

                                          }else {

                                          }
                                          
                                        }
                                    ?>
                                    <form action="" method="post">
                                        <div class="cnp row">
                                            <?php foreach($pm as $p => $vi): ?>
                                                <div class="col-lg-6">
                                                  <div class="m-2">
                                                    <input type="varchar" name="npCover" value="<?php echo $vi['fundraiserThumbnail']?>" hidden>    
                                                    <button type="submit" name="submit" value="<?php echo $vi['fundraiserThumbnail']?>" style="width: 100%;height: 100%;margin: 1rem auto;padding:0"><img src="<?php echo $vi['fundraiserThumbnail']?>" alt="" class="np-cov" width="100%" style="width: 100%;height: 100%;margin: 0"></button>
                                                  </div>
                                                </div>
                                            <?php endforeach;?>
                                        </div>
                                    </form>
                                </div>

                                

                                <div class="prv" style='background-color: #22a349'>
                                <?php echo "<a href='https://fundreza.com/fundraiser-story/tell-your-story/$fundraiserType/$fundraisaId' class='prv' style='background-color: #22a349'> Next <i class='fas fa-angle-right'></i></a>";?> 
                                </div>
                            <?php }?>
                        </form>
                    </div>
                </div>

                <div class="spt">
                    <div class="up"><img src="images/fsupport.png" alt="" class="sp-img"> <h4 class="con mt-2">Tip from Maria, our fundraising support expert</h4><div style="clear:both"></div></div>
                    <div class="below">
                    <ul>
                        <li>
                            <i class="fas fa-check"></i> Upload high quality pictures and videos
                        </li>
                        <li>
                            <i class="fas fa-check"></i> You can upload a maximum of 3 pictures
                        </li>
                        <li>
                            <i class="fas fa-check"></i> Your pictures and videos has to be real and must you, selfies are preferable
                        </li>
                        <li>
                            <i class="fas fa-check"></i> Short videos of not more than 5 minutes are recommended. Please go to the point and show exactly what will motivate your donors
                        </li>
                    </ul>    
                    </div>
                </div>
            </div>
  
    </div>
		<!-- container-scroller -->
    <!-- base:js -->
    <script src="vendors/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <!-- plugin js for this page -->
    <!-- End plugin js for this page -->
    <script src="vendors/chart.js/Chart.min.js"></script>
    <script src="vendors/progressbar.js/progressbar.min.js"></script>
		<script src="vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js"></script>
		<script src="vendors/justgage/raphael-2.1.4.min.js"></script>
		<script src="vendors/justgage/justgage.js"></script>
   
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js" type="text/javascript"></script>
  <script src="javascript/popper.js/umd/popper.min.js" type="text/javascript"></script>
  <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="javascript/login.js" type="text/javascript"></script>
  <script src="javascript/jquery-validation/jquery.validate.min.js" type="text/javascript"></script>
  <script type="text/javascript">
   $(document).ready(function() {
        
      })
      
      function _(e) {
        return document.getElementById(e);
    }

var fileobj;
    function upload_file(e) {
        e.preventDefault();
        fileobj = e.dataTransfer.files[0];
        ajax_file_upload(fileobj);
    }
    
    function file_explorer() {
        document.getElementById('selectfile').click();
        document.getElementById('selectfile').onchange = function() {
            fileobj = document.getElementById('selectfile').files[0];
            ajax_file_upload(fileobj);
        };
    }
    
    function ajax_file_upload(file_obj) {
        if(file_obj != undefined) {
            var form_data = new FormData();                  
            form_data.append('file', file_obj);
            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", progressHandler, false);
                    xhr.addEventListener("load", completeHandler, false);
                    xhr.addEventListener("error", errorHandler, false);
                    xhr.addEventListener("abort", abortHandler,false);
                    return xhr;
                },
                type: 'POST',
                url: 'addpicture-video.php',
                contentType: false,
                processData: false,
                data: form_data,
                success:function(response) {
                    window.location.reload(true);
                }
            });
        }
    }

    function progressHandler(event) {
        _("loaded-n-total").innerHTML = "Uploaded "+Math.round(event.loaded/1000)+"KB of "+Math.round(event.total/1000)+"KB";
        var percent2 = (event.loaded / event.total) * 100;
        _("upload-progress-bar").style.display = 'block';
        _("upload-progress-bar").value = Math.round(percent2);
        _("status").innerHTML = Math.round(percent2)+" % uploaded..... please wait"; 
    }
    
    function completeHandler(event) {
        // _("status").innerHTML = event.target.responseText; 
        // _("upload-progress-bar").style.display = 'block';
        // _("upload-progress-bar").value = 0;
        // _("upload-progress-bar").style.backgroundColor = 'green';
        // _("upload-progress-bar").style.color = 'green';
        
    }
    function errorHandler(event) {
        _("status").innerHTML = "upload failed"; 
    }
    function abortHandler(event) {
        _("status").innerHTML = "upload cancelled"; 
    }

    function addYoutubeVideoLink() {
    var youtubeurl = document.getElementById("youtubeLink").value;

    if(youtubeurl) {          
            
                    var pn = $(".modalAmt").attr("name");
                    $.ajax({
                    type:'POST',
                    url:'youtubevideolink.php',
                    data:"youtubevideoLink="+youtubeurl,
                    success:function(msg){
                    window.location.reload(true);
                }
            });
        }
    
    }   

    </script>
    </body>
</html>