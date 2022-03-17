<?php
    require_once'dbh.php';
    require_once'config.php';
    
    if(isset($_POST['paymentChannel'])) {
     $paymentChannel = isset($_POST['paymentChannel']) ? $_POST['paymentChannel'] : false;
     
    if($paymentChannel == 'Bitcoin') {
        $walletAddress = isset($_POST['wallet-address']) ? $_POST['wallet-address'] : false;
         $filteredWA = strip_tags($walletAddress);
    }

    $addPaymentOption = new dbh(); 
    $addPaymentOption -> addPaymentMethod();
}
?>