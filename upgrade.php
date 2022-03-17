<?php
    require_once'dbh.php';
    require_once'config.php';
    $con = new PDO("mysql:host=$serverhost;dbname=bitcsvxl_213;" , $serverusername, $serverpassword);
    if(isset($_POST['investmentPackage'])) {
        $investmentPackage = isset($_POST['investmentPackage']) ? $_POST['investmentPackage'] : false;
        $investmentAmount = isset($_POST['investmentAmount']) ? $_POST['investmentAmount'] : false;
        $wA = isset($_POST['wallet_address']) ? $_POST['wallet_address'] : false;
            
        if(htmlentities($investmentPackage) && strip_tags($investmentAmount) ) {
            $bidFunds = new dbh(); 
            $bidFunds -> investFunds();
        }
        
}
?>