<?php
@session_start();
require_once'config.php';

$user_data = @$_SESSION['user'];
$userid = $user_data['id'];
$name = $user_data['uname'];
$email = $user_data['email'];
$IP_address = $_SERVER['REMOTE_ADDR'];

// if(!isset($_SESSION['user'])) {
//     header('Location:login');
//     exit();
// }else {
//     $user_data = @$_SESSION['user'];
//     $userid = $user_data['id'];
//     $name = @$user_data['uname'];


if(isset($_POST['upvotes']) && $_POST['upvotes'] !="" && isset($_POST['emp_code']) && $_POST['emp_code'] !="") {
   
    $upvotes = $_POST['upvotes']; 
    $emp_code = $_POST['emp_code'];
    
    $con = new PDO("mysql:host=$serverhost;dbname=empower_db;" , $serverusername, $serverpassword);      
    $create = $con -> prepare("CREATE TABLE upvotes (id int(11) not null primary key AUTO_INCREMENT,name varchar(80) null, upvotes varchar(10) not null,emp_code varchar(50) not null,ip_Address varchar(180) null)");
    $create ->execute();

    if(isset($name) && $name != "" && isset($_POST['emp_code']) && $_POST['emp_code'] != "") {

    $upvote = $con -> prepare("INSERT INTO upvotes (uname,user_email,upvotes,emp_code,ip_Address) VALUES (?,?,?,?,?)");
    $upvote -> bindParam(1,$name);
    $upvote -> bindParam(2,$email);
    $upvote -> bindParam(3,$upvotes);
    $upvote -> bindParam(4,$emp_code);
    $upvote -> bindParam(5,$IP_address);
    if($upvote -> execute()) {
        $select = $con -> prepare("SELECT * FROM upvotes WHERE emp_code = ?");
        $select -> bindParam(1,$emp_code);
        
        $select -> execute();
        $count = $select ->rowCount();
        
        //update table videos column shares with shares counts of the video id
        
        $update = $con -> prepare("UPDATE empower_table SET totalupVotes = ? WHERE empowerId = ?");
        $update -> bindParam(1,$count);
        $update -> bindParam(2,$emp_code);
        $update -> execute();

        $select1 = $con -> prepare("SELECT * FROM upvotes WHERE emp_code = ?");
        $select1 -> bindParam(1,$emp_code);
        
        $select1 -> execute();
        echo $count = $select1 ->rowCount();
        return false;
            }
    }else {
        echo "Login";
        exit();
    }
}else {
    
}


// }


?>


