<?php
session_start();
require_once'config.php';

$user_data = @$_SESSION['user'];
$userid = $user_data['id'];
$name = $user_data['uname'];
$status = 0;

$con = new PDO("mysql:host=$serverhost;dbname=buyitch1_213;" , $serverusername, $serverpassword);
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sel = $con -> prepare("SELECT commentCode FROM parentcomments WHERE uname = ? AND status = ? LIMIT 30");
$sel -> bindParam(1,$name);
$sel -> bindParam(2,$status);
$sel -> execute();
$sel -> rowCount();
if($sel -> rowCount() == 1) {
    $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
    $array = array($rr[0]['commentCode']);
    $pcount = $sel -> rowCount();
    } if($sel -> rowCount() == 2) {
        $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
        $array = array($rr[0]['commentCode'],$rr[1]['commentCode']);
        $pcount = $sel -> rowCount();
    } if($sel -> rowCount() == 3) {
        $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
        $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode']);
        $pcount = $sel -> rowCount();
    } if($sel -> rowCount() == 4) {
        $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
        $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode']);
        $pcount = $sel -> rowCount();
    } if($sel -> rowCount() == 5) {
        $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
        $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode']);
        $pcount = $sel -> rowCount();
    } if($sel -> rowCount() == 6) {
        $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
        $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode']);
        $pcount = $sel -> rowCount();
    } if($sel -> rowCount() == 7) {
        $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
        $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode']);
    
    }
     if($sel -> rowCount() == 8) {
        $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
        $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode']);
        $pcount = $sel -> rowCount();
    }
     if($sel -> rowCount() == 9) {
        $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
        $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode']);
        $pcount = $sel -> rowCount();
    } if($sel -> rowCount() == 10) {
        $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
        $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode']);
        $pcount = $sel -> rowCount();
    } if($sel -> rowCount() == 11) {
        $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
        $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode']);
        $pcount = $sel -> rowCount();
    } if($sel -> rowCount() == 12) {
        $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
        $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode']);
        $pcount = $sel -> rowCount();
    } if($sel -> rowCount() == 13) {
        $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
        $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode']);
        $pcount = $sel -> rowCount();// var_dump($array);
    } if($sel -> rowCount() == 14) {
        $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
        $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode']);
        $pcount = $sel -> rowCount();
    } if($sel -> rowCount() == 15) {
        $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
        $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode']);
        $pcount = $sel -> rowCount();
    } if($sel -> rowCount() == 16) {
        $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
        $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode']);
        $pcount = $sel -> rowCount();
    } if($sel -> rowCount() == 17) {
        $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
        $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode']);
        $pcount = $sel -> rowCount();
    } if($sel -> rowCount() == 18) {
        $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
        $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode']);
        $pcount = $sel -> rowCount();
    } if($sel -> rowCount() == 19) {
        $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
        $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18]['commentCode']);
        $pcount = $sel -> rowCount();
    } if($sel -> rowCount() == 20) {
        $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
        $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18]['commentCode'],$rr[19]['commentCode']);
        $pcount = $sel -> rowCount();
    } if($sel -> rowCount() == 21) {
        $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
        $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18]['commentCode'],$rr[19]['commentCode'],$rr[20]['commentCode']);
        $pcount = $sel -> rowCount();
    } if($sel -> rowCount() == 22) {
        $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
        $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18]['commentCode'],$rr[19]['commentCode'],$rr[20]['commentCode'],$rr[21]['commentCode']);
        $pcount = $sel -> rowCount();
    } if($sel -> rowCount() == 23) {
        $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
        $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18]['commentCode'],$rr[19]['commentCode'],$rr[20]['commentCode'],$rr[21]['commentCode'],$rr[22]['commentCode']);
        $pcount = $sel -> rowCount();
    } if($sel -> rowCount() == 24) {
        $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
        $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18]['commentCode'],$rr[19]['commentCode'],$rr[20]['commentCode'],$rr[21]['commentCode'],$rr[22]['commentCode'],$rr[23]['commentCode']);
        $pcount = $sel -> rowCount();
    } if($sel -> rowCount() == 25) {
        $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
        $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18][' commentCode'],$rr[19]['commentCode'],$rr[20]['commentCode'],$rr[21]['commentCode'],$rr[22]['commentCode'],$rr[23]['commentCode'],$rr[24]['commentCode']);
        $pcount = $sel -> rowCount();
    } if($sel -> rowCount() == 26) {
        $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
        $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18]['commentCode'],$rr[19]['commentCode'],$rr[20]['commentCode'],$rr[21]['commentCode'],$rr[22]['commentCode'],$rr[23]['commentCode'],$rr[24]['commentCode'],$rr[25]['commentCode']);
        $pcount = $sel -> rowCount();
    } if($sel -> rowCount() == 27) {
        $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
        $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18]['commentCode'],$rr[19]['commentCode'],$rr[20]['commentCode'],$rr[21]['commentCode'],$rr[22]['commentCode'],$rr[23]['commentCode'],$rr[24]['commentCode'],$rr[25]['commentCode'],$rr[26]['commentCode']);
        $pcount = $sel -> rowCount();
    } if($sel -> rowCount() == 28) {
        $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
        $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18]['commentCode'],$rr[19]['commentCode'],$rr[20]['commentCode'],$rr[21]['commentCode'],$rr[22]['commentCode'],$rr[23]['commentCode'],$rr[24]['commentCode'],$rr[25]['commentCode'],$rr[26]['commentCode'],$rr[27]['commentCode']);
        $pcount = $sel -> rowCount();
    } if($sel -> rowCount() == 29) {
        $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
        $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18]['commentCode'],$rr[19]['commentCode'],$rr[20]['commentCode'],$rr[21]['commentCode'],$rr[22]['commentCode'],$rr[23]['commentCode'],$rr[24]['commentCode'],$rr[25]['commentCode'],$rr[26]['commentCode'],$rr[27]['commentCode'],$rr[28]['commentCode']);
    
    } if($sel -> rowCount() == 30) {
        $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
        $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18]['commentCode'],$rr[19]['commentCode'],$rr[20]['commentCode'],$rr[21]['commentCode'],$rr[22]['commentCode'],$rr[23]['commentCode'],$rr[24]['commentCode'],$rr[25]['commentCode'],$rr[26]['commentCode'],$rr[27]['commentCode'],$rr[28]['commentCode'],$rr[29]['commentCode']);
        $pcount = $sel -> rowCount();
    } if($sel -> rowCount() == 0) {
        echo $pcount = $sel -> rowCount();
        return false;
    }

    $rrr = implode(',',array_fill(0,count($array),'?'));
    
    $query = $con -> prepare("SELECT comment_time,parentcommentCode FROM childrencomments WHERE status = 0 AND uname <> '".$name."' AND parentcommentCode IN($rrr) AND parentcommentCode <> '' ORDER BY comment_time DESC");
    $query -> execute($array);
    if($query -> rowCount() == 0) {
        echo 0; 
    }else if($query -> rowCount() > 0) {
        echo $totalCount = (int)($pcount + $c_count + 1); 
    } else {
        echo 0;
    }
    

?>