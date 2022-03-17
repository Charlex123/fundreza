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

$header1 = "
<!-- Navbar -->
<div class='up-p bg-white'>
  <nav class='navbar navbar-expand-lg bg-white'>
				<a class='navbar-brand' href='https://fundreza.com'><img src='images/fundrezalogo.png' alt='' class='nav-logo'></a>
  <button class='navbar-toggler' type='button' onclick='toggleNav()'>
    <span class='navbar-toggler-icon'><i class='fas fa-bars text-secondary'></i></span>
  </button>

				<div class='collapse navbar-collapse bg-white' id='navbarSupportedContent'>
					<ul class='navbar-nav mr-auto'>
					<li class='nav-item'>
						<div class='search-dp'>
							<a class='sear' style='color: #888688' onclick='displaySearch()'> Search <i class='fas fa-search'></i></a>
						</div>
					</li>
					</ul>

					<ul class='navbar-nav ml-auto'>
						<li class='nav-item '>
						<a href='https://fundreza.com/redirect' class='nav-link nfa'> <i class='fas fa-donate'></i> Already have account? sign in </a>
						</li>  
						<li class='nav-item'>
                          <a href='https://m.me/fundreza' class='nav-link chat text-success'> <i class='fab fa-facebook-messenger'></i> Chat Us </a>
                        </li>  
					</ul>
					
					</div>
				</nav>
</div>
  <!-- /.navbar -->
  ";