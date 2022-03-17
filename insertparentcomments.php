<?php 
session_start();
ini_set('display_errors','1');
require_once'dbh.php';
require_once'config.php';
require_once'ranStrGen.php';

@$_SESSION['currentpage'] = $_SERVER['REQUEST_URI'];

if(isset($_POST['message']) && isset($_POST['Ename']) && isset($_POST['Email']) ) {
    $commented = isset($_POST['message']) ? $_POST['message'] : false;
    $name= isset($_POST['Ename']) ? $_POST['Ename'] : false;
    $Email = isset($_POST['Email']) ? $_POST['Email'] : false;
    $postId = isset($_POST['postId']) ? $_POST['postId'] : false;

    $_SESSION['postId'] = $postId;    

    if(htmlentities($commented) && strip_tags($name) && strip_tags($Email)) {
        $name= isset($_POST['Ename']) ? $_POST['Ename'] : false;
        $Email = isset($_POST['Email']) ? $_POST['Email'] : false;
        $comment = nl2br(htmlentities(strip_tags($commented)));
        $fundraiserId = isset($_POST['postId']) ? $_POST['postId'] : false;
        $comment_time = date('Y-m-d H:i:s');
        $commentCode = RandStrGen(25);
        $profilepics = 'images/users_profilePics/default_profilePic.png';
        $likes = 0;
        $dislikes = 0;
        $status = 0;
        //insert comment into database
        $con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword); 
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $insert = $con -> prepare("INSERT INTO parentcomments (uname,user_email,profilePics,comment_time,comment,fundraiserId,commentCode,likes,dislikes,status) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $insert -> bindParam(1,$name);
        $insert -> bindParam(2,$Email);
        $insert -> bindParam(3,$profilepics);
        $insert -> bindParam(4,$comment_time);
        $insert -> bindParam(5,$comment);
        $insert -> bindParam(6,$fundraiserId);
        $insert -> bindParam(7,$commentCode);
        $insert -> bindParam(8,$likes);
        $insert -> bindParam(9,$dislikes);
        $insert -> bindParam(10,$status);
        if($insert -> execute()) {
            echo $successMessage = 'comment submitted <i class="fas fa-check" style="color:green"></i>';
            exit();
        }
    }
    
    }else {
        echo 'enter comment';
    }




    ?>   