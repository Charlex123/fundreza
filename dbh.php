<?php
@session_start();
ini_set('display_errors','1');
require_once'ranStrGen.php';
require_once'mailer.php';

class dbh {

private $id;
private $name;
private $password;
private $Email;
private $phonenumber;
private $carrier;
private $fundraiser_id;

public $serverhost = "localhost";
public $serverdbname = "fundgcmf_db";
public $serverusername = "fundgcmf_db";
public $serverpassword = "Charles@9845";

public function __construct (){
   $this->getServer();

try{ 
  $con= new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     } 
    catch( PDOException $e)
        {
        throw new exception($e->getmessage());
        }
    
     } 

//setting users in the database class

public function setUsers ($userid, $name,$password,$Email,$phonenumber) {
      $this->userid=$userid;
      $this->name=$name;
      $this->password=$password;
      $this->Email=$Email;
      $this->phonenumber=$phonenumber;
      
      }      


public function getUsers() {
      return $this->userid;
      return $this->name;
      return $this->password;
      return $this->Email;
      return $this->phonenumber;
      
      }

public function setServer($serverhost,$serverusername,$serverpassword,$serverdbname) {
        $this->serverhost=$serverhost;
        $this->serverusername=$serverusername;
        $this->serverpassword=$serverpassword;
        $this->serverdbName=$serverdbname;
      }

public function getServer() {
       return $this->serverhost;
       return $this->serverusername;
       return $this->serverpassword;
       return $this->serverdbname;
}


public function total_online() {
    try{
        $_SESSION['session'] = session_id(); 
        $current_time = time();
        $timeOut = $current_time - (60);

        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $session_exist = $con ->prepare("SELECT session FROM total_visitors WHERE session = ?");
        $session_exist -> bindParam(1,$_SESSION['session']);
        $session_exist -> execute();
        $session_check = $session_exist -> rowCount();
        if($session_check == 0 && $_SESSION['session'] !="") {
                                
            $sql = $con -> prepare ("INSERT INTO total_visitors values('',?,?)");
            $sql -> bindParam(1,$_SESSION['session']);
            $sql -> bindParam(2,$current_time);
            $sql -> execute();
            }else {
                $query = $con ->prepare("UPDATE total_visitors set time = '".time()."' WHERE session = ?");
                $query -> bindParam(1,$_SESSION['session']);
                $query -> execute();
                }
                $select_total = $con ->prepare("SELECT * FROM total_visitors WHERE time >= ? ");
                $select_total -> bindParam(1,$timeOut);
                $select_total -> execute();
                $total_online_visitors = $select_total ->rowCount();
                
                return $total_online_visitors;

                if(isset($_fundraiser['get_online_visitors'])) {
                    $total_online = total_online();
                    $total_online;
                    exit();
                }
            }catch(PDOException $e) {
        throw new PDOException($e->getMessage());
    }
}


public function get_total_online() {
    try{
          
        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //To get total online visitors
        //$this-> total_online();
        //To get Total Visitors
        $stmt = $con -> prepare("SELECT * FROM total_visitors");
        $stmt -> execute();
        $total_visitors = $stmt -> rowCount();
        
        // To insert page view and select total page views
        $userIP = $_SERVER['REMOTE_ADDR'];
        $page = $_SERVER['PHP_SELF'];

        $insert = $con -> prepare("INSERT INTO pageviews values ('',?,?)");
        $insert -> bindParam(1,$page);
        $insert -> bindParam(2,$userIP);
        $insert -> execute();

        $pageViews = $con -> prepare("SELECT * FROM pageviews");
        $pageViews -> execute();
        $total_pageViews = $pageViews -> rowCount();
        echo "<div class='holder'>";
        echo "<div class='iner'>online <span class='ineris'>".$this-> total_online()."</span></div>";
        echo "<div class='iner'>visitors <span class='ineris'>".$total_visitors."</span></div>";
        echo "<div class='iner'>page views <span class='ineris'>".$total_pageViews."</span></div>";
        echo "</div>";
        }catch(PDOException $e) {
        throw new PDOException($e->getMessage());
    }
}


public function deleteUser() {
    try{
        $userid = "user_id";

        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $delete = $con -> prepare("DELETE FROM users WHERE userid = ? ");
        $delete -> bindParam(1,$userid);
        $delete -> execute();

        }catch(PDOException $e) {
        throw new PDOException($e->getMessage());
    }
}



public function profilePicsUpload($image_name) {
    try{
        $image_final_width = 200;
        $image_final_height = 200;
        $path_to_image_directory = 'images/users_profilePics/';
        $path_to_thumbnail_directory = 'images/user_profilePicsThumbnails/';

        $user_data = $_SESSION['user'];
        $userid = $user_data['id'];
        $image_name = $_FILES['profile_pix']['name'];
        $source = $_FILES['profile_pix']['tmp_name'];
        $target = $path_to_image_directory.$image_name;
        
        move_uploaded_file($source,$target);

        if(preg_match('/[.]jpg$/', $image_name)) {
            $im = imagecreatefromjpeg($path_to_image_directory.$image_name);
        }else if (preg_match('/[.]gif$/', $image_name)) {
            $im = imagecreatefromgif($path_to_image_directory.$image_name);
        }else if (preg_match('/[.]png$/', $image_name)) {
            $im = imagecreatefrompng($path_to_image_directory.$image_name);
        }

        $ox = imagesx($im);
        $oy = imagesy($im);

        $nx = $image_final_width;
        $ny = $image_final_height;

        $nm = imagecreatetruecolor($nx,$ny);

        imagecopyresized($nm, $im, 0,0,0,0, $nx,$ny,$ox,$oy);

        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;", $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if(!file_exists($path_to_image_directory)) {
            if(mkdir($path_to_image_directory)) {
            imagejpeg($nm, $path_to_image_directory.$image_name);
            $thumbnail = $path_to_iamge_directory.$image_name;
            $thumbnail;
            
            $update = $con -> prepare("UPDATE users set profile_pics = '".$thumbnail."' WHERE id = ?");
            $update -> bindParam(1,$userid);
            if($update -> execute()) {
                echo "profile pics successfully uploaded";
                exit();
                }else {
                echo "profile pics upload failed";
                    }
                }
            }else {
            imagejpeg($nm, $path_to_thumbnail_directory.$image_name);
            $thumbnail = $path_to_image_directory.$image_name;
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $update = $con -> prepare("UPDATE users set profile_pics = '".$thumbnail."' WHERE id = ?");
            $update -> bindParam(1,$userid);
            if($update -> execute()) {
                echo "profile pics successfully uploaded";
                exit();
                }else {
                echo "profile pics upload failed";
                    }
                }
        }catch(PDOException $e) {
        throw new pdoexception($e ->getMessage());
    }
}



public function fetchUserDetails() {
    try{
        $user_data = $_SESSION['user'];
        $userid = $user_data['id'];

        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;", $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $select = $con ->prepare("SELECT fname FROM users WHERE id = ? ");
        $select -> bindParam(1,$userid);
        if($select -> execute()) {
            $results = $select -> fetch(PDO::FETCH_ASSOC);
            $uname = $results['fname'];

                if(isset($uname) && $uname != null) {
                    echo "<div class='_users _details'>";
                    echo "<div class='_reter uio'> Name  <div class='_opers uio'>".$uname."</div></div>";
                    echo "</div>";
                }else {
                    echo "<div class='_reter uio'>Name No Name Found</div>";
                }
                
                
            }
    }catch(PDOException $e) {
        throw new PDOException ($e ->getMessage());
    }
}

public function trackId() {
    try{
        $user_data = $_SESSION['user'];
        $userid = $user_data['id'];

        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;", $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $select = $con ->prepare("SELECT investor_id FROM users WHERE id = ? ");
        $select -> bindParam(1,$userid);
        if($select -> execute()) {
            $results = $select -> fetch(PDO::FETCH_ASSOC);
                echo $results['investor_id'];
            }
    }catch(PDOException $e) {
        throw new PDOException ($e ->getMessage());
    }
}


public function fetchUserProfilePics() {
    try{
        $user_data = @$_SESSION['user'];
        $userid = $user_data['id'];
        $email = $user_data['email'];

        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;", $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $select = $con ->prepare("SELECT profile_pics FROM users WHERE email = ?");
        $select -> bindParam(1,$email);
        if($select -> execute() && $select -> rowCount() > 0) {
            $results = $select -> fetch(PDO::FETCH_ASSOC);
            echo "<img src='../images/default_profilePic.png' alt='profile pics' id='profile_pics' class='img-fluid rounded-circle mypics'>";
            }
    }catch(PDOException $e) {
        throw new PDOException ($e ->getMessage());
    }
}


public function fetchUserProfilePicsO() {
    try{
        $user_data = @$_SESSION['user'];
        $userid = @$user_data['id'];
        $email = @$user_data['email'];

        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;", $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $select = $con ->prepare("SELECT profile_pics FROM users WHERE email = ?");
        $select -> bindParam(1,$email);
        if($select -> execute() && $select -> rowCount() > 0) {
            $results = $select -> fetch(PDO::FETCH_ASSOC);
            echo "<img src='images/default_profilePic.png' alt='profile pics' id='profile_pics' class='img-fluid rounded-circle mypics'>";
            }
    }catch(PDOException $e) {
        throw new PDOException ($e ->getMessage());
    }
}



public function allauctions() {
    try{
        $user_data = @$_SESSION['user'];
        $userid = $user_data['id'];
        $email = $user_data['email'];
       
        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $invTyp = $con -> prepare("SELECT DISTINCT auctionChannel FROM fundraiser_table WHERE clientEmail = ?");
        $invTyp -> bindParam(1,$email);
        if($invTyp -> execute() && $invTyp -> rowCount() > 0) {
            $invT = $invTyp -> fetchAll(PDO::FETCH_ASSOC);
            foreach($invT as $item) {
                $investType = $item['auctionChannel'];
                if($investType == 'Buy Shares') {
                    $investTypes = 'Company Shares';
                }else {
                    $investTypes = $investType;
                }
                echo "<div>
                            <i class='fas fa-check-square'></i> $investTypes 
                                <span class='checkmark'></span> 
                    </div>";
                }
            }else {
                echo "<div class='no-invest' id='no-invest' name='no-invest'>No auction Found</div>";
            }
            
        }catch(PDOException $e) {
        throw new PDOException($e->getMessage());
    }
}




public function selectauction() {
    try{
        $user_data = @$_SESSION['user'];
        $userid = $user_data['id'];
        $email = $user_data['email'];
       
        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $invTyp = $con -> prepare("SELECT DISTINCT auctionChannel,auction_type FROM fundraiser_table WHERE clientEmail = ?");
        $invTyp -> bindParam(1,$email);
        
        if($invTyp -> execute() && $invTyp -> rowCount() > 0) {
            $invT = $invTyp -> fetchAll(PDO::FETCH_ASSOC);
            foreach($invT as $item) {
                $investType = $item['auctionChannel'];
                $investCurrency = $item['auction_currency'];
                if($investType == 'Buy Shares') {
                    $investTypes = 'Company Shares';
                }else {
                    $investTypes = $investType;
                }

                echo "<div class='checkcontainer text-left' title='rate me'>
                        <div class='rate-follow'><input type='radio' name='auctionChannel' class='form-checkbox' value='$investTypes' id='auctionChannel'> $investTypes <input type='text' name='auction_currency' class='form-checkbox' value='$investCurrency' id='auction_currency' hidden></div> 
                        <span class='checkmark'></span> 
                    </div>";
                }
            }else {
                echo "<div class='no-invest' id='no-invest' name='no-invest' value='No auction Found'>No auction Found</div>";
            }
            
        }catch(PDOException $e) {
        throw new PDOException($e->getMessage());
    }
}



public function checkWithdrawal() {
    try{
        $user_data = @$_SESSION['user'];
        $userid = $user_data['id'];
        $email = $user_data['email'];

        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $select = $con -> prepare("SELECT * FROM investfunds");
    }catch(PDOException $e) {
        throw new PDOException($e->getMessage());
    }
}




