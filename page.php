<?php
session_start();
require_once'dbh.php';
require_once'config.php';
include'header1.php';
include'footer.php';

@$_SESSION['currentpage'] = $_SERVER['REQUEST_URI'];
strip_tags(@$_SESSION['currentpage']);

@$user_data = @$_SESSION['user'];
@$userid = @$user_data['id'];
@$email_of_user = @$user_data['email'];


@$Email = $_SESSION['Email'];
@$Lname = $_SESSION['Lname'];
// $emailcode = $_SESSION['emailCode'];
@$emailUname = $_SESSION['emailUname'];
@$fundraiserType = $_SESSION['fundraiserType'];
@$title = @$_GET['fundraiserTitle'];
@$titled = str_replace("-"," ",$title);
@$titledd = ucwords($titled);
if(isset($_GET['fundraiserId'])) {
	$fiiid = intval($_GET['fundraiserId']);
	@$fftit = htmlspecialchars(@$_GET['fundraiserTitle']);
  $cht = $con -> prepare("SELECT fundraiserTitle,fundraiserBy FROM fundraiser_table WHERE fundraiserId = ?");
					$cht ->bindParam(1,$fiiid);
					$cht -> execute();
          $ftt = $cht -> fetch(PDO::FETCH_ASSOC);
          @$titledd = ucwords($ftt['fundraiserTitle']);
          @$fByy = ucwords($ftt['fundraiserTitle']);

}
if(isset($_SESSION['Email'])) {
    $eemail = $_SESSION['Email'];
    $uploadedBY = $_SESSION['Email'];
  }else if(isset($user_data['email'])) {
    $eemail = $user_data['email'];
    $uploadedBY = $user_data['email'];
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
	<base href="https://fundreza.com/">
    <meta charset="utf-8">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="robots" content="all,follow">
	<link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Libre Baskerville' rel='stylesheet'>
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
	<title> <?php  echo @$titledd;?> | Fundreza.com </title>
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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/fontawesome.min.css" integrity="sha512-OdEXQYCOldjqUEsuMKsZRj93Ht23QRlhIb8E/X0sbwZhme8eUw6g8q7AdxGJKakcBbv7+/PX0Gc2btf7Ru8cZA==" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/regular.min.css" integrity="sha512-Nqct4Jg8iYwFRs/C34hjAF5og5HONE2mrrUV1JZUswB+YU7vYSPyIjGMq+EAQYDmOsMuO9VIhKpRUa7GjRKVlg==" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css" integrity="sha512-jQqzj2vHVxA/yCojT8pVZjKGOe9UmoYvnOuM/2sQ110vxiajBU+4WkyRs1ODMmd4AfntwUEV4J+VfM6DkfjLRg==" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/svg-with-js.min.css" integrity="sha512-W3ZfgmZ5g1rCPFiCbOb+tn7g7sQWOQCB1AkDqrBG1Yp3iDjY9KYFh/k1AWxrt85LX5BRazEAuv+5DV2YZwghag==" crossorigin="anonymous" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" integrity="sha512-RXf+QSDCUQs5uwRKaDoXt55jygZZm2V++WUZduaU/Ui/9EGp3f/2KZVahFZBKGH0s774sd3HmrhUy+SgOFQLVQ==" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/brands.min.css" integrity="sha512-apX8rFN/KxJW8rniQbkvzrshQ3KvyEH+4szT3Sno5svdr6E/CP0QE862yEeLBMUnCqLko8QaugGkzvWS7uNfFQ==" crossorigin="anonymous" />	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script lang="javascript" type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<!-- Font Awesome CSS-->
	<link rel="stylesheet" type='text/css' href="fontawesome/fontawesomefiles/css/fontawesome.min.css">
	<link rel="stylesheet" type='text/css' href="fontawesome/fontawesomefiles/css/all.min.css">
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<script lang="javascript" type="text/javascript" src="fontawesome/fontawesomefiles/js/fontawesome.min.js"></script>
	<script lang="javascript" type="text/javascript" src="fontawesome/fontawesomefiles/js/all.min.js"></script>
	<!-- inject:css -->
	<link rel="stylesheet" href="css/customize.css?n=1">
	<link rel="stylesheet" href="css/pageloaders.css?n=1">
	<link rel="stylesheet" href="css/comments.css?n=1">
	<link rel="stylesheet" href="css/page.css?n=1">
    <link rel="stylesheet" href="css/ncustomize.css?n=1">
    <!-- endinject -->
    <link rel="shortcut icon" href="images/favicon.png" />
    <style type="text/css">
    	body {
		background-color: #f9f9f9 !important;font-family: 'PT Sans';
		width: 100%;margin: 0;padding: 0;color: gray;
		}
	</style>
  </head>
  <body>
<div class="overlayy" id="overlayy" onclick="remove()"></div>
	<div class="retun" id="ajaxd"><div class="con"id="adc" ></div><span id='closed'><i class="fas fa-times"></i></span></div>
	
 
	<div style="margin-top: 0" id="main">
		<div class="container-scroller">
			<!-- partial:partials/_horizontal-navbar.html -->
			
			<!--<div class="horizontal-menu">-->
				<?php echo @$header1; ?>
			<!--</div>-->

          <!-- pageloader  -->
          <div id="progress" class="waiting"></div>
          <!-- pageloader ends -->
                      
    <div class="search-f" id="search">
        <form action="" Method ="POST" id="formps">
          <div class="">
            <input type="varchar" class="form-control " name="query" id="search-input" placeholder="search fundraiser by name or category" aria-label="search" aria-describedby="search" onkeyup="checkSearch()">
            <button type="submit" class="border-none" name="submit"><i class="fas fa-search"></i></button>
          </div>
        </form> 
        <div id="kkkk" style="background-color: #ffffff;width: 100%"></div>
    </div>
			<!-- partial -->
		
			<?php 
				require_once'dbh.php';
				$con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
				$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				if(isset($_GET['fundraiserId'])) {
					$fid = htmlspecialchars($_GET['fundraiserId']);
					$ch = $con -> prepare("SELECT fundraiser_table.fundraiserId,fundraiser_table.fundraiserTitle,fundraiser_table.fundraiserEmail,fundraiser_table.youtubeLink,fundraiser_table.fundraiserBy,fundraiser_table.fundraiserFor,fundraiser_table.fundraiserType,fundraiser_table.fundraiserTitle,fundraiser_table.fundraiserStory,fundraiser_table.fundraiserUpdate,fundraiser_table.fundraiserCategory,fundraiser_table.fundraiserThumbnail,fundraiser_table.fundraiserGoal,fundraiser_table.fundraiserStatus,fundraiser_table.totalBitcoinDonations,fundraiser_table.bitcoinDonations,fundraiser_table.totaldonationsReceived,fundraiser_table.supportTipReceived,fundraiser_table.shortUrl,fundraiser_table.longString,fundraiser_table.totalLikes,fundraiser_table.totalShares,fundraiser_table.totalViews,fundraiser_table.totalFollowers,fundraiser_table.totalComments,fundraiser_table.totalDonations,count(donation_table.donatedBy) AS donatedBy FROM fundraiser_table LEFT JOIN donation_table ON fundraiser_table.fundraiserId = donation_table.fundraiserId WHERE fundraiser_table.fundraiserId = ? ORDER BY dateSubmitted DESC");
");
					$ch ->bindParam(1,$fid);
					$ch -> execute();

					if($ch -> execute() && $ch -> rowCount() > 0) {
						$s = $ch -> fetch(PDO::FETCH_ASSOC);
						
						@$fId = $s['fundraiserId'];
						@$fTitle = $s['fundraiserTitle'];
						@$fType = $s['fundraiserType'];
						@$fFor = $s['fundraiserFor'];
						@$fBy = $s['fundraiserBy'];
						@$dBy = $s['donatedBy'];
						@$fStory = $s['fundraiserStory'];
						@$fCateg = $s['fundraiserCategory'];
						@$fThumb = $s['fundraiserThumbnail'];
						@$fGoal = $s['fundraiserGoal'];
            @$youtubeLink = $s['youtubeLink'];
						@$ffGoal = number_format($s['fundraiserGoal']);
						@$fDonations = $s['fundraiserdonationsReceived'];
						$fSupportTip = $s['supportTipReceived'];
						$fTotalDonations = $s['totaldonationsReceived'];
						$fbtcDonations = $s['bitcoinDonations'];
						$fbtcTotalDonations = $s['totalBitcoinDonations'];
						@$fStatus = $s['fundraiserStatus'];
						@$fShares = $s['totalShares'];
						@$fViews = $s['totalViews'];
						@$fLikes = $s['totalLikes'];
						@$fFollowers = $s['totalFollowers'];
						@$ffShares = number_format($s['totalShares']);
						@$ffViews = number_format($s['totalViews']);
						@$ffLikes = number_format($s['totalLikes']);
						@$ffFollowers = number_format($s['totalFollowers']);
						@$dateSub = $s['dateSubmitted'];
						@$flUrl = $s['longString'];
            @$fbyy = strtolower(@$fBy);
            @$fbby = str_replace(' ','-',@$fbyy);
            @$ftitled = str_replace(' ','-',$fTitle);
						@$shortUrl = $s['shortUrl'];
						$se = $con -> prepare("SELECT uploadedDocument FROM documentuploads WHERE fundraiserId = ? ORDER BY time_uploaded DESC");
						$se -> bindParam(1,$fundraisaId);
						$se -> execute();
						$dc = $se -> fetch(PDO::FETCH_ASSOC);
							
						@$imgDo = $dc['uploadedDocument'];

						$ftitled = str_replace(" ",'-',$fTitle);
						$fcategd= str_replace("-",' ',$fCateg);

						if($fCateg == 'Rent-Food-Bills') {
							$fcateged = 'rent and bills';
						}

						if($fBy == $fFor) {
							$fFund = "<span class='hyurf'> ". @$fBy . "</span> is organizing this fundraiser";
						}else {
							$fFund = "<span class='hyurf'> ". @$fBy . "</span> is organizing this fundraiser onbehalf of <span class='hyurf'> ".@$fFor."'s </span>" .@$fcateged;
						}

						$shortStory = substr($fStory,0,320);

            if(isset($youtubeLink)) {
              $imgvidShow ="<iframe width='100%' height='100%' style='margin-top: 1.7rem' src='https://www.youtube.com/embed/$youtubeLink' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen id='iframeVd'></iframe>";
              $youtubevideoembedlist = "<img src='https://i3.ytimg.com/vi/$youtubeLink/0.jpg' class='iframeList' onclick='changeMe()' name='https://www.youtube.com/embed/$youtubeLink'>";
              }else {
                $youtubevideoembedlist = "";
                $imgvidShow = "<img src='".@$fThumb."' alt='' class='image-cover mt-4 pt-1 mb-3'>";
            }
            
						$longUrl = "https://fundreza.com/$fId/$ftitled/$flUrl";
						if($fDonations == "" || $fDonations == null) {
							$fiat = '$0';
						}else {
							$fiat = '$'.$fDonations;
						}if($fbtcDonations == "" || $fbtcDonations == null) {
							$btc = '$0';
						}else {
							$btc = '$'.$fbtcDonations;
						}if($fTotalDonations == "" || $fTotalDonations == null) {
							$fTotal = '$0';
							$ffTotal = '$0';
						}else {
							$fTotal = '$'.$fTotalDonations;
							$ffTotal = '$'.number_format($fTotalDonations);
						}
						
					}
				

					
					$if = $con -> prepare("SELECT uploadedDocument FROM documentuploads WHERE fundraiserId = ? ORDER BY time_uploaded DESC");
					$if -> bindParam(1,$fId);
					$if -> execute();
					if($if -> execute() && $if -> rowCount() > 0) {

						$i= $if -> fetchAll(PDO::FETCH_ASSOC);
						@$iid = @$i['uploadedDocument'];

						foreach($i as $limg) {
							$imga = $limg['uploadedDocument'];
							$mig = "<ul><li>$youtubevideoembedlist<img src='$imga' class='img-tiny' onerror.this=src='images/9.png'/></li></ul>";
						}
 						
					}

				}
				
			?>
		<!-- partial -->
			<div class="container-fluid page-body-wrapper ">
				<div class="main-panel">
					<div class="content-wrapper">
						
						<div class="main-row">
	 						<h1 class="text-dark ttt" ><?php echo @$fTitle; ?></h1>
							
							<div class="row" style='z-index: 0'>
								<div class="col-77" style='z-index: 0;position: relative'>
									
									<div style='position: relative'>
										<?php 
                      echo "<div class='image-thumb' style='z-index: 0;position: relative'>$imgvidShow</div>";
                      echo "<div class='mt-2'>";
                      if(isset($i)) {
                        if(isset($youtubevideoembedlist) && $youtubevideoembedlist != "") {
                          echo "<div class='liuma mt-2 bg-none' style='background: transparent; position: relative'><ul style='background: transparent'><li class='listimg none iframe-l' style='background: transparent'> <i class='fab fa-youtube ifr-icon' style='z-index: 99999'></i> $youtubevideoembedlist</li></ul></div>";
                        }
                        foreach(@$i as $limg) {
                          @$imga = @$limg['uploadedDocument'];
                          echo $mig = "<div class='liuma mt-2 bg-none' style='background: transparent'><ul style='background: transparent'><li class='listimg bg-none' style='background: transparent'><img src='$imga' name='$imga' class='img-tiny' onerror.this=src='images/9.png'/></li></ul></div>";
                        }
                      }
                      echo "<div class='end-float'></div>";
                      echo "</div>";
											
										?>
										
										<div class="tinylink" style='z-index:10'><?php echo "<a href='".@$shortUrl."' style='z-index: 10'> <i class='fas fa-link'></i> ". @$shortUrl." </a>"; ?></div>
										<div class="undefe">
											<?php echo "<span class='ereferve'><i class='fas fa-user-tag'></i></span> $fFund <img src='images/fundreza verify2.png' style='width: 8rem;height: 2.5rem'>";?>
										
                      <!-- Modal -->
                      <div class="mt-2">
                      <!-- Button trigger modal -->
                        <button type="button" class="btn btn-medium text-white"  style="background-color: #22a349" onclick="contactFundraiser()">
                            <i class="fas fa-envelope text-white"></i> Message Fundraiser
                        </button>
                        <!--Form with header-->

                        <form action="" method="post" id="sendf_mail">
                            <div class="card border-0 rounded-0 mt-5 pt-3">
                                <div class="card-header p-0">
                                    <div class="text-white text-center py-2" style="background-color: #22a349">
                                        <h3><i class="fa fa-envelope text-white"></i> Send Message To Fundraiser</h3>
                                    </div>
                                </div>
                                <div class="card-body p-3">

                                    <!--Body-->
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="donname" name="donname" placeholder="Your Name" required>
                                    </div>
                                    <div class="form-group">
										<input type="email" class="form-control" id="donemail" name="donemail" placeholder="your email" required>
                                    </div>

                                    <div class="form-group">
                                        <textarea class="form-control" placeholder="Message" name="donmessage" id="donmessage" required></textarea>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" value="Enviar" class="btn btn-md btn-block rounded-0 py-2 text-white" style="background-color: #22a349" onclick="sendFMessage()"> <i class="fas fa-paper-plane"></i> Send Message</button>
                                    </div>
									<div id="donstatus"></div>
                                </div>

                            </div>
                        </form>
                        <!--Form with header-->
                      </div>
                      <!-- Modal -->
                    </div>

									</div>

									<div class="bs-example">
										<ul class="nav nav-tabs">
											<li class="nav-item">
												<a href="#home" class="nav-link active" data-toggle="tab">Content</a>
											</li>
											<li class="nav-item">
												<?php 

													$ufc = $con -> prepare("SELECT fundraiserUpdate FROM fundraiserupdate_table WHERE fundraiserId = ? ORDER BY timestatus DESC");
													$ufc -> bindParam(1,$fId);
													$ufc -> execute();
													if($ufc -> execute() && $ufc -> rowCount() > 0) {
														$ucount = $ufc -> rowCount();
													}else {
														$ucount = '0';
													}
												?>
												<a href="#updates" class="nav-link" data-toggle="tab">Updates <span class='counts'><?php echo @$ucount;?></span></a>
											</li>
											<li class="nav-item">
												<a href="#comment-form-box" class="nav-link" data-toggle="tab">Comments <span class='counts'><?php $ucountc = new dbh(); $ucountc -> getTotalCommentsCount();?></span></a>
											</li>
										</ul>
										<div class="tab-content">
                      <div class="tab-pane bg-white show active" id="home">
												<h4 class="mt-2 text-capitalize">Fundraiser Content</h4>
												<div class="vvvid">
													<div class="fstory" id='short-st'>
														<?php echo @$shortStory; ?> <span class="tot">...</span>
													</div>
													<div class="fstory full-story" id='full-st'>
														<?php 
															echo @$fStory; 

															foreach($i as $limga) {
																$imgf = $limga['uploadedDocument'];
																echo $miga = "<div class='listimga'><img src='$imgf' class='fida' onerror.this=src='images/9.png'/></div>";
															}
														?> <span class="tot">...</span>
													</div>
													<div class="read">
														<div class="readmor" id="rmore">Read more...</div>
														<div class="readmor" id="rless">Read less...</div>	
													</div>
													<div class="vido">
														<?php echo @$vframe; ?>
													</div>
												</div>
												<div class="guranteenote">
													<h4><i class="fas fa-shield-alt"></i> Fundreza Guarrantee</h4>
													<div class="gnote">
														Only donations on our platform are protected by Fundreza Guarrantee
													</div>
												</div>
												<div class="cta">
													<div class="donatebtna"><a href="<?php echo "https://fundreza.com/d/$fiiid/$ftitled/$fbby"; ?>" class="font-weight-bold" style="font-weight: bold;font-size: 16px;"><button id="donateNow" style="font-weight: bold;font-size: 16px;"> <i class="fas fa-hand-holding-usd"></i> Donate </button></a></div>
												</div>

                        <!-- faq -->
                        <div class="panel-group" id="faqAccordion">
                          <h4 class="bg-none bg-transparent mx-auto m-3 text-center" style="color: #22a349">Frequently Asked Questions</h4>
                          <div class="panela panel-default ">
                              <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question0">
                                  <h4 class="panel-title">
                                      <a class="ing">Q: What is Lorem Ipsum <i class="fas fa-angle-down" style='color: #22a349'></i> </a>
                                </h4>
     
                              </div>
                              <div id="question0" class="panel-collapse collapse" style="height: 0px;">
                                  <div class="panel-body">
                                      <h5><span class="">Answer</span></h5>

                                      <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five  centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                          </p>
                                  </div>
                              </div>
                          </div>
                          <div class="panela panel-default ">
                              <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question1">
                                  <h4 class="panel-title">
                                      <a class="ing">Q: Why do we use it <i class="fas fa-angle-down" style='color: #22a349'></i> </a>
                                </h4>

                              </div>
                              <div id="question1" class="panel-collapse collapse" style="height: 0px;">
                                  <div class="panel-body">
                                      <h5><span class="">Answer</span></h5>

                                      <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                                  </div>
                              </div>
                          </div>
                          <div class="panela panel-default ">
                              <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question2">
                                  <h4 class="panel-title">
                                      <a class="ing">Q: Where does it come from <i class="fas fa-angle-down" style='color: #22a349'></i></a>
                                </h4>

                              </div>
                              <div id="question2" class="panel-collapse collapse" style="height: 0px;">
                                  <div class="panel-body">
                                      <h5><span class="">Answer</span></h5>

                                      <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
                                  </div>
                              </div>
                          </div>
                          <div class="panela panel-default ">
                              <div class="panel-heading accordion-toggle collapsed question-toggle" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question3">
                                  <h4 class="panel-title">
                                      <a class="ing">Q: Where can I get some <i class="fas fa-angle-down" style='color: #22a349'></i></a>
                                </h4>

                              </div>
                              <div id="question3" class="panel-collapse collapse" style="height: 0px;">
                                  <div class="panel-body">
                                      <h5><span class="">Answer</span></h5>

                                      <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. </p>
                                  </div>
                              </div>
                          </div>
                          
                      </div>
                          <!--/panel-group-->
                          <!-- faq -->
											</div>
									
											<div class="tab-pane bg-white" id="updates">
												<h4 class="mt-2">Fundraiser Updates</h4><div class="updte">
													<?php
													
														$uf = $con -> prepare("SELECT fundraiserUpdate FROM fundraiserupdate_table WHERE fundraiserId = ? ORDER BY timestatus DESC");
														$uf -> bindParam(1,$fId);
														$uf -> execute();
														if($uf -> execute() && $uf -> rowCount() > 0) {
									
															$u= $uf -> fetchAll(PDO::FETCH_ASSOC);
															
															foreach($u as $uf) {
																$updf = $uf['fundraiserUpdate'];
																echo $ug = "<div>$updf</div>";
															}
															
														}else {
															echo "<div>No fundraiser update found</div>";
														}
 
                            $postId = $fId;
													?>
												</div>
											</div>
											<div class="tab-pane bg-white" id="comment-form-box">
												<h4 class="mt-2">Comments shared on this fundraiser</h4>
                        <input type='text' value='<?php echo @$postId;?>' class='forminput' id='postId' hidden/>
												<div class="showcomments">
													<div class="sharetots font-weight-normal">
														<button class="comment_button"><a class="font-weight-normal">Share your thoughts on <?php require_once'dbh.php';require_once'config.php'; echo $fBy.' Fundaiser'; $totaltots = new dbh(); $totaltots -> getTotalComments(); ?></a></button> 
													</div>
													
													<div class='panel mt-2 pt-1' id='slidepanel <?php $par_code; ?>'>
														<div class='comment-error mt-2 mb-2' style="color: #22a349"></div>
														<form action='' method='post' class='comment-form' id='comments-form'>
															<div>
																<input type='text' value='<?php echo @$Ename?>' name='Ename' class='forminput' id='Ename' placeholder='Enter Name' required />
															</div>
															<div>
																<input type='text' value='<?php echo @$Email?>' name='Email' class='forminput' id='emaild' placeholder='Enter Email' required />
															</div>	
															<div class='pcode' name='<?php echo @$par_code?>'><textarea class='comments' id='comments'>Enter message</textarea></div>
															<div>
																<input type='submit'name='<?php echo @$par_code;?>'  value='Submit' class='submit_comment' style="color: #22a349" onclick = 'prevSubmit()' />
																<span class="comment-upload" onclick="file_explorer();"><i class="fas fa-paperclip" style="color: #22a349" name="uploadDocuments" onclick="file_explorer()"></i></span>
																<input type="file" id="selectfile" name="uploadDocuments" hidden>
															</div>
														</form>
													</div>
													<div class="rer">
														<?php @session_start(); require_once'dbh.php'; $eres = new dbh(); $eres -> showComments();?>
													</div>
												</div>
											</div>
										</div>
									</div>

								</div>
								<div class="col-55" style="">
									<div class="donate-det">
										<div class="cbtc">
											<div class="ibbtc"><div class="bgcj">Total Donations <span class="und"><strong><?php echo @$ffTotal; ?></strong></span></div></div>
											<div class='float'></div>
										</div>
										<div class="">
											<span style="color: #000000;font-size: 17px"><?php echo @$ffTotal; ?></span> <span class="font-weigh-normal" style="font-size: 16px;">raised of <span style="color: #000000;font-size: 17px;"><?php echo '$'.@$ffGoal; ?></span> goal
											<div class="dpbar"></div>
										</div>
										<div class="ctx">
											<div class="ibg"><div class="bgj"> <?php echo @$dBy; ?> <div class="und">donors</div></div></div>
											<div class="ibg"><div class="bgj"><?php echo @$ffShares; ?> <div class="und">shares</div></div></div>
											<div class="ibg"><div class="bgj"><?php echo @$ffFollowers; ?> <div class="und">followers</div></div></div>
										</div>
										<div class="cfbshare">
											<div class="sharebtn"> <a href="<?php echo "https://fundreza.com/share/share-with-family-and-friends/$fId"?>" style="font-weight: bold;font-size: 16px;"><button style="font-weight: bold;font-size: 16px;"  id="shareNow"><i class="fas fa-share"></i> Share </button></a></div>
											<div class="donatebtna"><a href="<?php echo "https://fundreza.com/d/$fiiid/$ftitled/$fbby"; ?>" style="font-weight: bold;font-size: 16px;"><button style="font-weight: bold;font-size: 16px;" id="donateNow"> <i class="fas fa-hand-holding-usd"></i> Donate </button></a></div>
										</div>
										<div class="ctxfd">

											<?php 
					
												require_once'dbh.php';

												$con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
												$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

												$chs = $con -> prepare("SELECT donatedBy,totaldonAmount,donation_time FROM donation_table WHERE fundraiserId =? LIMIT 8");
												$chs ->bindParam(1,$fiiid);
												$chs -> execute();
												if($chs -> execute()) {
													$rowas = $chs -> fetchAll(PDO::FETCH_ASSOC);
												}
											?>

											<?php $i = 1; ?>
											<?php foreach ($rowas as $row): $time = $row['donation_time'];
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
												$donationtime = "$sec seconds ago";
											}
											
											// Check for minutes
											else if($min <= 60) {
												if($min==1) {
													$donationtime = "one minute ago";
												}
												else {
													$donationtime = "$min minutes ago";
												}
											}
											
											// Check for hours
											else if($hrs <= 24) {
												if($hrs == 1) { 
													$donationtime = "an hour ago";
												}
												else {
													$donationtime = "$hrs hours ago";
												}
											}
											
											// Check for days
											else if($days <= 7) {
												if($days == 1) {
													$donationtime = "Yesterday";
												}
												else {
													$donationtime = "$days days ago";
												}
											}
											
											// Check for weeks
											else if($weeks <= 4.3) {
												if($weeks == 1) {
													$donationtime = "a week ago";
												}
												else {
													$donationtime = "$weeks weeks ago";
												}
											}
											
											// Check for months
											else if($mnths <= 12) {
												if($mnths == 1) {
													$donationtime = "a month ago";
												}
												else {
													$donationtime = "$mnths months ago";
												}
											}
											
											// Check for years
											else {
												if($yrs == 1) {
													$donationtime = "one year ago";
												}
												else {
													$donationtime = "$yrs years ago";
												}
											}
											?>   
												
											<div class="ibge">
												<div class="ereferv"><i class='fas fa-user-tag' style='color:#22a349;opacity:.6'></i></div> 
												<div class="hyurf"> <?php echo @$row['donatedBy'];?> <div class="goed"><span class="fft"><?php echo '$'.@$row['totaldonAmount'];?></span><span class="ffd"><?php echo @$donationtime;?></span></div></div>
											</div>
											<?php $i++; ?>
											<?php endforeach; ?>
										</div>
										<div class="donres">
											<div class="ssl">
                        <button class="btn bg-white" style="color: #22a349" onclick="showallDonors()"> <i class="fas fa-donate"></i> See all </button>
                      </div>
											<div class="ssr">
                        <button class="btn text-white" style="background-color: #22a349" onclick="showtopDonors()"><i class="far fa-star"></i> Top donations</button>
                      </div>
											<div class="float"></div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="others-c mt-5 pt-3">
								<?php $odas = new dbh(); $odas -> odasFundraisers();?>
							</div>
						</div>

            <div class="modala alldonors" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="alldonors" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content border-0" style="box-shadow: 1px 1px 1px 2px #f1f1f1">
                        <div class="modal-header">
                            <div class="container justify-content-center">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="input-group mb-3"> <input type="text" class="form-control input-text" name="<?php echo @$fBy;?>" id="donorsearch" placeholder="Search donors name,amount...." aria-label="Recipient's username" aria-describedby="basic-addon2">
                                            <div class="input-group-append"> <button class="btn bg-none" value="<?php echo @$ftitled;?>" name="<?php echo @$fiiid;?>" onclick="donSearch()" id="searchidbutton"><i class="fa fa-search"></i></button> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                        <?php 
                            
                            require_once'dbh.php';

                            $con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
                            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $chs = $con -> prepare("SELECT donatedBy,totaldonAmount,donation_time FROM donation_table WHERE fundraiserId =? ORDER BY donation_time DESC");
                            $chs ->bindParam(1,$fiiid);
                            $chs -> execute();
                            if($chs -> execute()) {
                              $rowas = $chs -> fetchAll(PDO::FETCH_ASSOC);
                            }
                          ?>

                          <?php $i = 1; ?>
                          <?php foreach ($rowas as $row): $time = $row['donation_time'];
                          $fBy = @$fByy;
                          $fffT = @$titledd;
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
                            $donationtime = "$sec seconds ago";
                          }
                          
                          // Check for minutes
                          else if($min <= 60) {
                            if($min==1) {
                              $donationtime = "one minute ago";
                            }
                            else {
                              $donationtime = "$min minutes ago";
                            }
                          }
                          
                          // Check for hours
                          else if($hrs <= 24) {
                            if($hrs == 1) { 
                              $donationtime = "an hour ago";
                            }
                            else {
                              $donationtime = "$hrs hours ago";
                            }
                          }
                          
                          // Check for days
                          else if($days <= 7) {
                            if($days == 1) {
                              $donationtime = "Yesterday";
                            }
                            else {
                              $donationtime = "$days days ago";
                            }
                          }
                          
                          // Check for weeks
                          else if($weeks <= 4.3) {
                            if($weeks == 1) {
                              $donationtime = "a week ago";
                            }
                            else {
                              $donationtime = "$weeks weeks ago";
                            }
                          }
                          
                          // Check for months
                          else if($mnths <= 12) {
                            if($mnths == 1) {
                              $donationtime = "a month ago";
                            }
                            else {
                              $donationtime = "$mnths months ago";
                            }
                          }
                          
                          // Check for years
                          else {
                            if($yrs == 1) {
                              $donationtime = "one year ago";
                            }
                            else {
                              $donationtime = "$yrs years ago";
                            }
                          }
                          ?>   
                          <div id="don-search-wrap">
                              <a href="<?php echo "https://fundreza.com/p/$fffT/$fBy/$fiiid";?>">
                                <div class="ibge">
                                  <div class="ereferv"><i class='fas fa-user-tag' style='color:#22a349;opacity:.6'></i></div> 
                                  <div class="hyurf"> <?php echo @$row['donatedBy'];?> <div class="goed"><span class="fft"><?php echo '$'.@$row['totaldonAmount'];?></span><span class="ffd"><?php echo @$donationtime;?></span></div></div>
                                </div>
                              </a>
                          </div>
                          <?php $i++; ?>
                          <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modala topdonors" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel1" id="topdonors" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content border-0" style="box-shadow: 1px 1px 1px 2px #f1f1f1">

                        <div class="modal-header">
                          <div class="container justify-content-center">
                              <div class="row">
                                  <div class="col-md-9">
                                      <div class="input-group mb-3"> <input type="text" class="form-control input-text" placeholder="Search top donors...." aria-label="Recipient's username" name="<?php echo @$fBy;?>" id="topdonorsearch" aria-describedby="basic-addon2">
                                          <div class="input-group-append"> <button class="btn bg-none" value="<?php echo @$ftitled;?>" name="<?php echo @$fiiid;?>" onclick="topdonSearch()" id="topidbutton"><i class="fa fa-search"></i></button> </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                        </div>
                        <div class="modal-body">
                        <?php 
					
                          require_once'dbh.php';

                          $con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
                          $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                          $chs = $con -> prepare("SELECT donatedBy,totaldonAmount,donation_time FROM donation_table WHERE fundraiserId = ? ORDER BY totaldonAmount DESC");
                          $chs ->bindParam(1,$fiiid);
                          $chs -> execute();
                          if($chs -> execute()) {
                            $rowas = $chs -> fetchAll(PDO::FETCH_ASSOC);
                          }
                        ?>

                        <?php $i = 1; ?>
                        <?php foreach ($rowas as $row): $time = $row['donation_time'];
                            $fBy = @$fByy;
                            $fffT = @$titledd;
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
                          $donationtime = "$sec seconds ago";
                        }
                        
                        // Check for minutes
                        else if($min <= 60) {
                          if($min==1) {
                            $donationtime = "one minute ago";
                          }
                          else {
                            $donationtime = "$min minutes ago";
                          }
                        }
                        
                        // Check for hours
                        else if($hrs <= 24) {
                          if($hrs == 1) { 
                            $donationtime = "an hour ago";
                          }
                          else {
                            $donationtime = "$hrs hours ago";
                          }
                        }
                        
                        // Check for days
                        else if($days <= 7) {
                          if($days == 1) {
                            $donationtime = "Yesterday";
                          }
                          else {
                            $donationtime = "$days days ago";
                          }
                        }
                        
                        // Check for weeks
                        else if($weeks <= 4.3) {
                          if($weeks == 1) {
                            $donationtime = "a week ago";
                          }
                          else {
                            $donationtime = "$weeks weeks ago";
                          }
                        }
                        
                        // Check for months
                        else if($mnths <= 12) {
                          if($mnths == 1) {
                            $donationtime = "a month ago";
                          }
                          else {
                            $donationtime = "$mnths months ago";
                          }
                        }
                        
                        // Check for years
                        else {
                          if($yrs == 1) {
                            $donationtime = "one year ago";
                          }
                          else {
                            $donationtime = "$yrs years ago";
                          }
                        }
                        ?>   
                        
                        <div id="topdon-search-wrap">
                              <a href="<?php echo "https://fundreza.com/p/$fffT/$fBy/$fiiid";?>">
                                <div class="ibge">
                                  <div class="ereferv"><i class='fas fa-user-tag' style='color:#22a349;opacity:.6'></i></div> 
                                  <div class="hyurf"> <?php echo @$row['donatedBy'];?> <div class="goed"><span class="fft"><?php echo '$'.@$row['totaldonAmount'];?></span><span class="ffd"><?php echo @$donationtime;?></span></div></div>
                                </div>
                              </a>
                          </div>
                        <?php $i++; ?>
                        <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>

					</div>
					<!-- content-wrapper ends -->
					<!-- partial:partials/_footer.html -->
					
                    
					<!-- partial -->
				</div>
				<!-- main-panel ends -->
			</div>

        </div>	
			<!-- page-body-wrapper ends -->
		</div>
			<!-- container-scroller -->
		<!-- base:js -->
    <!-- endinject -->
    <!-- plugin js for this page -->
    <!-- Custom js for this page-->
    
    <script src="javascript/front.js?n=1"></script>
	<script src="javascript/comments.js?n=1"></script>
	<script src="javascript/page.js?n=1"></script>
	<script src="javascript/progressloaders.js?n=1"></script>
	<script src="javascript/interactions.js?n=1"></script>
	<script type="text/javascript">
