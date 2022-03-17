<?php
session_start();
require_once'config.php';
require_once'mailer.php';

$user_data = @$_SESSION['user'];
$userid = $user_data['id'];
// $name = $user_data['name'];
$name = 'John';
$Email = $user_data['Email'];

// if(!isset($user_data) && !isset($name) && !isset($userid)) {
//         echo "<a href='login' style='text-decoration:none;color: #001737'>Login To View Notificatons</a>";
//         exit();
//     }else if(isset($user_data) && isset($name) && isset($userid) && $name != "") {
   
            $status = 0;

        $sel = $con -> prepare("SELECT commentCode FROM parentcomments WHERE uname = ? AND status = ?");
        $sel -> bindParam(1,$name);
        $sel -> bindParam(2,$status);
        $sel -> execute();

        $rrr = $sel -> fetchAll(PDO::FETCH_ASSOC);
        
          $array = new RecursiveArrayIterator($rrr);
          $array = new RecursiveIteratorIterator($array);
          $array = iterator_to_array($array,false);
        
            $rrr = implode(',',array_fill(0,count($array),'?'));
        
        
            $query = $con -> prepare("SELECT childrencomments.uname,users.profile_pics,childrencomments.comment_time,childrencomments.Code,childrencomments.commentCode FROM childrencomments INNER JOIN users ON childrencomments.uname = users.uname WHERE childrencomments.status = 0 AND childrencomments.uname <> '".$name."' AND childrencomments.parentcommentCode IN($rrr) AND childrencomments.childcommentCode <> '' ORDER BY childrencomments.comment_time DESC");
            $query -> execute($array);
        
            if($query -> rowCount() > 0)  {
                $rows = $query -> fetchAll(PDO::FETCH_ASSOC);
                var_dump($rows);
                foreach($rows as $r) {
                $rname = $r['uname'];
                echo '
                <ul>
                <li>
                    <a> 
                        <small class="_holyer"><img src="'.$r['profile_pics'].'" class="reminder"><span class="_proper">'.$name.',</span><span class="_proper" > '.$r['name'].'</span> replied to your comment on a , ...reply back</small>
                    </a>
                </li>
                </ul>'; 

                commentMail($Email,$rname,$name);
                }
            }else {
                echo "<div class='_notifications checked'>No new notifications</div>";
                exit(); 
            }
        
    // }
    


?>