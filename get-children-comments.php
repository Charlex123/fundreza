<?php
session_start();
require_once'config.php';

if(isset($_POST['new_reply']) && $_POST['new_reply'] != "" && $_POST['new_reply'] != null && isset($_POST['code']) && $_POST['code'] != "" && $_POST['code'] != null) {
    
    $user_data = @$_SESSION['user'];
    $userid = $user_data['userid'];
    $name = $user_data['name'];
    $par_code = htmlentities(trim($_POST['code']));
    
    if(!isset($user_data) && !isset($name) && !isset($userid)) {
        
        exit();
    }else {
        
        $fetch_c_reply = $con -> prepare("SELECT videochildrencomments.name,videochildrencomments.comment,users.profile_pics,videochildrencomments.comment_time,videochildrencomments.videoCode,videochildrencomments.commentCode,videochildrencomments.replyCode, FROM videochildrencomments INNER JOIN users ON videochildrencomments.name = users.name WHERE videochildrencomments.commentCode = ? AND videochildrencomments.name = ? ORDER BY videochildrencomments.comment_time DESC");
        $fetch_c_reply -> bindParam(1,$par_code);
        $fetch_c_reply -> bindParam(2,$name);
        if($fetch_c_reply -> execute()) {
        $com = $fetch_c_reply -> fetch(PDO::FETCH_ASSOC);
        $c_count = $fetch_c_reply->rowCount();

        $c_date = new dateTime($com['comment_time']);
        $c_comment_time = date_format($c_date, 'M j, Y | H:i:s');
        $c_name = $com['name'];
        $c_comment = $com['comment'];
        $c_par = $com['replyCode'];
        $image = $com['profile_pics'];
        
        echo "<div class='child' id='".$par_code."-C' value='".$par_code."'>"
            ."<img src='".$image."' alt='profile image' class='ite'>"
            ."<div class='user'>".$c_name."</div>"
            ."<div class='_opo _345 _800'>
                    <div class='time'>".$c_comment_time."</div>
                    <div class='comment-text'><p class='position-comments'>".$c_comment."</p></div>
              </div>"
            ."</div>";
            }
             exit();
        }
    }
        


    
?>