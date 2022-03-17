<?php
    session_start();
    require_once'dbh.php';
    require_once'config.php';
    
    $user_data = @$_SESSION['user'];
    $userid = $user_data['id'];
    $name = @$user_data['uname'];
    $Email = @$user_data['email'];
    
    @$user_data = @$_SESSION['user'];
    @$userid = @$user_data['id'];
    @$email_of_user = @$user_data['email'];
    
    
    @$Email = $_SESSION['Email'];
    @$Lname = $_SESSION['Lname'];
    // $emailcode = $_SESSION['emailCode'];
    @$emailUname = $_SESSION['emailUname'];
    @$fundraiserType = $_SESSION['fundraiserType'];
    $message = '';
    $phoneError = "";
    
    
    $con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
        
    if(isset($_POST['youtubevideoLink']) && isset($_POST['fundraiserId'])) {
        $url = isset($_POST['youtubevideoLink']) ? $_POST['youtubevideoLink'] : false;
        $fundaId = isset($_POST['fundraiserId']) ? $_POST['fundraiserId'] : false;
        
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
        $youtube_id = $match[1];
        
        $queryy = $con->prepare("UPDATE fundraiser_table SET youtubeLink = ? WHERE fundraiserId = ?");
        $queryy ->bindParam(1, $youtube_id);
        $queryy ->bindParam(2, $fundaId);
        $queryy ->execute();
        if($queryy) {
            echo "Youtube video link successfully added";
        }
}
?>