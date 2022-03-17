<?php
session_start();
require_once'config.php';


if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['keyPressed']) && $_POST['keyPressed'] != "") {
 
 $query_search = htmlentities(strip_tags($_POST['keyPressed'])); 
 
 if($query_search && $query_search != "") {
    $query_search = htmlentities(strip_tags($_POST['keyPressed']));
    $cc = "%".$query_search."%";
    $con = new PDO("mysql:host=$serverhost;dbname=fundgcmf_db;" , $serverusername, $serverpassword);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = $con -> prepare("SELECT fundraiserId,fundraiserTitle,fundraiserBy FROM fundraiser_table WHERE fundraiserCategory LIKE ? OR fundraiserTitle LIKE ? OR fundraiserBy LIKE ?");
    $sql -> bindParam(1,$cc);
    $sql -> bindParam(2,$cc);
    $sql -> bindParam(3,$cc);
    
    if($sql -> execute() && $sql -> rowCount() > 0) {
        
        $rows = $sql -> fetchALL(PDO::FETCH_ASSOC);
        // var_dump($rows);
        foreach($rows as $row) {
            $fundraiserTitle = $row['fundraiserTitle'];
            $fundraiserId = $row['fundraiserId'];
            $fundraiserBy = $row['fundraiserBy'];
            
            $fundraiserT = str_replace(" ","-",$row['fundraiserTitle']);
            $fundraiserI = str_replace(" ","-",$row['fundraiserId']);
            $fundraiserB = str_replace(" ","-",$row['fundraiserBy']);
            
            echo "<div name=".$fundraiserTitle." value=".$fundraiserTitle." class='result text-left m-2 p-2'><i class='fas fa-check text-success'></i> <a href='https://fundreza.com/p/$fundraiserT/$fundraiserB/$fundraiserI' class=''>".ucwords($fundraiserTitle)."</a></div><div style='clear:left;'></div>";
       
        }
    }else{
        echo "<div class='text-left m-2 p-2'>search not found</div>";
        exit();
    }
}
}















