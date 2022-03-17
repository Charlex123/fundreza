<?php
session_start();
require_once'dbh.php';
require_once'config.php';
require_once'ranStrGen.php';


if(isset($_POST['editComment']) && isset($_POST['pCode'])) {
                
    $commented = isset($_POST['editComment']) ? $_POST['editComment'] : false;
    $name= isset($_POST['Rname']) ? $_POST['Rname'] : false;
    $Email = isset($_POST['Remail']) ? $_POST['Remail'] : false;
    $pCode = isset($_POST['pCode']) ? $_POST['pCode'] : false;
    $fundraiserId = isset($_POST['postId']) ? $_POST['postId'] : false;
    
    $comment = $_POST['editComment'];
    $pCode = $_POST['pCode'];

    
    
    if($_POST['editComment'] == "") {
        echo 'enter comment first!';
        exit();
        }
        
    if(htmlentities($_POST['editComment']) && strip_tags($_POST['editComment']) && strip_tags($_POST['pCode'])) {
            
            $comment = nl2br(htmlentities(strip_tags($_POST['editComment'])));
            $comment_time = date('Y-m-d H:i:s');
            
            $likes = 0;
            $dislikes = 0;
            $status = 0;
            //insert comment into database
            $con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword); 
            $sel = $con -> prepare("SELECT uname,user_email FROM childrencomments WHERE fundraiserId = ? AND childcommentCode = ?");
            $sel -> bindParam(1,$fundraiserId);
            $sel -> bindParam(2,$pCode);
            $sel -> execute();
            if($sel -> execute() && $sel -> rowCount() > 0) {
                $r = $sel -> fetch(PDO::FETCH_ASSOC);
                $rs = $r['uname'];
                $res = $r['user_email'];
               if($name == $rs && $Email == $res) {
                    $insert = $con -> prepare("UPDATE childrencomments SET comment = ? WHERE fundraiserId = ? AND childcommentCode = ?");
                    $insert -> bindParam(1,$comment);
                    $insert -> bindParam(2,$fundraiserId);
                    $insert -> bindParam(3,$childcommentCode);
                    if($insert -> execute()) {
                        echo 'edit succesful <i class="fas fa-check" style="color:green"></i>';
                        exit();
                    }
               } else {
                   echo 'you can only edit your comment';
               }
            }
            
        
    }
}

?>





