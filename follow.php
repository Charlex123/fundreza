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


if(isset($_POST['follow']) && $_POST['follow'] !="" && isset($_POST['emp_code']) && $_POST['emp_code'] !="") {
   
    $follow = $_POST['follow']; 
    $emp_code = $_POST['emp_code'];
    
    $con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);      
    $create = $con -> prepare("CREATE TABLE follow (id int(11) not null primary key AUTO_INCREMENT,name varchar(80) null, follow varchar(10) not null,emp_code varchar(50) not null,ip_Address varchar(180) null)");
    $create ->execute();

    if(isset($_POST['emp_code']) && $_POST['emp_code'] != "") {

    $followd = $con -> prepare("INSERT INTO follow (uname,user_email,follow,emp_code,ip_Address) VALUES (?,?,?,?,?)");
    $followd -> bindParam(1,$name);
    $followd -> bindParam(2,$email);
    $followd -> bindParam(3,$follow);
    $followd -> bindParam(4,$emp_code);
    $followd -> bindParam(5,$IP_address);
    if($followd -> execute()) {
        $select = $con -> prepare("SELECT * FROM follow WHERE emp_code = ?");
        $select -> bindParam(1,$emp_code);
        
        $select -> execute();
        $count = $select ->rowCount();
        $_SESSION['emp_followers'] = $count;
        
        //update table videos column shares with shares counts of the video id
        
        $update = $con -> prepare("UPDATE empower_table SET totalFollowers = ? WHERE empowerId = ?");
        $update -> bindParam(1,$count);
        $update -> bindParam(2,$emp_code);
        $update -> execute();

        $select1 = $con -> prepare("SELECT SUM(totalFollowers) AS followers FROM empower_table WHERE user_email = ?");
        $select1 -> bindParam(1,$email);
        if($select1 -> execute()) {
            $followers = $select1 -> fetch(PDO::FETCH_ASSOC);
            $gtfollowers = $followers['followers'];

            $update2 = $con -> prepare("UPDATE users SET grandtotalFollowers = ? WHERE email = ?");
            $update2 -> bindParam(1,$gtfollowers);
            $update2 -> bindParam(2,$email);
            $update2 -> execute();
            echo $gtfollowers = $followers['followers'];
        }
        
        return false;
            }
    }else {
        echo "Login";
        exit();
    }
}else {
    
}

if(isset($_POST['follow']) && $_POST['follow'] !="" && isset($_POST['replaceSpan']) && $_POST['replaceSpan'] !="") {
    if(isset($name) && $name != "") {
        echo $_SESSION['emp_followers'];
    }
    return false;
}



?>


