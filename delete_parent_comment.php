<?php
session_start();
require_once'config.php';

if(isset($_POST['pCode']) && isset($_POST['postId'])) {
    
    echo $name= isset($_POST['Dname']) ? $_POST['Dname'] : false;
    echo $Email = isset($_POST['Demail']) ? $_POST['Demail'] : false;
    $pCode = isset($_POST['pCode']) ? $_POST['pCode'] : false;
    $fundraiserId = isset($_POST['postId']) ? $_POST['postId'] : false;

    $fetch_c_reply = $con -> prepare("SELECT commentCode,user_email,uname,fundraiserId FROM parentcomments WHERE fundraiserId = ? AND commentCode = ?");
    $fetch_c_reply -> bindParam(1,$fundraiserId);
    $fetch_c_reply -> bindParam(2,$pCode);
    if($fetch_c_reply -> execute()) {
        $c = $fetch_c_reply -> fetch(PDO::FETCH_ASSOC);
        $c_count = $fetch_c_reply -> rowCount();
        $c['name'];
        $c['user_email'];
        $c['commentCode'];
        if($c_count != 0 && $c['name'] == $name && $c['user_email'] == $Email && $c['commentCode'] == $pCode) {
            
                $del = $con -> prepare("DELETE FROM parentcomments WHERE commentCode = ?");
                $del -> bindParam(1,$pCode);
                if($del -> execute()) {
                    echo 'comment delete <i class="fas fa-check" style="color:green"></i>';
                    }
        }else{
            echo 'you can only delete your comment <i class="fas fa-times" style="color:green"></i>';
            }
        }
    
    }
  
    
?>