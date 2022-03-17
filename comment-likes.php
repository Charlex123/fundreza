<?php
@session_start();
require_once'config.php';


if(isset($_POST['pcomment_likes']) && $_POST['pcomment_likes'] !="" && isset($_POST['pCode']) && $_POST['postId'] !="") {
    $code = $_POST['pCode'];
    $fundraiserId = $_POST['postId'];
    $pcomment_likes = $_POST['pcomment_likes']; 
  
    $con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);      
    $create = $con -> prepare("CREATE TABLE pcomment_likes (id int(11) not null primary key AUTO_INCREMENT, likes varchar(10) not null,fundraiserId varchar(50) not null,commentCode varchar(50) not null)");
    $create ->execute();
   
    $up = $con -> prepare("INSERT INTO pcomment_likes (likes,fundraiserId,commentCode) VALUES (?,?,?)");
    $up -> bindParam(1,$pcomment_likes);
    $up -> bindParam(2,$fundraiserId);
    $up -> bindParam(3,$code);
    
    if($up -> execute()) {
        $select = $con -> prepare("SELECT * FROM pcomment_likes WHERE commentCode = ?");
        $select -> bindParam(1,$code);
        $select -> execute();
        $count = $select ->rowCount();
        
        //update table videos column shares with shares counts of the video id
        
        $update = $con -> prepare("UPDATE parentcomments SET likes = '".$count."' WHERE fundraiserId = ? AND commentCode = ?");
        $update -> bindParam(1,$fundraiserId);
        $update -> bindParam(2,$code);
        $update -> execute();
        // exit();
    }

}


if(isset($_POST['pCode'])) {
   
    $code = $_POST['pCode'];

    $check = $con -> prepare("SELECT * FROM pcomment_likes WHERE commentCode = ?");
    $check -> bindParam(1,$code);
    if($check -> execute() && $check -> rowCount() > 0) {
        $select = $con -> prepare("SELECT * FROM pcomment_likes WHERE fundraiserId = ? AND commentCode = ?");
        $select -> bindParam(1,$fundraiserId);
        $select -> bindParam(2,$code);
        $select -> execute();
        echo $count = $select ->rowCount();
        exit();
    }
}


?>