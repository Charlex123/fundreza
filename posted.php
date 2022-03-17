<?php
@session_start();
require_once'dbh.php';
require_once'config.php';
require_once'ranStrGen.php';

if (isset($_POST['postTitle']) && isset($_POST['postContent'])) {
   
    $postContent = isset($_POST['postContent']) ? $_POST['postContent'] : false;
    $postTitled = isset($_POST['postTitle']) ? $_POST['postTitle'] : false;
    $postedBy = isset($_POST['postedBy']) ? $_POST['postedBy'] : false;
        
    if(strip_tags($postContent) && htmlentities($postTitle) && htmlentities($postedBy)) {

        $postTitle = str_replace("'","",$postTitled);
        $_SESSION['postTitle'] = $postTitle;
        $_SESSION['postedBy'] = $postedBy;
        
        $con = new PDO("mysql:host=$serverhost;dbname=bitcsvxl_213;" , $serverusername, $serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $timestatus = time(); 
        $postId = rand();
        
        if(isset($_POST['postContent'])) {
            $postContent = isset($_POST['postContent']) ? $_POST['postContent'] : false;
            $postTitle = isset($_POST['postTitle']) ? $_POST['postTitle'] : false;
            $postedBy = isset($_POST['postedBy']) ? $_POST['postedBy'] : false;
            $postCategory = isset($_POST['postCategory']) ? $_POST['postCategory'] : false;

            if(htmlentities($postContent) && strip_tags($postTitle) ) {
            $_SESSION['postTitle'] = $postTitle;
            $_SESSION['postedBy'] = $postedBy;

            $select = $con -> prepare("SELECT postTitle FROM post_table WHERE postTitle = ?");
            $select -> bindParam(1,$postTitle);
            $select -> execute();
            if($select -> execute() && $select -> rowCount() > 0 ) {
                echo "<div class='alert-success p-2 m-3 rounded'> Posted Already Exits, Post Another <span class='close-err'>&times;</span> </div>";
            }else {
                $totallikes = 0;
                $totalshares = 0;
                $totalviews = 0;
                $totallikes = 0;
                $totalfollowers = 0;
                $totaldownloads = 0;
                $totalupVote = 0;
                $totalcomments = 0;
                $postStatus = 'Active';
    
                $invst = $con ->prepare("INSERT INTO post_table (postId,postedBy,postTitle,postContent,postCategory,totalLikes,totalFollowers,totalDownloads,totalupVotes,totalShares,totalViews,totalComments,dateSubmitted,postStatus) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                $invst -> bindParam(1,$postId);
                $invst -> bindParam(2,$postedBy);
                $invst -> bindParam(3,$postTitle);
                $invst -> bindParam(4,$postContent);
                $invst -> bindParam(5,$postCategory);
                $invst -> bindParam(6,$totallikes);
                $invst -> bindParam(7,$totalfollowers);
                $invst -> bindParam(8,$totaldownloads);
                $invst -> bindParam(9,$totalupVote);
                $invst -> bindParam(10,$totalshares);
                $invst -> bindParam(11,$totalviews);
                $invst -> bindParam(12,$totalcomments);
                $invst -> bindParam(13,$timestatus);
                $invst -> bindParam(14,$postStatus);
                if($invst->execute()) {
                    $lastInsertId = $con -> lastinsertId();
    
                    $chek = $con -> prepare("SELECT postId FROM post_table WHERE postTitle = ? AND id = ?");
                    $chek ->bindParam(1,$postTitle);
                    $chek ->bindParam(2,$lastInsertId);
                    $chek -> execute();
                    if($chek -> execute() && $chek -> rowCount() > 0) {
                        $f = $chek -> fetch(PDO::FETCH_ASSOC);
                        $empId = $f['postId'];
                        $_SESSION['empid'] = $empId;
                    }
                    
                    $_SESSION['postTitle'] = $postTitle;
                    $_SESSION['postedBy'] = $postedBy;
    
                    // getpostedActivateEmail($email,$postType,$postTitle,$name);
                                
                        echo "<div class='alert-success p-2 m-3 rounded'> Posted Successfully <span class='close-err'>&times;</span> </div>";
                        }else {
                            echo "<div class='alert-success p-2 m-3 rounded'> Ops!! Stake Request Failed <span class='close-err'>&times;</span> </div>";
                                exit();
                    }
            }
        

            }
        }

    }
    
}

if((isset($_FILES['file']) && $_FILES['file'] != "")) {

    $emp_id = $_SESSION['empid'];
    $uploadedBY = $_SESSION['postedBy'];
    $filename = $_FILES['file']["name"];
    $type = $_FILES['file']["type"];
    $filesize = $_FILES['file']['size'];
    $source = $_FILES['file']['tmp_name'];
    $path_to_file_directory = 'uploadedDocuments';

    $arr_file_types = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg','video/mp4','video/webm','video/mkv','video/avi','video/3gp','application/vnd.openxmlformats-officedocument.wordprocessingml.document','text/plain','docx','application/pdf'];
 

    if (!(in_array($_FILES['file']['type'], $arr_file_types))) {
        echo "Document type not supported";
        exit();
    }

    if($filesize > 10000000) {
        echo "Document must be smaller than 10 MB";
        exit();
    }
    $documenturl = 'uploadedDocuments/'. time() . '_' . $filename;
    
    $documenturlstrReplace = str_replace(" ", "_", $documenturl);
    move_uploaded_file($_FILES['file']['tmp_name'], $documenturlstrReplace);
    
    $video_files = ['video/mp4','video/webm','video/mkv','video/avi','video/3gp'];
    $image_files = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg'];
    $pdf_files = ['application/pdf'];
    $txt_files = ['text/plain'];

    if (in_array($_FILES['file']['type'], $video_files)) {
        $docType = 'video';
    }
    
    if (in_array($_FILES['file']['type'], $image_files)) {
        $docType = 'image';
    }

    if (in_array($_FILES['file']['type'], $pdf_files)) {
        $docType = 'pdf';
    }

    if (in_array($_FILES['file']['type'], $txt_files)) {
        $docType = 'txt';
    }

    $timestatus = time();
    $documentId = rand();

    $con = new PDO("mysql:host=$serverhost;dbname=bitcsvxl_213;" , $serverusername, $serverpassword);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $select = $con -> prepare("SELECT uploadedDocument FROM documentuploads WHERE uploadedDocument = ?");
    $select -> bindParam(1,$documenturlstrReplace);
    $select -> execute();
    if($select -> execute() && $select -> rowCount() > 0 ) {
        // echo 'upload successful';
        }else {
            $uploadDoc = $con -> prepare("INSERT INTO documentuploads (postId,documentId,uploadedDocument,documentType,fileType,uploadedBy,time_uploaded) VALUES (?,?,?,?,?,?,?)");
            $uploadDoc -> bindParam(1,$emp_id);
            $uploadDoc -> bindParam(2,$documentId);
            $uploadDoc -> bindParam(3,$documenturlstrReplace);
            $uploadDoc -> bindParam(4,$docType);
            $uploadDoc -> bindParam(5,$type);
            $uploadDoc -> bindParam(6,$uploadedBY);
            $uploadDoc -> bindParam(7,$timestatus);
            $uploadDoc -> execute();

            $documenturlstrReplace;

            $selectThumb = $con -> prepare("SELECT postThumbnail FROM post_table WHERE postId = ? AND postThumbnail <> ''");
            $selectThumb -> bindParam(1,$emp_id);
            $selectThumb -> execute();
            if($selectThumb -> rowCount() > 0) {
                echo 'not in';
            }else {
                $upd = $con -> prepare("UPDATE post_table SET postThumbnail = ? WHERE postId = ?");
                $upd -> bindParam(1,$documenturlstrReplace);
                $upd -> bindParam(2,$emp_id);
                $upd -> execute();

                // getposteduploadsEmail($email,$postType,$postTitle,$name);
                echo "<div class='alert-success p-2 m-3 rounded'> Documents Upload Successful <span class='close-err'>&times;</span> </div>";
                $documentType = 'image';
                $selectimg = $con -> prepare("SELECT uploadedDocument FROM documentuploads WHERE postId = ? AND documentType = ?");
                $selectimg -> bindParam(1,$emp_id);
                $selectimg -> bindParam(2,$documentType);
                $selectimg -> execute();
                if($selectimg -> execute() && $selectimg -> rowCount() > 0 ) {
                    
                    $doc_ext = $selectimg -> fetchAll(PDO::FETCH_ASSOC);

                    foreach($doc_ext as $docExt) {
                        $imgDoc = implode('.',$docExt);
                        echo "<div class='end-float'></div><div class='select-thumbnail'><img src='$imgDoc' alt='post thumbnail' class='post-thumbnail'></div><div class='end-float'></div>";
                        
                    }
                }
            }
            
            
        }
            
}



if(isset($_POST['postThumbnail'])) {
   
    $postThumbnail = isset($_POST['postThumbnail']) ? $_POST['postThumbnail'] : false;
    $emp_id = $_SESSION['empid'];

    if(strip_tags($postThumbnail)) {
        $sq = $con -> prepare("SELECT postThumbnail FROM post_table WHERE postId = ?");
        $chek ->bindParam(1,$email);
        $chek ->bindParam(2,$postTitle);
        $chek -> execute();
        if($chek -> execute() && $chek -> rowCount() > 0) {
            $upt = $con -> prepare("UPDATE post_table SET postThumbnail = ? WHERE postId = ?");
            $upt -> bindParam(1,$postThumbnail);#
            $upt -> bindParam(2,$emp_id);
            if($upt -> execute()) {
                // echo 'inout';
            }
        }else {
            // $uploadThumb = $con -> prepare("INSERT INTO post_table (postId,documentId,user_email,uploadedDocument,documentType,uploadedBy,time_uploaded) VALUES (?,?,?,?,?,?,?)");
            // $uploadThumb -> bindParam(1,$emp_id);
            // $uploadThumb -> bindParam(2,$documentId);
            // $uploadThumb -> bindParam(3,$email);
            // $uploadDoc -> execute();
        }
    }
}
?>