public function withdrawFunds(){
    try{
        $user_data = @$_SESSION['user'];
        $userid = $user_data['id'];
        $email = $user_data['email'];
        $name = $user_data['fname'];
        
        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $withdrawId = randStrGena(6);
        $timestatus = date('Y-m-d H:i:s',time()); 
        $withdrawStatus = 'Processing';

        if(isset($_fundraiser['withdrawalChannel'])) {
            $withdrawChannel = isset($_fundraiser['withdrawalChannel']) ? $_fundraiser['withdrawalChannel'] : false;
            $withdrawAmount = isset($_fundraiser['withdrawalAmount']) ? $_fundraiser['withdrawalAmount'] : false;
            $withdrawalReason = isset($_fundraiser['withdrawalReason']) ? $_fundraiser['withdrawalReason'] : false;
            $withdrawalCurrency = isset($_fundraiser['auction_currency']) ? $_fundraiser['auction_currency'] : false;
            $auctionType = isset($_fundraiser['auctionChannel']) ? $_fundraiser['auctionChannel'] : false;
            $totalEarnings = isset($_fundraiser['totalEarnings']) ? $_fundraiser['totalEarnings'] : false;
            $withdrawBal = $totalEarnings - $withdrawAmount;

            if($withdrawChannel == 'Bitcoin' || $withdrawChannel == 'Ethereum' || $withdrawChannel == 'Litecoin') {
                $walletAddress = isset($_fundraiser['wallet-address']) ? $_fundraiser['wallet-address'] : false;
                $filteredWA = strip_tags($walletAddress);
            }

            $_SESSION['withAmt'] = $withdrawAmount;
            $_SESSION['Email'] = $email;
            $_SESSION['invType'] = $auctionType;
            $_SESSION['fname'] = $name;
            
            $withdraw = $con ->prepare("INSERT INTO withdrawals (withdrawalId,clientEmail,totalEarning,amountWithdrawn,withdrawalBalance,reasonForWithdrawal,withdrawalStatus,withdrawalDate,auctionChannel,auction_currency,withdrawalChannel,walletAddress) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
            $withdraw -> bindParam(1,$withdrawId);
            $withdraw -> bindParam(2,$email);
            $withdraw -> bindParam(3,$totalEarnings);
            $withdraw -> bindParam(4,$withdrawAmount);
            $withdraw -> bindParam(5,$withdrawBal);
            $withdraw -> bindParam(6,$withdrawalReason);
            $withdraw -> bindParam(7,$withdrawStatus);
            $withdraw -> bindParam(8,$timestatus);
            $withdraw -> bindParam(9,$auctionType);
            $withdraw -> bindParam(10,$withdrawalCurrency);
            $withdraw -> bindParam(11,$withdrawChannel);
            $withdraw -> bindParam(12,$walletAddress);
            if($withdraw->execute()) {
                
                $Email = $_SESSION['Email'];
                $auctionType = $_SESSION['invType'];
                $withdrawAmount = $_SESSION['withAmt'];
                $uname = $_SESSION['fname'];
                
                withdrawFundsMail($Email,$auctionType,$withdrawAmount,$uname);
                    echo "<div class='alert-success'> Withdrawal Request Successful <div> Please check your email, we have sent you your withdrawal details </div> <span class='close-err'>&times;</span> </div>";        
                    }else {
                    echo "<div class='alert-success'> Withdrawal Request Successful <div> Please check your email, we have sent you your withdrawal details </div> <span class='close-err'>&times;</span> </div>";
                        exit();
                    }
            
        }        

    }catch(PDOException $e) {
        throw new PDOException($e->getMessage());
    }
}




public function showrecentActivities() {
    try{
        $user_data = @$_SESSION['user'];
        $userid = $user_data['id'];
        $email = $user_data['email'];

        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $selectreg = $con -> prepare("SELECT DISTINCT uname,Fname,Lname,users.profile_pics FROM users  GROUP BY email ORDER BY email ASC LIMIT 10");
        $selectemp = $con -> prepare("SELECT DISTINCT users.Fname,users.Lname,users.uname,fundraiser_table.fundraiserThumbnail FROM users INNER JOIN fundraiser_table ON users.email = fundraiser_table.user_email  GROUP BY users.email ORDER BY fundraiser_table.fundraiserId DESC LIMIT 10");
        $selectcomments = $con -> prepare("SELECT DISTINCT users.Fname,users.Lname,users.uname,users.profile_pics,parentcomments.*,fundraiser_table.fundraiserThumbnail FROM users INNER JOIN parentcomments INNER JOIN fundraiser_table ON users.email = parentcomments.user_email = fundraiser_table.user_email WHERE fundraiser_table.fundraiserThumbnail <> '' GROUP BY parentcomments.user_email ORDER BY parentcomments.comment_time DESC LIMIT 10");
        $selectcomreply = $con -> prepare("SELECT DISTINCT users.Fname,users.Lname,users.uname,users.profile_pics,childrencomments.*,fundraiser_table.fundraiserThumbnail FROM users INNER JOIN childrencomments INNER JOIN fundraiser_table ON users.email = childrencomments.user_email = fundraiser_table.user_email WHERE fundraiser_table.fundraiserThumbnail <> '' GROUP BY childrencomments.user_email ORDER BY childrencomments.comment_time DESC LIMIT 10");
        $selectreg -> execute();
        $selectemp -> execute();
        $selectcomments -> execute();
        $selectcomreply -> execute();
        if($selectemp -> execute() && $selectcomments -> execute() && $selectcomreply -> execute()) {
            $actreg = $selectreg -> fetchAll(PDO::FETCH_ASSOC);
            $thumb = $selectemp -> fetch(PDO::FETCH_ASSOC);
            $selcomments = $selectcomments -> fetchAll(PDO::FETCH_ASSOC);
            $comreply = $selectcomreply -> fetchAll(PDO::FETCH_ASSOC);
            
            echo "<div> <h3> <i class='fas fa-clock h3-icons'></i> RECENT ACTIVITIES </h3></div>";

            foreach($selcomments as $c) {
                $commentOwner = ucfirst($c['commentOwner']);
                $comment = $c['comment'];
                $thumbnail = $c['fundraiserThumbnail'];
                $commenterUname = $c['uname'];
                $fundraiserId = $c['fundraiserId'];

                $querry = $con -> prepare("SELECT fundraiserBy FROM fundraiser_table WHERE fundraiserId = ?");
                $querry -> bindParam(1,$fundraiserId);
                $querry -> execute();
                $f = $querry -> fetch(PDO::FETCH_ASSOC);
                $fundraiserBy = $f['fundraiserBy'];
                echo "<div class='recent-activities'>
                        <ul>
                            <i class='fas fa-check seta'></i> <li><span class='commenter-name'> $commenterUname </span> just commented on $commentOwner's <span class='marqueespan'> <img src='../$thumbnail' class='emp-thumb'> $fundraiserBy </span><i class='fas fa-check'></i></li>
                        </ul>
                    </div>";
            }

            
            foreach($comreply as $rp) {
                $comment = $rp['comment'];
                $commenterUname = $rp['uname'];
                $parentcommentCode = $rp['parentcommentCode'];
                $thumbnail = $rp['fundraiserThumbnail'];
                $fundraiserId = $c['fundraiserId'];

                $querry = $con -> prepare("SELECT fundraiserBy FROM fundraiser_table WHERE fundraiserId = ?");
                $querry -> bindParam(1,$fundraiserId);
                $querry -> execute();
                $f = $querry -> fetch(PDO::FETCH_ASSOC);
                $fundraiserBy = $f['fundraiserBy'];

                $qurry = $con -> prepare("SELECT parentcomments.uname,parentcomments.commentOwner,childrencomments.uname As replyer,childrencomments.comment FROM parentcomments INNER JOIN childrencomments ON parentcomments.commentCode = childrencomments.parentcommentCode WHERE parentcomments.commentCode = ?");
                $qurry -> bindParam(1,$parentcommentCode);
                $qurry -> execute();
                $cf = $qurry -> fetch(PDO::FETCH_ASSOC);
                $parentcommentUname = $cf['uname'];
                $commentOwner = $cf['commentOwner'];
                $replyer = $cf['replyer'];

                echo "<div class='recent-activities'>
                        <ul>
                            <i class='fas fa-check seta'></i> <li> <span class='commenter-name'> $replyer </span> just replied to $parentcommentUname's comment on <span class='marqueepan'> $commentOwner's </span> <span class='marqueespan'><img src='../$thumbnail' class='emp-thumb'> $fundraiserBy </span></li>
                        </ul>
                    </div>";
            }
        }

    }catch(PDOException $e) {
        throw new PDOException($e->getMessage());
    }
}


public function investFunds(){
    try{
        $user_data = @$_SESSION['user'];
        $userid = $user_data['id'];
        $email = $user_data['email'];
        $uname = $user_data['uname'];

        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $investId = randStrGena(6);
        $timestatus = time(); 
        $investStatus = 'Processing';
        
        if(isset($_fundraiser['investmentPackage'])) {
            $investmentPackage = isset($_fundraiser['investmentPackage']) ? $_fundraiser['investmentPackage'] : false;
            $investAmount = isset($_fundraiser['investmentAmount']) ? $_fundraiser['investmentAmount'] : false;
            $investCoin = 'Bitcoin';
            $wA = isset($_fundraiser['wallet_address']) ? $_fundraiser['wallet_address'] : false;

            if($investmentPackage == "Basic") {
                $growthRate = '21% in 7 Days';
                $profitAmount = $investAmount * 0.21;
                $profitROI = '21%';
                $amountEarned = $profitAmount + $investAmount;
                $totalEarnings = $amountEarned;
                $accumulatedgR = $amountEarned;

            }else if($investmentPackage == "Carbon") {
                $growthRate = '24% in 7 Days';
                $profitAmount = $investAmount * 0.24;
                $profitROI = '24%';
                $amountEarned = $profitAmount + $investAmount;
                $totalEarnings = $amountEarned;
                $accumulatedgR = $amountEarned;
            }
            else if($investmentPackage == "Fibre") {
                $growthRate = '26% in 7 Days';
                $profitAmount = $investAmount * 0.26;
                $profitROI = '26%';
                $amountEarned = $profitAmount + $investAmount;
                $totalEarnings = $amountEarned;
                $accumulatedgR = $amountEarned;
            }
            else if($investmentPackage == "Steel") {
                $growthRate = '24% in 7 Days';
                $profitAmount = $investAmount * 0.24;
                $profitROI = '24%';
                $amountEarned = $profitAmount + $investAmount;
                $totalEarnings = $amountEarned;
                $accumulatedgR = $amountEarned;
            }
            else if($investmentPackage == "Bronze") {
                $growthRate = '30% in 7 Days';
                $profitAmount = $investAmount * 0.3;
                $profitROI = '30%';
                $amountEarned = $profitAmount + $investAmount;
                $totalEarnings = $amountEarned;
                $accumulatedgR = $amountEarned;
            }
            else if($investmentPackage == "Silver") {
                $growthRate = '35% in 7 Days';
                $profitAmount = $investAmount * 0.3;
                $profitROI = '35%';
                $amountEarned = $profitAmount + $investAmount;
                $totalEarnings = $amountEarned;
                $accumulatedgR = $amountEarned;
            }
            else if($investmentPackage == "Gold") {
                $growthRate = '40% in 7 Days';
                $profitAmount = $investAmount * 0.4;
                $profitROI = '40%';
                $amountEarned = $profitAmount + $investAmount;
                $totalEarnings = $amountEarned;
                $accumulatedgR = $amountEarned;
            }
            else if($investmentPackage == "VIP") {
                $growthRate = '40% in 7 Days';
                $profitAmount = $investAmount * 0.4;
                $profitROI = '40%';
                $amountEarned = $profitAmount + $investAmount;
                $totalEarnings = $amountEarned;
                $accumulatedgR = $amountEarned;
            }

            $timestatus = time();
            $currentgrowthRate = 0;
            $investStatus = 'Confirmed';
            $withdrawalStatus = 'Locked';
            $withdrawalTime = '7 Days';

            $invst = $con ->prepare("INSERT INTO investment_table (investmentId,clientEmail,wallet_address,investmentAmount,investmentPackage,investmentCoin,totalEarningAmount,profitROI,profitAmount,amountEarned,growthRate,accumulatedgrowthRate,withdrawalStatus,withdrawalTime,investmentDate,investmentStatus) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $invst -> bindParam(1,$investId);
            $invst -> bindParam(2,$email);
            $invst -> bindParam(3,$wA);
            $invst -> bindParam(4,$investAmount);
            $invst -> bindParam(5,$investmentPackage);
            $invst -> bindParam(6,$investCoin);
            $invst -> bindParam(7,$totalEarnings);
            $invst -> bindParam(8,$profitROI);
            $invst -> bindParam(9,$profitAmount);
            $invst -> bindParam(10,$amountEarned);
            $invst -> bindParam(11,$growthRate);
            $invst -> bindParam(12,$accumulatedgR);
            $invst -> bindParam(13,$withdrawalStatus);
            $invst -> bindParam(14,$withdrawalTime);
            $invst -> bindParam(15,$timestatus);
            $invst -> bindParam(16,$investStatus);
            if($invst->execute()) {
                
                investFundsMail($Email,$investmentPackage,$investAmount,$uname);
                echo "<div class='alert-success'> Investment Request Successful <div> Please check your email, we have sent you your investment details </div> <span class='close-err'>&times;</span> </div>";        
                }else {
                echo "<div class='alert-success'> Investment Request Successful <div> Please check your email, we have sent you your investment details </div> <span class='close-err'>&times;</span> </div>";
                    exit();
                }

            }
    }catch(PDOException $e) {
        throw new PDOException($e->getMessage());
    }
}



public function calcProfits(){
    try{
        $user_data = @$_SESSION['user'];
        $userid = $user_data['id'];
        $email = $user_data['email'];
        $uname = $user_data['uname'];

        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $investId = randStrGena(6);
        $timestatus = time(); 
        $investStatus = 'Processing';
        $inv = $con->prepare("SELECT investmentId,investmentAmount,investmentCoin,growthRate,accumulatedgrowthRate,investmentStatus,investmentDate FROM investment_table WHERE clientEmail = ? ");
        $inv -> bindParam(1,$email_of_user);
        if($inv -> execute()) {
            $in = $inv -> fetch(PDO::FETCH_ASSOC);
            $invAmt = $in['investmentAmount'];
            $growthrate = $in['accumulatedgrowthRate'];
            $invDate = $in['investmentDate'];
            
            $sevenDaysinsecs = 604800;
            $sevenDayInterval = $invDate + $sevenDaysinsecs;
            $time = time();
        
            if($time >= $sevenDayInterval) {
                $pay;
            }

        }
    }catch(PDOException $e) {
        throw new PDOException($e->getMessage());
    }
}




public function marqueeTicker() {
    try{
        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $selectreg = $con -> prepare("SELECT DISTINCT uname,Fname,Lname,users.profile_pics FROM users  GROUP BY email ORDER BY email ASC LIMIT 10");
        $selectemp = $con -> prepare("SELECT DISTINCT users.Fname,users.Lname,users.uname,fundraiser_table.fundraiserThumbnail FROM users INNER JOIN fundraiser_table ON users.email = fundraiser_table.user_email  GROUP BY users.email ORDER BY fundraiser_table.fundraiserId DESC LIMIT 10");
        $selectcomments = $con -> prepare("SELECT DISTINCT users.Fname,users.Lname,users.uname,users.profile_pics,parentcomments.*,fundraiser_table.fundraiserThumbnail FROM users INNER JOIN parentcomments INNER JOIN fundraiser_table ON users.email = parentcomments.user_email = fundraiser_table.user_email WHERE fundraiser_table.fundraiserThumbnail <> '' GROUP BY parentcomments.user_email ORDER BY parentcomments.comment_time DESC LIMIT 10");
        $selectcomreply = $con -> prepare("SELECT DISTINCT users.Fname,users.Lname,users.uname,users.profile_pics,childrencomments.*,fundraiser_table.fundraiserThumbnail FROM users INNER JOIN childrencomments INNER JOIN fundraiser_table ON users.email = childrencomments.user_email = fundraiser_table.user_email WHERE fundraiser_table.fundraiserThumbnail <> '' GROUP BY childrencomments.user_email ORDER BY childrencomments.comment_time DESC LIMIT 10");
        $selectreg -> execute();
        $selectemp -> execute();
        $selectcomments -> execute();
        $selectcomreply -> execute();
        if($selectemp -> execute() && $selectcomments -> execute() && $selectcomreply -> execute()) {
            $actreg = $selectreg -> fetchAll(PDO::FETCH_ASSOC);
            $thumb = $selectemp -> fetch(PDO::FETCH_ASSOC);
            $selcomments = $selectcomments -> fetchAll(PDO::FETCH_ASSOC);
            $comreply = $selectcomreply -> fetchAll(PDO::FETCH_ASSOC);
            
            foreach($selcomments as $c) {
                $commentOwner = ucfirst($c['commentOwner']);
                $comment = $c['comment'];
                $thumbnail = $c['fundraiserThumbnail'];
                $commenterUname = $c['uname'];
                $fundraiserId = $c['fundraiserId'];

                $querry = $con -> prepare("SELECT fundraiserBy FROM fundraiser_table WHERE fundraiserId = ?");
                $querry -> bindParam(1,$fundraiserId);
                $querry -> execute();
                $f = $querry -> fetch(PDO::FETCH_ASSOC);
                $fundraiserBy = $f['fundraiserBy'];
                echo "<div class='lista'>
                        <ul>
                            <li><span class='commenter-name'> $commenterUname </span> just commented on $commentOwner's <span class='marqueespan'> <img src='../$thumbnail' class='emp-thumb'> $fundraiserBy <a href='../waep.africa' style='text-decoration: none' target='_blank'><span style='color: orange'>waep.africa</span></a> </span></li>
                        </ul>
                    </div>";
            }

            foreach($actreg as $r) {
                $invfname = ucfirst($r['Fname']);
                $invlname = ucfirst($r['Lname']);
                $invuname = ucfirst($r['uname']);

                echo "<div class='lista'>
                        <ul>
                            <li> <span class='marque-name'>$invfname $invlname</span> just joined <span class='marqueespan'> <a href='../waep.africa' target='_blank' style='text-decoration: none'><span style='color: orange'>waep.africa</span></a> </span></li>
                        </ul>
                    </div>";
            }
            
            foreach($comreply as $rp) {
                $comment = $rp['comment'];
                $commenterUname = $rp['uname'];
                $parentcommentCode = $rp['parentcommentCode'];
                $thumbnail = $rp['fundraiserThumbnail'];
                $fundraiserId = $c['fundraiserId'];

                $querry = $con -> prepare("SELECT fundraiserBy FROM fundraiser_table WHERE fundraiserId = ?");
                $querry -> bindParam(1,$fundraiserId);
                $querry -> execute();
                $f = $querry -> fetch(PDO::FETCH_ASSOC);
                $fundraiserBy = $f['fundraiserBy'];

                $qurry = $con -> prepare("SELECT parentcomments.uname,parentcomments.commentOwner,childrencomments.uname As replyer,childrencomments.comment FROM parentcomments INNER JOIN childrencomments ON parentcomments.commentCode = childrencomments.parentcommentCode WHERE parentcomments.commentCode = ?");
                $qurry -> bindParam(1,$parentcommentCode);
                $qurry -> execute();
                $cf = $qurry -> fetch(PDO::FETCH_ASSOC);
                $parentcommentUname = $cf['uname'];
                $commentOwner = $cf['commentOwner'];
                $replyer = $cf['replyer'];

                echo "<div class='lista'>
                        <ul>
                            <li><span class='commenter-name'> $replyer </span> just replied to $parentcommentUname's comment on <span class='marqueepan'> $commentOwner </span> <span class='marqueespan'><img src='../$thumbnail' class='emp-thumb'> $fundraiserBy <a href='../waep.africa' target='_blank' style='text-decoration: none'><span style='color: orange'>waep.africa</span></a> </span></li>
                        </ul>
                    </div>";
            }
        }

    }catch(PDOException $e) {
        throw new PDOException($e->getMessage());
    }
}



public function fundraiserBy() {
    try{
        $user_data = @$_SESSION['user'];
        $userid = $user_data['id'];
        $name = $user_data['uname'];
        $email = $user_data['email'];
        
        $empId = strip_tags($_GET['fundraiserId']);
        $empname = strip_tags($_GET['uname']);
        
        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $con -> prepare("SELECT fundraiserBy FROM fundraiser_table WHERE uname = ? AND fundraiserId = ?");
        $query -> bindParam(1,$empname);
        $query -> bindParam(2,$empId);
        $query -> execute();
        if($query -> execute() || $emot -> execute()) {
            $row = $query -> fetch(PDO::FETCH_ASSOC);
            echo $row['fundraiserBy'];
        }
    }catch(PDOException $e) {
        throw new PDOException($e->getMessage());
    }
}



public function topFollowers() {
    try{
        $user_data = @$_SESSION['user'];
        $userid = $user_data['id'];
        $name = $user_data['uname'];
        $email = $user_data['email'];
        // SELECT parentcomments.uname,parentcomments.likes,parentcomments.dislikes,parentcomments.comment,parentcomments.commentupload,parentcomments.documentType,parentcomments.fileType,users.profile_pics,parentcomments.comment_time,parentcomments.fundraiserId,parentcomments.commentCode FROM parentcomments INNER JOIN users ON parentComments.uname = users.uname  WHERE parentcomments.fundraiserId = ? ORDER BY parentcomments.comment_time DESC LIMIT 20
        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $con -> prepare("SELECT fundraiser_table.totalFollowers,fundraiserThumbnail,fundraiser_table.fundraiserTitle,fundraiser_table.fundraiserId,users.uname FROM fundraiser_table INNER JOIN users ON fundraiser_table.user_email = users.email WHERE fundraiser_table.totalFollowers <> ''  GROUP BY fundraiser_table.user_email ORDER BY totalFollowers DESC LIMIT 20");
        if($query -> execute()) {
            $rows = $query -> fetchALL(PDO::FETCH_ASSOC);
            echo "<div> <h3> <i class='fas fa-users h3-icons'></i> TRENDING FOLLOWERS </h3></div>";
            foreach($rows as $row) {

                $followers = $row['totalFollowers'];
                $uname = $row['uname'];
                $thumb = $row['fundraiserThumbnail'];
                $empTitle = $row['fundraiserTitle'];
                // first strip any formatting;
                      
                $followersd = (0+str_replace(",","",$followers));
                    
                // is this a number?
                if(!is_numeric($followersd)) return false;
                
                // now filter it;
                if($followers>1000000000000) {
                    $followersd = round(($followers/1000000000000),1).' trillion';
                }
                else if($followers>1000000000) {
                    $followersd = round(($followers/1000000000),1).' billion';
                } 
                else if($followers>1000000) {
                    $followersd = round(($followers/1000000),1).' million';
                }
                else if($followers>1000) {
                    $followersd = round(($followers/1000),1).' thousand';
                }else {
                    $followersd = number_format($followers);
                }


                if($followers == 0) {
                    $followers = $row['TotalFollowers']."<span> Follower </span>";
                }else if($row['totalFollowers'] == 1) {
                    $followers = $row['TotalFollowers']."<span > Follower </span>";
                }else{
                    $followers = $followersd."<span> Followers </span>";
                }
                echo "<div class='top-followers'>
                        <a target='_blank' href=''>
                            <img src='../".$row['fundraiserThumbnail']."' alt='empower image' class='top-followers-img img-responsive'/>
                            <div class='top-follow-trends text-left'>
                                <div class='em-title'> $empTitle </div>
                                
                                <div class='u-names'><span class='user-nam'> User: </span><span class='u-names' style=''>".ucwords($row['uname'])."</span> </div>
                                    
                                <div class='followers-count'><span class='_uipo'><span class='followers-count'> <i class='fas fa-users' style='color: orange'></i> ".$followers."</span></span></div>
                            </div>
                        </a>
                    </div>";

                    echo "<div class='end-float'></div><hr>";
                }
            
        }
    }catch(PDOException $e) {
        throw new PDOException($e->getMessage());
    }
}





public function readfundraiser() {
    try{
        
        if(preg_match("/^[a-zA-Z0-9]*$/",$_GET['fundraiserId'])) {
            $fundraiser_Id = htmlentities(trim($_GET['fundraiserId']));
            
            $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = $con -> prepare("SELECT * FROM fundraiser_table WHERE fundraiserId = ?");
            $qery = $con -> prepare("SELECT totalFollowers FROM fundraiser_table WHERE fundraiserId = ?");
            $selectdoc = $con -> prepare("SELECT uploadedBy,uploadedDocument,fileType,documentType FROM documentuploads WHERE fundraiserId = ?");
            $selectdoc -> bindParam(1,$fundraiser_Id);
            $selectdoc -> execute();
            $qery -> bindParam(1,$fundraiser_Id);
            $qery -> execute();
            $query -> bindParam(1,$fundraiser_Id);
            $query -> execute();
            if($query -> execute()) {
                $row = $query -> fetch(PDO::FETCH_ASSOC);
                $rw = $qery -> fetch(PDO::FETCH_ASSOC);
                $r = $selectdoc -> fetch(PDO::FETCH_ASSOC);
                
                    //   $name = $row['_name'];
                    //   $ad = $r['ad'];
                    //   if($row['url'] != "") {
                    //       $url = $row['url'];  
                    //   }else if($r['ad'] != "") {
                    //       $url = $r['adVideo'];
                    //   }
                    $id = $row['id'];
                    $emp_id = $row['fundraiserId'];
                    $title = $row['fundraiserTitle'];
                    $fundraiserBy = $row['fundraiserBy'];
                    $fundraiserContent = $row['fundraiserContent'];
                    $_SESSION['fundraiserTitle'] = $title;
                    $uploadedBy = $r['uploadedBy'];
                    $views = $row['totalViews'];
                    $likes = $row['totalLikes'];
                    $shares = $row['totalShares'];
                    $empThumb = $row['fundraiserThumbnail'];
                    $comments = $row['totalComments'];
                    //   $downloads = $row['downloads'];
                    $tupvotes = $row['totalupVotes'];
                    $followers = $row['totalFollowers'];
                    $time = $row['dateSubmitted'];
                    $category = $row['fundraiserCategory'];
                    //   $cutvid = $row['cutvid'];
                        // for views
                        
                        // PHP program to convert timestamp
                        // to time ago
                        
                            
                            // Calculate difference between current
                            // time and given timestamp in seconds
                            // PHP program to convert timestamp
                    // to time ago
                
                    
                    // Calculate difference between current
                    // time and given timestamp in seconds
                    $diff     = time() - $time;
                    
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
                        $fundraisertime = "$sec seconds ago";
                    }
                    
                    // Check for minutes
                    else if($min <= 60) {
                        if($min==1) {
                            $fundraisertime = "one minute ago";
                        }
                        else {
                            $fundraisertime = "$min minutes ago";
                        }
                    }
                    
                    // Check for hours
                    else if($hrs <= 24) {
                        if($hrs == 1) { 
                            $fundraisertime = "an hour ago";
                        }
                        else {
                            $fundraisertime = "$hrs hours ago";
                        }
                    }
                    
                    // Check for days
                    else if($days <= 7) {
                        if($days == 1) {
                            $fundraisertime = "Yesterday";
                        }
                        else {
                            $fundraisertime = "$days days ago";
                        }
                    }
                    
                    // Check for weeks
                    else if($weeks <= 4.3) {
                        if($weeks == 1) {
                            $fundraisertime = "a week ago";
                        }
                        else {
                            $fundraisertime = "$weeks weeks ago";
                        }
                    }
                    
                    // Check for months
                    else if($mnths <= 12) {
                        if($mnths == 1) {
                            $fundraisertime = "a month ago";
                        }
                        else {
                            $fundraisertime = "$mnths months ago";
                        }
                    }
                    
                    // Check for years
                    else {
                        if($yrs == 1) {
                            $fundraisertime = "one year ago";
                        }
                        else {
                            $fundraisertime = "$yrs years ago";
                        }
                    }
            }

            // first strip any formatting;
            $views = (int)($views);
                
            // is this a number?
            if(is_numeric($views)) {
            // now filter it;
            if($views>1000000000000) {
                $views = round(($views/1000000000000),1).' trillion';
            }
            else if($views>1000000000) {
                $views = round(($views/1000000000),1).' billion';
            } 
            else if($views>1000000) {
                $views = round(($views/1000000),1).' million';
            }
            else if($views>1000) {
                $views = round(($views/1000),1).' thousand';
            }else {
                $views = number_format($views);
            }
            }
            
            

            // first strip any formatting;
            $likes = (int)($likes);
                
            // is this a number?
            if(!is_numeric($likes)) return false;
            
            // now filter it;
            if($likes>1000000000000) {
                $likes = round(($likes/1000000000000),1).' trillion';
            }
            else if($likes>1000000000) {
                $likes = round(($likes/1000000000),1).' billion';
            } 
            else if($likes>1000000) {
                $likes = round(($likes/1000000),1).' million';
            }
            else if($likes>1000) {
                $likes = round(($likes/1000),1).' thousand';
            }else {
                $likes = number_format($likes);
            }

            // first strip any formatting;
            $tupvotes = (int)($tupvotes);
                
            // is this a number?
            if(!is_numeric($tupvotes)) return false;
            
            // now filter it;
            if($tupvotes>1000000000000) {
                $tupvotes = round(($tupvotes/1000000000000),1).' trillion';
            }
            else if($tupvotes>1000000000) {
                $tupvotes = round(($tupvotes/1000000000),1).' billion';
            } 
            else if($tupvotes>1000000) {
                $tupvotes = round(($tupvotes/1000000),1).' million';
            }
            else if($tupvotes>1000) {
                $tupvotes = round(($tupvotes/1000),1).' thousand';
            }else {
                $tupvotes = number_format($tupvotes);
            }

            // first strip any formatting;
            $shares = (int)($shares);
                
            // is this a number?
            if(!is_numeric($shares)) return false;
            
            // now filter it;
            if($shares>1000000000000) {
                $shares = round(($shares/1000000000000),1).' trillion';
            }
            else if($shares>1000000000) {
                $shares = round(($shares/1000000000),1).' billion';
            } 
            else if($shares>1000000) {
                $shares = round(($shares/1000000),1).' million';
            }
            else if($shares>1000) {
                $shares = round(($shares/1000),1).' thousand';
            }else {
                $shares = number_format($shares);
            }


            
                
            $doc_ext = $selectdoc -> fetchAll(PDO::FETCH_ASSOC);


        @$_SESSION['currentpage'] = $_SERVER['REQUEST_URI'];
        $pageUrl = strip_tags(@$_SESSION['currentpage']);

        echo "<div class='text-left fundraisercontent'>
                <div class=''>
                    <img src='../$empThumb' class='thumbnail-img' style='' alt='empower thumbnail'>
                </div>
                <div class='page-owner mt-2 mb-2'>
                    <span class='fundraisertimed'><b>$category | $fundraisertime</b></span>  <span id='uploadby'>$fundraiserBy</span>
                </div>
                ";

        echo "<div id=''>
                <h1 class='fundraiserTitle text-center'> $title </h1>
                
                <div id='l'>
                    <div class=''><p class='e-content'> $fundraiserContent </p></div>";

                    if($fundraiserBy == 'Business') {
                        echo "<h1> Uploaded Documents </h1>";
                    }
                    else if($fundraiserBy == 'Talent') {
                        echo "<h1> Uploaded Documents </h1>";
                    }else if($fundraiserBy == 'Idea') {
                        echo "<h1> Uploaded Documents </h1>";
                    }

                    foreach($doc_ext as $docExt) {

                        $fileType = $docExt['fileType'];
                        $docType = $docExt['documentType'];
                        $document = $docExt['uploadedDocument'];
                        
                        $video_files = ['video/mp4','video/webm','video/mkv','video/avi','video/3gp'];
                        $image_files = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg'];
                        $pdf_files = ['application/pdf'];
                        $txt_files = ['text/plain'];

                        if (in_array($fileType, $video_files)) {
                            // echo '<div class="select-doc"><video width="100%" height="465" controls data-fundraiserer="'.$empThumb.'">
                            //         <source src="'.$document.'" type="video/mp4">
                            //     </video></div>';
                            
                        }
                        
                        if (in_array($fileType, $image_files)) {
                            // echo "<div class='select-doc'>
                            //         <img src='../$document' alt='empower thumbnail' width='100%' height='520px' class='empower-thumbnail'>
                                    
                            //     </div>";
                        }
                    
                        if (in_array($fileType, $pdf_files)) {
                            // echo '<div class="select-doc">
                            //         <embed src="'.$document.'" width="100%" height="720px" />
                            //     </div>';
                            
                        }
                    
                        if (in_array($fileType, $txt_files)) {
                            // echo "<div class='select-doc'><img src='../$document' alt='empower thumbnail' width='100%' height='720px' class='empower-thumbnail'></div><div class='end-float'></div>";
                        }
                        
                        
                    }

                        echo "</div>
                    </div>";

            $views = true;
    
            // $up_video = $con -> prepare("INSERT INTO views (views,fundraiserId) VALUES (?,?)");
            // $up_video -> bindParam(1,$views);
            // $up_video -> bindParam(2,$fundraiser_Id);
            // if($up_video -> execute()) {
            //     $select = $con -> prepare("SELECT views FROM views WHERE fundraiserId = ?");
            //     $select -> bindParam(1,$fundraiser_Id);
            //     $select -> execute();
            //     $count = $select ->rowCount();
                
            //     //update table videos column shares with shares counts of the video id
                
            //     $update = $con -> prepare("UPDATE fundraiser_table SET totalViews = '".$count."' WHERE fundraiserId = ?");
            //     $update -> bindParam(1,$fundraiser_id);
            //     $update -> execute();
            // }

    
        }
        else {
            $vid_no = "";
        }
    
    echo "</div>";
    
        }catch(PDOException $e) {
    throw new PDOException($e -> getMessage());
    }
}



public function userBio() {
    try{
        $user_data = @$_SESSION['user'];
        $userid = $user_data['id'];
        $name = $user_data['uname'];
        $email = $user_data['email'];
        
        $empId = $_SESSION['fundraiserId'];
        
        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $con -> prepare("SELECT userBio FROM fundraiser_table WHERE fundraiserId = ?");
        $query -> bindParam(1,$email);
        $query -> bindParam(2,$empId);
        $query -> execute();
        if($query -> execute()) {
            $row = $query -> fetch(PDO::FETCH_ASSOC);

            $userBio = $row['userBio'];

            echo "<div class='u-bio'>
                    <div class='mybio text-left'>
                        <div class='userbio' style=''>".$row['userBio']."</div> 
                    </div>
                </div>";

            }    
        }catch(PDOException $e) {
        throw new PDOException($e -> getMessage());
    }
}






public function specialRow() {
    try{
        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //fetch all available artists...........
        $stmt = $con -> prepare("SELECT fundraiser_table.* FROM fundraiser_table WHERE fundraiserThumbnail <> '' OR fundraiserThumbnail <> null GROUP BY fundraiser_table.fundraiserId ORDER BY fundraiser_table.dateSubmitted DESC LIMIT 8");
        
        if($stmt -> execute() && $stmt -> rowCount() > 0) {
            $rows = $stmt -> fetchALL(PDO::FETCH_ASSOC);
            foreach($rows as $row) {

                $id = $row['id'];
                $fundraiseredB = $row['fundraiserBy'];
                $fundraiserBy = str_replace(" ",'-',$fundraiseredB);
                $title = $row['fundraiserTitle'];
                $titled = str_replace(" ",'-',$title);
                $fundraiserId = $row['fundraiserId'];
                $view = $row['totalViews'];
                $likes = $row['totalLikes'];
                $shares = $row['totalShares'];
                $upvotes = $row['totalupVotes'];
                $fundraiserThumbnail = $row['fundraiserThumbnail'];
                $time = $row['dateSubmitted'];
                $pstitle = substr($title,0,40).'...';
                $category = $row['fundraiserCategory'];// first strip any formatting;
                $upvotesd = (0+str_replace(",","",$upvotes));
                 
                echo "<div class='top-rank-col'>
                        <a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' class='top-rank-link' style='text-decoration: none'>
                            <div class=''>
                                <img src='../$fundraiserThumbnail' alt='Thumbnail' class='emp-img img-responsive'/>
                            </div>

                            <div class='rate-s'>
                                <div class='col-12 '>
                                    <a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;'>
                                        <div class='fulltitle-spec'> $pstitle </div>
                                    </a>
                                </div> 
                            </div>
                        </a>
                    </div>";
                    echo "<hr>";
                }
            }    
        }catch(PDOException $e) {
        throw new PDOException($e -> getMessage());
    }
}



public function fundraiserList() {
    try{
        
        $user_data = @$_SESSION['user'];
        $userid = $user_data['id'];
        $name = $user_data['uname'];
        $email = $user_data['email'];

        $fundraiserId = @strip_tags($_GET['fundraiserId']);

        $pages = isset($_GET['page']) ? $_GET['page'] : 1;
        $page = intval($pages);
        if($page == 0) {
            $page = 1;
        }
        $limit = 10;
        $start = ($page - 1) * $limit;
        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $con -> prepare("SELECT * FROM fundraiser_table");
        $query -> execute(); 
        $sql = $con -> prepare("SELECT * FROM fundraiser_table GROUP BY fundraiserId ORDER BY RAND() LIMIT $start,$limit");
        $sql -> bindParam(1,$email);
        $sql -> execute();

        $paginate = $con->prepare("SELECT count(id) AS id FROM fundraiser_table GROUP BY fundraiserId");
        $paginate -> execute();
        
            if($sql -> execute() && $query -> execute() && $paginate -> execute()) {
                
            // pagination code

                $countd = $paginate -> fetchAll(PDO::FETCH_ASSOC);
                $totalcountd = $countd[0]['id'];
                $pages = ceil($totalcountd / $limit); 
                $Previous = $page - 1;
                $Next = $page + 1;

                $videoCount = $query -> rowCount(); 
                $getown = $sql -> fetch(PDO::FETCH_ASSOC);
                $rows = $sql -> fetchALL(PDO::FETCH_ASSOC);
                
                $ownnerName = $getown['uname'];

                if($sql -> rowCount() > 1) {
                    
                }
                echo "<div class='user-emplist'>
                Other Amazing Shares By <span style='color: orange'
                >$ownnerName</span>
            </div>";
                echo "<div class='row'>"; 

                foreach($rows as $row) {
                    //   $url = "https://empowerafrica.com/".$row['url'];
                    $id = $row['id'];
                    $fundraiserBy = $row['fundraiserBy'];
                    $title = $row['fundraiserTitle'];
                    $pstitle = substr($title,0,40).'...';
                    $fundraiserId = $row['fundraiserId'];
                    $view = $row['totalViews'];
                    $likes = $row['totalLikes'];
                    $shares = $row['totalShares'];
                    $upvotes = $row['totalupVotes'];
                    $fundraiserThumbnail = $row['fundraiserThumbnail'];
                    //   $cutvid = $row['cutvid'];
                        // for views
                    
                    // first strip any formatting;
                    $view = (0+str_replace(",","",$view));
                    
                    // is this a number?
                    if(!is_numeric($view)) return false;
                    
                    // now filter it;
                    if($view>1000000000000) {
                        $view = round(($view/1000000000000),1).' trillion';
                    }
                    else if($view>1000000000) {
                        $view = round(($view/1000000000),1).' billion';
                    } 
                    else if($view>1000000) {
                        $view = round(($view/1000000),1).' million';
                    }
                    else if($view>1000) {
                        $view = round(($view/1000),1).' thousand';
                    }else {
                        $view = number_format($view);
                    }


                    $upvotes = (0+str_replace(",","",$upvotes));
                    
                    // is this a number?
                    if(!is_numeric($view)) return false;
                    
                    // now filter it;
                    if($upvotes>1000000000000) {
                        $upvotes = round(($upvotes/1000000000000),1).' trillion';
                    }
                    else if($upvotes>1000000000) {
                        $upvotes = round(($upvotes/1000000000),1).' billion';
                    } 
                    else if($upvotes>1000000) {
                        $upvotes = round(($upvotes/1000000),1).' million';
                    }
                    else if($upvotes>1000) {
                        $upvotes = round(($upvotes/1000),1).' thousand';
                    }else {
                        $upvotes = number_format($upvotes);
                    }
                        
                        
                    
                echo "<div class='col-xs-12 col-sm-6 col-md-4 col-lg-4 show-emp-list'>";
                
                // echo "<a target='_blank' href='../mypage.php?fundraiserId=$fundraiserId'><iframe style='display:none;width:100%;' fundraiserer='$fundraiserThumbnail' class='videoslideshow'><source src='../$cutvid'></source></iframe></a>";
                
                echo "<div class='listings'>";

                    echo "<div class='emp-thump-wrapper'>
                            <a target='_blank' href='../page.php?$uname/$fundraiserBy/$fundraiserId' style='text-decoration:none;'>
                                <img src='../$fundraiserThumbnail' name='thumbsvid' alt='thumbnail image' value='$fundraiserId' class='img-fluid img-responsive img-rounded emp-thumb'><span class='values' name ='ling' ></span>
                            </a>
                        </div>";

                    echo "<div class='ro'>
                            <div class='col-12 c-title'>
                                <a target='_blank' href='../page.php?$uname/$fundraiserBy/$fundraiserId' style='text-decoration:none;'>
                                    <div class='e-title padding ' title='empower tile'>".$pstitle."</div> <div class='full-title text-gray'> $title </div>
                                </a>
                            </div>
                        </div>";

                    echo "<div class='rowt'>
                            <div class='pb-2 e-react text-left'>
                                <div class='tripple-view u-react'>
                                    <i class='far fa-eye user-act'></i> ".$view." 
                                </div>
                                <div class='tripple-vote mr-5'>
                                    <i class='far fa-heart user-act'></i> ".$upvotes." 
                                </div>
                            </div>

                        </div>";
                
                echo "</div>";
                
                echo "</div>";

                }
                echo "</div>";

                echo "<div class='row text-center col-12 paginate-add'>
                    <div class='col-12 text-center paginate'>
                        <nav aria-label='Page navigation'>
                            <ul class='pagination text-center'>";
                        if($page > 1) {
                            echo "<li class='active'>
                                    <a href='../page.php?$uname/$fundraiserBy/$fundraiserId/$Previous' aria-label='Previous'>
                                        <span aria-hidden='true'>
                                            &laquo; Previous                        
                                        </span>
                                    </a>
                                </li>";
                        }       
                        
                                for($i = 1; $i <= $pages; $i++) {
                                    echo "<li class='inner'><a href='../page.php?$uname/$fundraiserBy/$fundraiserId/$i'>$i</a></li>";
                                }
                        
                        echo "<li>
                                    <a href='../page.php?$uname/$fundraiserBy/$fundraiserId/$Next' aria-label='Next'>
                                        <span aria-hidden='true'>
                                            Next &raquo;                        
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>";
                
            }else {
                echo "<div class='alert-success p-2 m-3 rounded'> No Listing Found <a target='_blank' href='../checkoutpay.php'>Add A Listing To Get Empowered </a> <span class='close-err'>&times;</span> </div>";
                return false;
        }    
    }catch(PDOException $e) {
    throw new PDOException($e -> getMessage());
    }
 }



 
 public function topfundraiser() {
    try{
        
        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $con -> prepare("SELECT * FROM fundraiser_table");
        $query -> execute(); 
        $sql = $con -> prepare("SELECT DISTINCT * FROM fundraiser_table WHERE fundraiserThumbnail <> '' OR fundraiserThumbnail <> null GROUP BY fundraiserId ORDER BY RAND() LIMIT 2");
        $sql -> execute();

            if($sql -> execute() && $query -> execute() ) {
                
            // pagination code

                $rows = $sql -> fetchALL(PDO::FETCH_ASSOC);

                echo "<div class='row'>"; 

                foreach($rows as $row) {
                    //   $url = "https://empowerafrica.com/".$row['url'];
                    $id = $row['id'];
                    $fundraiseredB = $row['fundraiserBy'];
                    $fundraiserBy = str_replace(" ",'-',$fundraiseredB);
                    $title = $row['fundraiserTitle'];
                    $titled = str_replace(" ",'-',$title);
                    $fundraiserId = $row['fundraiserId'];
                    $view = $row['totalViews'];
                    $likes = $row['totalLikes'];
                    $shares = $row['totalShares'];
                    $upvotes = $row['totalupVotes'];
                    $fundraiserThumbnail = $row['fundraiserThumbnail'];
                    $time = $row['dateSubmitted'];
                    $category = $row['fundraiserCategory'];
                    //   $cutvid = $row['cutvid'];
                        // for views
                        
                        // PHP program to convert timestamp
                        // to time ago
                        
                            
                            // Calculate difference between current
                            // time and given timestamp in seconds
                            // PHP program to convert timestamp
                    // to time ago
                
                    
                    // Calculate difference between current
                    // time and given timestamp in seconds
                    $diff     = time() - $time;
                    
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
                        $fundraisertime = "$sec seconds ago";
                    }
                    
                    // Check for minutes
                    else if($min <= 60) {
                        if($min==1) {
                            $fundraisertime = "one minute ago";
                        }
                        else {
                            $fundraisertime = "$min minutes ago";
                        }
                    }
                    
                    // Check for hours
                    else if($hrs <= 24) {
                        if($hrs == 1) { 
                            $fundraisertime = "an hour ago";
                        }
                        else {
                            $fundraisertime = "$hrs hours ago";
                        }
                    }
                    
                    // Check for days
                    else if($days <= 7) {
                        if($days == 1) {
                            $fundraisertime = "Yesterday";
                        }
                        else {
                            $fundraisertime = "$days days ago";
                        }
                    }
                    
                    // Check for weeks
                    else if($weeks <= 4.3) {
                        if($weeks == 1) {
                            $fundraisertime = "a week ago";
                        }
                        else {
                            $fundraisertime = "$weeks weeks ago";
                        }
                    }
                    
                    // Check for months
                    else if($mnths <= 12) {
                        if($mnths == 1) {
                            $fundraisertime = "a month ago";
                        }
                        else {
                            $fundraisertime = "$mnths months ago";
                        }
                    }
                    
                    // Check for years
                    else {
                        if($yrs == 1) {
                            $fundraisertime = "one year ago";
                        }
                        else {
                            $fundraisertime = "$yrs years ago";
                        }
                    }
                        
                    // first strip any formatting;
                    $view = (0+str_replace(",","",$view));
                    
                    // is this a number?
                    if(!is_numeric($view)) return false;
                    
                    // now filter it;
                    if($view>1000000000000) {
                        $view = round(($view/1000000000000),1).' trillion';
                    }
                    else if($view>1000000000) {
                        $view = round(($view/1000000000),1).' billion';
                    } 
                    else if($view>1000000) {
                        $view = round(($view/1000000),1).' million';
                    }
                    else if($view>1000) {
                        $view = round(($view/1000),1).' thousand';
                    }else {
                        $view = number_format($view);
                    }


                    $upvotes = (0+str_replace(",","",$upvotes));
                    
                    // is this a number?
                    if(!is_numeric($view)) return false;
                    
                    // now filter it;
                    if($upvotes>1000000000000) {
                        $upvotes = round(($upvotes/1000000000000),1).' trillion';
                    }
                    else if($upvotes>1000000000) {
                        $upvotes = round(($upvotes/1000000000),1).' billion';
                    } 
                    else if($upvotes>1000000) {
                        $upvotes = round(($upvotes/1000000),1).' million';
                    }
                    else if($upvotes>1000) {
                        $upvotes = round(($upvotes/1000),1).' thousand';
                    }else {
                        $upvotes = number_format($upvotes);
                    }
                        
                        
                    
                echo "<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 pt-2 pb-2 ' style=''>";
                
                // echo "<a href='../mypage.php?fundraiserId=$fundraiserId'><iframe style='display:none;width:100%;' fundraiserer='$fundraiserThumbnail' class='videoslideshow'><source src='../$cutvid'></source></iframe></a>";
                
                echo "<div class=''>";

                    echo "<div class='emp-thump-wrapper bg-white'>
                            <a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;'>
                                <img src='../$fundraiserThumbnail' name='thumbsvid' alt='thumbnail image' value='$fundraiserId' class='image-rounded fundraiser-thumb' style=''>
                            </a>
                            
                            <div class='incont' style='position: relative'>
                                <div class='infundraiser'>$category</div>
                            </div>
                            
                            <div class='col-12 c-title bg-white'>
                                <a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;' class=''>
                                    <div class='fulltitled p-1'> $title </div>
                                </a>
                            </div>
                            <div class='fundraisertimed pt-2 pb-2 pl-1'> <div class='categ'>$category | $fundraisertime</div> <div class='fundraiserby'>by <span class='fonter'>$fundraiseredB</span></div></div>
                        </div>";

                    
                    // echo "<div class='rowt'>
                    //         <div class='pb-2 e-react text-left'>
                    //             <div class='tripple-view u-react'>
                    //                 <i class='far fa-eye user-act'></i> ".$view." 
                    //             </div>
                    //             <div class='tripple-vote mr-5'>
                    //                 <i class='far fa-heart user-act'></i> ".$upvotes." 
                    //             </div>
                    //         </div>

                    //     </div>";
                
                echo "</div>";
                
                echo "</div>";

                }
                echo "</div>";

            }else {
                echo "<div class='alert-success p-2 m-3 rounded'> No Listing Found <a target='_blank' href='../checkoutpay.php'>Add A Listing To Get Empowered </a> <span class='close-err'>&times;</span> </div>";
                return false;
            
        }    
    }catch(PDOException $e) {
    throw new PDOException($e -> getMessage());
    }
 }
 
 
 public function middlefundraiser() {
    try{
        $limit = 8;
        $start = 5;
        
        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $con -> prepare("SELECT * FROM fundraiser_table");
        $query -> execute(); 
        $sql = $con -> prepare("SELECT DISTINCT * FROM fundraiser_table WHERE fundraiserThumbnail <> '' OR fundraiserThumbnail <> null GROUP BY fundraiserId ORDER BY RAND() LIMIT $start,$limit");
        $sql -> execute();

            if($sql -> execute() && $query -> execute() ) {
                
            // pagination code

                $rows = $sql -> fetchALL(PDO::FETCH_ASSOC);
                var_dump($row);
                echo "<div class='row'>"; 

                foreach($rows as $row) {
                    //   $url = "https://empowerafrica.com/".$row['url'];
                    $id = $row['id'];
                    $fundraiseredB = $row['fundraiserBy'];
                    $fundraiserBy = str_replace(" ",'-',$fundraiseredB);
                    $title = $row['fundraiserTitle'];
                    $titled = str_replace(" ",'-',$title);
                    $fundraiserId = $row['fundraiserId'];
                    $view = $row['totalViews'];
                    $likes = $row['totalLikes'];
                    $shares = $row['totalShares'];
                    $upvotes = $row['totalupVotes'];
                    $fundraiserThumbnail = $row['fundraiserThumbnail'];
                    $time = $row['dateSubmitted'];
                    $categ = $row['fundraiserCategory'];
                    $category = preg_replace("-"," ",$categ);
                    //   $cutvid = $row['cutvid'];
                        // for views
                        
                        // PHP program to convert timestamp
                        // to time ago
                        
                            
                            // Calculate difference between current
                            // time and given timestamp in seconds
                            // PHP program to convert timestamp
                    // to time ago
                
                    
                    // Calculate difference between current
                    // time and given timestamp in seconds
                    $diff     = time() - $time;
                    
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
                        $fundraisertime = "$sec seconds ago";
                    }
                    
                    // Check for minutes
                    else if($min <= 60) {
                        if($min==1) {
                            $fundraisertime = "one minute ago";
                        }
                        else {
                            $fundraisertime = "$min minutes ago";
                        }
                    }
                    
                    // Check for hours
                    else if($hrs <= 24) {
                        if($hrs == 1) { 
                            $fundraisertime = "an hour ago";
                        }
                        else {
                            $fundraisertime = "$hrs hours ago";
                        }
                    }
                    
                    // Check for days
                    else if($days <= 7) {
                        if($days == 1) {
                            $fundraisertime = "Yesterday";
                        }
                        else {
                            $fundraisertime = "$days days ago";
                        }
                    }
                    
                    // Check for weeks
                    else if($weeks <= 4.3) {
                        if($weeks == 1) {
                            $fundraisertime = "a week ago";
                        }
                        else {
                            $fundraisertime = "$weeks weeks ago";
                        }
                    }
                    
                    // Check for months
                    else if($mnths <= 12) {
                        if($mnths == 1) {
                            $fundraisertime = "a month ago";
                        }
                        else {
                            $fundraisertime = "$mnths months ago";
                        }
                    }
                    
                    // Check for years
                    else {
                        if($yrs == 1) {
                            $fundraisertime = "one year ago";
                        }
                        else {
                            $fundraisertime = "$yrs years ago";
                        }
                    }
                        
                    // first strip any formatting;
                    $view = (0+str_replace(",","",$view));
                    
                    // is this a number?
                    if(!is_numeric($view)) return false;
                    
                    // now filter it;
                    if($view>1000000000000) {
                        $view = round(($view/1000000000000),1).' trillion';
                    }
                    else if($view>1000000000) {
                        $view = round(($view/1000000000),1).' billion';
                    } 
                    else if($view>1000000) {
                        $view = round(($view/1000000),1).' million';
                    }
                    else if($view>1000) {
                        $view = round(($view/1000),1).' thousand';
                    }else {
                        $view = number_format($view);
                    }


                    $upvotes = (0+str_replace(",","",$upvotes));
                    
                    // is this a number?
                    if(!is_numeric($view)) return false;
                    
                    // now filter it;
                    if($upvotes>1000000000000) {
                        $upvotes = round(($upvotes/1000000000000),1).' trillion';
                    }
                    else if($upvotes>1000000000) {
                        $upvotes = round(($upvotes/1000000000),1).' billion';
                    } 
                    else if($upvotes>1000000) {
                        $upvotes = round(($upvotes/1000000),1).' million';
                    }
                    else if($upvotes>1000) {
                        $upvotes = round(($upvotes/1000),1).' thousand';
                    }else {
                        $upvotes = number_format($upvotes);
                    }
                        
                        
                    
                echo "<div class='col-xs-12 col-sm-6 col-md-6 col-lg-4 pt-2 pb-2 ' style=''>";
                
                // echo "<a href='../mypage.php?fundraiserId=$fundraiserId'><iframe style='display:none;width:100%;' fundraiserer='$fundraiserThumbnail' class='videoslideshow'><source src='../$cutvid'></source></iframe></a>";
                
                echo "<div class=''>";

                    echo "<div class='emp-thump-wrapper bg-white'>
                            <a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;'>
                                <img src='../$fundraiserThumbnail' name='thumbsvid' alt='thumbnail image' value='$fundraiserId' class='fundraiser-thumb-middle' style=''>
                            </a>
                            
                            <div class='incont' style='position: relative'>
                                <div class='infundraiser'>$category</div>
                            </div>
                            
                            <div class='col-12 c-title bg-white'>
                                <a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;' class=''>
                                    <div class='fulltitled p-1'> $title </div>
                                </a>
                            </div>
                            <div class='fundraisertimed pt-2 pb-2 pl-1'> <div class='categ'>$category | $fundraisertime</div> <div class='fundraiserby'>by <span class='fonter'>$fundraiseredB</span></div></div>
                        </div>";

                    
                    // echo "<div class='rowt'>
                    //         <div class='pb-2 e-react text-left'>
                    //             <div class='tripple-view u-react'>
                    //                 <i class='far fa-eye user-act'></i> ".$view." 
                    //             </div>
                    //             <div class='tripple-vote mr-5'>
                    //                 <i class='far fa-heart user-act'></i> ".$upvotes." 
                    //             </div>
                    //         </div>

                    //     </div>";
                
                echo "</div>";
                
                echo "</div>";

                }
                echo "</div>";

                
            }else {
                echo "<div class='alert-success p-2 m-3 rounded'> No Listing Found <a target='_blank' href='../checkoutpay.php'>Add A Listing To Get Empowered </a> <span class='close-err'>&times;</span> </div>";
                return false;
            
        }    
    }catch(PDOException $e) {
    throw new PDOException($e -> getMessage());
    }
 }

 
 

 public function mfShare() {
    try{
        
        $limit = 10;
        $start = 1;
        $user_data = @$_SESSION['user'];
        $userid = $user_data['id'];
        $email = $user_data['email'];
        $name = $user_data['uname'];
        $fid = htmlspecialchars($_GET['fundraiserId']);
        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $con -> prepare("SELECT * FROM fundraiser_table");
        $query -> execute(); 
        $sql = $con -> prepare("SELECT DISTINCT fundraiser_table.fundraiserStory,fundraiser_table.donationsReceived,fundraiser_table.totaldonationsReceived,
        fundraiser_table.totalDonations,fundraiser_table.fundraiserId,fundraiser_table.fundraiserThumbnail,fundraiser_table.fundraiserTitle,
        fundraiser_table.fundraiserCategory,fundraiser_table.fundraiserGoal,fundraiser_table.fundraiserBy,donation_table.donation_time,
        fundraiser_table.dateSubmitted,COUNT(donation_table.donatedAmount) AS donorsCount FROM fundraiser_table 
        LEFT JOIN donation_table ON fundraiser_table.fundraiserId = donation_table.fundraiserId WHERE fundraiser_table.fundraiserThumbnail <> '' AND fundraiser_table.fundraiserStory <> ''
        AND fundraiser_table.fundraiserId = ?");
        $sql -> bindParam(1,$fid);
        $sql -> execute();
        
            if($sql -> execute() && $query -> execute() && $sql -> rowCount() > 0) {
                
            // pagination code

                $rows = $sql -> fetchALL(PDO::FETCH_ASSOC);
                // var_dump($rows);
                echo "<h4 class='mt-3'> You are Sharing </h4>";
                echo "<div class='row'>"; 

                foreach($rows as $row) {

                    //   $url = "https://empowerafrica.com/".$row['url'];
                    // $id = $row['id'];
                    $fundraiseredB = ucwords($row['fundraiserBy']);
                    $fundraiserBy = str_replace(" ",'-',$fundraiseredB);
                    $title = ucwords($row['fundraiserTitle']);
                    $fStory = $row['fundraiserStory'];
                    $ldtime = $row['donation_time'];
                    $fstory = substr($fStory,0,120);
                    $ftitle = substr($title,0,30).'...';
                    $titled = str_replace(" ",'-',$title);
                    $fgg = $row['fundraiserGoal'];
                    $donationcount = $row['donorsCount'];
                    $fundraiserId = $row['fundraiserId'];
                    $dona = $row['totaldonationsReceived'];
                    $dR = $row['donationsReceived'];
                    // $likes = $row['totalLikes'];
                    // $shares = $row['totalShares'];
                    // $upvotes = $row['totalupVotes'];
                    $fundraiserThumbnail = $row['fundraiserThumbnail'];
                    $time = $row['donation_time'];
                    $categ = $row['fundraiserCategory'];
                    $category = str_replace("-"," ", $categ);


                    $fg = number_format($fgg);
                    $testdona = number_format($dona);
                    if($dona == null || $dona == "") {
                        $dona = '0';
                    }else {
                        $dona = $dona; 
                    }
                    
                    $diff     = time() - $time;
                    
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
                        $fundraisertime = "$sec seconds ago";
                    }
                    
                    // Check for minutes
                    else if($min <= 60) {
                        if($min==1) {
                            $fundraisertime = "one minute ago";
                        }
                        else {
                            $fundraisertime = "$min minutes ago";
                        }
                    }
                    
                    // Check for hours
                    else if($hrs <= 24) {
                        if($hrs == 1) { 
                            $fundraisertime = "an hour ago";
                        }
                        else {
                            $fundraisertime = "$hrs hours ago";
                        }
                    }
                    
                    // Check for days
                    else if($days <= 7) {
                        if($days == 1) {
                            $fundraisertime = "Yesterday";
                        }
                        else {
                            $fundraisertime = "$days days ago";
                        }
                    }
                    
                    // Check for weeks
                    else if($weeks <= 4.3) {
                        if($weeks == 1) {
                            $fundraisertime = "a week ago";
                        }
                        else {
                            $fundraisertime = "$weeks weeks ago";
                        }
                    }
                    
                    // Check for months
                    else if($mnths <= 12) {
                        if($mnths == 1) {
                            $fundraisertime = "a month ago";
                        }
                        else {
                            $fundraisertime = "$mnths months ago";
                        }
                    }
                    
                    // Check for years
                    else {
                        if($yrs == 1) {
                            $fundraisertime = "one year ago";
                        }
                        else {
                            $fundraisertime = "$yrs years ago";
                        }
                    }
                        
                    // first strip any formatting;
                    $dona = (0+str_replace(",","",$dona));
                    
                    // is this a number?
                    if(!is_numeric($dona)) return false;
                    
                    // now filter it;
                    if($dona>1000000000000) {
                        $testdona = round(($dona/1000000000000),1).' trillion';
                    }
                    else if($dona>1000000000) {
                        $testdona = round(($dona/1000000000),1).' billion';
                    } 
                    else if($dona>1000000) {
                        $testdona = round(($dona/1000000),1).' million';
                    }
                    else if($dona>1000) {
                        $testdona = round(($dona/1000),1).' thousand';
                    }else {
                        $testdona = number_format($dona);
                    }


                        
                    
                    echo "<div id='widthControlled' class='col-lg-12'>
                    <div class='funda text-center'>
                        <div class='mb-3 position-relative'>
                            <div class='badge text-white badge-'></div>
                            <a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;'>
                                <img src='$fundraiserThumbnail' name='thumbsvid' alt='thumbnail image' value='$fundraiserId' class='mfr-imga' style=''>
                            </a>
                            
                            <div class='f-con'>
                                <div class='dorna text-left'>
                                    <div class='drin'><img src='$fundraiserThumbnail' style='' class='by-img'><div class='fb-b'>$fundraiseredB</div></div>
                                </div>
                                <div class='mfrsc-title bg-white'>
                                    <a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;' class=''>
                                        <div class='fulltitled p-1'> $ftitle <div class='mfrsc-ft'>$title</div></div> 
                                    </a>
                                </div>
                                
                                <div class='mfrsc-in text-dark' style='position: relative;width:100%;white-space: initial'> 
                                    <div class='mfrsc-td' style='position: relative;width:100%;white-space: initial'> $fstory </div>
                                </div>
    
                                <div class='p-con  mb-3 mt-3'>
                                    <div class='amtt'>
                                        <div class='amtraisedc'>$<span class='amtraised' name='$dona'>$testdona</span> raised of</div> 
                                        <div class='amttotalc'>$<span class='amttotal' name='$fgg'>$fg</span></div>
                                    </div><div class='end-float'></div>
                                    <div class='progress'>
                                        <div class='progress-bar' aria-valuemin='0' aria-valuemax='100' style=''>
                                    </div>
                                </div>
    
                                <div class='mfrscc pt-0 pb-2 pl-1'> <div class='mfrsc-time'> Last donation received: $fundraisertime </div> <div class='mfrsc-eyev icc'><i class='far fa-heart'></i> $donationcount</div> </div>
                            </div>
                        </div>
                            
                        </div>
                    </div>
                </div>";
                
                }
                echo "</div>";

            }else {
                echo "<div class='p-2 m-3 nf'> No Fundraiser Found <a target='_blank' href='../s/choose-type' class='text-decoration-none'> Start A new Fundraiser </a> <span class='close-err'>&times;</span> </div>";
                return false;
            
        }    
    }catch(PDOException $e) {
    throw new PDOException($e -> getMessage());
    }
 }
  
 
 
 
 
 public function shareFundraisers() {
    try{
        
        $limit = 10;
        $start = 1;
        $user_data = @$_SESSION['user'];
        $userid = $user_data['id'];
        $email = $user_data['email'];
        $name = $user_data['uname'];

        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $con -> prepare("SELECT * FROM fundraiser_table");
        $query -> execute(); 
        $sql = $con -> prepare("SELECT DISTINCT fundraiseStory,totaldonationsReceived,totalViews,fundraiserId,fundraiserThumbnail,fundraiserTitle,fundraiserCategory,fundraiserBy,dateSubmitted FROM fundraiser_table WHERE fundraiserThumbnail <> '' AND fundraiserEmail = ? GROUP BY fundraiserId ORDER BY dateSubmitted DESC LIMIT 10");
        $sql -> bindParam(1,$email);
        $sql -> execute();
        
            if($sql -> execute() && $query -> execute() && $sql -> rowCount() > 0) {
                
            // pagination code

                $rows = $sql -> fetchALL(PDO::FETCH_ASSOC);
                // var_dump($rows);
                echo "<h4 class='mt-3'> Select Fundraiser To Share</h4>";
                echo "<div class='row'>"; 

                foreach($rows as $row) {
                    //   $url = "https://empowerafrica.com/".$row['url'];
                    // $id = $row['id'];
                    $fundraiseredB = $row['fundraiserBy'];
                    $fundraiserBy = str_replace(" ",'-',$fundraiseredB);
                    $title = $row['fundraiserTitle'];
                    $fStory = $row['fundraiserStory'];
                    $fstory = substr($fStory,0,120);
                    $ftitle = substr($title,0,30).'...';
                    $titled = str_replace(" ",'-',$title);
                    $fundraiserId = $row['fundraiserId'];
                    $view = $row['totalViews'];
                    $tdr = $row['totaldonationsReceived'];
                    // $likes = $row['totalLikes'];
                    // $shares = $row['totalShares'];
                    // $upvotes = $row['totalupVotes'];
                    $fundraiserThumbnail = $row['fundraiserThumbnail'];
                    $time = $row['dateSubmitted'];
                    $categ = $row['fundraiserCategory'];
                    $category = str_replace("-"," ", $categ);

                    if($tdr == null || $tdr == "") {
                        $tdR = '0';
                    }else {
                        $tdR = $tdr; 
                    }
                    $diff     = time() - $time;
                    
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
                        $fundraisertime = "$sec seconds ago";
                    }
                    
                    // Check for minutes
                    else if($min <= 60) {
                        if($min==1) {
                            $fundraisertime = "one minute ago";
                        }
                        else {
                            $fundraisertime = "$min minutes ago";
                        }
                    }
                    
                    // Check for hours
                    else if($hrs <= 24) {
                        if($hrs == 1) { 
                            $fundraisertime = "an hour ago";
                        }
                        else {
                            $fundraisertime = "$hrs hours ago";
                        }
                    }
                    
                    // Check for days
                    else if($days <= 7) {
                        if($days == 1) {
                            $fundraisertime = "Yesterday";
                        }
                        else {
                            $fundraisertime = "$days days ago";
                        }
                    }
                    
                    // Check for weeks
                    else if($weeks <= 4.3) {
                        if($weeks == 1) {
                            $fundraisertime = "a week ago";
                        }
                        else {
                            $fundraisertime = "$weeks weeks ago";
                        }
                    }
                    
                    // Check for months
                    else if($mnths <= 12) {
                        if($mnths == 1) {
                            $fundraisertime = "a month ago";
                        }
                        else {
                            $fundraisertime = "$mnths months ago";
                        }
                    }
                    
                    // Check for years
                    else {
                        if($yrs == 1) {
                            $fundraisertime = "one year ago";
                        }
                        else {
                            $fundraisertime = "$yrs years ago";
                        }
                    }
                        
                    // first strip any formatting;
                    $view = (0+str_replace(",","",$view));
                    
                    // is this a number?
                    if(!is_numeric($view)) return false;
                    
                    // now filter it;
                    if($view>1000000000000) {
                        $view = round(($view/1000000000000),1).' trillion';
                    }
                    else if($view>1000000000) {
                        $view = round(($view/1000000000),1).' billion';
                    } 
                    else if($view>1000000) {
                        $view = round(($view/1000000),1).' million';
                    }
                    else if($view>1000) {
                        $view = round(($view/1000),1).' thousand';
                    }else {
                        $view = number_format($view);
                    }

                        
                    
                echo "<div class='col-xs-12 col-sm-6 col-md-6 col-lg-4 pt-2 pb-2 ' style=''>
                            <div class='funda text-center'>
                                    <div class='mb-3 position-relative'>
                                        <div class='badge text-white badge-'></div>
                                        <a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;'>
                                            <img src='$fundraiserThumbnail' name='thumbsvid' alt='thumbnail image' value='$fundraiserId' class='mfr-imga' style=''>
                                        </a>
                                        
                                        <div class='f-con'>
                                            <div class='dorna text-left'>
                                                <div class='drin'><img src='$fundraiserThumbnail' style='' class='by-img'><div class='fb-b'>$fundraiseredB</div></div>
                                            </div>
                                            <div class='mfrsc-title bg-white'>
                                                <a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;' class=''>
                                                    <div class='fulltitled p-1'> $ftitle <div class='mfrsc-ft'>$title</div></div> 
                                                </a>
                                            </div>
                                            
                                            <div class='mfrsc-in text-dark' style='position: relative'> 
                                                <div class='mfrsc-td'> $fstory </div>
                                            </div>
                
                                            <div class='p-con  mb-3 mt-3'>
                                                <div class='amtt'>
                                                    <div class='amtraisedc'>$<span class='amtraised' name='$dona'>$testdona</span> raised of</div> 
                                                    <div class='amttotalc'>$<span class='amttotal' name='$fgg'>$fg</span></div>
                                                </div><div class='end-float'></div>
                                                <div class='progress'>
                                                    <div class='progress-bar' aria-valuemin='0' aria-valuemax='100' style=''>
                                                </div>
                                            </div>
                
                                            <div class='mfrscc pt-0 pb-2 pl-1'> <div class='mfrsc-time'> Last donation received: $fundraisertime </div> <div class='mfrsc-eyev icc'><i class='far fa-heart'></i> $donationcount</div> </div>
                                        </div>
                                    </div>
                                        
                                        <div class='funda-overlay'>
                                            <ul class='mb-0'>
                                                <div class='dorna'>
                                                    <div class='drin'><img src='$fundraiserThumbnail' style='' class='by-img'><div class='text-left fb-b'>$fundraiseredB</div></div>
                                                </div>
                                                
                                                <div class='mfrsc-title bg-white'>
                                                    <a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;' class=''>
                                                        <div class='fulltitled p-1'> $ftitle <div class='mfrsc-ft'>$title</div></div> 
                                                    </a>
                                                </div>
                                                
                                                <div class='f-st mb-5 text-dark'>
                                                    <div class='m-2'> $fstory</div>
                                                    <a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;color: #22a349;' class=''><small class='readmor m-2' id='rmore'><em>Read more...</em></small></a>
                                                </div>
                
                                                <div class='p-con  mb-3 mt-3'>
                                                    <div class='amtt'>
                                                        <div class='amtraisedc'>$<span class='amtraised' name='$dona'>$testdona</span> raised of</div> 
                                                        <div class='amttotalc'>$<span class='amttotal' name='$fgg'>$fg</span></div>
                                                    </div><div class='end-float'></div>
                                                    <div class='progress'>
                                                        <div class='progress-bar' aria-valuemin='0' aria-valuemax='100' style=''>
                                                    </div>
                                                </div>
                
                                                <div class='mfrscc pt-0 pb-2 pl-1'> <div class='mfrsc-time'> Last donation received: $fundraisertime </div> <div class='mfrsc-eyev icc'><i class='far fa-heart'></i> $donationcount</div> </div>
                                                
                                                <div class='mfd border-0'>
                                                    <div class='mf text-center mx-auto mt-1 pt-4 border-0'><a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;' class='nf text-white'> <i class='fas fa-donate'></i> Donate To This Campaign </a></form></div>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                
                </div>";

                }
                echo "</div>";

            }else {
                echo "<div class='p-2 m-3 nf'> No Fundraiser Found <a target='_blank' href='../s/choose-type' class='text-decoration-none'> Start A new Fundraiser </a> <span class='close-err'>&times;</span> </div>";
                return false;
            
        }    
    }catch(PDOException $e) {
    throw new PDOException($e -> getMessage());
    }
 }



 public function odasFundraisers() {
    try{
        
        $limit = 6;
        $start = 1;
        $user_data = @$_SESSION['user'];
        @$userid = $user_data['id'];
        @$email = $user_data['email'];
        @$name = $user_data['uname'];

        $fit = htmlspecialchars($_GET['fundraiserId']);

        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $con -> prepare("SELECT * FROM donation_table");
        $query -> execute(); 
        $sql = $con -> prepare("SELECT DISTINCT fundraiser_table.fundraiserStory,fundraiser_table.donationsReceived,fundraiser_table.totaldonationsReceived,
        fundraiser_table.totalDonations,fundraiser_table.fundraiserId,fundraiser_table.fundraiserThumbnail,fundraiser_table.fundraiserTitle,
        fundraiser_table.fundraiserCategory,fundraiser_table.fundraiserGoal,fundraiser_table.fundraiserBy,donation_table.donation_time,
        fundraiser_table.dateSubmitted,COUNT(donation_table.donatedAmount) AS donorsCount FROM fundraiser_table 
        LEFT JOIN donation_table ON fundraiser_table.fundraiserId = donation_table.fundraiserId WHERE fundraiser_table.fundraiserThumbnail <> '' AND fundraiser_table.fundraiserStory <> ''
        AND fundraiser_table.fundraiserId <> ? GROUP BY fundraiser_table.fundraiserId ORDER BY fundraiser_table.dateSubmitted AND donation_table.donation_time DESC LIMIT $limit");
        $sql -> bindParam(1,$fit);
        $sql -> execute();

        
            if($sql -> execute() && $query -> execute() && $sql -> rowCount() > 0) {
                
            // pagination code
            
                $rows = $sql -> fetchALL(PDO::FETCH_ASSOC);
                // var_dump($rows);
                echo "<h2 class='mt-5 oda-c'> Fundraisers To Consider </h2>";
                echo "<div class='row'>"; 
                foreach($rows as $row) {

                    //   $url = "https://empowerafrica.com/".$row['url'];
                    // $id = $row['id'];
                    $fundraiseredB = ucwords($row['fundraiserBy']);
                    $fundraiserBy = str_replace(" ",'-',$fundraiseredB);
                    $title = ucwords($row['fundraiserTitle']);
                    $fStory = $row['fundraiserStory'];
                    $ldtime = $row['donation_time'];
                    $fstory = substr($fStory,0,120);
                    $ftitle = substr($title,0,30).'...';
                    $titled = str_replace(" ",'-',$title);
                    $fgg = $row['fundraiserGoal'];
                    $donationcount = $row['donorsCount'];
                    $fundraiserId = $row['fundraiserId'];
                    $dona = $row['totaldonationsReceived'];
                    $dR = $row['donationsReceived'];
                    // $likes = $row['totalLikes'];
                    // $shares = $row['totalShares'];
                    // $upvotes = $row['totalupVotes'];
                    $fundraiserThumbnail = $row['fundraiserThumbnail'];
                    $time = $row['donation_time'];
                    $categ = $row['fundraiserCategory'];
                    $category = str_replace("-"," ", $categ);


                    $fg = number_format($fgg);
                    $testdona = number_format($dona);
                    if($dona == null || $dona == "") {
                        $dona = '0';
                    }else {
                        $dona = $dona; 
                    }
                    
                    $diff     = time() - $time;
                    
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
                        $fundraisertime = "$sec seconds ago";
                    }
                    
                    // Check for minutes
                    else if($min <= 60) {
                        if($min==1) {
                            $fundraisertime = "one minute ago";
                        }
                        else {
                            $fundraisertime = "$min minutes ago";
                        }
                    }
                    
                    // Check for hours
                    else if($hrs <= 24) {
                        if($hrs == 1) { 
                            $fundraisertime = "an hour ago";
                        }
                        else {
                            $fundraisertime = "$hrs hours ago";
                        }
                    }
                    
                    // Check for days
                    else if($days <= 7) {
                        if($days == 1) {
                            $fundraisertime = "Yesterday";
                        }
                        else {
                            $fundraisertime = "$days days ago";
                        }
                    }
                    
                    // Check for weeks
                    else if($weeks <= 4.3) {
                        if($weeks == 1) {
                            $fundraisertime = "a week ago";
                        }
                        else {
                            $fundraisertime = "$weeks weeks ago";
                        }
                    }
                    
                    // Check for months
                    else if($mnths <= 12) {
                        if($mnths == 1) {
                            $fundraisertime = "a month ago";
                        }
                        else {
                            $fundraisertime = "$mnths months ago";
                        }
                    }
                    
                    // Check for years
                    else {
                        if($yrs == 1) {
                            $fundraisertime = "one year ago";
                        }
                        else {
                            $fundraisertime = "$yrs years ago";
                        }
                    }
                        
                    // first strip any formatting;
                    $dona = (0+str_replace(",","",$dona));
                    
                    // is this a number?
                    if(!is_numeric($dona)) return false;
                    
                    // now filter it;
                    if($dona>1000000000000) {
                        $testdona = round(($dona/1000000000000),1).' trillion';
                    }
                    else if($dona>1000000000) {
                        $testdona = round(($dona/1000000000),1).' billion';
                    } 
                    else if($dona>1000000) {
                        $testdona = round(($dona/1000000),1).' million';
                    }
                    else if($dona>1000) {
                        $testdona = round(($dona/1000),1).' thousand';
                    }else {
                        $testdona = number_format($dona);
                    }


                        
                    
                    echo "<div id='widthControlled' class='col-lg-3 col-sm-6'>
                    <div class='funda text-center'>
                        <div class='mb-3 position-relative'>
                            <div class='badge text-white badge-'></div>
                            <a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;'>
                                <img src='$fundraiserThumbnail' name='thumbsvid' alt='thumbnail image' value='$fundraiserId' class='mfr-imga' style=''>
                            </a>
                            
                            <div class='f-con'>
                                <div class='dorna text-left'>
                                    <div class='drin'><img src='$fundraiserThumbnail' style='' class='by-img'><div class='fb-b'>$fundraiseredB</div></div>
                                </div>
                                <div class='mfrsc-title bg-white'>
                                    <a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;' class=''>
                                        <div class='fulltitled p-1'> $ftitle <div class='mfrsc-ft'>$title</div></div> 
                                    </a>
                                </div>
                                
                                <div class='mfrsc-in text-dark' style='position: relative'> 
                                    <div class='mfrsc-td'> $fstory </div>
                                </div>
    
                                <div class='p-con  mb-3 mt-3'>
                                    <div class='amtt'>
                                        <div class='amtraisedc'>$<span class='amtraised' name='$dona'>$testdona</span> raised of</div> 
                                        <div class='amttotalc'>$<span class='amttotal' name='$fgg'>$fg</span></div>
                                    </div><div class='end-float'></div>
                                    <div class='progress'>
                                        <div class='progress-bar' aria-valuemin='0' aria-valuemax='100' style=''>
                                    </div>
                                </div>
    
                                <div class='mfrscc pt-0 pb-2 pl-1'> <div class='mfrsc-time'> Last donation received: $fundraisertime </div> <div class='mfrsc-eyev icc'><i class='far fa-heart'></i> $donationcount</div> </div>
                            </div>
                        </div>
                            
                            <div class='funda-overlay'>
                                <ul class='mb-0'>
                                    <div class='dorna'>
                                        <div class='drin'><img src='$fundraiserThumbnail' style='' class='by-img'><div class='text-left fb-b'>$fundraiseredB</div></div>
                                    </div>
                                    
                                    <div class='mfrsc-title bg-white'>
                                        <a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;' class=''>
                                            <div class='fulltitled p-1'> $ftitle <div class='mfrsc-ft'>$title</div></div> 
                                        </a>
                                    </div>
                                    
                                    <div class='f-st mb-5 text-dark'>
                                        <div class='m-2'> $fstory</div>
                                        <a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;color: #22a349;' class=''><small class='readmor m-2' id='rmore'><em>Read more...</em></small></a>
                                    </div>
    
                                    <div class='p-con  mb-3 mt-3'>
                                        <div class='amtt'>
                                            <div class='amtraisedc'>$<span class='amtraised' name='$dona'>$testdona</span> raised of</div> 
                                            <div class='amttotalc'>$<span class='amttotal' name='$fgg'>$fg</span></div>
                                        </div><div class='end-float'></div>
                                        <div class='progress'>
                                            <div class='progress-bar' aria-valuemin='0' aria-valuemax='100' style=''>
                                        </div>
                                    </div>
    
                                    <div class='mfrscc pt-0 pb-2 pl-1'> <div class='mfrsc-time'> Last donation received: $fundraisertime </div> <div class='mfrsc-eyev icc'><i class='far fa-heart'></i> $donationcount</div> </div>
                                    
                                    <div class='mfd border-0'>
                                        <div class='mf text-center mx-auto mt-1 pt-4 border-0'><a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;' class='nf text-white'> <i class='fas fa-donate'></i> Donate To This Campaign </a></form></div>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>";
                }

                echo "<div class='col-12'>
                        <div class='addert'>
                            <div class='sdft'>Start your own fundraiser campaign <div><a href='https://fundreza.com/redirect'><button><i class='fas fa-dollar-sign'></i> Start A Fundraiser</button></a></div></div>
                            <div class='dsc'>Don't know how to start a fundraiser <div><a href='contact.php'><button><i class='fas fa-headset'></i> Talk to us</button></a></div></div>
                        </div>
                    </div>";
                echo "</div>";

            }else {
                echo "<div class='p-2 m-3 nf'> No Fundraiser Found <a target='_blank' href='../s/choose-type' class='text-decoration-none text-dark'> Start A new Fundraiser </a> <span class='close-err'>&times;</span> </div>";
                return false;
            
        }    
    }catch(PDOException $e) {
    throw new PDOException($e -> getMessage());
    }
 }




