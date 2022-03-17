<?php

//fetch_data.php

include('config.php');
require_once'dbh.php';

if(isset($_POST["action"]))
{
	// $query = "SELECT * FROM fundraiser_table WHERE fundraiserStatus = 'Active'";
	$query = "SELECT DISTINCT fundraiser_table.fundraiserStory,fundraiser_table.donationsReceived,fundraiser_table.totaldonationsReceived,
  fundraiser_table.totalDonations,fundraiser_table.fundraiserId,fundraiser_table.fundraiserThumbnail,fundraiser_table.fundraiserTitle,
  fundraiser_table.fundraiserCategory,fundraiser_table.fundraiserGoal,fundraiser_table.fundraiserBy,donation_table.donation_time,
  fundraiser_table.dateSubmitted,donation_table.donatedAmount AS donorsCount FROM fundraiser_table 
  LEFT JOIN donation_table ON fundraiser_table.fundraiserId = donation_table.fundraiserId WHERE fundraiser_table.fundraiserThumbnail <> '' AND fundraiser_table.fundraiserStory <> '' 
  AND fundraiser_table.fundraiserStatus = 'Active'";
	if(isset($_POST["fundraiserType"]))
	{
		$type_filter = implode("','", $_POST["fundraiserType"]);
		$query .= "AND fundraiser_table.fundraiserType IN('".$type_filter."')";
	}
	if(isset($_POST["fundraiserCategory"]))
	{
		$categ_filter = implode("','", $_POST["fundraiserCategory"]);
		$query .= "AND fundraiser_table.fundraiserCategory IN('".$categ_filter."')";
	}

	$statement = $con->prepare($query);
	$statement->execute();
	$rows = $statement->fetchAll();
	$total_row = $statement->rowCount();
	if($total_row > 0)
	{
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
                    $testdna = '32500';
                    $dR = $row['donationsReceived'];
                    // $likes = $row['totalLikes'];
                    // $shares = $row['totalShares'];
                    // $upvotes = $row['totalupVotes'];
                    $fundraiserThumbnail = $row['fundraiserThumbnail'];
                    $time = $row['donation_time'];
                    $categ = $row['fundraiserCategory'];
                    $category = str_replace("-"," ", $categ);


                    $fg = number_format($fgg);
                    $testdona = number_format($testdna);
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
                        $dona = round(($dona/1000000000000),1).' trillion';
                    }
                    else if($dona>1000000000) {
                        $dona = round(($dona/1000000000),1).' billion';
                    } 
                    else if($dona>1000000) {
                        $dona = round(($dona/1000000),1).' million';
                    }
                    else if($dona>1000) {
                        $dona = round(($dona/1000),1).' thousand';
                    }else {
                        $dona = number_format($dona);
                    }    
                    
                    echo "<div id='widthControlled' class='col-xs-12 col-sm-12 col-md-6 col-lg-4 pt-2 pb-2 mb-5'>
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
							<div class='sdft'>Start your own fundraiser campaign <div><a href='account/dashboard.php'><button><i class='fas fa-dollar-sign'></i>Start fundriser</button></a></div></div>
							<div class='dsc'>Don't know how to start a fundraiser <div><a href='contact.php'><button><i class='fas fa-headset'></i>Talk to us</button></a></div></div>
						</div>
					</div>";
		}
		else {
			echo "<div class='p-2 m-3 nf'> No Fundraiser Found <a target='_blank' href='../choose-type.php' class='text-decoration-none text-dark'> Start A new Fundraiser </a> <span class='close-err'>&times;</span> </div>";
			return false;

		}   
}

?>          