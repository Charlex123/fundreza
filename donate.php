<?php
ob_start();
session_start();
require_once'dbh.php';
require_once'config.php';
include'footer.php';
include'header1.php';

@$_SESSION['currentpage'] = $_SERVER['REQUEST_URI'];
strip_tags(@$_SESSION['currentpage']);

$client  = @$_SERVER['HTTP_CLIENT_IP'];
$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
$remote  = @$_SERVER['REMOTE_ADDR'];
$result  = array('country'=>'', 'city'=>'');
if(filter_var($client, FILTER_VALIDATE_IP)){
    $ip = $client;
}elseif(filter_var($forward, FILTER_VALIDATE_IP)){
    $ip = $forward;
}else{
    $ip = $remote;
}
$geoDetails = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));

$userCountry = $geoDetails['geoplugin_countryName'];
$userCountryCurCode = $geoDetails['geoplugin_currencyCode'];
$countryCurSymbol = $geoDetails['geoplugin_currencySymbol'];
$countryflag = $geoDetails['geoplugin_countryCode'];
$countryFlg = strtolower($countryflag);
$countryFlag = $countryFlg.'.png';

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
	$fftit = htmlspecialchars($_GET['fundraiserTitle']);
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
  <base href="https://fundreza.com/">
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
    
	<!-- fontawesome -->
	<link rel="stylesheet" type='text/css' href="fontawesome/fontawesomefiles/css/fontawesome.min.css">
	<link rel="stylesheet" type='text/css' href="fontawesome/fontawesomefiles/css/all.min.css">
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<script lang="javascript" type="text/javascript" src="fontawesome/fontawesomefiles/js/fontawesome.min.js"></script>
	<script lang="javascript" type="text/javascript" src="fontawesome/fontawesomefiles/js/all.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
	
	<!-- inject:css -->
	<link rel="stylesheet" href="css/style.css?n=1">
	<link rel="stylesheet" href="css/customize.css?n=1">
	<link rel="stylesheet" href="css/ncustomize.css?n=1">
	<link rel="stylesheet" href="css/pageloaders.css?n=1">
    <link rel="stylesheet" href="css/comments.css?n=1">
	<link rel="stylesheet" href="css/page.css?n=1">
  <script type="text/javascript" src="javascript/ajax.js"></script>
    <!-- endinject -->
    <link rel="shortcut icon" href="images/favicon.png" />
    <style type="text/css">
    	body {
		background-color: #ffffff !important;font-family: 'PT Sans';
		width: 100%;margin: 0;padding: 0;color: gray;
		}
		.main-panel {
		/* background-color: #ffffff !important;color: gray;width: 100%;margin: 1rem auto auto auto; */
		}
		.fccd {
			width: 8rem;max-width: 8rem;margin-right: 2rem;float: left;
			height: 5rem;max-height: 5rem;border-radius: 4px;
		}
	</style>
  </head>
  <body>

  <div class="overlayy" id="overlayy"></div>

 
	<div id="main">
		<div class="container-scroller bg-white">
			<!-- partial:partials/_horizontal-navbar.html -->
			
			 <!--<div class="horizontal-menu"> -->
				<?php echo @$header1 ;?>
			 <!--</div> -->
			<!-- partial -->

            <!-- pageloader  -->
            <div id="progress" class="waiting"></div>
            <!-- pageloader ends -->

			<?php 
				require_once'dbh.php';
				$con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
				$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				if(isset($_GET['fundraiserId'])) {
					$fid = htmlspecialchars($_GET['fundraiserId']);
					$ch = $con -> prepare("SELECT * FROM fundraiser_table WHERE fundraiserId = ?");
					$ch ->bindParam(1,$fid);
					$ch -> execute();

					if($ch -> execute() && $ch -> rowCount() > 0) {
						$s = $ch -> fetch(PDO::FETCH_ASSOC);
						@$fId = $s['fundraiserId'];
						@$fTitle = $s['fundraiserTitle'];
						@$fType = $s['fundraiserType'];
						@$fFor = $s['fundraiserFor'];
						@$fBy = $s['fundraiserBy'];
						@$fStory = $s['fundraiserStory'];
						@$fCateg = $s['fundraiserCategory'];
						@$fThumb = $s['fundraiserThumbnail'];
						@$fGoal = $s['fundraiserGoal'];
						$fDonations = $s['donationsReceived'];
						$fSupportTipp = $s['supportTipReceived'];
						$fTotalDonations = $s['totaldonationsReceived'];
						$fbtcDonations = $s['bitcoinDonations'];
						$fbtcTotalDonations = $s['totalBitcoinDonations'];
						@$fStatus = $s['fundraiserStatus'];
						@$fShares = $s['totalShares'];
						@$fViews = $s['totalViews'];
						@$fLikes = $s['totalLikes'];
						@$fFollowers = $s['totalFollowers'];
						@$dateSub = $s['dateSubmitted'];
						@$flUrl = $s['longString'];
                        @$fbyy = strtolower(@$fBy);
                        @$fbby = str_replace(' ','-',@$fbyy);
						
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

						$shortUrl = "https://fundraiser.com/$fId";
						$longUrl = "https://fundraiser.com/$fId/$ftitled/$flUrl";
						if($fTotalDonations == "" || $fTotalDonations == null) {
							$fTotal = '$0';
							$ffTotal = '$0';
						}else {
							$fTotal = '$'.$fTotalDonations;
							$ffTotal = '$'.number_format($fTotalDonations);
						}
						
						if($fSupportTipp == "" || $fSupportTipp == null) {
							$fSupportTip = '$0';
							$ffSupportTip = '$0';
						}else {
							$fSupportTip = '$'.$fSupportTipp;
							$ffSupportTip = '$'.number_format($fSupportTipp);
						}

						if($fDonations == "" || $fDonations == null) {
							$fDonations = '$0';
							$ffDonations = '$0';
						}else {
							$fDonations = '$'.$fDonations;
							$ffDonations = '$'.number_format($fDonations);
						}
						
					}
					
					$dType = "video";
					$vf = $con -> prepare("SELECT uploadedDocument FROM documentuploads WHERE fundraiserId = ? AND documentType = ? ORDER BY time_uploaded DESC");
					$vf -> bindParam(1,$fId);
					$vf -> bindParam(2,$dType);
					$vf -> execute();
					if($vf -> execute() && $vf -> rowCount() > 0) {

						$v= $vf -> fetch(PDO::FETCH_ASSOC);
						@$vid = $v['uploadedDocument'];

						$vframe = "<video src='$vid' controls></video>";
					}

					$if = $con -> prepare("SELECT uploadedDocument FROM documentuploads WHERE fundraiserId = ? ORDER BY time_uploaded DESC");
					$if -> bindParam(1,$fId);
					$if -> execute();
					if($if -> execute() && $if -> rowCount() > 0) {

						$i= $if -> fetchAll(PDO::FETCH_ASSOC);
						@$iid = $i['uploadedDocument'];

						// foreach($i as $limg) {
						// 	$imga = $limg['uploadedDocument'];
						// 	$mig = "<ul><li><img src='$imga' class='img-tiny' onerror.this=src='images/9.png'/></li></ul>";
						// }
 						
					}

				}
			?>
		<!-- partial -->
			<div class="container-fluid page-body-wrapper ">
				<div class="main-panel">
					<div class="content-wrapper">
						
						<div class="main-row mt-0">
	 						<div class="row">
								<div class="col-77">
									<div class="ivx">
										<div class="return font-weight-normal">
											<?php echo "<a href='https://fundreza.com/p/$ftitled/$fbby/$fId' class='font-weight-lighter'> <i class='fas fa-angle-left'></i> return to fundraiser</a>";?>
										</div>
										<div class="fundese"> 
											<div class="dt">
												<?php echo "<img src='$fThumb' alt=' class='fccd' style='width: 6rem;max-width: 6rem;margin-right: 2rem;float: left;height: 5rem;max-height: 5rem;border-radius: 4px;'>";?>
												<div class="ggc">You're supporting <span class="eer font-weight-normal text-capitalize" style="font-weight: 500;font-size: 16px;color: #000000;"><?php echo @$fTitle;?></span></div>
											</div>
											<div class="ddv">Your donations will  benefit <span class="vcf text-capitalize"><?php echo @$fFor;?></span></div><div class="float"></div>
										</div>
										<div class="formddc">
											<form action="" method="POST" class="donsubmit" id="currency-form">
												<div class="form-group">
													<label for="">Enter Donation Amount</label>
													<div class="input-group mb-3 mt-3">
                           <div class="input-group-prepend" style="margin: .78rem 0 0 0;font-size: 20px">
                              <span class="input-group-text rounded" id="inputGroup-sizing-default" style="background-color: #22a349;color: #ffffff;font-size: 20px"> <?php echo @$countryCurSymbol;?> </span>
                           </div>
                           <input type="text" name="currency_symbol" id="currency_symbol" value="<?php echo @$countryCurSymbol;?>" hidden>
                           <input type="text" name="from_currency" id="from_currency" value="GBP" hidden>
                              <input type="text" name="to_currency" id="to_currency" value="<?php echo @$userCountryCurCode;?>" hidden>
                           <input type="varchar" class="donamt form-control" name="amount" id="amount" aria-label="Default" style="font-size: 20px" onmouseout = "commaSeparateNumber()">
                           <div class="input-group-append" style="margin: .78rem 0 0 0">
                             <span class="input-group-text rounded" id="inputGroup-sizing-default" style="background-color: #22a349;color: #ffffff;font-size: 20px">.00</span>
                           </div>
                         </div>
                         <small id="terror" style="color: red"></small>
                         <div class="">
                             <div id="converted_amount" style="color: #22a349"></div>
                           <div id="converted_rate" style="color: #22a349"></div>
                           <div class="form-group">
                             <button type="submit" name="convert" id="convert" class="btn btn-sm rounded p-2 font-weight-normal" style="background-color: #22a349;color: #ffffff">Check Current Exchange Rate</button>
                           </div>
                         </div>
												</div>
												<div class="tipxcv font-weight-normal">
													<h3 style="font-weight: 500;color: #000000">Support Us To Help Others</h3>
													<div class="sdf">
														Fundreza don't charge fundraisers any fee, our services are completely 100% free and will continue to be free.
														<span class="bvc">Thanks to heart warmimg donors who will leave an optional amount here <i class="fas fa-praying-hands" style="color:#22a349"></i></span>

														<div class="ctipc">
															<div class="ctip">Support Us (<span class="opt"> <i class="fas fa-hands-helping" style="color: #22a349"></i> optional</span>)</div>
															<?php @$amtCalc5 = '<span id="amtcalc5" style=""></span>';?>
															<div class="ctipf"  id="ctipf">
																<select name="" id="setTip" class="setip rounded form-control" onchange="selectTip('setTip')">
																	<option value="">select tip</option>
																	<option value="5" id="p5">5% </option>
																	<option value="10" id="p10">10% </option>
																	<option value="15" id="p15">15% </option>
																	<option value="20" id="p20">20% </option>
																	<option value="25" id="p25">25% </option>
																	<option value="other">Other</option>
																</select>
																<div class="sp-input" id="sput">
																	<div class="input-group mb-3 mt-3">
                                    <div class="input-group-prepend" style="margin: .78rem 0 .78rem 0">
                                      <span class="input-group-text rounded" id="spanCur" style="background-color: #22a349;color: #ffffff;font-size: 20px"> <?php echo @$countryCurSymbol;?> </span>
                                    </div>
                                    <input type="varchar" value="" id="tipamt" class="donamt" onmouseout="commaSeparateNumber()" required style="font-size: 20px">
                                    <div class="input-group-append" style="margin: .78rem 0 .78rem 0">
                                      <span class="input-group-text rounded" id="inputGroup-sizing-default" style="background-color: #22a349;color: #ffffff;font-size: 20px">.00</span>
                                    </div>
                                  </div>
                                </div>
																<div class="tiper" id='tiperr'></div>
															</div>
														</div>
														<div class="contdon">
															<div class="dpb" id="dpb"> CONTINUE <i class="fas fa-angle-right"></i></div>
															<div class="spb" id="spb">
																<h4>Payment Methods</h4>
                                <div class="form-group">
                                  <input type="checkbox" id="cc-pay" name="cc-pay" value="" onchange="ccPay()">
                                  <label for="" class="cclab"> Donate With Credit/Debit Card</label>
                                </div>
                                <div class="form-group">
                                  <input type="checkbox" id="btc-pay" name="cc-btc" value="" onchange="btcPay()">
                                  <label for="" class="btclab"> Donate With Bitcoin</label>
                                </div>
                                <!-- <div class="show-f for"> -->
                                <div class="cc-det" id="cc-det">
                                    <div class="padding">
                                            <div class="form-group">
                                                <input type="checkbox" id="hide-det" name="hideDetails" value="hide" onchange="hideDet()">
                                                <label for="" class="cclab"> <small> <em> Hide Donation Details </em></small> </label>
                                            </div>
                                            <div class="donor-details" id="donor-det">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text rounded" style="background: #22a349;color: white" id="basic-addon1">First Name</span>
                                                    </div>
                                                    <input type="text" class="form-control" name="fname" id="f-name" value="<?php #echo @$fn;?>" placeholder="First name" aria-label="First name" aria-describedby="basic-addon1">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text text-white rounded" style="background: #22a349" id="basic-addon1">Last Name</span>
                                                    </div>
                                                    <input type="text" class="form-control" name="lname" id="l-name" value="<?php #echo @$ln;?>" placeholder="Last name" aria-label="Last name" aria-describedby="basic-addon1">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text rounded" style="background: #22a349; color: white"  id="basic-addon2">Email</span>
                                                    </div>
                                                    <input type="text" class="form-control" name="email" id="donoremail"  value="<?php #echo @$Eemail;?>" placeholder="Email" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                </div>
                                            </div>
                                            <div class="form-submit">
												<script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
                                                <button type="submit" name="donateNow" onclick="donate()" id="donate-Now" class="form-control" style="background: #22a349;color: #ffffff;border-radius: 4px;"> <i class='fas fa-shield-alt'></i> Donate Securely</button>
                                            </div>
											<!-- <script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
												<button type="button" onClick="payWithRave()">Pay Now</button> -->
											</form>

                                    </div>
                                </div>

                                <div class="btc-det" id="btc-det">
                                    <small class="mx-auto text-center p-2 rounded" style="box-shadow: 1px 1px 1px 2px #f1f1f1;color: #22a349">Crypto Donations is in Beta Stage <b>Coming Soon</b></small>
                                  <!--<div class="form-group">-->
                                  <!--  <label for="">Name of donor</label>-->
                                  <!--  <input type="text" class="form-control" name="donorName" placeholder="name">-->
                                  <!--</div>-->
                                  <!--<div class="form-group">-->
                                  <!--  <label for="">Wallet Address</label>-->
                                  <!--  <input type="text" class="form-control" name="walletAddress" placeholder="e.g 3FZbgi29cpjq2GjdwV8eyHuJJnkLtktZc5">-->
                                  <!--</div>-->
                                  <!--<div class="form-group">-->
                                  <!--  <input type="submit" value="Donate With Crypto" style="background-color: #22a349" class="btn btn-lg text-white" onclick="preventSubmit()">-->
                                  <!--</div>-->
                                </div>
																<!-- </div> -->
															</div>
															<div class="pro">
																This donation is protected by reCAPTCHA the Google <a href="http://"> privacy policy</a> and <a href="">terms</a> apply 
															</div>
														</div>
														<div class="fundese">
															<div class="dt">
																<img src="images/favicon.png" aslt="" class="fcc">
																<div class="ggc">Fundreza Guarrantee</div>
															</div>
															<div class="ddv">In the rare cae when something isn't right, we will wrk with you to determine if miuse has occurred</div>
														</div>
													</div>
												</div>
											</form>
										</div>
										
									</div>
								</div>
								<div class="col-d55">
									<div class="dondet">
										<h4 style="font-weight: 500;color: #000000">Your donations</h4>
										<ul>
											<li>
												<div class="cct text-left">Your donation &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div class="sst text-right"><?php echo @$ffDonations.'.00';?></div>
											</li>
											<li>
												<div class="cct text-left">Fundreza Support &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div class="sst"><?php echo @$ffSupportTip.'.00';?></div>
											</li>
											<li class="ttf">
												<div class="cct">Total today &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><div class="sst"><?php echo $ffTotal.'.00';?></div>
											</li>
										</ul>
									</div>
									<div class="hhh">
										<div class="eer"><?php echo @$ftitle;?></div>
										<div class="createdate">
											Created: <?php echo date('l jS F Y | h:i:s A',$dateSub);?>
										</div>
									</div>
									<div class="ctxfd">
										<div class="ibgff">
											<div class="erefer"><i class='fas fa-user-tag'></i></div> 
											<div class="hyu"> <span id="fundrezaBy" name="<?php echo $fId;?>"><?php echo @ucwords($fBy);?></span> <div class="goed"><span class="fft font-weight-normal"> Organizer</span></div></div>
										</div>
										<div class="ibgff">
											<div class="erefer"><i class='fas fa-user-tag'></i></div> 
											<div class="hyu"> <span id="fundrezaFor"><?php echo @ucwords($fFor);?></span> <div class="goed"><span class="fft font-weight-normal">Beneficiary</span></div></div>
										</div>
									</div>
									<div class="recv">
										<?php if($fType == "non-profit") {?>
										The beneficiary <?php echo @$fFor;?> will receive this donation through PAYPAY CHARITY FUND FOUNDATION. This donation is protected by Fundreza GUARAANTEE
										<?php }else if($fType == "individual") {?>
											The beneficiary <?php echo @$fFor;?> will receive this donation through directly. This donation is protected by Fundreza GUARAANTEE
										<?php }?>
									</div>
									<div class="h-gua">
										Fundreza guarantors
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
			<!-- page-body-wrapper ends -->
		</div>
			<!-- container-scroller -->
		<!-- base:js -->
    <!-- endinject -->
    <!-- plugin js for this page -->
    <!-- Custom js for this page-->
	<script src="javascript/front.js?n=1"></script>
	<script src="javascript/donate.js?n=1"></script>
	<script src="javascript/interactions.js?n=1"></script>
	<script src="javascript/progressloaders.js?n=1"></script>
  <script src="javascript/jquery-validation/jquery.validate.min.js" type="text/javascript"></script>
    <script src="js/dashboard.js"></script>
		<script type="text/javascript">

