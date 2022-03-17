<?php 
session_start();
require_once'dbh.php';
require_once'config.php';
require_once'ranStrGen.php';



if(isset($_POST['Rname']) && isset($_POST['replyComment']) && isset($_POST['pCode'])) {
                
        $commented = isset($_POST['replyComment']) ? $_POST['replyComment'] : false;
        $name= isset($_POST['Rname']) ? $_POST['Rname'] : false;
        $Email = isset($_POST['Remail']) ? $_POST['Remail'] : false;
        $pCode = isset($_POST['pCode']) ? $_POST['pCode'] : false;
        $postId = isset($_POST['postId']) ? $_POST['postId'] : false;
        if(htmlentities($commented) && strip_tags($name) && strip_tags($Email)) {
            $name= isset($_POST['Rname']) ? $_POST['Rname'] : false;
            $Email = isset($_POST['Remail']) ? $_POST['Remail'] : false;
            $comment = nl2br(htmlentities(strip_tags($_POST['replyComment'])));
            $user_data = @$_SESSION['user'];
            $comment_time = date('Y-m-d H:i:s');
            $parentcommentCode = strip_tags($_POST['pCode']);
            $profilepics = 'images/users_profilePics/default_profilePic.png';
            $childcommentCode = RandStrGen(25);
            $likes = 0;
            $dislikes = 0;
            $status = 0;
            //insert comment into database
            $con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword); 
            $insert = $con -> prepare("INSERT INTO childrencomments (uname,user_email,profilePics,comment_time,comment,fundraiserId,parentcommentCode,childcommentCode,likes,dislikes,status) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
            $insert -> bindParam(1,$name);
            $insert -> bindParam(2,$Email);
            $insert -> bindParam(3,$profilepics);
            $insert -> bindParam(4,$comment_time);
            $insert -> bindParam(5,$comment);
            $insert -> bindParam(6,$postId);
            $insert -> bindParam(7,$parentcommentCode);
            $insert -> bindParam(8,$childcommentCode);
            $insert -> bindParam(9,$likes);
            $insert -> bindParam(10,$dislikes);
            $insert -> bindParam(11,$status);
            if($insert -> execute()) {
                echo 'reply submitted <i class="fas fa-check" style="color:green"></i>';
                exit();
            }
        }

            
    }else {
        echo 'enter comment';
        exit();
}




    ?>        
    