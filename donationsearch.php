<?php 
require_once'dbh.php';

if(isset($_POST['donorSearch'])) {
    $dsearch = htmlspecialchars($_POST['donorSearch']);
    $fiiid = $_POST['fid'];
    $fBy = $_POST['fBy'];
    $fffT = $_POST['fTitle'];
    $con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $chs = $con -> prepare("SELECT donatedBy,totaldonAmount,donation_time FROM donation_table WHERE fundraiserId = ? AND totaldonAmount LIKE ? OR donatedBy LIKE ? ORDER BY totaldonAmount DESC");
    $chs ->bindParam(1,$fiiid);
    $chs ->bindParam(2,$dsearch);
    $chs ->bindParam(3,$dsearch);
    $chs -> execute();
    if($chs -> execute() && $chs -> rowCount() > 0) {
    $rowas = $chs -> fetchAll(PDO::FETCH_ASSOC);

    foreach ($rowas as $row) { 
        
        $time = $row['donation_time'];
        $diff = time() - $time;
        $donAmount = $row['totaldonAmount'];
        $donBy = $row['donatedBy'];
        // Time difference in seconds
        $sec     = $diff;
        
        // Convert time difference in minutes
        $min     = round($diff / 60 );
        
        // Convert time difference in hours
        $hrs     = round($diff / 3600);
        
        // Convert time difference in days
        $days     = round($diff / 86400 );
        
        // Convert time difference in weeks
        $weeks     = round($diff / 604800);
        
        // Convert time difference in months
        $mnths     = round($diff / 2600640 );
        
        // Convert time difference in years
        $yrs     = round($diff / 31207680 );
        
        // Check for seconds
        if($sec <= 60) {
        $donationtime = "$sec seconds ago";
        }
        
        // Check for minutes
        else if($min <= 60) {
        if($min==1) {
            $donationtime = "one minute ago";
        }
        else {
            $donationtime = "$min minutes ago";
        }
        }
        
        // Check for hours
        else if($hrs <= 24) {
        if($hrs == 1) { 
            $donationtime = "an hour ago";
        }
        else {
            $donationtime = "$hrs hours ago";
        }
        }
        
        // Check for days
        else if($days <= 7) {
        if($days == 1) {
            $donationtime = "Yesterday";
        }
        else {
            $donationtime = "$days days ago";
        }
        }
        
        // Check for weeks
        else if($weeks <= 4.3) {
        if($weeks == 1) {
            $donationtime = "a week ago";
        }
        else {
            $donationtime = "$weeks weeks ago";
        }
        }
        
        // Check for months
        else if($mnths <= 12) {
        if($mnths == 1) {
            $donationtime = "a month ago";
        }
        else {
            $donationtime = "$mnths months ago";
        }
        }
        
        // Check for years
        else {
        if($yrs == 1) {
            $donationtime = "one year ago";
        }
        else {
            $donationtime = "$yrs years ago";
        }
        }

        echo "<a href='https://fundreza.com/p/$fffT/$fBy/$fiiid'><div class='ibge'>
        <div class='ereferv'><i class='fas fa-user-tag' style='color:#22a349;opacity:.6'></i></div> 
        <div class='hyurf'>  $donBy <div class='goed'><span class='fft'> $$donAmount</span><span class='ffd'>$donationtime</span></div></div>
        </div></a>";
    }
    
}else{
echo "<div class='text-left m-2 p-2'>search not found</div>";
exit();
}
}
?>