public function fundraiserstolove() {
    try{
        
        $limit = 6;
        $start = 1;
        
        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $con -> prepare("SELECT * FROM donation_table");
        $query -> execute(); 
        $sql = $con -> prepare("SELECT DISTINCT fundraiser_table.fundraiserStory,fundraiser_table.donationsReceived,fundraiser_table.totaldonationsReceived,
        fundraiser_table.totalDonations,fundraiser_table.fundraiserId,fundraiser_table.fundraiserThumbnail,fundraiser_table.fundraiserTitle,
        fundraiser_table.fundraiserCategory,fundraiser_table.fundraiserGoal,fundraiser_table.fundraiserBy,donation_table.donation_time,
        fundraiser_table.dateSubmitted,COUNT(donation_table.donatedAmount) AS donorsCount FROM fundraiser_table 
        LEFT JOIN donation_table ON fundraiser_table.fundraiserId = donation_table.fundraiserId WHERE fundraiser_table.fundraiserThumbnail <> '' AND fundraiser_table.fundraiserStory <> ''
         GROUP BY fundraiser_table.fundraiserId ORDER BY fundraiser_table.dateSubmitted AND donation_table.donation_time DESC LIMIT $limit");
        $sql -> execute();

        
            if($sql -> execute() && $query -> execute() && $sql -> rowCount() > 0) {
                
            // pagination code
            
                $rows = $sql -> fetchALL(PDO::FETCH_ASSOC);
                // var_dump($rows);
                echo "<h3 class='mt-5 oda-c text-dark text-left font-weight-bold'> Fundraisers You Love </h3>";
                echo "<div class='row'>"; 
                foreach($rows as $row) {

                    //   $url = "https://empowerafrica.com/".$row['url'];
                    // $id = $row['id'];
                    $fundraiseredB = ucwords($row['fundraiserBy']);
                    $fundraiserBy = str_replace(" ",'-',$fundraiseredB);
                    $title = ucwords($row['fundraiserTitle']);
                    $fStory = $row['fundraiserStory'];
                    $ldtime = $row['donation_time'];
                    $fstory = substr($fStory,0,120);
                    $ftitle = substr($title,0,30).'...';
                    $titled = str_replace(" ",'-',$title);
                    $fgg = $row['fundraiserGoal'];
                    $donationcount = $row['donorsCount'];
                    $fundraiserId = $row['fundraiserId'];
                    $dona = $row['totaldonationsReceived'];
                    $dona = $row['totaldonationsReceived'];
                    $dR = $row['donationsReceived'];
                    // $likes = $row['totalLikes'];
                    // $shares = $row['totalShares'];
                    // $upvotes = $row['totalupVotes'];
                    $fundraiserThumbnail = $row['fundraiserThumbnail'];
                    $time = $row['donation_time'];
                    $categ = $row['fundraiserCategory'];
                    $category = str_replace("-"," ", $categ);


                    $fg = number_format($fgg);
                    $testdona = number_format($dona);
                    if($dona == null || $dona == "") {
                        $dona = '0';
                    }else {
                        $dona = $dona; 
                    }
                    
                    $diff     = time() - $time;
                    
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
                        $fundraisertime = "$sec seconds ago";
                    }
                    
                    // Check for minutes
                    else if($min <= 60) {
                        if($min==1) {
                            $fundraisertime = "one minute ago";
                        }
                        else {
                            $fundraisertime = "$min minutes ago";
                        }
                    }
                    
                    // Check for hours
                    else if($hrs <= 24) {
                        if($hrs == 1) { 
                            $fundraisertime = "an hour ago";
                        }
                        else {
                            $fundraisertime = "$hrs hours ago";
                        }
                    }
                    
                    // Check for days
                    else if($days <= 7) {
                        if($days == 1) {
                            $fundraisertime = "Yesterday";
                        }
                        else {
                            $fundraisertime = "$days days ago";
                        }
                    }
                    
                    // Check for weeks
                    else if($weeks <= 4.3) {
                        if($weeks == 1) {
                            $fundraisertime = "a week ago";
                        }
                        else {
                            $fundraisertime = "$weeks weeks ago";
                        }
                    }
                    
                    // Check for months
                    else if($mnths <= 12) {
                        if($mnths == 1) {
                            $fundraisertime = "a month ago";
                        }
                        else {
                            $fundraisertime = "$mnths months ago";
                        }
                    }
                    
                    // Check for years
                    else {
                        if($yrs == 1) {
                            $fundraisertime = "one year ago";
                        }
                        else {
                            $fundraisertime = "$yrs years ago";
                        }
                    }
                        
                    // first strip any formatting;
                    $dona = (0+str_replace(",","",$dona));
                    
                    // is this a number?
                    if(!is_numeric($dona)) return false;
                    
                    // now filter it;
                    if($dona>1000000000000) {
                        $testdona = round(($dona/1000000000000),1).' trillion';
                    }
                    else if($dona>1000000000) {
                        $testdona = round(($dona/1000000000),1).' billion';
                    } 
                    else if($dona>1000000) {
                        $testdona = round(($dona/1000000),1).' million';
                    }
                    else if($dona>1000) {
                        $testdona = round(($dona/1000),1).' thousand';
                    }else {
                        $testdona = number_format($dona);
                    }


                        
                    
                    echo "<div id='widthControlled' class='col-lg-4 col-sm-6'>
                            <div class='funda text-center'>
                                <div class='mb-3 position-relative'>
                                    <div class='badge text-white badge-'></div>
                                    <a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;'>
                                        <img src='$fundraiserThumbnail' name='thumbsvid' alt='thumbnail image' value='$fundraiserId' class='mfr-imga' style=''>
                                    </a>
                                    
                                    <div class='f-con'>
                                        <div class='dorna text-left'>
                                            <div class='drin'><img src='$fundraiserThumbnail' style='' class='by-img'><div class='fb-b'>$fundraiseredB</div></div>
                                        </div>
                                        <div class='mfrsc-title bg-white'>
                                            <a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;' class=''>
                                                <div class='fulltitled p-1'> $ftitle <div class='mfrsc-ft'>$title</div></div> 
                                            </a>
                                        </div>
                                        
                                        <div class='mfrsc-in text-dark' style='position: relative'> 
                                            <div class='mfrsc-td'> $fstory </div>
                                        </div>
            
                                        <div class='p-con  mb-3 mt-3'>
                                            <div class='amtt'>
                                                <div class='amtraisedc'>$<span class='amtraised' name='$dona'>$testdona</span> raised of</div> 
                                                <div class='amttotalc'>$<span class='amttotal' name='$fgg'>$fg</span></div>
                                            </div><div class='end-float'></div>
                                            <div class='progress'>
                                                <div class='progress-bar' aria-valuemin='0' aria-valuemax='100' style=''>
                                            </div>
                                        </div>
            
                                        <div class='mfrscc pt-0 pb-2 pl-1'> <div class='mfrsc-time'> Last donation received: $fundraisertime </div> <div class='mfrsc-eyev icc'><i class='far fa-heart'></i> $donationcount</div> </div>
                                    </div>
                                </div>
                            </div>

                            <div class='funda-overlay'>
                                <ul class='mb-0'>
                                    <div class='dorna'>
                                        <div class='drin'><img src='$fundraiserThumbnail' style='' class='by-img'><div class='text-left fb-b'>$fundraiseredB</div></div>
                                    </div>
                                    
                                    <div class='mfrsc-title bg-white'>
                                        <a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;' class=''>
                                            <div class='fulltitled p-1'> $ftitle <div class='mfrsc-ft'>$title</div></div> 
                                        </a>
                                    </div>
                                    
                                    <div class='f-st mb-5 text-dark'>
                                        <div class='m-2'> $fstory</div>
                                        <a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;color: #22a349;' class=''><small class='readmor m-2' id='rmore'><em>Read more...</em></small></a>
                                    </div>

                                    <div class='p-con  mb-3 mt-3'>
                                        <div class='amtt'>
                                            <div class='amtraisedc'>$<span class='amtraised' name='$dona'>$testdona</span> raised of</div> 
                                            <div class='amttotalc'>$<span class='amttotal' name='$fgg'>$fg</span></div>
                                        </div><div class='end-float'></div>
                                        <div class='progress'>
                                            <div class='progress-bar' aria-valuemin='0' aria-valuemax='100' style=''>
                                        </div>
                                    </div>

                                    <div class='mfrscc pt-0 pb-2 pl-1'> <div class='mfrsc-time'> Last donation received: $fundraisertime </div> <div class='mfrsc-eyev icc'><i class='far fa-heart'></i> $donationcount</div> </div>
                                    
                                
                                    <div class='mfd border-0'>
                                        <div class='mf text-center mx-auto mt-1 pt-4 border-0'><a target='_blank' href='p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;' class='nf text-white'> <i class='fas fa-donate'></i> Donate To This Campaign </a></form></div>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>";
                        
                }

                echo "</div>";

            }
    }catch(PDOException $e) {
    throw new PDOException($e -> getMessage());
    }
 }
  
 
 
 
 
 public function myFundraisers() {
    try{
        
        $limit = 10;
        $start = 1;
        $user_data = @$_SESSION['user'];
        $userid = $user_data['id'];
        $email = $user_data['email'];
        $name = $user_data['uname'];

        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $con -> prepare("SELECT * FROM fundraiser_table");
        $query -> execute(); 
        $sql = $con -> prepare("SELECT DISTINCT fundraiser_table.fundraiserStory,fundraiser_table.donationsReceived,fundraiser_table.totaldonationsReceived,
        fundraiser_table.totalDonations,fundraiser_table.fundraiserId,fundraiser_table.fundraiserThumbnail,fundraiser_table.fundraiserTitle,
        fundraiser_table.fundraiserCategory,fundraiser_table.fundraiserGoal,fundraiser_table.fundraiserBy,donation_table.donation_time,
        fundraiser_table.dateSubmitted,COUNT(donation_table.donatedAmount) AS donorsCount FROM fundraiser_table 
        LEFT JOIN donation_table ON fundraiser_table.fundraiserId = donation_table.fundraiserId WHERE fundraiser_table.fundraiserThumbnail <> '' AND fundraiser_table.fundraiserStory <> ''
        AND fundraiser_table.fundraiserEmail = ? GROUP BY fundraiser_table.fundraiserId ORDER BY fundraiser_table.dateSubmitted AND donation_table.donation_time DESC LIMIT $limit");
        $sql -> bindParam(1,$email);
        $sql -> execute();
        
            if($sql -> execute() && $query -> execute() && $sql -> rowCount() > 0) {
                
            // pagination code

                $rows = $sql -> fetchALL(PDO::FETCH_ASSOC);
                // var_dump($rows);
                echo "<h4 class='mt-3'> My Fundraisers</h4>";
                echo "<div class='row'>"; 

                foreach($rows as $row) {
                    //   $url = "https://empowerafrica.com/".$row['url'];
                    // $id = $row['id'];
                    $fundraiseredB = ucwords($row['fundraiserBy']);
                    $fundraiserBy = str_replace(" ",'-',$fundraiseredB);
                    $title = ucwords($row['fundraiserTitle']);
                    $fStory = $row['fundraiserStory'];
                    $ldtime = $row['donation_time'];
                    $fstory = substr($fStory,0,120);
                    $ftitle = substr($title,0,30).'...';
                    $titled = str_replace(" ",'-',$title);
                    $fgg = $row['fundraiserGoal'];
                    $donationcount = $row['donorsCount'];
                    $fundraiserId = $row['fundraiserId'];
                    $dona = $row['totaldonationsReceived'];
                    $dona = $row['totaldonationsReceived'];
                    $dR = $row['donationsReceived'];
                    // $likes = $row['totalLikes'];
                    // $shares = $row['totalShares'];
                    // $upvotes = $row['totalupVotes'];
                    $fundraiserThumbnail = '../'.$row['fundraiserThumbnail'];
                    $time = $row['donation_time'];
                    $categ = $row['fundraiserCategory'];
                    $category = str_replace("-"," ", $categ);


                    $fg = number_format($fgg);
                    $testdona = number_format($dona);
                    if($dona == null || $dona == "") {
                        $dona = '0';
                    }else {
                        $dona = $dona; 
                    }
                    
                    $diff     = time() - $time;
                    
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
                        $fundraisertime = "$sec seconds ago";
                    }
                    
                    // Check for minutes
                    else if($min <= 60) {
                        if($min==1) {
                            $fundraisertime = "one minute ago";
                        }
                        else {
                            $fundraisertime = "$min minutes ago";
                        }
                    }
                    
                    // Check for hours
                    else if($hrs <= 24) {
                        if($hrs == 1) { 
                            $fundraisertime = "an hour ago";
                        }
                        else {
                            $fundraisertime = "$hrs hours ago";
                        }
                    }
                    
                    // Check for days
                    else if($days <= 7) {
                        if($days == 1) {
                            $fundraisertime = "Yesterday";
                        }
                        else {
                            $fundraisertime = "$days days ago";
                        }
                    }
                    
                    // Check for weeks
                    else if($weeks <= 4.3) {
                        if($weeks == 1) {
                            $fundraisertime = "a week ago";
                        }
                        else {
                            $fundraisertime = "$weeks weeks ago";
                        }
                    }
                    
                    // Check for months
                    else if($mnths <= 12) {
                        if($mnths == 1) {
                            $fundraisertime = "a month ago";
                        }
                        else {
                            $fundraisertime = "$mnths months ago";
                        }
                    }
                    
                    // Check for years
                    else {
                        if($yrs == 1) {
                            $fundraisertime = "one year ago";
                        }
                        else {
                            $fundraisertime = "$yrs years ago";
                        }
                    }
                        
                    // first strip any formatting;
                    $dona = (0+str_replace(",","",$dona));
                    
                    // is this a number?
                    if(!is_numeric($dona)) return false;
                    
                    // now filter it;
                    if($dona>1000000000000) {
                        $testdona = round(($dona/1000000000000),1).' trillion';
                    }
                    else if($dona>1000000000) {
                        $testdona = round(($dona/1000000000),1).' billion';
                    } 
                    else if($dona>1000000) {
                        $testdona = round(($dona/1000000),1).' million';
                    }
                    else if($dona>1000) {
                        $testdona = round(($dona/1000),1).' thousand';
                    }else {
                        $testdona = number_format($dona);
                    }

                        
                    
                echo "<div id='' class='col-lg-4 col-sm-6 '>
                    <div class='funda text-center'>
                        <div class='mb-3 position-relative'>
                            <div class='badge text-white badge-'></div>
                            <a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;'>
                                <img src='$fundraiserThumbnail' name='thumbsvid' alt='thumbnail image' value='$fundraiserId' class='mfr-imga' style=''>
                            </a>
                            
                            <div class='f-con'>
                                <div class='dorna text-left'>
                                    <div class='drin'><img src='$fundraiserThumbnail' style='' class='by-img'><div class='fb-b'>$fundraiseredB</div></div>
                                </div>
                                <div class='mfrsc-title bg-white'>
                                    <a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;' class=''>
                                        <div class='fulltitled p-1'> $ftitle <div class='mfrsc-ft'>$title</div></div> 
                                    </a>
                                </div>
                                
                                <div class='mfrsc-in text-dark' style='position: relative'> 
                                    <div class='mfrsc-td'> $fstory </div>
                                </div>
    
                                <div class='p-con  mb-3 mt-3'>
                                    <div class='amtt'>
                                        <div class='amtraisedc'>$<span class='amtraised' name='$dona'>$testdona</span> raised of</div> 
                                        <div class='amttotalc'>$<span class='amttotal' name='$fgg'>$fg</span></div>
                                    </div><div class='end-float'></div>
                                    <div class='progress'>
                                        <div class='progress-bar' aria-valuemin='0' aria-valuemax='100' style=''>
                                    </div>
                                </div>
    
                                <div class='mfrscc pt-0 pb-2 pl-1'> <div class='mfrsc-time'> Last donation received: $fundraisertime </div> <div class='mfrsc-eyev icc'><i class='far fa-heart'></i> $donationcount</div> </div>
                            </div>
                        </div>
                            
                            <div class='funda-overlay'>
                                <ul class='mb-0'>
                                    <div class='dorna'>
                                        <div class='drin'><img src='$fundraiserThumbnail' style='' class='by-img'><div class='text-left fb-b'>$fundraiseredB</div></div>
                                    </div>
                                    
                                    <div class='mfrsc-title bg-white'>
                                        <a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;' class=''>
                                            <div class='fulltitled p-1'> $ftitle <div class='mfrsc-ft'>$title</div></div> 
                                        </a>
                                    </div>
                                    
                                    <div class='f-st mb-5 text-dark'>
                                        <div class='m-2'> $fstory</div>
                                        <a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;color: #22a349;' class=''><small class='readmor m-2' id='rmore'><em>Read more...</em></small></a>
                                    </div>
    
                                    <div class='p-con  mb-3 mt-3'>
                                        <div class='amtt'>
                                            <div class='amtraisedc'>$<span class='amtraised' name='$dona'>$testdona</span> raised of</div> 
                                            <div class='amttotalc'>$<span class='amttotal' name='$fgg'>$fg</span></div>
                                        </div><div class='end-float'></div>
                                        <div class='progress'>
                                            <div class='progress-bar' aria-valuemin='0' aria-valuemax='100' style=''>
                                        </div>
                                    </div>
    
                                    <div class='mfrscc pt-0 pb-2 pl-1'> <div class='mfrsc-time'> Last donation received: $fundraisertime </div> <div class='mfrsc-eyev icc'><i class='far fa-heart'></i> $donationcount</div> </div>
                                    
                                
                                <div class='mfd border-0'>
                                    <div class='mf text-center mx-auto mt-1 pt-4 border-0'><a target='_blank' href='p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;' class='nf text-white'> <i class='fas fa-donate'></i> Donate To This Campaign </a></form></div>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>";
                    
                }
                echo "</div>";

            }else {
                echo "<div class='p-2 m-3 nf' style='white-space: nowrap'> No Fundraiser Found <a target='_blank' href='../s/choose-type' class='text-decoration-none'> Start A new Fundraiser </a> <span class='close-err'>&times;</span> </div>";
                return false;
            
        }    
    }catch(PDOException $e) {
    throw new PDOException($e -> getMessage());
    }
 }
 
 

 public function allfundraiser() {
    try{
        
        $limit = 10;
        $start = 4;
        
        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $con -> prepare("SELECT * FROM fundraiser_table");
        $query -> execute(); 
        $sql = $con -> prepare("SELECT DISTINCT * FROM fundraiser_table WHERE fundraiserThumbnail <> '' OR fundraiserThumbnail <> null GROUP BY fundraiserId ORDER BY RAND() LIMIT $start,$limit");
        $sql -> execute();
        
            if($sql -> execute() && $query -> execute() ) {
                
            // pagination code

                $rows = $sql -> fetchALL(PDO::FETCH_ASSOC);

                echo "<div class='row'>"; 

                foreach($rows as $row) {
                    //   $url = "https://empowerafrica.com/".$row['url'];
                    $id = $row['id'];
                    $fundraiseredB = $row['fundraiserBy'];
                    $fundraiserBy = str_replace(" ",'-',$fundraiseredB);
                    $title = $row['fundraiserTitle'];
                    $titled = str_replace(" ",'-',$title);
                    $fundraiserId = $row['fundraiserId'];
                    $view = $row['totalViews'];
                    $likes = $row['totalLikes'];
                    $shares = $row['totalShares'];
                    $upvotes = $row['totalupVotes'];
                    $fundraiserThumbnail = $row['fundraiserThumbnail'];
                    $time = $row['dateSubmitted'];
                    $category = $row['fundraiserCategory'];
                    //   $cutvid = $row['cutvid'];
                        // for views
                        
                        // PHP program to convert timestamp
                        // to time ago
                        
                            
                            // Calculate difference between current
                            // time and given timestamp in seconds
                            // PHP program to convert timestamp
                    // to time ago
                
                    
                    // Calculate difference between current
                    // time and given timestamp in seconds
                    $diff     = time() - $time;
                    
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
                        $fundraisertime = "$sec seconds ago";
                    }
                    
                    // Check for minutes
                    else if($min <= 60) {
                        if($min==1) {
                            $fundraisertime = "one minute ago";
                        }
                        else {
                            $fundraisertime = "$min minutes ago";
                        }
                    }
                    
                    // Check for hours
                    else if($hrs <= 24) {
                        if($hrs == 1) { 
                            $fundraisertime = "an hour ago";
                        }
                        else {
                            $fundraisertime = "$hrs hours ago";
                        }
                    }
                    
                    // Check for days
                    else if($days <= 7) {
                        if($days == 1) {
                            $fundraisertime = "Yesterday";
                        }
                        else {
                            $fundraisertime = "$days days ago";
                        }
                    }
                    
                    // Check for weeks
                    else if($weeks <= 4.3) {
                        if($weeks == 1) {
                            $fundraisertime = "a week ago";
                        }
                        else {
                            $fundraisertime = "$weeks weeks ago";
                        }
                    }
                    
                    // Check for months
                    else if($mnths <= 12) {
                        if($mnths == 1) {
                            $fundraisertime = "a month ago";
                        }
                        else {
                            $fundraisertime = "$mnths months ago";
                        }
                    }
                    
                    // Check for years
                    else {
                        if($yrs == 1) {
                            $fundraisertime = "one year ago";
                        }
                        else {
                            $fundraisertime = "$yrs years ago";
                        }
                    }
                        
                    // first strip any formatting;
                    $view = (0+str_replace(",","",$view));
                    
                    // is this a number?
                    if(!is_numeric($view)) return false;
                    
                    // now filter it;
                    if($view>1000000000000) {
                        $view = round(($view/1000000000000),1).' trillion';
                    }
                    else if($view>1000000000) {
                        $view = round(($view/1000000000),1).' billion';
                    } 
                    else if($view>1000000) {
                        $view = round(($view/1000000),1).' million';
                    }
                    else if($view>1000) {
                        $view = round(($view/1000),1).' thousand';
                    }else {
                        $view = number_format($view);
                    }


                    $upvotes = (0+str_replace(",","",$upvotes));
                    
                    // is this a number?
                    if(!is_numeric($view)) return false;
                    
                    // now filter it;
                    if($upvotes>1000000000000) {
                        $upvotes = round(($upvotes/1000000000000),1).' trillion';
                    }
                    else if($upvotes>1000000000) {
                        $upvotes = round(($upvotes/1000000000),1).' billion';
                    } 
                    else if($upvotes>1000000) {
                        $upvotes = round(($upvotes/1000000),1).' million';
                    }
                    else if($upvotes>1000) {
                        $upvotes = round(($upvotes/1000),1).' thousand';
                    }else {
                        $upvotes = number_format($upvotes);
                    }
                        
                        
                    
                echo "<div class='col-xs-12 col-sm-6 col-md-6 col-lg-4 pt-2 pb-2 ' style=''>";
                
                // echo "<a href='../mypage.php?fundraiserId=$fundraiserId'><iframe style='display:none;width:100%;' fundraiserer='$fundraiserThumbnail' class='videoslideshow'><source src='../$cutvid'></source></iframe></a>";
                
                echo "<div class=''>";

                    echo "<div class='emp-thump-wrapper bg-white'>
                            <a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;'>
                                <img src='../$fundraiserThumbnail' name='thumbsvid' alt='thumbnail image' value='$fundraiserId' class='image-rounded fundraiser-thumb-allfundraiser' style=''>
                            </a>
                            
                            <div class='incont' style='position: relative'>
                                <div class='infundraiser'>$category</div>
                            </div>
                            
                            <div class='col-12 c-title bg-white'>
                                <a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;' class=''>
                                    <div class='fulltitled p-1'> $title </div>
                                </a>
                            </div>
                            <div class='fundraisertimed pt-2 pb-2 pl-1'> <div class='categ'>$category | $fundraisertime</div> <div class='fundraiserby'>by <span class='fonter'>$fundraiseredB</span></div></div>
                        </div>";

                    
                    // echo "<div class='rowt'>
                    //         <div class='pb-2 e-react text-left'>
                    //             <div class='tripple-view u-react'>
                    //                 <i class='far fa-eye user-act'></i> ".$view." 
                    //             </div>
                    //             <div class='tripple-vote mr-5'>
                    //                 <i class='far fa-heart user-act'></i> ".$upvotes." 
                    //             </div>
                    //         </div>

                    //     </div>";
                
                echo "</div>";
                
                echo "</div>";

                }
                echo "</div>";

            }else {
                echo "<div class='alert-success p-2 m-3 rounded'> No Listing Found <a target='_blank' href='../checkoutpay.php'>Add A Listing To Get Empowered </a> <span class='close-err'>&times;</span> </div>";
                return false;
            
        }    
    }catch(PDOException $e) {
    throw new PDOException($e -> getMessage());
    }
 }


