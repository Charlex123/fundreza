<?php
session_start();
require_once'config.php';
require_once'dbh.php';
$user_data = @$_SESSION['user'];
$userid = $user_data['id'];
$email = $user_data['email'];

if((isset($_FILES['file']) && $_FILES['file'] != "")) {
    
    $filename = $_FILES['file']["name"];
    $type = $_FILES['file']["type"];
    $filesize = $_FILES['file']['size'];
    $source =  $_FILES['file']['tmp_name'];
    $path_to_image_directory = "images/users_profilePics/";
    $destination = $path_to_image_directory.$filename;

if(!preg_match('/[.](jpg)|(gif)|(jpeg)|(png)$/', $filename)) {
    echo "only image formats jpg or gif or jpeg or png are accepted";
    $uploadOk = 0;
    exit();
}if($filesize > 5000000) {
    echo "image size too big, images should be less than 5MB";
    $uploadOk = 0;
    exit();
}else {
    $image_final_width = 200;
    $image_final_height = 200;
    $path_to_image_directory = 'images/users_profilePics/';
    $path_to_thumbnail_directory = 'images/users_profilePicsThumbnails/';

    $source = $_FILES['file']['tmp_name'];
    $target = $path_to_image_directory.$filename;

    move_uploaded_file($source,$target);

if(preg_match('/[.]jpg$/', $filename)) {
    $im = imagecreatefromjpeg($path_to_image_directory.$filename);
}else if(preg_match('/[.]jpeg$/', $filename)) {
    $im = imagecreatefromjpeg($path_to_image_directory.$filename);
}else if (preg_match('/[.]gif$/', $filename)) {
    $im = imagecreatefromgif($path_to_image_directory.$filename);
}else if (preg_match('/[.]png$/', $filename)) {
    $im = imagecreatefrompng($path_to_image_directory.$filename);
}

$ox = imagesx($im);
$oy = imagesy($im);

$nx = $image_final_width;
$ny = $image_final_height;

$nm = imagecreatetruecolor($nx,$ny);

imagecopyresized($nm, $im, 0,0,0,0, $nx,$ny,$ox,$oy);

}
    

imagejpeg($nm, $path_to_thumbnail_directory.$filename);

$thumbnail = $path_to_thumbnail_directory.$filename;
$con = new PDO("mysql:host=$serverhost;dbname=u260645912_waep;" , $serverusername, $serverpassword);
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$select = $con -> prepare("UPDATE users SET profile_pics = ? WHERE email = ?");
$select -> bindParam(1,$thumbnail);
$select -> bindParam(2,$email);
$select -> execute();
if($select -> execute() ) {
    echo "<div class='alert-success'> Profile Pics Succcessfully Changed <span class='close-err'>&times;</span> </div>";
    }
            
}else{
//header("Location:profile.php?name=$name");

}

?>
