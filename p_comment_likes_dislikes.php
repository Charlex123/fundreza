<?php
@session_start();
require_once'config.php';


$user_data = @$_SESSION['user'];
$userid = $user_data['userid'];
$name = $user_data['name'];
    
    if(!isset($user_data) && !isset($name) && !isset($userid)) {
        echo 'login to like/dislike a comment';
        exit();
    }

else if(isset($_POST['p_comment_likes']) && $_POST['p_comment_likes'] !="" && isset($_POST['code']) && $_POST['code'] !="" && isset($name)) {
   
    $p_comment_likes = $_POST['p_comment_likes']; 
    $code = $_POST['code'];
    
    $create = $con -> prepare("CREATE TABLE p_comment_likes (id int(11) not null primary key AUTO_INCREMENT,name varchar(80) not null likes varchar(255) not null,code varchar(255) not null)");
    $create ->execute();

    $check = $con -> prepare("SELECT * FROM p_comment_likes WHERE name = ? AND code = ?");
    $check -> bindParam(1,$name);
    $check -> bindParam(2,$code);
    if($check -> execute() && $check -> rowCount() > 0) {
        echo 'comment already liked by you';
        exit();
    }else {
        $up_video = $con -> prepare("INSERT INTO p_comment_likes (name,likes,code) VALUES (?,?,?)");
        $up_video -> bindParam(1,$name);
        $up_video -> bindParam(2,$p_comment_likes);
        $up_video -> bindParam(3,$code);
        $up_video -> execute();
        echo 'comment liked';
            $select = $con -> prepare("SELECT * FROM p_comment_likes WHERE code = ?");
            $select -> bindParam(1,$code);
            $select -> execute();
            $count = $select ->rowCount();
            
            //update table videos column shares with shares counts of the video id
            
            $update = $con -> prepare("UPDATE videoparentcomments SET likes = '".$count."' WHERE commentCode = ?");
            $update -> bindParam(1,$code);
            $update -> execute();
            exit();
        
    }
}


if(isset($_POST['p']) && $_POST['p'] !="" && isset($_POST['code']) && $_POST['code'] !="" && isset($name)) {
   
    $code = $_POST['code'];
    
    $check = $con -> prepare("SELECT * FROM p_comment_likes WHERE code = ?");
    $check -> bindParam(1,$code);
    if($check -> execute() && $check -> rowCount() > 0) {
        $select = $con -> prepare("SELECT * FROM p_comment_likes WHERE code = ?");
        $select -> bindParam(1,$code);
        $select -> execute();
        echo $count = $select ->rowCount();
        exit();
    }
}


if(isset($_POST['p_comment_dislikes']) && $_POST['p_comment_dislikes'] !="" && isset($_POST['code']) && $_POST['code'] !="") {
   
    $p_comment_dislikes = $_POST['p_comment_dislikes']; 
    $code = $_POST['code'];
    
    $create = $con -> prepare("CREATE TABLE p_comment_dislikes (id int(11) not null primary key AUTO_INCREMENT,name varchar(80) not null dislikes varchar(255) not null,code varchar(255) not null)");
    $create ->execute();

    $check = $con -> prepare("SELECT * FROM p_comment_dislikes WHERE name = ? AND code = ?");
    $check -> bindParam(1,$name);
    $check -> bindParam(2,$code);
    if($check -> execute() && $check -> rowCount() > 0) {
        echo 'comment already disliked by you';
        exit();
    }else {
        $up_video = $con -> prepare("INSERT INTO p_comment_dislikes (name,dislikes,code) VALUES (?,?,?)");
        $up_video -> bindParam(1,$name);
        $up_video -> bindParam(2,$p_comment_dislikes);
        $up_video -> bindParam(3,$code);
        $up_video -> execute();
        echo 'comment disliked';
            $select = $con -> prepare("SELECT * FROM p_comment_dislikes WHERE code = ?");
            $select -> bindParam(1,$code);
            $select -> execute();
            $count = $select ->rowCount();
            
            //update table videos column shares with shares counts of the video id
            
            $update = $con -> prepare("UPDATE videoparentcomments SET dislikes = '".$count."' WHERE commentCode = ?");
            $update -> bindParam(1,$code);
            $update -> execute();
            exit();
        
    }
}


if(isset($_POST['w']) && $_POST['w'] !="" && isset($_POST['code']) && $_POST['code'] !="" && isset($name)) {
   
    $code = $_POST['code'];
    
    $check = $con -> prepare("SELECT * FROM p_comment_dislikes WHERE name = ? AND code = ?");
    $check -> bindParam(1,$name);
    $check -> bindParam(2,$code);
    if($check -> execute() && $check -> rowCount() > 0) {
        $select = $con -> prepare("SELECT * FROM p_comment_dislikes WHERE code = ?");
        $select -> bindParam(1,$code);
        $select -> execute();
        echo $count = $select ->rowCount();
        exit();
    }
}
?>