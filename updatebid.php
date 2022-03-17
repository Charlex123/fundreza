<?php
session_start();
require_once'dbh.php';
require_once'config.php';

$user_data = @$_SESSION['user'];
$userid = $user_data['id'];
$Email = @$user_data['email'];

if(isset($_POST['fUpdate'])) {
    $fupdate = isset($_POST['fUpdate']) ? $_POST['fUpdate'] : false;
    $fid = $_POST['fid'];
    $upd = nl2br(htmlspecialchars(($_POST['fUpdate'])));
    $timestatus = time(); 
    
    $con = new PDO("mysql:host=$serverhost;dbname=bitcsvxl_213;" , $serverusername, $serverpassword);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $invst = $con ->prepare("INSERT INTO fundraiserupdate_table (fundraiserId,fundraiserEmail,fundraiserUpdate,timestatus) VALUES (?,?,?,?)");
    $invst -> bindParam(1,$fid);
    $invst -> bindParam(2,$Email);
    $invst -> bindParam(3,$upd);
    $invst -> bindParam(4,$timestatus);
    if($invst->execute()) {
    echo 'fundraiser progress update successfully posted';
    }
}
?>