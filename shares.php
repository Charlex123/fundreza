<?php
@session_start();
require_once'config.php';


if(isset($_POST['shares']) && isset($_POST['fundraiserId'])) {
   

    $shares = $_POST['shares']; 
    $fid = $_POST['fundraiserId'];
    $fid;
    $con = new PDO("mysql:host=$serverhost;dbname=bitcsvxl_213;" , $serverusername, $serverpassword);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $up_shares = $con -> prepare("INSERT INTO shares (shares,fundraiserId) VALUES (?,?)");
    $up_shares -> bindParam(1,$shares);
    $up_shares -> bindParam(2,$fid);
    $up_shares -> execute();
    if($up_shares -> execute()) {
        $select = $con -> prepare("SELECT * FROM shares WHERE fundraiserId = ?");
        $select -> bindParam(1,$fid);
        $select -> execute();
        echo $count = $select ->rowCount();
       //update table videos column shares with shares counts of the video id
        
        $update = $con -> prepare("UPDATE fundraiser_table SET totalShares = ? WHERE fundraiserId = ?");
        $update -> bindParam(1,$count);
        $update -> bindParam(2,$fid);
        $update -> execute();
        
        $select1 = $con -> prepare("SELECT * FROM shares WHERE fundraiserId = ?");
        $select1 -> bindParam(1,$fid);
        $select1 -> execute();
        $count1 = $select1 ->rowCount();
        return false;
    }
}

?>