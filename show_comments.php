<?php
session_start();
require_once'config.php';

if(isset($_POST['code']) && $_POST['code'] != "") {
    
    $user_data = @$_SESSION['user'];
    $userid = $user_data['userid'];
    $name = $user_data['name'];
    $par_code = $_POST['code'];

    if(!isset($user_data) && !isset($name) && !isset($userid)) {
        echo 'login to comment';
        exit();
    }

    $fetch_c_reply = $con -> prepare("SELECT videochildrencomments.name,videochildrencomments.likes,videochildrencomments.dislikes,videochildrencomments.comment,users.profile_pics,videochildrencomments.comment_time,videochildrencomments.videoCode,videochildrencomments.commentCode FROM videochildrencomments INNER JOIN users ON videochildrencomments.name = users.name WHERE videochildrencomments.commentCode = ? AND videochildrencomments.commentCode <> '' ORDER BY comment_time DESC");
    $fetch_c_reply -> bindParam(1,$par_code);
    if($fetch_c_reply -> execute()) {
        $c = $fetch_c_reply -> fetch(PDO::FETCH_ASSOC);
        $c_count = $fetch_c_reply->rowCount();
        
        if($c_count == 0) {
              // do nothing
        }else {
            
                echo "<a class='link-reply' id='children' name='".$par_code."'><span id='tog-text' style='cursor:pointer;'>(".$c_count.")</span></a>";
            
            $c_date = new dateTime($c['comment_time']);
            $c_comment_time = date_format($c_date, 'M j, Y | H:i:s');
            $c_name = $c['name'];
            $c_comment = $c['comment'];
            $c_par = $c['par_code'];
            $image = $c['profile_pics'];
        }
           
    }

}

    
?>