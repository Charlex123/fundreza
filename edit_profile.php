<?php
    session_start();
    require_once'config.php';
    require_once'dbh.php';

    $user_data = @$_SESSION['user'];
    $userid = $user_data['id'];
    $refid = $user_data['referral_id'];
    if(($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit_account']) && isset($_POST['name']) && $_POST['name'] !="" && isset($_POST['phone']) && $_POST['phone'] !="" && isset($_POST['user_type']) && $_POST['user_type'] !="") || (isset($_POST['name']) && $_POST['name'] !="" && isset($_POST['user_type']) && $_POST['user_type'] !="" )) {
        $name = isset($_POST['name']) ? $_POST['name'] : false;
        $phone = isset($_POST['phone']) ? $_POST['phone'] : false;
        $usertype = isset($_POST['user_type']) ? $_POST['user_type'] : false;
        $errorMsg = "";
        $user_data = @$_SESSION['user'];
        $userid = $user_data['id'];

        if(isset($name) && $name != "" && $phone != "") {
            if($phone != htmlentities(strip_tags($_POST['phone']))) {
                $errorMsg = "invalid phonenumber";
                
            }else if(!preg_match("/^[ 0-9]*$/",$phone) && !ctype_digit($phone)) {
                $errorMsg = 'only numbers required!';
                header("location:profile.php?active=$userid");
                     exit();
                }
            if(preg_match("/^[a-z A-Z0-9]*$/",$name)) {

                if(strlen($name) < 3 || strlen($name) > 80) {
                    echo 'Name must be between 3 - 80 characters long';
                    header("location:profile.php?active=$userid");
                     exit(); 
                }

                $acname = $name;
                $phone;
                $upLogin = $con -> prepare("UPDATE users SET name = ?, phonenumber = ?, user_type = ? WHERE id = ?");
                $upLogin -> bindParam(1,$acname,PDO::PARAM_STR);
                $upLogin -> bindParam(2,$phone);
                $upLogin -> bindParam(3,$usertype);
                $upLogin -> bindParam(4,$userid);
                $upLogin -> execute();
                $upLog = $con -> prepare("SELECT * FROM users WHERE id = ?");
                $upLog -> bindParam(1,$userid);
                $upLog -> execute();

                $t = $upLog -> fetch(PDO::FETCH_ASSOC);
                $uname = $t['name'];
                $_SESSION['updated_user'] = $t;
                header("location:profile.php?name=$uname");
                exit();
                
                }else {
                echo 'only letters and numbers accepted';
                
            }
        }elseif (isset($name) && $name != "" && $phone =="") {
            if(preg_match("/^[a-z A-Z0-9]*$/",$name)) {

                if(strlen($name) < 3 || strlen($name) > 80) {
                    echo 'Name must be between 3 - 80 characters long';
                    header("location:profile.php?active=$userid");
                     exit();
                }
                
                $acname = $name;
                $phone;
                $upLogin = $con -> prepare("UPDATE users SET name = ?, user_type = ? WHERE id = ? ");
                $upLogin -> bindParam(1,$acname,PDO::PARAM_STR);
                $upLogin -> bindParam(2,$usertype);
                $upLogin -> bindParam(3,$userid);
                $upLogin -> execute();
                $upLog = $con -> prepare("SELECT * FROM users WHERE id = ?");
                $upLog -> bindParam(1,$userid);
                $upLog -> execute();
                
                $t = $upLog -> fetch(PDO::FETCH_ASSOC);
                $uname = $t['name'];
                $_SESSION['updated_user'] = $t;
                header("location:profile.php?name=$uname");
                exit();
                
                }
            }
        }else {
            header("location:profile.php?active=$refid");
            exit();
        }
?>