public function sponsoredfundraisers() {
    try{
        $pages = isset($_GET['page']) ? $_GET['page'] : 1;
        $page = intval($pages);
        if($page == 0) {
            $page = 1;
        }
        
        $limit = 10;
        $start = ($page - 1) * $limit;
        
        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $con -> prepare("SELECT * FROM fundraiser_table");
        $query -> execute(); 
        $sql = $con -> prepare("SELECT * FROM fundraiser_table WHERE (fundraiserThumbnail <> '' OR fundraiserThumbnail <> null) AND fundraiserCategory = 'sponsored' GROUP BY fundraiserId ORDER BY RAND() LIMIT $start,$limit");
        $sql -> execute();

        $paginate = $con->prepare("SELECT count(id) AS id FROM fundraiser_table GROUP BY fundraiserId");
        $paginate -> execute();
        
            if($sql -> execute() && $query -> execute() && $paginate -> execute()) {
                
            // pagination code

                $countd = $paginate -> fetchAll(PDO::FETCH_ASSOC);
                $totalcountd = $countd[0]['id'];
                $pages = ceil($totalcountd / $limit); 
                $Previous = $page - 1;
                $Next = $page + 1;

                $videoCount = $query -> rowCount(); 
                $rows = $sql -> fetchALL(PDO::FETCH_ASSOC);

                echo "<div class=''>"; 

                foreach($rows as $row) {
                    $id = $row['id'];
                    $fundraiseredB = $row['fundraiserBy'];
                    $fundraiserBy = str_replace(" ",'-',$fundraiseredB);
                    $title = $row['fundraiserTitle'];
                    $titled = str_replace(" ",'-',$title);
                    $fundraiserId = $row['fundraiserId'];
                    $view = $row['totalViews'];
                    $likes = $row['totalLikes'];
                    $shares = $row['totalShares'];
                    $upvotes = $row['totalupVotes'];
                    $fundraiserThumbnail = $row['fundraiserThumbnail'];
                    $time = $row['dateSubmitted'];
                    $category = $row['fundraiserCategory'];
                    //   $cutvid = $row['cutvid'];
                        // for views
                    
                    // first strip any formatting;
                    $view = (0+str_replace(",","",$view));
                    
                    // is this a number?
                    if(!is_numeric($view)) return false;
                    
                    // now filter it;
                    if($view>1000000000000) {
                        $view = round(($view/1000000000000),1).' trillion';
                    }
                    else if($view>1000000000) {
                        $view = round(($view/1000000000),1).' billion';
                    } 
                    else if($view>1000000) {
                        $view = round(($view/1000000),1).' million';
                    }
                    else if($view>1000) {
                        $view = round(($view/1000),1).' thousand';
                    }else {
                        $view = number_format($view);
                    }


                    $upvotes = (0+str_replace(",","",$upvotes));
                    
                    // is this a number?
                    if(!is_numeric($view)) return false;
                    
                    // now filter it;
                    if($upvotes>1000000000000) {
                        $upvotes = round(($upvotes/1000000000000),1).' trillion';
                    }
                    else if($upvotes>1000000000) {
                        $upvotes = round(($upvotes/1000000000),1).' billion';
                    } 
                    else if($upvotes>1000000) {
                        $upvotes = round(($upvotes/1000000),1).' million';
                    }
                    else if($upvotes>1000) {
                        $upvotes = round(($upvotes/1000),1).' thousand';
                    }else {
                        $upvotes = number_format($upvotes);
                    }
                        
                        
                    
                echo "<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12 show-emp-list p-0 m-0'>";
                
                // echo "<a href='../mypage.php?fundraiserId=$fundraiserId'><iframe style='display:none;width:100%;' fundraiserer='$fundraiserThumbnail' class='videoslideshow'><source src='../$cutvid'></source></iframe></a>";
                
                echo "<div class='listings mb-4'>";

                    echo "<div class='emp-thump-wrapper'>
                            <a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;'>
                                <img src='../$fundraiserThumbnail' name='thumbsvid' alt='thumbnail image' value='$fundraiserId' class='img-fluid img-responsive img-rounded emp-thumb-sponsored'>
                            </a>
                        </div>";

                    echo "<div class='row '>
                            <div class='col-12'>
                                <a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;'>
                                    <div class='fulltitles p-2'> $title </div>
                                </a>
                            </div>

                            
                        </div>";
                    
                echo "</div>";
                
                echo "</div>";

                }
                echo "</div>";

                
            }else {
                echo "<div class='alert-success p-2 m-3 rounded'> No Listing Found <a target='_blank' href='../checkoutpay.php'>Add A Listing To Get Empowered </a> <span class='close-err'>&times;</span> </div>";
                return false;
        }    
    }catch(PDOException $e) {
    throw new PDOException($e -> getMessage());
    }
 }



 public function mostrecentfundraisers() {
    try{
        
        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $con -> prepare("SELECT * FROM fundraiser_table");
        $query -> execute(); 
        $sql = $con -> prepare("SELECT fundraiser_table.* FROM fundraiser_table WHERE fundraiserThumbnail <> '' OR fundraiserThumbnail <> null GROUP BY fundraiser_table.fundraiserId ORDER BY fundraiser_table.dateSubmitted DESC LIMIT 4");
        $sql -> execute();

       
        
            if($sql -> execute() && $query -> execute()) {
                
            // pagination code

                

                $videoCount = $query -> rowCount(); 
                $rows = $sql -> fetchALL(PDO::FETCH_ASSOC);

                foreach($rows as $row) {
                    $id = $row['id'];
                    $fundraiseredB = $row['fundraiserBy'];
                    $fundraiserBy = str_replace(" ",'-',$fundraiseredB);
                    $title = $row['fundraiserTitle'];
                    $titled = str_replace(" ",'-',$title);
                    $fundraiserId = $row['fundraiserId'];
                    $view = $row['totalViews'];
                    $likes = $row['totalLikes'];
                    $shares = $row['totalShares'];
                    $upvotes = $row['totalupVotes'];
                    $fundraiserThumbnail = $row['fundraiserThumbnail'];
                    $time = $row['dateSubmitted'];
                    $category = $row['fundraiserCategory'];
                    //   $cutvid = $row['cutvid'];
                        // for views
                        
                    // PHP program to convert timestamp
                    // to time ago
                
                    
                    // Calculate difference between current
                    // time and given timestamp in seconds
                    $diff     = time() - $time;
                    
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
                        $fundraisertime = "$sec seconds ago";
                    }
                    
                    // Check for minutes
                    else if($min <= 60) {
                        if($min==1) {
                            $fundraisertime = "one minute ago";
                        }
                        else {
                            $fundraisertime = "$min minutes ago";
                        }
                    }
                    
                    // Check for hours
                    else if($hrs <= 24) {
                        if($hrs == 1) { 
                            $fundraisertime = "an hour ago";
                        }
                        else {
                            $fundraisertime = "$hrs hours ago";
                        }
                    }
                    
                    // Check for days
                    else if($days <= 7) {
                        if($days == 1) {
                            $fundraisertime = "Yesterday";
                        }
                        else {
                            $fundraisertime = "$days days ago";
                        }
                    }
                    
                    // Check for weeks
                    else if($weeks <= 4.3) {
                        if($weeks == 1) {
                            $fundraisertime = "a week ago";
                        }
                        else {
                            $fundraisertime = "$weeks weeks ago";
                        }
                    }
                    
                    // Check for months
                    else if($mnths <= 12) {
                        if($mnths == 1) {
                            $fundraisertime = "a month ago";
                        }
                        else {
                            $fundraisertime = "$mnths months ago";
                        }
                    }
                    
                    // Check for years
                    else {
                        if($yrs == 1) {
                            $fundraisertime = "one year ago";
                        }
                        else {
                            $fundraisertime = "$yrs years ago";
                        }
                    }
                    //   $cutvid = $row['cutvid'];
                        // for views
                    
                    // first strip any formatting;
                    $view = (0+str_replace(",","",$view));
                    
                    // is this a number?
                    if(!is_numeric($view)) return false;
                    
                    // now filter it;
                    if($view>1000000000000) {
                        $view = round(($view/1000000000000),1).' trillion';
                    }
                    else if($view>1000000000) {
                        $view = round(($view/1000000000),1).' billion';
                    } 
                    else if($view>1000000) {
                        $view = round(($view/1000000),1).' million';
                    }
                    else if($view>1000) {
                        $view = round(($view/1000),1).' thousand';
                    }else {
                        $view = number_format($view);
                    }


                    $upvotes = (0+str_replace(",","",$upvotes));
                    
                    // is this a number?
                    if(!is_numeric($view)) return false;
                    
                    // now filter it;
                    if($upvotes>1000000000000) {
                        $upvotes = round(($upvotes/1000000000000),1).' trillion';
                    }
                    else if($upvotes>1000000000) {
                        $upvotes = round(($upvotes/1000000000),1).' billion';
                    } 
                    else if($upvotes>1000000) {
                        $upvotes = round(($upvotes/1000000),1).' million';
                    }
                    else if($upvotes>1000) {
                        $upvotes = round(($upvotes/1000),1).' thousand';
                    }else {
                        $upvotes = number_format($upvotes);
                    }
                        
                        
                echo "<div class='card w100 rounded-0 mt-3 mb-3 pt-1 pb-1'>";    
                echo "<div class=' most-recent-list'>";
                
                // echo "<a target='_blank' href='../mypage.php?fundraiserId=$fundraiserId'><iframe style='display:none;width:100%;' fundraiserer='$fundraiserThumbnail' class='videoslideshow'><source src='../$cutvid'></source></iframe></a>";
                echo "<div class='most-recent-wrap'>
                        <a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;'>
                            <img src='../$fundraiserThumbnail' name='thumbsvid' alt='thumbnail image' value='$fundraiserId' class='img-fluid img-responsive most-recent-emp-thumb'><span class='values' name ='ling' ></span>
                        </a>
                    </div>";
                
                echo "<div class='list-emp'>";

                    echo "<div class='row '>
                            <div class='col-12 '>
                                <a target='_blank' href='https://fundreza.com/p/$titled/$fundraiserBy/$fundraiserId' style='text-decoration:none;'>
                                    <div class='fulltitle'> $title </div>
                                </a>
                            </div>
                            <div class='fundraisertime'><div class='categ'>$category | $fundraisertime <span class='fundraiserbyd'>by <span class='fonter'>$fundraiseredB</span></span></div></div>
                            
                        </div>";
                    
                echo "</div>";
                
                echo "</div>";

                echo "</div>";

                }
                
            }
    //         else {
    //             echo "<div class='alert-success p-2 m-3 rounded'> No Listings Found <span class='close-err'>&times;</span> </div>";
    //             return false;
    //    }    
    }catch(PDOException $e) {
    throw new PDOException($e -> getMessage());
    }
 }


