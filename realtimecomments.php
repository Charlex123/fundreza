<?php
require('Persistence.php');

$db = new Persistence();
if( $db->add_comment($_POST) ) {
  header( 'Location: index.php' );
}
else {
  header( 'Location: index.php?error=Your comment was not posted due to errors in your form submission' );
}
?>

<?php
require('Persistence.php');
$comment_post_ID = 1;
$db = new Persistence();
$comments = $db->get_comments($comment_post_ID);
$has_comments = (count($comments) > 0);
if(isset($name) && $name != "") {
        $status = 0;

        $sel = $con -> prepare("SELECT commentCode FROM videoparentcomments WHERE name = ? AND status = ?");
        $sel -> bindParam(1,$name);
        $sel -> bindParam(2,$status);
        $sel -> execute();
        if($sel -> rowCount() == 1) {
            $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
            $array = array($rr[0]['commentCode']);
            
            }else if($sel -> rowCount() == 2) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode']);
            
            }else if($sel -> rowCount() == 3) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode']);
            
            }else if($sel -> rowCount() == 4) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode']);
        
            }else if($sel -> rowCount() == 5) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode']);
            
            }else if($sel -> rowCount() == 6) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode']);
            
            }else if($sel -> rowCount() == 7) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode']);
            
            }
            else if($sel -> rowCount() == 8) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode']);
            
            }
            else if($sel -> rowCount() == 9) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode']);
        
            }else if($sel -> rowCount() == 10) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode']);
            
            }else if($sel -> rowCount() == 11) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode']);
        
            }else if($sel -> rowCount() == 12) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode']);
            
            }else if($sel -> rowCount() == 13) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode']);
        
            }else if($sel -> rowCount() == 14) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode']);
            
            }else if($sel -> rowCount() == 15) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode']);
            
            }else if($sel -> rowCount() == 16) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode']);
            
            }else if($sel -> rowCount() == 17) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode']);
            
            }else if($sel -> rowCount() == 18) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode']);
            
            }else if($sel -> rowCount() == 19) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18]['commentCode']);
            
            }else if($sel -> rowCount() == 20) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18]['commentCode'],$rr[19]['commentCode']);
            
            }else if($sel -> rowCount() == 21) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18]['commentCode'],$rr[19]['commentCode'],$rr[20]['commentCode']);
            
            }else if($sel -> rowCount() == 22) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18]['commentCode'],$rr[19]['commentCode'],$rr[20]['commentCode'],$rr[21]['commentCode']);
            
            }else if($sel -> rowCount() == 23) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18]['commentCode'],$rr[19]['commentCode'],$rr[20]['commentCode'],$rr[21]['commentCode'],$rr[22]['commentCode']);
            
            }else if($sel -> rowCount() == 24) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18]['commentCode'],$rr[19]['commentCode'],$rr[20]['commentCode'],$rr[21]['commentCode'],$rr[22]['commentCode'],$rr[23]['commentCode']);
            
            }else if($sel -> rowCount() == 25) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18][' commentCode'],$rr[19]['commentCode'],$rr[20]['commentCode'],$rr[21]['commentCode'],$rr[22]['commentCode'],$rr[23]['commentCode'],$rr[24]['commentCode']);
            
            }else if($sel -> rowCount() == 26) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18]['commentCode'],$rr[19]['commentCode'],$rr[20]['commentCode'],$rr[21]['commentCode'],$rr[22]['commentCode'],$rr[23]['commentCode'],$rr[24]['commentCode'],$rr[25]['commentCode']);
            
            }else if($sel -> rowCount() == 27) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18]['commentCode'],$rr[19]['commentCode'],$rr[20]['commentCode'],$rr[21]['commentCode'],$rr[22]['commentCode'],$rr[23]['commentCode'],$rr[24]['commentCode'],$rr[25]['commentCode'],$rr[26]['commentCode']);
            
            }else if($sel -> rowCount() == 28) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18]['commentCode'],$rr[19]['commentCode'],$rr[20]['commentCode'],$rr[21]['commentCode'],$rr[22]['commentCode'],$rr[23]['commentCode'],$rr[24]['commentCode'],$rr[25]['commentCode'],$rr[26]['commentCode'],$rr[27]['commentCode']);
            
            }else if($sel -> rowCount() == 29) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18]['commentCode'],$rr[19]['commentCode'],$rr[20]['commentCode'],$rr[21]['commentCode'],$rr[22]['commentCode'],$rr[23]['commentCode'],$rr[24]['commentCode'],$rr[25]['commentCode'],$rr[26]['commentCode'],$rr[27]['commentCode'],$rr[28]['commentCode']);
            
            }else if($sel -> rowCount() == 30) {
                $rr = $sel -> fetchAll(PDO::FETCH_ASSOC);
                $array = array($rr[0]['commentCode'],$rr[1]['commentCode'],$rr[2]['commentCode'],$rr[3]['commentCode'],$rr[4]['commentCode'],$rr[5]['commentCode'],$rr[6]['commentCode'],$rr[7]['commentCode'],$rr[8]['commentCode'],$rr[9]['commentCode'],$rr[10]['commentCode'],$rr[11]['commentCode'],$rr[12]['commentCode'],$rr[13]['commentCode'],$rr[14]['commentCode'],$rr[15]['commentCode'],$rr[16]['commentCode'],$rr[17]['commentCode'],$rr[18]['commentCode'],$rr[19]['commentCode'],$rr[20]['commentCode'],$rr[21]['commentCode'],$rr[22]['commentCode'],$rr[23]['commentCode'],$rr[24]['commentCode'],$rr[25]['commentCode'],$rr[26]['commentCode'],$rr[27]['commentCode'],$rr[28]['commentCode'],$rr[29]['commentCode']);
            
            }else if($sel -> rowCount() == 0) {
                echo "<div class='write comment' >write comment to see replies<div>";
                return false;
            }

?>
<html>
<head>
<style>
#respond {
  margin-top: 40px;
}

#respond input[type='text'],
#respond input[type='email'], 
#respond textarea {
  margin-bottom: 10px;
  display: block;
  width: 100%;

  border: 1px solid rgba(0, 0, 0, 0.1);
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  -o-border-radius: 5px;
  -ms-border-radius: 5px;
  -khtml-border-radius: 5px;
  border-radius: 5px;

  line-height: 1.4em;
}
</style>
</head>
<body>
<div id="respond">

  <h3>Leave a Comment</h3>

  <form action="post_comment.php" method="post" id="commentform">

    <label for="comment_author" class="required">Your name</label>
    <input type="text" name="comment_author" id="comment_author" value="" tabindex="1" required="required">
    
    <label for="email" class="required">Your email;</label>
    <input type="email" name="email" id="email" value="" tabindex="2" required="required">
    
    <label for="comment" class="required">Your message</label>
    <textarea name="comment" id="comment" rows="10" tabindex="4"  required="required"></textarea>
    
    <-- comment_post_ID value hard-coded as 1 -->
    <input type="hidden" name="comment_post_ID" value="<?php echo($comment_post_ID); ?>" id="comment_post_ID" />
    
    <input name="submit" type="submit" value="Submit comment" />

  </form>

</div>
</body>
</html>