function copyTextToClipboard(text) {
    var textArea = document.createElement("textarea");
  
    // Place in top-left corner of screen regardless of scroll position.
    textArea.style.position = 'fixed';
    textArea.style.top = 0;
    textArea.style.left = 0;
  
    // Ensure it has a small width and height. Setting to 1px / 1em
    // doesn't work as this gives a negative w/h on some browsers.
    textArea.style.width = '2em';
    textArea.style.height = '2em';
  
    // We don't need padding, reducing the size if it does flash render.
    textArea.style.padding = 0;
  
    // Clean up any borders.
    textArea.style.border = 'none';
    textArea.style.outline = 'none';
    textArea.style.boxShadow = 'none';
  
    // Avoid flash of white box if rendered for any reason.
    textArea.style.background = 'transparent';
  
  
    textArea.value = text;
  
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
  
    try {
      var successful = document.execCommand('copy');
      var msg = successful ? 'successful' : 'unsuccessful';
    } catch (err) {
      console.log('Oops, unable to copy');
    }
  
    document.body.removeChild(textArea);
  }
  
  
//   var copyLink = document.getElementById("svflc").innerHTML;
  var copyButton = document.getElementById("copylink");

  copyButton.addEventListener('click', function(event) {
      var textToCopy;
      var longUrldiv = document.getElementById("svflc"),
        chkbx = document.getElementById("chklink");
        longUrl = document.getElementById("svflc").getAttribute("name"),
        divLink = document.getElementById("chklink").getAttribute("name");
        if(chkbx.checked) {
            longUrldiv.innerHTML = divLink;
            textToCopy = divLink;
        }else {
            longUrldiv.innerHTML = longUrl;
            textToCopy = longUrl;
        }
      copyButton.innerHTML = 'Copied';
    copyTextToClipboard(textToCopy);
  });


  
		</script>
	</div>
<?php echo @$footer;?>
	<div class='social-shares'>
	    <!--<div style="color: #22a439><small>Sharing is caring .... </smal></div>-->
	    <a href='https://facebook.com'><i class='fab fa-facebook fa-2x' style='color: #39569c;'></i></a> <a href='https://instagram.com'><i class='fab fa-instagram fa-2x'></i></a> <a href='https://twitter.com'><i class='fab fa-twitter fa-2x'></i></a> <a href='https://wa.me'><i class='fab fa-whatsapp fa-2x'></i></a></div>		
  </body>
</html>                    