public function empowerMe(){
    try{
        $user_data = @$_SESSION['user'];
        $userid = $user_data['id'];
        $email = $user_data['email'];
        $name = $user_data['uname'];

        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $selectinv = $con -> prepare("SELECT DISTINCT fundraiserId,uploadedBy,fundraiserTitle,fundraiserContent,fundraiserThumbnail,totalLikes,totalShares,totalViews,totalupVote,totalComments FROM fundraiser_table WHERE user_email = ? AND fundraiserId = ?");
        $selectinv -> execute();
        $selectwithd -> execute();
        if($selectinv -> execute() && $selectwithd -> execute()) {
            $actinv = $selectinv -> fetchAll(PDO::FETCH_ASSOC);
            $actwithd = $selectwithd -> fetchAll(PDO::FETCH_ASSOC);

            foreach($actinv as $a) {
                $invfname = ucfirst($a['fname']);
                $invlname = ucfirst($a['Lname']);
                $invdate = $a['auctionDate'];
                $invtype = $a['auctionChannel'];
                $invtimestatus = date('Y-m-d',$invdate); 



                echo "<div class='item'>
                        <div class='row'>
                        <div class='col-3 date-holder text-right'>
                            <div class='icon'><i class='icon-clock'></i></div>
                            <div class='date'> <span>$invtimestatus</span></div>
                        </div>
                        <div class='col-9 content up-title'>
                            <h6 class='update-title'>$invfname $invlname</h6>
                            <p>Completed an auction in $invtype </p>
                        </div>
                        </div>
                    </div>";
            }

            
            foreach($actwithd as $w) {
                $withdfname = ucfirst($w['fname']);
                $withdlname = ucfirst($w['lname']);
                $withdate = $w['withdrawalDate'];



                echo "<div class='item'>
                        <div class='row'>
                        <div class='col-3 date-holder text-right'>
                            <div class='icon'><i class='icon-clock'></i></div>
                            <div class='date'> <span>$withdate</span></div>
                        </div>
                        <div class='col-9 content'>
                            <h5 class='text-grey' style='color:#7a7a7a !important;'>$withdfname $withdlname</h5>
                            <p>Successfully completed a withdrawal request </p>
                        </div>
                        </div>
                    </div>";
            }
        }
    }catch(PDOException $e) {
        throw new PDOException($e->getMessage());
    }
}



