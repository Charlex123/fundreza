<?php
session_start();
require_once'config.php';

if(isset($_POST['getForm']) && $_POST['getForm'] != "" && $_POST['getForm'] != null) {
    
    $user_data = @$_SESSION['user'];
    $userid = $user_data['userid'];
    $name = $user_data['name'];
    $code = @$_SESSION['videocode'];
    
    if(!isset($user_data) && !isset($name) && !isset($userid)) {
        
        exit();
    }else {
        
        $fetch_p_comment = $con -> prepare("SELECT videoparentcomments.name,videoparentcomments.comment,users.profile_pics,videoparentcomments.comment_time,videoparentcomments.videoCode,videoparentcomments.commentCode FROM videoparentcomments INNER JOIN users ON videoparentcomments.name = users.name WHERE videoparentcomments.videoCode = ? ORDER BY videoparentcomments.comment_time DESC");
        $fetch_p_comment -> bindParam(1,$code);
        if($fetch_p_comment -> execute() && $fetch_p_comment -> rowCount() > 0) {
            $p = $fetch_p_comment -> fetch(PDO::FETCH_ASSOC);
            $date = new dateTime($p['comment_time']);
            $comment_time = date_format($date, 'M j, Y | H:i:s');
            $name = $p['name'];
            $comment = $p['comment'];
            $vid_code = $p['videoCode'];
            $par_code = $p['commentCode'];
            $user_image = $p['profile_pics'];
            echo "<div class='comment' id='parent' name='".$par_code."'>"
                ."<img src='".$user_image."' alt='profile image' class='userimage'>"
                ."<div class='user'>".$name."</div>"
                ."<div class='_opo _345 _700'>
                        <div class='time'>".$comment_time."</div>
                        <div class='comment-text'><p class='position-comments'>".$comment."</p></div>
                  </div>";
            echo "</div>";
        }
        exit();
    }
        
}

    
?>