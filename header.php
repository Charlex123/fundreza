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

$header = "
<!-- Navbar -->
<div class='up-p'>
  <nav class='navbar navbar-expand-lg'>
  <a class='navbar-brand' href='https://fundreza.com'><img src='images/fundrezalogo.png' alt='' class='nav-logo'></a>
  <button class='navbar-toggler' type='button' onclick='toggleNav()'>
    <span class='navbar-toggler-icon'><i class='fas fa-bars text-secondary'></i></span>
  </button>

  <div class='collapse navbar-collapse' id='navbarSupportedContent'>
    <ul class='navbar-nav mr-auto'>
      <li class='nav-item'>
          <div class='search-dp' onclick='displaySearch()'>
            <a class='sear' style='color: #888688'> Search <i class='fas fa-search'></i></a>
          </div>
      </li>
      <li class='nav-item'>
          <a href='https://fundreza.com/all/browse/fundraisers' class='nav-link'>Browser Fundraisers</a>
      </li>
      <li class='nav-item dropdown'>
        <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
          Dropdown
        </a>
        <div class='dropdown-m'>
          <ul aria-labelledby='languages' class='dropdown-menu'> </li>
              <li>
                  <a class='text-decoration-none rounded p-2 m-2' href='https://fundreza.com/category/politics'> 
                    <i class='fas fa-angle-double-right '></i>  Political Campaign 
                  </a>
              </li>
  
              <li><a href='https://fundreza.com/category/medical' class='text-decoration-none rounded p-2 m-2'> <span class='d-none d-sm-inline-block'> <i class='fas fa-angle-double-right '></i> Health, Medical & Illness</span> </a></li>
              <li><a href='https://fundreza.com/category/art-music-film' class='text-decoration-none rounded p-2 m-2'>  <span class='d-none d-sm-inline-block'> <i class='fas fa-angle-double-right '></i> Creative Art, Film & Music</span> </a></li>
              
              <li><a href='https://blog.fundreza.com/fundraising-ideas/' class='text-decoration-none rounded p-2 m-2'> <span class='d-none d-sm-inline-block'> <i class='fas fa-angle-double-right '></i> Community Good</span> </a></li>
              <li><a href='https://fundreza.com/category/charity' class='text-decoration-none rounded p-2 m-2'> <span class='d-none d-sm-inline-block'> <i class='fas fa-angle-double-right '></i> Non profit</span> </a></li>
              <li><a href='https://fundreza.com/category/covid-19' class='text-decoration-none rounded p-2 m-2'> <span class='d-none d-sm-inline-block'> <i class='fas fa-angle-double-right '></i> Covid 19 </span> </a></li>
            </ul>
        </div>
      </li>
      <li class='nav-item'>
        <a href='../#howitworks' class='nav-link'>How it works</a>
      </li>
    </ul>

    <ul class='navbar-nav ml-auto'>
        <li class='nav-item '>
          <a href='https://fundreza.com/redirect' class='nav-link nfa'> <i class='fas fa-donate'></i> Start A Fundraisers </a>
        </li>  
        <li class='nav-item' style='width: min-width'>
          <a href='https://m.me/fundreza' class='nav-link chat text-success'><i class='fab fa-facebook-messenger'></i> Chat Us </a>
        </li>  
    </ul>
    
    </div>
</nav>
</div>
  <!-- /.navbar -->
  ";
  ?>