public function showComments() {
    try {
        //  comments...
        echo '<div id="parent-comment"></div>';
        $this -> getComments();
                                    
    } catch(PDOException $e) {
        throw new PDOException($e->getMessage());
    }
}


public function getTotalComments() {
    try {
        if(isset($_GET['fundraiserId']) && preg_match("/^[a-zA-Z0-9]*$/",$_GET['fundraiserId'])) {

            $fundraiserId = htmlentities($_GET['fundraiserId']);
            
            $fundraiserId = $fundraiserId;
            
            $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $fetch_p_comment = $con -> prepare("SELECT commentCode FROM parentcomments WHERE fundraiserId = ? ");
            $fetch_p_comment -> bindParam(1,$fundraiserId);
            $fetch_p_comment -> execute();
            $query = $con -> prepare("SELECT parentcommentCode FROM childrencomments WHERE fundraiserId = ?");
            $query -> bindParam(1,$fundraiserId);
            $query -> execute(); 
            $query1 = $con -> prepare("SELECT fundraiserId FROM childrenreplycomments WHERE fundraiserId = ?");
            $query1 -> bindParam(1,$fundraiserId);
            $query1 -> execute(); 
            if($fetch_p_comment -> execute() && $query -> execute()) {
                $parentCommentCount = $fetch_p_comment -> rowCount();
                $repliesCount = $query -> rowCount();
                $repliesCountc = $query1 -> rowCount();
                $totalcomments = intval($parentCommentCount+$repliesCount+$repliesCountc);
                echo "<span class='tttshared'> (".$totalcomments." thoughts shared)</span>";
            }

        }

    }catch (PDOEXception $e) {
        throw new PDOException($e->getMessage());
    }
}


public function getTotalCommentsCount() {
    try {
        if(isset($_GET['fundraiserId']) && preg_match("/^[a-zA-Z0-9]*$/",$_GET['fundraiserId'])) {

            $fundraiserId = htmlentities($_GET['fundraiserId']);
            
            $fundraiserId = $fundraiserId;
            
            $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $fetch_p_comment = $con -> prepare("SELECT commentCode FROM parentcomments WHERE fundraiserId = ? ");
            $fetch_p_comment -> bindParam(1,$fundraiserId);
            $fetch_p_comment -> execute();
            $query = $con -> prepare("SELECT parentcommentCode FROM childrencomments WHERE fundraiserId = ?");
            $query -> bindParam(1,$fundraiserId);
            $query -> execute(); 
            $query1 = $con -> prepare("SELECT fundraiserId FROM childrenreplycomments WHERE fundraiserId = ?");
            $query1 -> bindParam(1,$fundraiserId);
            $query1 -> execute(); 
            if($fetch_p_comment -> execute() && $query -> execute()) {
                $parentCommentCount = $fetch_p_comment -> rowCount();
                $repliesCount = $query -> rowCount();
                $repliesCountc = $query1 -> rowCount();
                $totalcomments = intval($parentCommentCount+$repliesCount+$repliesCountc);
                echo "$totalcomments";
            }else {
                echo '0';
            }

        }

    }catch (PDOEXception $e) {
        throw new PDOException($e->getMessage());
    }
}




