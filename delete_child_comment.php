<?php
session_start();
require_once'config.php';

if(isset($_POST['code'])) {
    
    $user_data = @$_SESSION['user'];
    $userid = $user_data['userid'];
    $name = $user_data['name'];
    $par_code = $_POST['code'];

        
    $fetch_c_reply = $con -> prepare("SELECT childcommentCode FROM childrencomments WHERE parentcommentCode = ? AND childcommentCode = ?");
    $fetch_c_reply -> bindParam(1,$par_code);
    $fetch_c_reply -> bindParam(2,$name);
    if($fetch_c_reply -> execute()) {
        $c = $fetch_c_reply -> fetch(PDO::FETCH_ASSOC);
        $c_count = $fetch_c_reply -> rowCount();
        $c['name'];
        $c['commentCode'];
        if($c_count != 0 && $c['name'] === $name && $c['commentCode'] === $par_code) {
            
                $del = $con -> prepare("DELETE FROM parentcomments WHERE commentCode = ?");
                $del -> bindParam(1,$par_code);
                $del -> bindParam(2,$name);
                if($del -> execute()) {
                    echo 'comment delete <i class="fas fa-check" style="color:green"></i>';
                    }
        }else{
            echo 'you can only delete your comment <i class="fas fa-times" style="color:green"></i>';
            }
        }
    
    }
    
?>