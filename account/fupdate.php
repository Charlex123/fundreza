<?php 

require_once'../dbh.php';
require_once'../config.php';


$user_data = @$_SESSION['user'];
        $userid = $user_data['id'];
        $email = $user_data['email'];
        $name = $user_data['uname'];
        $fuid = $_POST['fup'];
        $con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = $con -> prepare("SELECT DISTINCT totaldonationsReceived,totalViews,fundraiserId,fundraiserThumbnail,fundraiserTitle,fundraiserCategory,fundraiserBy,dateSubmitted FROM fundraiser_table WHERE fundraiserThumbnail <> '' AND fundraiserEmail = ? AND fundraiserId = ?");
        $sql -> bindParam(1,$email);
        $sql -> bindParam(2,$fuid);
        $sql -> execute();
        
            if($sql -> execute() ) {
                
            // pagination code

                $row = $sql -> fetch(PDO::FETCH_ASSOC);
                // var_dump($rows);
                echo "<h4 class='mt-3'> You are Sharing fundraiser progress update of</h4>";

                    //   $url = "https://empowerafrica.com/".$row['url'];
                    // $id = $row['id'];
                    $fundraiseredB = $row['fundraiserBy'];
                    $fundraiserBy = str_replace(" ",'-',$fundraiseredB);
                    $title = $row['fundraiserTitle'];
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

                echo "<div class='col-xs-12 col-sm-12 pt-2 pb-2 ' style=''>";
                
                // echo "<a href='mypage.php?fundraiserId=$fundraiserId'><iframe style='display:none;width:100%;' fundraiserer='$fundraiserThumbnail' class='videoslideshow'><source src='$cutvid'></source></iframe></a>";
                
                echo "<div class='mfrs'>";

                    echo "<div class=' bg-white'>
                            <a target='_blank' href='../page.php?fundraiserTitle=$titled&fundraiserBy=$fundraiserBy&fundraiserId=$fundraiserId' style='text-decoration:none;'>
                                <img src='../$fundraiserThumbnail' name='thumbsvid' alt='thumbnail image' value='$fundraiserId' class='mfr-img' style=''>
                            </a>
                            
                            <div class='mfrsc'>
                                <div class='mfrsc-in' style='position: relative'> 
                                    <div class='mfrsc-td'> Total Donations Received </div> <div class='mfrsc-dona icc'> <i class='fas fa-dollar-sign'></i> $tdR </div>
                                </div>
                                
                                <div class='mfrsc-title bg-white'>
                                    <a target='_blank' href='../page.php?fundraiserTitle=$titled&fundraiserBy=$fundraiserBy&fundraiserId=$fundraiserId' style='text-decoration:none;' class=''>
                                        <div class='fulltitled p-1'> $ftitle <div class='mfrsc-ft'>$title</div></div> 
                                    </a>
                                </div>
                                <div class='mfrscc pt-2 pb-2 pl-1'> <div class='mfrsc-time'> Created: $fundraisertime </div> <div class='mfrsc-eyev icc'><i class='fas fa-eye'></i> $view</div> </div>

                                <div class='mf mt-5 mb-3'><a rel='nofollow' style='cursor:pointer' data-toggle='modal' data-target='#upF' name='$fundraiserId' aria-haspopup='true' aria-expanded='false' id='fup' onclick='getId()' class='nf w100 mt-3 mb-3 pl-3 pr-3'> Share fundraiser progress update</a></div>
                            </div>
                            
                        </div>";

                    
                echo "</div>";
                echo "</div>";

            }

?>