public function getComments() {
    try{
        if(isset($_GET['fundraiserId']) && preg_match("/^[a-zA-Z0-9]*$/",$_GET['fundraiserId'])) {

        $pages = isset($_GET['page']) ? $_GET['page'] : 1;
        $page = intval($pages);
        if($page == 0) {
            $page = 1;
        }
        $limit = 10;
        $start = ($page - 1) * $limit;

        $fundraiserId = htmlentities($_GET['fundraiserId']);
        $fundraiserTitle = htmlentities($_GET['fundraiserTitle']);
        $fundraiserBy = htmlentities($_GET['fundraiserBy']);
        $user_data = @$_SESSION['user'];
        $userid = $user_data['id'];
        $name = $user_data['uname'];
        $email = $user_data['email'];

        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $fetch_p_comment = $con -> prepare("SELECT parentcomments.uname,parentcomments.user_email,parentcomments.profilePics,parentcomments.likes,parentcomments.dislikes,parentcomments.comment,parentcomments.commentupload,parentcomments.documentType,parentcomments.fileType,users.profile_pics,parentcomments.comment_time,parentcomments.fundraiserId,parentcomments.commentCode FROM parentcomments LEFT JOIN users ON parentcomments.uname = users.uname  WHERE parentcomments.fundraiserId = ? ORDER BY parentcomments.comment_time DESC LIMIT 20");
        $fetch_p_comment -> bindParam(1,$fundraiserId);
        $fetch_p_comment -> execute();
        $p = $fetch_p_comment -> fetchALL(PDO::FETCH_ASSOC);
        $query = $con -> prepare("SELECT * FROM parentcomments");
        $query -> execute(); 

        $paginate = $con->prepare("SELECT count(id) AS id FROM parentcomments GROUP BY fundraiserId");
        $paginate -> execute();
                    
        $countd = $paginate -> fetchAll(PDO::FETCH_ASSOC);
        $totalcountd = $countd[0]['id'];
        $pages = ceil($totalcountd / $limit); 
        $Previous = $page - 1;
        $Next = $page + 1;
        
        foreach($p as $item) {
           $item[] = $p;
           $date = new dateTime($item['comment_time']);
           $comment_time = date_format($date, 'M j, Y | H:i:s');
           $Ename = $item['uname'];
           $Email = $item['user_email'];
           $commenttext = $item['comment'];
           $commentupload = $item['commentupload'];
           $fileType = $item['fileType'];
           $commentuploadType = $item['documentType'];
           $fundraiserId = $item['fundraiserId'];
           $par_code = $item['commentCode'];
           $user_image = $item['profilePics'];
           $likes = $item['likes'];
           $dislikes = $item['dislikes'];
           
           $video_files = ['video/mp4','video/webm','video/mkv','video/avi','video/3gp'];
           $image_files = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg'];

           if (in_array($fileType, $video_files)) {
               $comment = '<video class="comment-vids" controls >
                            <source src="'.$commentupload.'" type="video/mp4">';
           }else if (in_array($fileType, $image_files)) {
                $comment = "<img src='$commentupload' alt='comment images' class='comment-images'>";
           }else {
               $comment = '<p class="position-comments">' .$commenttext. '</p>';
           }
           
           echo "<div class='comment' id='parent' name='".$par_code."'>"
                   ."<div class='comment-wrap'>
                        <img src='".$user_image."' alt='profile image' class='pcomment-pix'>
                        <div class='comment-content'>
                            <div class='user-name' id ='name'>".$Ename."</div>
                            <div class='_opo _345 _897'>"
                                .'<div class="comment-text-files">'.$comment.'</div>'
                                ."<div class='likes _sec'>
                                    <span class='likes-mama-updates' name=".$par_code." id='ccc-likes'><i class='fas fa-heart comment_likes' name=".$par_code." id='okay'></i> <span class='commentlikes'>".$likes."</span></span>
                                </div>"

                                ."<div class='comment-activities'>
                                    <div class='replyForm' id='tesa' style='display:block;'>
                                        <span class='edit_comment activ' name=".$par_code." > Edit </span>
                                        <span class='reply_comment activ'  name=".$par_code."> Reply </span>
                                    </div>
                                    <div class='epanel mt-2 pt-1' id='slideepanel $par_code'>
                                        <div class='comment-error'></div>
                                        <form action='' method='post' class='ecomment-form' id='ecomments-form'>
                                            <div>
                                                <input type='text' value='".@$Ename."' name='Ename' class='forminput' id='Ename' placeholder='Enter Name' required />
                                                <input type='text' value='$fundraiserId' class='forminput' id='fundraiserId' hidden/>
                                            </div>
                                            <div>
                                                <input type='text' value='".@$Email."' name='Email' class='forminput' id='emaild' placeholder='Enter Email' required />
                                            </div>
                                            <div class='pcode' name='$par_code'><textarea name='editComments' class='ecomments' id='$par_code'></textarea></div>
                                            <div>
                                                <input type='submit' value='Edit' name='$par_code' class='submit_edit' onclick = 'preveditSubmit()'/>
                                            </div>
                                        </form>
                                    </div>
                                    <div class='rpanel mt-2 pt-1' id='sliderpanel $par_code'>
                                        <div class='comment-error'></div>
                                        <form action='' method='post' class='rcomment-form' id='rcomments-form'>
                                            <div>
                                                <input type='text' value='".@$Ename."' name='Ename' class='forminput' id='Ename' placeholder='Enter Name' required />
                                                <input type='text' value='$fundraiserId' class='forminput' id='fundraiserId' hidden/>
                                            </div>
                                            <div>
                                                <input type='text' value='".@$Email."' name='Email' class='forminput' id='emaild' placeholder='Enter Email' required />
                                            </div>	
                                            <div class='pcode' name='$par_code'><textarea class='rcomments' id='replycomments'></textarea></div>
                                            <div>
                                                <input type='submit'name='$par_code'  value='Reply' class='submit_reply' onclick = 'prevreplySubmit()' />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                </diV>";                               
                     
           // fetch video reply/children comments

           $fetch_c_reply = $con -> prepare("SELECT childrencomments.uname,childrencomments.user_email,childrencomments.profilePics,childrencomments.likes,childrencomments.dislikes,childrencomments.comment,childrencomments.commentupload,childrencomments.documentType,childrencomments.fileType,users.profile_pics,childrencomments.comment_time,childrencomments.fundraiserId,childrencomments.parentcommentCode,childrencomments.childcommentCode FROM childrencomments LEFT JOIN users ON childrencomments.uname = users.uname WHERE childrencomments.parentcommentCode = ? AND childrencomments.parentcommentCode <> '' ORDER BY childrencomments.comment_time DESC LIMIT 5");
           $fetch_c_reply -> bindParam(1,$par_code);
           if($fetch_c_reply -> execute()) {
           $c = $fetch_c_reply -> fetchALL(PDO::FETCH_ASSOC);
           $c_count = $fetch_c_reply->rowCount();

           if($c_count == 0) {
              
           }else {
               
               echo "<div class='toggle-child-comments'><span><i class='fas fa-angle-down'></i></span> <span> | </span> <span><i class='fas fa-angle-up'></i></span></div>";
                   foreach($c as $com) {
                        $com[] = $c;
                        $c_date = new dateTime($com['comment_time']);
                        $c_comment_time = date_format($c_date, 'M j, Y | H:i:s');
                        $c_name = $com['uname'];
                        $c_commenttext = $com['comment'];
                        $c_commentupload = $com['commentupload'];
                        $c_fileType = $com['fileType'];
                        $c_commentuploadType = $com['documentType'];
                        $fundraiserId = $com['fundraiserId'];
                        $par_code = $com['parentcommentCode'];
                        $c_code = $com['childcommentCode'];
                        $c_user_image = $com['profilePics'];
                        $c_likes = $com['likes'];
                        $c_dislikes = $com['dislikes'];
                        

                        $video_files = ['video/mp4','video/webm','video/mkv','video/avi','video/3gp'];
                        $image_files = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg'];

                        if (in_array($fileType, $video_files)) {
                            $c_comment = '<video class="comment-vids" controls >
                                            <source src="'.$c_commentupload.'" type="video/mp4">';
                        }else if (in_array($fileType, $image_files)) {
                                $c_comment = "<img src='$c_commentupload' alt='comment images' class='comment-images'>";
                        }else {
                            $c_comment = '<p class="position-comments">' .$c_commenttext. '</p>';
                        }
                        

                       echo "<div class='child-comments' id='child' name='".$c_code."'>"
                                ."<div class='comment-wrap'>
                                        <img src='".$c_user_image."' alt='profile image' class='pcomment-pix'>
                                        <div class='comment-content'>
                                            <div class='user-name' id ='name'>".$c_name."</div>
                                            <div class='_opo _345 _897'>"
                                                .'<div class="comment-text-files">'.$c_comment.'</div>'
                                                ."<div class='likes _sec'>
                                                    <span class='likes-mama-updates' name=".$c_code."><i class='fas fa-heart comment_likes' name=".$c_code." id='okay'></i> <span class='commentlikes'>".$likes."</span></span>
                                                </div>"

                                                ."<div class='comment-activities'>
                                                    <div class='replyForm' id='tesa' style='display:block;'>
                                                        <span class='edit_comment activ' name=".$c_code."> Edit </span>
                                                        <span class='reply_comment activ' name=".$c_code."> Reply </span>
                                                    </div>
                                                    <div class='epanel mt-2 pt-1' id='slideepanel $c_code'>
                                                        <div class='comment-error'></div>
                                                        <form action='' method='post' class='echildcomments-form' id='echildcomments-form'>
                                                            <div>
                                                                <input type='text' value='".@$Ename."' name='Ename' class='forminput' id='Ename' placeholder='Enter Name' required />
                                                                <input type='text' value='$fundraiserId' class='forminput' id='fundraiserId' hidden/>
                                                            </div>
                                                            <div>
                                                                <input type='text' value='".@$Email."' name='Email' class='forminput' id='emaild' placeholder='Enter Email' required />
                                                            </div>    
                                                            <div class='pcode' name='$c_code'><textarea name='editComments' class='ecomments' id='$c_code'></textarea></div>
                                                            <div>
                                                                <input type='submit' value='Edit' name='$c_code' class='submit_child_commentedit' onclick = 'preveditSubmit()'/>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class='rpanel mt-2 pt-1' id='sliderpanel $c_code'>
                                                        <div class='comment-error'></div>
                                                        <form action='' method='post' class='rcomment-form' id='rccomments-form'>
                                                            <div>
                                                                <input type='text' value='".@$Ename."' name='Ename' class='forminput' id='Ename' placeholder='Enter Name' required />
                                                                <input type='text' value='$fundraiserId' class='forminput' id='fundraiserId' hidden/>
                                                            </div>
                                                            <div>
                                                                <input type='text' value='".@$Email."' name='Email' class='forminput' id='emaild' placeholder='Enter Email' required />
                                                            </div>	
                                                            <div class='pcode' name='$c_code'><textarea class='rcomments' id='replycomments'></textarea></div>
                                                            <div>
                                                                <input type='submit'name='$c_code'  value='Reply' class='submit_creply' onclick = 'prevreplySubmit()' />
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>";

                                                        // children reply comments
                                $fetch_c_reply = $con -> prepare("SELECT * FROM childrenreplycomments WHERE childcommentCode = ? AND childcommentCode <> '' ORDER BY comment_time DESC LIMIT 5");
                                $fetch_c_reply -> bindParam(1,$par_code);
                                if($fetch_c_reply -> execute()) {
                                $c = $fetch_c_reply -> fetchALL(PDO::FETCH_ASSOC);
                                $c_count = $fetch_c_reply->rowCount();

                                if($c_count == 0) {
                                    
                                }else {
                                    
                                    echo "<div class='toggle-reply-child-comments'><span><i class='fas fa-angle-down'></i></span> <span> | </span> <span><i class='fas fa-angle-up'></i></span></div>";
                                        foreach($c as $com) {
                                                $com[] = $c;
                                                $c_date = new dateTime($com['comment_time']);
                                                $c_comment_time = date_format($c_date, 'M j, Y | H:i:s');
                                                $c_name = $com['uname'];
                                                $c_commenttext = $com['comment'];
                                                $c_commentupload = $com['commentupload'];
                                                $c_fileType = $com['fileType'];
                                                $c_commentuploadType = $com['documentType'];
                                                // $fundraiserId = $com['fundraiserId'];
                                                // $par_code = $com['parentcommentCode'];
                                                $c_code = $com['childcommentCode'];
                                                $c_user_image = $com['profilePics'];
                                                $c_likes = $com['likes'];
                                                $c_dislikes = $com['dislikes'];
                                                $fundraiserId = htmlentities($_GET['fundraiserId']);
                                                $titled = htmlentities($_GET['fundraiserTitle']);

                                                $video_files = ['video/mp4','video/webm','video/mkv','video/avi','video/3gp'];
                                                $image_files = ['image/png', 'image/gif', 'image/jpg', 'image/jpeg'];

                                                if (in_array($fileType, $video_files)) {
                                                    $c_comment = '<video class="comment-vids" controls >
                                                                    <source src="'.$c_commentupload.'" type="video/mp4">';
                                                }else if (in_array($fileType, $image_files)) {
                                                        $c_comment = "<img src='../$c_commentupload' alt='comment images' class='comment-images'>";
                                                }else {
                                                    $c_comment = '<p class="position-comments">' .$c_commenttext. '</p>';
                                                }
                                                

                                            echo "<div class='child-reply-comments' id='child' name='".$par_code."'>"
                                                        ."<div class='comment-wrap'>
                                                                <img src='".$c_user_image."' alt='profile image' class='pcomment-pix'>
                                                                <div class='comment-content'>
                                                                    <div class='user-name' id ='name'>".$c_name."</div>
                                                                    <div class='_opo _345 _897'>"
                                                                        .'<div class="comment-text-files">'.$c_comment.'</div>'
                                                                        ."<div class='likes _sec'>
                                                                            <span class='likes-mama-updates' name=".$c_code." id='ccc-likes'><i class='fas fa-heart comment_likes' name=".$par_code." id='okay'></i> <span class='commentlikes'>".$likes."</span></span>
                                                                        </div>"
                                                                        ."
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>";
                                                    }
                                            //    echo  "</div>";
                                                }
                                                                
                                            }
                            }
                    //    echo  "</div>";
                        }
                                        
                    }
                echo "</div>";
                }
                echo "<div class='row text-center col-12 paginate-add'>
                    <div class='col-12 text-center paginate'>
                        <nav aria-label='Page navigation'>
                            <ul class='pagination text-center' style='list-style:none;'>";
                        if($page > 1) {
                            echo "<li class='active'>
                                    <a href='https://fundreza.com/p/$fundraiserTitle/$fundraiserBy/$fundraiserId' aria-label='Previous'>
                                        <span aria-hidden='true'>
                                            &laquo; Previous                        
                                        </span>
                                    </a>
                                </li>";
                                }       
                        
                                for($i = 1; $i <= $pages; $i++) {
                                    echo "<li class='inner'><a href='https://fundreza.com/p/$fundraiserTitle/$fundraiserBy/$fundraiserId/$i'>$i</a></li>";
                                }
                        if($page > 1) {
                            echo "<li>
                                    <a href='https://fundreza.com/p/$fundraiserTitle/$fundraiserBy/$fundraiserId/$Next' aria-label='Next'>
                                        <span aria-hidden='true'>
                                            Next &raquo;                        
                                        </span>
                                    </a>
                                </li>";
                        }
                            echo "
                            </ul>
                        </nav>
                    </div>
                </div>";
            }else {
                // echo 'select a video';
            }          
       }catch(PDOException $e) {
        throw new PDOException($e->getMessage());
    }
}



public function searchResult() {
    try{
      
        if($_SERVER['REQUEST_METHOD']=='fundraiser' && isset($_fundraiser['submit']) && isset($_fundraiser['query'])) {
    
        $query_search = strip_tags($_fundraiser['query']); 
        
        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if($query_search && $query_search != "" ) {
    
          $query_search = htmlentities($_fundraiser['query']);
          $cc = $query_search;

          $sql = $con -> prepare("SELECT * FROM fundraiser_table WHERE MATCH(fundraiserTitle,fundraiserBy,uname) AGAINST(?) ");
          $sql -> bindParam(1,$cc);
          if($sql -> execute() && $sql -> rowCount() > 0) {
              echo "<div class='show search results'>";
               $search_result_count = $sql -> rowCount();
                if($sql -> rowCount() == 1) {
                    echo "<div class='search count'><span class='count'>".$search_result_count." results found</span></div>";
                }else {
                    echo "<div class='search count'><span class='count'>".$search_result_count." results found</span></div>";
                }
                $rows = $sql -> fetchALL(PDO::FETCH_ASSOC);
                echo "<div class='row'>"; 

                foreach($rows as $row) {
                    //   $url = "https://empowerafrica.com/".$row['url'];
                    $id = $row['id'];
                    $fundraiserBy = $row['fundraiserBy'];
                    $title = $row['fundraiserTitle'];
                    $pstitle = substr($title,0,40).'...';
                    $fundraiserId = $row['fundraiserId'];
                    $uname = $row['uname'];
                    $view = $row['totalViews'];
                    $likes = $row['totalLikes'];
                    $shares = $row['totalShares'];
                    $upvotes = $row['totalupVotes'];
                    $fundraiserThumbnail = $row['fundraiserThumbnail'];
                    //   $cutvid = $row['cutvid'];
                        // for views
                    
                    // first strip any formatting;
                    $view = (0+str_replace(",","",$view));
                    
                    // is this a number?
                    if(!is_numeric($view)) return false;
                    
                    // now filter it;
                    if($view>1000000000000) {
                        $view = round(($view/1000000000000),1).' trillion';
                    }
                    else if($view>1000000000) {
                        $view = round(($view/1000000000),1).' billion';
                    } 
                    else if($view>1000000) {
                        $view = round(($view/1000000),1).' million';
                    }
                    else if($view>1000) {
                        $view = round(($view/1000),1).' thousand';
                    }else {
                        $view = number_format($view);
                    }


                    $upvotes = (0+str_replace(",","",$upvotes));
                    
                    // is this a number?
                    if(!is_numeric($view)) return false;
                    
                    // now filter it;
                    if($upvotes>1000000000000) {
                        $upvotes = round(($upvotes/1000000000000),1).' trillion';
                    }
                    else if($upvotes>1000000000) {
                        $upvotes = round(($upvotes/1000000000),1).' billion';
                    } 
                    else if($upvotes>1000000) {
                        $upvotes = round(($upvotes/1000000),1).' million';
                    }
                    else if($upvotes>1000) {
                        $upvotes = round(($upvotes/1000),1).' thousand';
                    }else {
                        $upvotes = number_format($upvotes);
                    }
                        
                        
                    
                echo "<div class='col-xs-12 col-sm-6 col-md-4 col-lg-4 show-emp-list'>";
                
                // echo "<a href='../mypage.php?fundraiserId=$fundraiserId'><iframe style='display:none;width:100%;' fundraiserer='$fundraiserThumbnail' class='videoslideshow'><source src='../$cutvid'></source></iframe></a>";
                
                echo "<div class='listings'>";

                    echo "<div class='emp-thump-wrapper'>
                            <a target='_blank' href='../page.php?empwerType=$fundraiserBy&&fundraiserId=$fundraiserId' style='text-decoration:none;'>
                                <img src='../$fundraiserThumbnail' name='thumbsvid' alt='thumbnail image' value='$fundraiserId' class='img-fluid img-responsive img-rounded emp-thumb'><span class='values' name ='ling' ></span>
                            </a>
                            <div class='thumb-inners'>
                                <div><a target='_blank' href='../page.php?$uname/$fundraiserBy/$fundraiserId'><i class='fas fa-share user-act'></i> ".$view." </a></div>
                                <div><a target='_blank' href='../page.php?$uname/$fundraiserBy/$fundraiserId'><i class='far fa-comments user-act'></i> ".$view." </a></div>
                                <div><a target='_blank' href='../page.php?$uname/$fundraiserBy/$fundraiserId'><i class='fas fa-users user-act'></i> ".$view." </a></div>
                            </div>
                        </div>";

                    echo "<div class='row '>
                            <div class='col-12 c-title'>
                                <a target='_blank' href='../page.php?$uname/$fundraiserBy/$fundraiserId' style='text-decoration:none;'>
                                    <div class='e-title padding' title='empower tile'>".$pstitle."</div> <div class='full-title text-gray'> $title </div>
                                </a>
                            </div>

                            
                        </div>";
                    echo "<div class='rowt'>
                            <div class='pb-2 e-react text-left'>
                                <div class='tripple-view u-react'>
                                    <i class='far fa-eye user-act'></i> ".$view." 
                                </div>
                                <div class='tripple-vote mr-5'>
                                    <i class='far fa-heart user-act'></i> ".$upvotes." 
                                </div>
                            </div>

                        </div>";
                
                echo "</div>";
                
                echo "</div>";

                }
                echo "</div>";
             echo "</div>";
          }else{
          echo "<div class='search-not-found'>search not found</div>";
          return false;
          }
          }
        }
    }catch(PDOException $e) {
      throw new PDOException($e-> getMessage());
    }
  }



public function updateActiveusers(){
    try{
        $user_data = @$_SESSION['user'];
        $userid = $user_data['id'];
        $email = $user_data['email'];

        $sq = $con -> prepare("SELECT auctionStatus FROM fundraiser_table WHERE clientEmail = ?");

        $sq -> bindParam(1,$email);
        $sq -> execute();
        if($sq->execute()) {
            $f = $sq -> fetch(PDO::FETCH_ASSOC);
            $auctStatt = $f['auctionStatus'];
            $accStat = 'Activated';
            if(isset($auctStatt) && $auctStatt == "Active") {
                $upt = $con -> prepare("UPDATE users SET accountStatus = ? WHERE email = ?");
                $upt -> bindParam(1,$accStat);
                $upt -> bindParam(2,$email);
                if($upt -> execute()) {
                    // echo 'inout';
                }
            }
        }


    }catch(PDOException $e) {
        throw new PDOException($e->getMessage());
    }
}