// const API_publicKey = "FLWPUBK-55c9eec23d18758b12d7738a94f35f1d-X";
// const donoremail = document.getElementById("donoremail").value;
// const donorfname = document.getElementById("f-name").value;
// const donorlname = document.getElementById("l-name").value;
// const amount = document.getElementById("amount").value;
// function payWithRave() {
// 	var x = getpaidSetup({
// 		PBFPubKey: API_publicKey,
// 		customer_email: donoremail,
// 		amount: document.getElementById("donoremail").value,
// 		customer_phone: "234099940409",
// 		currency: "NGN",
// 		txref: "rave-123456",
// 		meta: [{
// 			metaname: "flightID",
// 			metavalue: "AP1234"
// 		}],
// 		onclose: function() {},
// 		callback: function(response) {
// 			var txref = response.data.txRef; // collect txRef returned and pass to a                    server page to complete status check.
// 			console.log("This is the response returned after a charge", response);
// 			if (
// 				response.data.chargeResponseCode == "00" ||
// 				response.data.chargeResponseCode == "0"
// 			) {
// 				// redirect to a success page
// 			} else {
// 				// redirect to a failure page.
// 			}

// 			x.close(); // use this to close the modal immediately after payment.
// 		}
// 	});
// }

		// function toggleSidebar(ref){
		// 	document.getElementById("sidebar").classList.toggle('active');
		// 	}
		// 	const paymentForm = document.getElementById('paymentForm');

        //     paymentForm.addEventListener("submit", payWithPaystack, false);
            
        //     function payWithPaystack(e) {
            
        //       e.preventDefault();
            
        //       let handler = PaystackPop.setup({
            
        //         key: 'pk_live_5b42b34095574b2a4f4dff7502be7612055d211e', // Replace with your public key
            
        //         email: document.getElementById("email-address").value,
        //         fname: document.getElementById("first-name").value,
        //         lname: document.getElementById("last-name").value,
        //         currency: "NGN",
        //         amount: document.getElementById("amount").value * 100,
            
        //         ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
            
        //         // label: "Optional string that replaces customer email"
            
        //         onClose: function(){
        //         window.location.reload(true);
        //         },
            
        //         callback: function(response){
            
        //           let message = 'Payment complete! Reference: ' + response.reference;
        //             window.location = "https://waep.africa/verify_transaction.php?reference=" + response.reference;
        //         }
            
        //       });
            
        //       handler.openIframe();
            
        //     }
	//</script>
	</div>
	<?php echo $footer;?>
  </body>
</html>.
