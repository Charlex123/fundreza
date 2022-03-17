<?php
ob_start();
session_start();
require_once'dbh.php';
require_once'config.php';

@$_SESSION['currentpage'] = $_SERVER['REQUEST_URI'];
strip_tags(@$_SESSION['currentpage']);

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
	<title> Bitcoin News Today | Latest Bitcoin News Today </title>
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
	<script lang="javascript" type="text/javascript" src="ckeditor5/ckeditor.js"></script>
	<script lang="javascript" type="text/javascript" src="ckeditor5/ckeditor.js.map"></script>
	<script lang="javascript" type="text/javascript" src="ckeditor5/vendor.js"></script>
	<script src="https://ckeditor.com/apps/ckfinder/3.5.0/ckfinder.js"></script>
	<script lang="javascript" type="text/javascript" src="ckeditor5/vendor.js.map"></script>
	<script lang="javascript" type="text/javascript" src="ckeditor5/ckeditor.js"></script>
	
    <!-- inject:css -->

	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/customize.css">
	<script src="https://cdn.ckeditor.com/ckeditor5/27.0.0/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="css/empower.css">
	<link type="text/css" href="sample/css/sample.css" rel="stylesheet" media="screen" />
    <!-- endinject -->
	<style>
	textarea {
		width: 100%;border: 1px solid #f1f1f1;border-radius: 4px;height: 10rem;max-height: inherit;
	}
	</style>
    <link rel="shortcut icon" href="images/favicon.png" />
  </head>
  <body>

  <!-- sidebar nav -->

		<!-- partial -->
			<div class="container-fluid page-body-wrapper" style="background:#001737;">
				<div class="main-panel text-center" style="background:#001737;">
					<h1 class="text-center">
                        SEND EMAIL
                    </h1>
                    
                    <!-- Edit Profile Modal -->
                
                    <div class="share-talent-upload-form">
                        <form action='' method='POST' id="post-submit-form" enctype="multipart/form-data">
                        
							

							<div class="form-group" id="">
								<label for="recipient-name" class="col-form-label"> Article1 Title </label>
								<input type="text" class="form-control" id="aTitle1" name='aTitle1' value = "<?php echo @$_POST['aTitle1']?>" placeholder='enter post title'>
							</div>
							<div class="form-group" id="">
								<label for="recipient-name" class="col-form-label"> Article2 Title </label>
								<input type="text" class="form-control" id="" name='aTitle2' value = "<?php echo @$_POST['aTitle2']?>" placeholder='enter post title'>
							</div>
							<div class="form-group" id="">
								<label for="recipient-name" class="col-form-label"> Article3 Title </label>
								<input type="text" class="form-control" id="" name='aTitle3' value = "<?php echo @$_POST['aTitle3']?>" placeholder='enter post title'>
							</div>
							<div class="form-group" id="">
								<label for="recipient-name" class="col-form-label"> Article4 Title </label>
								<input type="text" class="form-control" id="" name='aTitle4' value = "<?php echo @$_POST['aTitle4']?>" placeholder='enter post title'>
							</div>
							<div class="form-group" id="">
								<label for="recipient-name" class="col-form-label"> Article5 Title </label>
								<input type="text" class="form-control" id="" name='aTitle5' value = "<?php echo @$_POST['aTitle5']?>" placeholder='enter post title'>
							</div>
							<div class="form-group" id="">
								<label for="recipient-name" class="col-form-label"> Article6 Title </label>
								<input type="text" class="form-control" id="" name='aTitle6' value = "<?php echo @$_POST['aTitle6']?>" placeholder='enter post title'>
							</div>
							<div class="form-group" id="">
								<label for="recipient-name" class="col-form-label"> Article7 Title </label>
								<input type="text" class="form-control" id="" name='aTitle7' value = "<?php echo @$_POST['aTitle7']?>" placeholder='enter post title'>
							</div>

							<div class="form-group" id="">
								<label for="recipient-name" class="col-form-label"> Article1 Link </label>
								<input type="text" class="form-control" id="" name='aLink1' value = "<?php echo @$_POST['aLink1']?>" placeholder='enter post upload'>
							</div>
							<div class="form-group" id="">
								<label for="recipient-name" class="col-form-label"> Article2 Link </label>
								<input type="text" class="form-control" id="" name='aLink2' value = "<?php echo @$_POST['aLink2']?>" placeholder='enter post upload'>
							</div>
							<div class="form-group" id="">
								<label for="recipient-name" class="col-form-label"> Article3 Link </label>
								<input type="text" class="form-control" id="" name='aLink3' value = "<?php echo @$_POST['aLink3']?>" placeholder='enter post upload'>
							</div>
							<div class="form-group" id="">
								<label for="recipient-name" class="col-form-label"> Article4 Link </label>
								<input type="text" class="form-control" id="" name='aLink4' value = "<?php echo @$_POST['aLink4']?>" placeholder='enter post upload'>
							</div>
							<div class="form-group" id="">
								<label for="recipient-name" class="col-form-label"> Article5 Link </label>
								<input type="text" class="form-control" id="" name='aLink5' value = "<?php echo @$_POST['aLink5']?>" placeholder='enter post upload'>
							</div>
							<div class="form-group" id="">
								<label for="recipient-name" class="col-form-label"> Article6 Link </label>
								<input type="text" class="form-control" id="" name='aLink6' value = "<?php echo @$_POST['aLink6']?>" placeholder='enter post upload'>
							</div>
							<div class="form-group" id="">
								<label for="recipient-name" class="col-form-label"> Articl7 Link </label>
								<input type="text" class="form-control" id="" name='aLink7' value = "<?php echo @$_POST['aLink7']?>" placeholder='enter post upload'>
							</div>
							<div class="form-group" id="">
								<label for="recipient-name" class="col-form-label"> Receivers Email Address </label>
								<input type="text" class="form-control" id="postCategory" name='rEmail' value = "<?php echo @$_POST['postCategory']?>" placeholder='enter post category'>
							</div>

							<div class="form-group" id="">
								<label for="recipient-name" class="col-form-label"> Article Link </label>
								<input type="text" class="form-control" id="" name='' value = "<?php echo @$_POST['']?>" placeholder='enter post upload'>
							</div>
							
							<div class="centered">
								<label for="recipient-name" class="col-form-label text-left"> Post Content </label><div style="clear:both"></div>
								<textarea name="postContent"></textarea>
							</div>
							<div class="centered">
								<label for="recipient-name" class="col-form-label text-left"> Post Content </label><div style="clear:both"></div>
								<textarea name="postContent"></textarea>
							</div>
							<div class="centered">
								<label for="recipient-name" class="col-form-label text-left"> Post Content </label><div style="clear:both"></div>
								<textarea name="postContent"></textarea>
							</div>
							<div class="centered">
								<label for="recipient-name" class="col-form-label text-left"> Post Content </label><div style="clear:both"></div>
								<textarea name="postContent"></textarea>
							</div>
							<div class="centered">
								<label for="recipient-name" class="col-form-label text-left"> Post Content </label><div style="clear:both"></div>
								<textarea name="postContent"></textarea>
							</div>
							<div class="centered">
								<label for="recipient-name" class="col-form-label text-left"> Post Content </label><div style="clear:both"></div>
								<textarea name="postContent"></textarea>
							</div>
							<div class="centered">
								<label for="recipient-name" class="col-form-label text-left"> Post Content </label><div style="clear:both"></div>
								<textarea name="postContent"></textarea>
							</div>
							
							<div class="form-group text-center mt-5 mb-5" id='sub-form'>
								<button type="submit" name="submit_account" class="btn btn-md" id='submit_account' > Submit </button> <button type="reset" name="reset" class="btn btn-md bg-danger ml-5" id='cancel'>Cancel </button>
								<div><h3 id='status2'></h3></div>
							</div>

							<div class="svg-animate" id="svg-down-arrow">
								<svg class="arrows">
									<path class="a1" d="M0 0 L30 32 L60 0"></path>
									<path class="a2" d="M0 20 L30 52 L60 20"></path>
									<path class="a3" d="M0 40 L30 72 L60 40"></path>
								</svg>
							</div>

							<div class="form-group" id="upload-form">
								<div class="form-group" id="business-plan">
									
									<label for="recipient-name" class="col-form-label"> Upload Images and Videos For Your Posts <span class="reqd"> * </span> </label>
									
								</div>
								<div style="clear:both"></div>
								
								<div id="drop_file_zone" >
									<div id="drag_upload_file">
										<input type="file" id="selectfile" name="uploadDocuments">
									</div>
								</div>
								<div class="dont-close">
									<h1>IMPORTANT!!!: Dont close this page until you have uploaded all your documents</h1>
								</div>
								
							</div>
							
                        </form>
                    </div>
                    
                            
                <!-- Edit Profile Modal Ends -->

					<!-- partial -->
				</div>
				<!-- main-panel ends -->
			</div>
			<!-- page-body-wrapper ends -->
		</div>
			<!-- container-scroller -->
		
		
	</div>
  </body>
</html>