public function upgradeLevel(){
    try{
        $user_data = @$_SESSION['user'];
        $userid = $user_data['id'];
        $email = $user_data['email'];
        $name = $user_data['uname'];

        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $auctionId = randStrGena(6);
        $timestatus = time(); 
        $auctionStatus = 'Bid Inactive';
        
        if(isset($_fundraiser['auctionChannel'])) {
            $auctionChannel = isset($_fundraiser['auctionChannel']) ? $_fundraiser['auctionChannel'] : false;
            $auctionamount = isset($_fundraiser['auctionAmount']) ? $_fundraiser['auctionAmount'] : false;
            $auctionType = isset($_fundraiser['auction_type']) ? $_fundraiser['auction_type'] : false;
            $wA = isset($_fundraiser['wallet_address']) ? $_fundraiser['wallet_address'] : false;
            $bidCycle = isset($_fundraiser['biddingCycle']) ? $_fundraiser['biddingCycle'] : false;
            $transfee = isset($_fundraiser['transFee']) ? $_fundraiser['transFee'] : false;

            $auctionAmount = intval($auctionamount);
            $WA = strip_tags($wA);
            $totalEarnings  = $auctionamount;

            if((preg_match("/^[0-9.]*$/",$transfee) && htmlentities($transfee) && $WA )) {
            $_SESSION['auctAmt'] = $auctionAmount;
            $_SESSION['Email'] = $email;
            $_SESSION['auctType'] = $auctionType;
            $_SESSION['fname'] = $name;
        
            if($auctionType == "Starter") {
                $growthRate = '1';
            }else if($auctionType == "Elite") {
                $growthRate = '1.5';
            }
            else if($auctionType == "Prime") {
                $growthRate = '2';
            }
            else if($auctionType == "Pro") {
                $growthRate = '3';
            }
            
            $currentgrowthRate = 0;

            // Get user current stake level/package
            $check = $con -> prepare("SELECT auctionStatus FROM fundraiser_table WHERE clientEmail = ?");
            $check -> bindParam(1,$email);
                if($check -> execute() && $check -> rowCount() > 0) {

                    $getStat = $check -> fetch(PDO::FETCH_ASSOC);
                    $stakeStat = $getStat['auctionStatus'];

                    if($stakeStat == 'Active') {
                        $getcur_stake = $con -> prepare("SELECT bidLevel FROM users WHERE email = ? ");
                        $getcur_stake ->bindParam(1,$email);
                        $getcur_stake -> execute();
                        if($getcur_stake -> execute()) {

                            $gtcur_stake = $getcur_stake -> fetch(PDO::FETCH_ASSOC);
                            $curStakeLevel = $gtcur_stake['bidLevel'];

                            if($auctionType == $curStakeLevel) {
                                echo "<div class='alert-success p-2 m-3 rounded'> Already Active On This Level  <span class='close-err'>&times;</span> </div>";
                                exit();
                                }else {
                                    $invst = $con ->prepare("INSERT INTO fundraiser_table (auctionId,clientEmail,wallet_address,auctionAmount,transFee,auction_type,auctionChannel,bidCycle,totalEarning,growthRate,accumulatedgrowthRate,auctionDate,auctionStatus) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
                                    $invst -> bindParam(1,$auctionId);
                                    $invst -> bindParam(2,$email);
                                    $invst -> bindParam(3,$wA);
                                    $invst -> bindParam(4,$auctionAmount);
                                    $invst -> bindParam(5,$transfee);
                                    $invst -> bindParam(6,$auctionType);
                                    $invst -> bindParam(7,$auctionChannel);
                                    $invst -> bindParam(8,$bidCycle);
                                    $invst -> bindParam(9,$totalEarnings);
                                    $invst -> bindParam(10,$growthRate);
                                    $invst -> bindParam(11,$currentgrowthRate);
                                    $invst -> bindParam(12,$timestatus);
                                    $invst -> bindParam(13,$auctionStatus);
                                    if($invst->execute()) {
                                        $lastInsertId = $con -> lastinsertId();
                    
                                        $chek = $con -> prepare("SELECT auctionAmount FROM fundraiser_table WHERE clientEmail = ? AND id = ?");
                                        $chek ->bindParam(1,$email);
                                        $chek ->bindParam(2,$lastInsertId);
                                        $chek -> execute();
                                        if($chek -> execute()) {
                    
                                            $d = $chek -> fetch(PDO::FETCH_ASSOC);
                                            // Update users/bidders/users table with bidders bidding count
                                            $upt = $con -> prepare("UPDATE users SET last_auction = ? WHERE email = ?");
                                            $upt -> bindParam(1,$r['auctionAmount']);
                                            $upt -> bindParam(2,$email);
                                            if($upt -> execute()) {
                                                // echo 'inout';
                                            }
                                        
                                        }
                                        
                                        $auctStatus = 'Active';
                                        // Select all auction/bid details in auction-bid table
                                        $chec = $con -> prepare("SELECT COUNT(*) AS bidCount, SUM(totalEarning) AS totalauctionEarning, SUM(auctionAmount) AS totalauctionAmount FROM fundraiser_table WHERE clientEmail = ? AND auctionStatus = ?");
                                        $chec ->bindParam(1,$email);
                                        $chec ->bindParam(2,$auctStatus);
                                        if($chec -> execute() && $chec -> rowCount() > 0) {
                                            $r = $chec -> fetch(PDO::FETCH_ASSOC);
                                            $r['bidCount'];
                                            $r['totalauctionAmount'];
                                            $r['totalauctionEarning'];
                                            // Update users/bidders/users table with bidders bidding count
                                            $up = $con -> prepare("UPDATE users SET bidLevel = ?, auction_count = ?, totalauctionAmount = ?, totalauctionEarnings = ? WHERE email = ?");
                                            $up -> bindParam(1,$auctionType);
                                            $up -> bindParam(2,$r['bidCount']);
                                            $up -> bindParam(3,$r['totalauctionAmount']);
                                            $up -> bindParam(4,$r['totalauctionEarning']);
                                            $up -> bindParam(5,$email);
                                            if($up -> execute()){
                    
                                            }
                                            
                                        }
                    
                                        
                                            echo "<div class='alert-success p-2 m-3 rounded'> Account Upgrade Successful <div> Please check your email, we have sent you your stake details </div> <span class='close-err'>&times;</span> </div>";
                                            $Email = $_SESSION['Email'];
                                            $auctionType = $_SESSION['auctType'];
                                            $auctAmount = $_SESSION['auctAmt'];
                                            $uname = $_SESSION['fname'];
                                            
                                            upgradeAccountMail($Email,$auctionType,$auctAmount,$uname);

                                        }else {
                                            echo "<div class='alert-success p-2 m-3 rounded'> Ops!! Upgrade Request Failed <div> <a target='_blank' href='../stake' target='_blank' class='text-decoration-none p-2 rounded bg-primary' > Stake To Earn </a> </div> <span class='close-err'>&times;</span> </div>";
                                                exit();
                                            }
                                        
                                    }
                                }
                    }else {
                        echo "<div class='alert-success p-2 m-3 rounded'> Redeem Your Outstanding Stake To Activate Your Account<a rel='nofollow' style='cursor:pointer' data-toggle='modal' data-target='#activateStake' aria-haspopup='true' aria-expanded='false' class='text-decoration-none p-2 rounded bg-primary'> Stake To Earn </a> <span class='close-err'>&times;</span> </div>";
                        exit();
                    }

                    
                }else {
                    echo "<div class='alert-success p-2 m-3 rounded'> Ops!! You Must Stake First Before Upgrading Your Account <div> <a target='_blank' href='../stake' target='_blank' class='text-decoration-none p-2 rounded bg-primary' > Stake To Earn </a> </div> <span class='close-err'>&times;</span> </div>";
                    exit();
                }

            
                
            }
        }

              
        // }        

    }catch(PDOException $e) {
        throw new PDOException($e->getMessage());
    }
}




public function blockAccount() {
    try{
        $user_data = @$_SESSION['user'];
        $userid = $user_data['id'];
        $email = $user_data['email'];

        $sq = $con -> prepare("SELECT auctionStatus,auctionDate FROM fundraiser_table WHERE clientEmail = ?");

        $sq -> bindParam(1,$email);
        $sq -> bindParam(2,$auctStat);
        $sq -> execute();
        if($sq->execute() && $sq -> rowCount() > 0) {
            $f = $sq -> fetch(PDO::FETCH_ASSOC);
            $auctStatt = $f['auctionStatus'];
            $auctDate = $f['auctionDate'];
            $accStat = 'Blocked';

            $sevendays = $auctDate + (7*60*60*24);

            if(isset($auctStatt) && $auctStatt == "Inactive" && time() > $sevendays) {
                $upt = $con -> prepare("UPDATE users SET accountStatus = ? WHERE email = ?");
                $upt -> bindParam(1,$accStat);
                $upt -> bindParam(2,$email);
                if($upt -> execute()) {
                    // echo 'inout';
                }
            }
            
        }


    }catch(PDOException $e) {
        throw new PDOException($e->getMessage());
    }
}


public function withdrawalHistory() {
    try {

        $user_data = @$_SESSION['user'];
        $userid = $user_data['id'];
        $email = $user_data['email'];

        $pages = isset($_GET['page']) ? $_GET['page'] : 1;
        $page = intval($pages);
        if($page == 0) {
            $page = 1;
        }
        $limit = 10;
        $start = ($page - 1) * $limit;
        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = $con -> prepare("SELECT * FROM withdrawals WHERE clientEmail = ? GROUP BY withdrawalId DESC LIMIT $start,$limit");
        $sql -> bindParam(1,$email);
        $sql -> execute();

        $paginate = $con->prepare("SELECT count(id) AS id FROM withdrawals GROUP BY withdrawalId");
        $paginate -> execute();
        
        echo "<h4 class='text-center mt-4 mb-4 max-auto col-12'> Withdrawal History </h4><br>";

            if($sql -> execute() && $sql -> rowCount() > 0 && $paginate -> execute()) {
                
            // pagination code

                $countd = $paginate -> fetchAll(PDO::FETCH_ASSOC);
                $totalcountd = $countd[0]['id'];
                $pages = ceil($totalcountd / $limit); 
                $Previous = $page - 1;
                $Next = $page + 1;

                $rows = $sql -> fetchALL(PDO::FETCH_ASSOC);
                    
                echo "<div class='container-fluid'>";
                echo "<div class='text-center col-12 table-responsive'>";
                echo "<table  class='table table-responsive text-left table-striped table-bordered table-sm' cellspacing='0' col='5' width='100%'>
                        <thead>
                        <tr>
                            <th class='th-sm'>Withdrawal Id

                            </th>
                            <th class='th-sm'>Withdrawal Amount

                            </th>
                            <th class='th-sm'>Auction Type

                            </th>
                            <th class='th-sm'>Withdrawal Method

                            </th>
                            <th class='th-sm'>Remainig Balance

                            </th>
                            <th class='th-sm'>Withdrawal Status

                            </th>
                        </tr>
                        </thead>";
                        
                        foreach($rows as $row) {
                    
                            $withdrawalid = $row['withdrawalId'];
                            $email = $row['clientEmail'];
                            $withdrawalCurrency = $row['auction_currency'];
                            $investType = $row['auctionChannel'];
                            $withdrawAmt = $row['amountWithdrawn'];
                            $withdrawalchannel = $row['withdrawalChannel'];
                            $withdrawBalance = $row['withdrawalBalance'];
                            $withdrawStatus = $row['withdrawalStatus'];

                            if($withdrawalCurrency == 'Pounds'){
                                $withdrawAmount = "<i class='fas fa-pound-sign'></i>".$withdrawAmt;
                                $withdrawBal = "<i class='fas fa-pound-sign'></i>".$withdrawBalance;
                              }
                              
                              if($withdrawalCurrency == 'Dollar'){
                                $withdrawAmount = "<i class='fas fa-dollar-sign'></i>".$withdrawAmt;
                                $withdrawBal = "<i class='fas fa-dollar-sign'></i>".$withdrawBalance;
                              }
                              
                              if($withdrawalCurrency == 'Euro'){
                                $withdrawAmount = "<i class='fas fa-euro-sign'></i>".$withdrawAmt;
                                $withdrawBal = "<i class='fas fa-euro-sign'></i>".$withdrawBalance;
                              }
                              
                            
                        echo "<tbody>
                                <tr>
                                    <td>$withdrawalid</td>
                                    <td>$withdrawAmount</td>
                                    <td>$investType</td>
                                    <td>$withdrawalchannel</td>
                                    <td>$withdrawBal</td>
                                    <td>$withdrawStatus</td>
                                </tr>
                            </tbody>";
                                }
                    echo "</table>";

                echo "</div>";
                
                echo "</div>";
                

                echo "<div class='row text-center col-12 paginate-add'>
                    <div class='col-12 text-center paginate'>
                        <nav aria-label='Page navigation'>
                            <ul class='pagination text-center' style='list-style:none;'>";
                        if($page > 1) {
                            echo "<li class='active'>
                                    <a target='_blank' href='../page.php?$uname/$fundraiserBy/$fundraiserId/$Previous' aria-label='Previous'>
                                        <span aria-hidden='true'>
                                            &laquo; Previous                        
                                        </span>
                                    </a>
                                </li>";
                                }       
                        
                                for($i = 1; $i <= $pages; $i++) {
                                    echo "<li class='inner'><a target='_blank' href='../page.php?$uname/$fundraiserBy/$fundraiserId/$i'>$i</a></li>";
                                }
                        if($page > 1) {
                            echo "<li>
                                    <a target='_blank' href='../page.php?$uname/$fundraiserBy/$fundraiserId/$Next' aria-label='Next'>
                                        <span aria-hidden='true'>
                                            Next &raquo;                        
                                        </span>
                                    </a>
                                </li>";
                        }
                            echo "
                            </ul>
                        </nav>
                    </div>
                </div>";
                
            }else {
                echo "<div class='alert-success text-center col-12 max-auto mt-3 mb-3'> No Withdrawals Found <span class='close-err'>&times;</span> </div>";
                return false;
            }  

    }catch(PDOException $e) {
        throw new PDOException($e->getMessage());
    }
}



public function getReferrer() {
    try{
        $user_data = @$_SESSION['user'];
        $userid = $user_data['id'];
        $email = $user_data['email'];

        $pages = isset($_GET['page']) ? $_GET['page'] : 1;
        $page = intval($pages);
        if($page == 0) {
            $page = 1;
        }
        $limit = 10;
        $start = ($page - 1) * $limit;
        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = $con -> prepare("SELECT invitee_refId,sponsordById,referredEmail,RefBonus,inviteeActivityEarnings FROM referrer_table WHERE sponsoredByEmail = ?");
        $sql -> bindParam(1,$email);
        $sql -> execute();
        $qa = $con -> prepare("SELECT SUM(RefBonus) AS sumrefBonus,SUM(inviteeActivityEarnings) AS suminviteeActEarns FROM referrer_table WHERE sponsoredByEmail = ?");
        $qa -> bindParam(1,$email);
        $qa -> execute();
        $paginate = $con->prepare("SELECT count(id) AS id FROM referrer_table GROUP BY id");
        $paginate -> execute();
        
        echo "<h4 class='text-center mt-4 mb-4 mx-auto'> Referral History </h4>";

            if($sql -> execute() && $sql -> rowCount() > 0 && $paginate -> execute()) {
                
            // pagination code

                $countd = $paginate -> fetchAll(PDO::FETCH_ASSOC);
                $totalcountd = $countd[0]['id'];
                $pages = ceil($totalcountd / $limit); 
                $Previous = $page - 1;
                $Next = $page + 1;

                $sumEarn = $qa -> fetch(PDO::FETCH_ASSOC);
                $sumRefEarns = $sumEarn['sumrefBonus'];
                $suminviteeactivityearns = $sumEarn['suminviteeActEarns'];

                $in = $sql -> fetchALL(PDO::FETCH_ASSOC);
                    
                echo "<div class='container-fluid'>";
                echo "<div class='text-center col-12 table-responsive'>";
                echo "<table  class='table text-left table-responsive table-striped table-bordered table-sm' cellspacing='0' col='5' width='100%'>
                        <thead>
                        <tr>
                            <th class='th-xs'>My Ref Id

                            </th>
                            <th class='th-xs'>Invitee Ref Id

                            </th>
                            <th class='th-xs'>My Referrals

                            </th>
                            <th class='th-xs'>Sponsor/Referral Bonus Earnings

                            </th>
                            <th class='th-xs'>Referrals Activity Earnings

                            </th>
                        </tr>
                        </thead>";
                        
                        foreach ($in as $key => $value) {
                            # code...
                            $refid = $value['sponsordById'];
                            $irefid = $value['invitee_refId'];
                            $referrals = $value['referredEmail'];
                            $refBonus = '$'.$value['RefBonus'];
                            $inviteeActivityEarn = '$'.$value['inviteeActivityEarnings'];
        
                            echo "<tbody>
                                    <tr>
                                        <td>$refid</td>
                                        <td>$irefid</td>
                                        <td>$referrals</td>
                                        <td>$refBonus</td>
                                        <td>$inviteeActivityEarn</td>
                                    </tr>
                                </tbody>";
                              }
                            echo "<tfoot>
                                    <tr>
                                        <td>
                                            Sum Referral Bonus Earnings $$sumRefEarns
                                        </td>
                                        <td>
                                            Sum Referral Activities Earnings $$suminviteeactivityearns
                                        </td>
                                    </tr>
                                </tfoot>";
                    echo "</table>";

                echo "</div>";
                
                echo "</div>";
                

                echo "<div class='row text-center col-12 paginate-add'>
                    <div class='col-12 text-center paginate'>
                        <nav aria-label='Page navigation'>
                            <ul class='pagination text-center' style='list-style:none;'>";
                        if($page > 1) {
                            echo "<li class='active'>
                                    <a href='../page.php?$uname/$fundraiserBy/$fundraiserId/$Previous' aria-label='Previous'>
                                        <span aria-hidden='true'>
                                            &laquo; Previous                        
                                        </span>
                                    </a>
                                </li>";
                                }       
                        
                                for($i = 1; $i <= $pages; $i++) {
                                    echo "<li class='inner'><a href='../page.php?$uname/$fundraiserBy/$fundraiserId/$i'>$i</a></li>";
                                }
                        if($page > 1) {
                            echo "<li>
                                    <a href='../page.php?$uname/$fundraiserBy/$fundraiserId/$Next' aria-label='Next'>
                                        <span aria-hidden='true'>
                                            Next &raquo;                        
                                        </span>
                                    </a>
                                </li>";
                        }
                            echo "
                            </ul>
                        </nav>
                    </div>
                </div>";
                
            }else {
                echo "<div class='alert-success'> No Referral Records Found <span class='close-err'>&times;</span> </div>";
                return false;
            }

    }catch(PDOException $e) {
        throw new PDOException($e->getMessage());
    }
}



public function referralEarningsCalc() {
    try{
        $user_data = @$_SESSION['user'];
        $userid = $user_data['id'];
        $email = $user_data['email'];

        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;", $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = $con -> prepare("SELECT referredEmail FROM referrer_table WHERE sponsoredByEmail = ?");
        $sql -> bindParam(1,$email);
        $sql -> execute();
            if($sql -> execute() && $sql -> rowCount() > 0) {
                
                $in = $sql -> fetchALL(PDO::FETCH_ASSOC);
                
                        foreach ($in as $key => $value) {
                            # code...
                            $referrals = $value['referredEmail'];
                            $auctStat = 'Active';
                            $sq = $con -> prepare("SELECT auctionAmount FROM fundraiser_table WHERE clientEmail = ? AND auctionStatus = ?");
                            $sq -> bindParam(1,$referrals);
                            $sq -> bindParam(2,$auctStat);
                            $sq -> execute();
                            if($sq->execute()) {
                                // fetch each referrals active investment amount
                                $f = $sq -> fetch(PDO::FETCH_ASSOC);
                                $inviteeBidAmout = $f['auctionAmount'];

                                $percentRefEarn = 0.05;
                                $earnPerRef = $inviteeBidAmout * $percentRefEarn;

                                // Update referrers table with sponsors bonus earnings
                                $upt = $con -> prepare("UPDATE referrer_table SET RefBonus = ? WHERE referredEmail = ? AND sponsoredByEmail = ? ");
                                $upt -> bindParam(1,$earnPerRef);
                                $upt -> bindParam(2,$referrals);
                                $upt -> bindParam(3,$email);
                                if($upt -> execute()) {
                                     // Select all referral details in referrer-table
                                     
                                    $chec = $con -> prepare("SELECT COUNT(*) AS refCount, SUM(RefBonus) AS totalRefEarning, SUM(inviteeActivityEarnings) AS totalinviteeActivityEarnings, SUM(sponsorpointReceived) AS sponsorPR FROM referrer_table WHERE sponsoredByEmail = ? ");
                                    $chec ->bindParam(1,$email);
                                    if($chec -> execute()) {
                                        
                                        $r = $chec -> fetch(PDO::FETCH_ASSOC);
                                        // Update users/bidders/users table with sponsors referral earnings
                                        $refcount = $r['refCount'];
                                        $sumRefBonus = $r['totalRefEarning'];
                                        $suminviteeactivityEarning = $r['totalinviteeActivityEarnings'];
                                        $sponsorPR = $r['sponsorpointReceived'];

                                        $totalReferralEarnings = $sumRefBonus + $suminviteeactivityEarning;

                                        $up = $con -> prepare("UPDATE users SET referral_count = ?, total_refEarnings = ?, pointReceived = ? WHERE email = ?");
                                        $up -> bindParam(1,$refcount);
                                        $up -> bindParam(2,$totalReferralEarnings);
                                        $up -> bindParam(3,$email);
                                        if($up -> execute()){
                                        }

                                    }
                                }
                            }
        
                            
                        }
                  

            }else {
                echo "<div class='alert-success'> No Referral Records Found <span class='close-err'>&times;</span> </div>";
                return false;
            }

    }catch(PDOException $e) {
        throw new PDOException($e->getMessage());
    }
}




public function auctionHistory() {
    try {

        $user_data = @$_SESSION['user'];
        $userid = $user_data['id'];
        $email = $user_data['email'];

        $pages = isset($_GET['page']) ? $_GET['page'] : 1;
        $page = intval($pages);
        if($page == 0) {
            $page = 1;
        }
        $limit = 10;
        $start = ($page - 1) * $limit;
        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = $con -> prepare("SELECT * FROM fundraiser_table WHERE clientEmail = ? GROUP BY auctionId DESC LIMIT $start,$limit");
        $sql -> bindParam(1,$email);
        $sql -> execute();

        $paginate = $con->prepare("SELECT count(id) AS id FROM fundraiser_table GROUP BY auctionid");
        $paginate -> execute();
        
        echo "<h4 class='text-center mt-4 mb-4 mx-auto'> Auction History </h4>";

            if($sql -> execute() && $sql -> rowCount() > 0 && $paginate -> execute()) {
                
            // pagination code

                $countd = $paginate -> fetchAll(PDO::FETCH_ASSOC);
                $totalcountd = $countd[0]['id'];
                $pages = ceil($totalcountd / $limit); 
                $Previous = $page - 1;
                $Next = $page + 1;

                $in = $sql -> fetchALL(PDO::FETCH_ASSOC);
                    
                echo "<div class='container-fluid'>";
                echo "<div class='text-center col-12 table-responsive'>";
                echo "<table  class='table text-left table-responsive table-striped table-bordered table-sm' cellspacing='0' col='5' width='100%'>
                        <thead>
                        <tr>
                            <th class='th-xs'>Bid Id

                            </th>
                            <th class='th-xs'>Bid Amount

                            </th>
                            <th class='th-xs'>Bidding Coin

                            </th>
                            <th class='th-xs'>Bidding Type

                            </th>
                            <th class='th-xs'>Growth Rate(% Daily)

                            </th>
                            <th class='th-xs'>Accumulated Growth Rate(Days)

                            </th>
                            <th class='th-xs'>Status

                            </th>
                        </tr>
                        </thead>";
                        
                        foreach ($in as $key => $value) {
                            # code...
                            $auctAmt = '$'.$value['auctionAmount'];
                            $auctChannel = $value['auctionChannel'];
                            $growthrate = $value['growthRate'].'%';
                            $auctionTyp = $value['auction_type'];
                            $accumulatedgR = $value['accumulatedgrowthRate'];
                            $auctStat = $value['auctionStatus'];
                            $auctId = $value['auctionId'];
        
                            echo "<tbody>
                              <tr>
                                  <td>$auctId</td>
                                  <td>$auctAmt</td>
                                  <td>$auctChannel</td>
                                  <td>$auctionTyp</td>
                                  <td>$growthrate</td>
                                  <td>$accumulatedgR</td>
                                  <td>$auctStat</td>
                              </tr>
                          </tbody>";
                              }
                    echo "</table>";

                echo "</div>";
                
                echo "</div>";
                

                echo "<div class='row text-center col-12 paginate-add'>
                    <div class='col-12 text-center paginate'>
                        <nav aria-label='Page navigation'>
                            <ul class='pagination text-center' style='list-style:none;'>";
                        if($page > 1) {
                            echo "<li class='active'>
                                    <a href='../page.php?$uname/$fundraiserBy/$fundraiserId/$Previous' aria-label='Previous'>
                                        <span aria-hidden='true'>
                                            &laquo; Previous                        
                                        </span>
                                    </a>
                                </li>";
                                }       
                        
                                for($i = 1; $i <= $pages; $i++) {
                                    echo "<li class='inner'><a href='../page.php?$uname/$fundraiserBy/$fundraiserId/$i'>$i</a></li>";
                                }
                        if($page > 1) {
                            echo "<li>
                                    <a href='../page.php?$uname/$fundraiserBy/$fundraiserId/$Next' aria-label='Next'>
                                        <span aria-hidden='true'>
                                            Next &raquo;                        
                                        </span>
                                    </a>
                                </li>";
                        }
                            echo "
                            </ul>
                        </nav>
                    </div>
                </div>";
                
            }else {
                echo "<div class='alert-success'> No auction Records Found <span class='close-err'>&times;</span> </div>";
                return false;
            }  

    }catch(PDOException $e) {
        throw new PDOException($e->getMessage());
    }
}




public function addPaymentMethod(){
    try{
        $user_data = @$_SESSION['user'];
        $userid = $user_data['id'];
        $email = $user_data['email'];

        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $payoptionId = randStrGena(6);
        $timestatus = date('Y-m-d H:i:s',time()); 
        
        if(isset($_fundraiser['paymentChannel'])) {
            $paymentChannel = isset($_fundraiser['paymentChannel']) ? $_fundraiser['paymentChannel'] : false;

            if($paymentChannel == 'Bitcoin' || $paymentChannel == 'Ethereum' || $paymentChannel == 'Litecoin') {
                $walletAddress = isset($_fundraiser['wallet-address']) ? $_fundraiser['wallet-address'] : false;
                $filteredWA = strip_tags($walletAddress);
            }

            $payOpt = $con ->prepare("INSERT INTO paymentdetails (payoptionId,clientEmail,paymentChannel,walletAddress,timestatus) VALUES (?,?,?,?,?)");
            $payOpt -> bindParam(1,$payoptionId);
            $payOpt -> bindParam(2,$email);
            $payOpt -> bindParam(3,$paymentChannel);
            $payOpt -> bindParam(4,$walletAddress);
            $payOpt -> bindParam(5,$timestatus);
            if($payOpt->execute()) {
                echo "<div class='alert-success'> Payment Option Successfully Added <span class='close-err'>&times;</span> </div>";
                return false;
            }


        }        

    }catch(PDOException $e) {
        throw new PDOException($e->getMessage());
    }
}




public function paymentOptions() {
    try {

        $user_data = @$_SESSION['user'];
        $userid = $user_data['id'];
        $email = $user_data['email'];

        $pages = isset($_GET['page']) ? $_GET['page'] : 1;
        $page = intval($pages);
        if($page == 0) {
            $page = 1;
        }
        $limit = 10;
        $start = ($page - 1) * $limit;
        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = $con -> prepare("SELECT * FROM paymentdetails WHERE clientEmail = ? GROUP BY payoptionId DESC LIMIT $start,$limit");
        $sql -> bindParam(1,$email);
        $sql -> execute();

        $paginate = $con->prepare("SELECT count(id) AS id FROM paymentdetails GROUP BY payoptionId");
        $paginate -> execute();
        
        echo "<h4 class='text-center mt-4 mb-4'> Payment Options </h4>";

            if($sql -> execute() && $sql -> rowCount() > 0 && $paginate -> execute()) {
                
            // pagination code

                $countd = $paginate -> fetchAll(PDO::FETCH_ASSOC);
                $totalcountd = $countd[0]['id'];
                $pages = ceil($totalcountd / $limit); 
                $Previous = $page - 1;
                $Next = $page + 1;

                $rows = $sql -> fetchALL(PDO::FETCH_ASSOC);
                    
                echo "<div class='col-xs-12 col-12'>";
                echo "<div class=''>";
                echo "<table id='dtBasicExample' class='table table-striped table-responsive table-sm' cellspacing='0' width='100%'>
                        <thead>
                        <tr>
                            <th class='th-sm'>Payment ID

                            </th>
                            <th class='th-sm'>Selected Payment Channel

                            </th>
                            <th class='th-sm'>Wallet Address

                            </th>
                            <th class='th-sm'>Time Added

                            </th>
                        </tr>
                        </thead>";
                        
                        foreach($rows as $row) {
                    
                            $email = $row['clientEmail'];
                            $paymentChannel = $row['paymentChannel'];
                            $walletAddress = $row['walletAddress'];
                            $payoptionId = $row['payoptionId'];
                            $time = $row['timestatus'];
                            
                        echo "<tbody>
                                <tr>
                                    <td>$payoptionId</td>
                                    <td>$paymentChannel</td>
                                    <td>$walletAddress</td>
                                    <td>$time</td>
                                </tr>
                            </tbody>";
                                }
                    echo "</table>";

                echo "</div>";
                
                echo "</div>";
                

                
            }else {
                echo "<div class='alert-success'> No Payment Option Found <span class='close-err'>&times;</span> </div>";
                return false;
            }  

    }catch(PDOException $e) {
        throw new PDOException($e->getMessage());
    }
}





public function showrecentUpdates() {
    try{
        $user_data = @$_SESSION['user'];
        $userid = $user_data['id'];
        $email = $user_data['email'];

        $con = new PDO("mysql:host=$this->serverhost;dbname=fundgcmf_db;" , $this->serverusername, $this->serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $select = $con -> prepare("SELECT * FROM recentupdates ORDER BY timestatus DESC LIMIT 12");
        if($select -> execute() && $select -> rowCount() > 0) {
            $update = $select -> fetchAll(PDO::FETCH_ASSOC);
            foreach($update as $u) {
                $updatetitle = $u['title'];
                $updatecontent = $u['content'];
                $image = $u['updateimage'];
                $time = $u['timestatus'];

                echo "<div class='item d-flex justify-content-between'>
                        <div class='info d-flex'>
                            <div class='icon'><img src='../$image' class='img-fluid rounded-circle'></div>
                            <div class='up-title'>
                            <h6 class='update-title'>$updatetitle</h6>
                            <p>$updatecontent</p>
                            </div>
                        </div>
                        <div class='date text-right'><span>$time</span></div>
                    </div>";
            }
        }

    }catch(PDOException $e) {
        throw new PDOException($e->getMessage());
    }
}







}


 ?>