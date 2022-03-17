<?php
ob_start();
session_start();
require_once'dbh.php';
require_once'config.php';

@$_SESSION['currentpage'] = $_SERVER['REQUEST_URI'];
strip_tags(@$_SESSION['currentpage']);

$user_data = @$_SESSION['user'];
$userid = $user_data['id'];

// $Email = $_SESSION['Email'];


// $ref = $_GET['reference'];
// if(isset($ref)) {
    
//     $curl = curl_init();

  

//   curl_setopt_array($curl, array(

//     CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurldecode($ref),

//     CURLOPT_RETURNTRANSFER => true,

//     CURLOPT_ENCODING => "",

//     CURLOPT_MAXREDIRS => 10,

//     CURLOPT_TIMEOUT => 30,

//     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

//     CURLOPT_CUSTOMREQUEST => "GET",

//     CURLOPT_HTTPHEADER => array(

//       "Authorization: Bearer sk_live_18b2331f2bc1875205fe4c6e01cfb86e5f6a3f23",

//       "Cache-Control: no-cache",

//     ),

//   ));

  

//   $response = curl_exec($curl);

//   $err = curl_error($curl);

//   curl_close($curl);

  

//   if ($err) {

//     echo "cURL Error #:" . $err;

//   } else {

//     $result = json_decode($response);

//   }
  
//   if($result->data->status == "success") {
        
//         $status = $_SESSION['status'];
//         $_SESSION['paytime'] = date('m/d/Y h:i:s a', time());
//         $empowerStat = 'Active';
//         $empowerAmt = '2';
//         $Email = $_SESSION['Email'];
//         $con = new PDO("mysql:host=$serverhost;dbname=u260645912_waep;", $serverusername, $serverpassword);
//         $getDet = $con -> prepare("UPDATE users SET empowerStatus = ?, empower_activationAmt = ? WHERE email = ?");
//         $getDet -> bindParam(1,$empowerStat);
//         $getDet -> bindParam(2,$empowerAmt);
//         $getDet -> bindParam(3,$Email);
//         $getDet -> execute();
//         header("location:https://waep.africa/login");
//   }else {
//       header("location:https://waep.africa/login");
//   }
    
// }else {
//   header("location:javascript://history.go(-1)");
// }


// Retrieve the request's body
$body = @file_get_contents("php://input");

// retrieve the signature sent in the reques header's.
$signature = (isset($_SERVER['HTTP_VERIF_HASH']) ? $_SERVER['HTTP_VERIF_HASH'] : '');

/* It is a good idea to log all events received. Add code *
 * here to log the signature and body to db or file       */

if (!$signature) {
    // only a post with rave signature header gets our attention
    exit();
}

// Store the same signature on your server as an env variable and check against what was sent in the headers
$local_signature = getenv('FLUTTERWAVE_TEST');

// confirm the event's signature
if( $signature !== $local_signature ){
  // silently forget this ever happened
  exit();
}

http_response_code(200); // PHP 5.4 or greater
// parse event (which is json string) as object
// Give value to your customer but don't give any output
// Remember that this is a call from rave's servers and 
// Your customer is not seeing the response here at all
$response = json_decode($body);
if ($response->status == 'successful') {
    var_dump($response);
    # code...
    // TIP: you may still verify the transaction
            // before giving value.
}
exit();
ob_end_flush();
?>