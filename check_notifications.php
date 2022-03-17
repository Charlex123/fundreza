<?php
session_start();
require_once'config.php';

$user_data = $_SESSION['user'];
$userid = $user_data['userid'];
$name = $user_data['uname'];

if(isset($_POST['view'])) {
    
    if(isset($name) && $name != "") {
        $status = 0;

        $sel = $con -> prepare("SELECT commentCode FROM parentcomments WHERE user_email = ? AND status = ?");
        $sel -> bindParam(1,$name);
        $sel -> bindParam(2,$status);
        $sel -> execute();
        if($sel -> rowCount() == 1) {
            $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
            $array = array($rr[0]['commentCode']);
            
            }else if($sel -> rowCount() == 2) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode']);
            
            }else if($sel -> rowCount() == 3) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode']);
            
            }else if($sel -> rowCount() == 4) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode']);
        
            }else if($sel -> rowCount() == 5) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode']);
            
            }else if($sel -> rowCount() == 6) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode']);
            
            }else if($sel -> rowCount() == 7) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode']);
            
            }
            else if($sel -> rowCount() == 8) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode']);
            
            }
            else if($sel -> rowCount() == 9) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode']);
        
            }else if($sel -> rowCount() == 10) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode']);
            
            }else if($sel -> rowCount() == 11) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode']);
        
            }else if($sel -> rowCount() == 12) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode']);
            
            }else if($sel -> rowCount() == 13) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode']);
        
            }else if($sel -> rowCount() == 14) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode']);
            
            }else if($sel -> rowCount() == 15) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode']);
            
            }else if($sel -> rowCount() == 16) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode']);
            
            }else if($sel -> rowCount() == 17) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode']);
            
            }else if($sel -> rowCount() == 18) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode']);
            
            }else if($sel -> rowCount() == 19) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18]['commentCode']);
            
            }else if($sel -> rowCount() == 20) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18]['commentCode'],$rr[19]['commentCode']);
            
            }else if($sel -> rowCount() == 21) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18]['commentCode'],$rr[19]['commentCode'],$rr[20]['commentCode']);
            
            }else if($sel -> rowCount() == 22) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18]['commentCode'],$rr[19]['commentCode'],$rr[20]['commentCode'],$rr[21]['commentCode']);
            
            }else if($sel -> rowCount() == 23) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18]['commentCode'],$rr[19]['commentCode'],$rr[20]['commentCode'],$rr[21]['commentCode'],$rr[22]['commentCode']);
            
            }else if($sel -> rowCount() == 24) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18]['commentCode'],$rr[19]['commentCode'],$rr[20]['commentCode'],$rr[21]['commentCode'],$rr[22]['commentCode'],$rr[23]['commentCode']);
            
            }else if($sel -> rowCount() == 25) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18][' commentCode'],$rr[19]['commentCode'],$rr[20]['commentCode'],$rr[21]['commentCode'],$rr[22]['commentCode'],$rr[23]['commentCode'],$rr[24]['commentCode']);
            
            }else if($sel -> rowCount() == 26) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18]['commentCode'],$rr[19]['commentCode'],$rr[20]['commentCode'],$rr[21]['commentCode'],$rr[22]['commentCode'],$rr[23]['commentCode'],$rr[24]['commentCode'],$rr[25]['commentCode']);
            
            }else if($sel -> rowCount() == 27) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18]['commentCode'],$rr[19]['commentCode'],$rr[20]['commentCode'],$rr[21]['commentCode'],$rr[22]['commentCode'],$rr[23]['commentCode'],$rr[24]['commentCode'],$rr[25]['commentCode'],$rr[26]['commentCode']);
            
            }else if($sel -> rowCount() == 28) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18]['commentCode'],$rr[19]['commentCode'],$rr[20]['commentCode'],$rr[21]['commentCode'],$rr[22]['commentCode'],$rr[23]['commentCode'],$rr[24]['commentCode'],$rr[25]['commentCode'],$rr[26]['commentCode'],$rr[27]['commentCode']);
            
            }else if($sel -> rowCount() == 29) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18]['commentCode'],$rr[19]['commentCode'],$rr[20]['commentCode'],$rr[21]['commentCode'],$rr[22]['commentCode'],$rr[23]['commentCode'],$rr[24]['commentCode'],$rr[25]['commentCode'],$rr[26]['commentCode'],$rr[27]['commentCode'],$rr[28]['commentCode']);
            
            }else if($sel -> rowCount() == 30) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18]['commentCode'],$rr[19]['commentCode'],$rr[20]['commentCode'],$rr[21]['commentCode'],$rr[22]['commentCode'],$rr[23]['commentCode'],$rr[24]['commentCode'],$rr[25]['commentCode'],$rr[26]['commentCode'],$rr[27]['commentCode'],$rr[28]['commentCode'],$rr[29]['commentCode']);
            
            }else if($sel -> rowCount() == 0) {
                return false;
            }

            $rrr = implode(',',array_fill(0,count($array),'?'));
            
            $query = $con -> prepare("UPDATE childrencomments SET status = 1  WHERE parentcommentCode IN($rrr) ");
            $query -> execute($array);
            if($query -> rowCount() > 0)  {
                $sql = $con -> prepare("SELECT parentcommentCode FROM childrencomments WHERE status = 1 AND parentcommentCode IN($rrr)");
                if($sql -> execute($array) && $sql -> rowCount() > 0) {
                    $returns = $sql -> fetchAll(PDO::FETCH_ASSOC);
                    foreach($returns as $r) {
                        $commentCode = $r['parentcommentCode'];
                        $status = 0;
                        $stmt = $con -> prepare("UPDATE parentcomments SET status = ? WHERE commentCode = ?");
                        $stmt -> bindParam(1,$status);
                        $stmt -> bindParam(2,$commentCode);
                        $stmt -> execute();
                    }
                }
                
            }
    }
}
?>