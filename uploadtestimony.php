
<?php
session_start();
require_once'dbh.php';

if(isset($_FILES['profile_pix']["name"]) ) {    
   
    $allowed_type = array('image/jpeg','image/jpg','image/png','image/gif');
    $image_name = $_FILES['profile_pix']["name"];
    $type = $_FILES['profile_pix']["type"];
    $size = $_FILES['profile_pix']['size'];
    $source =  $_FILES['profile_pix']['tmp_name'];
    $path_to_image_directory = "images/users_profilePics/";
    $destination = $path_to_image_directory.$image_name;
    // check file size
        if ($size > 5000000) {
            echo 'File too large, Image size must be less than 5MB ';
            $uploadOk = 0;
            exit();
        }if ($image_name == "") {
            echo 'upload empty ';
            $uploadOk = 0;
            exit();
        }
    // selecting image format to be uploaded
        if (in_array($type,$allowed_type) && $size <= 5000000 ) {

            move_uploaded_file($source, $destination);
        
            $obj = new dbh();
            $obj -> profilePicsUpload($image_name);
           }else {
               echo "file format not accepted";
               exit();
           }
    }
                        
?>
