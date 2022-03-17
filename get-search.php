<?php
require_once'config.php';


if(isset($_POST['search_query']) && $_POST['search_query'] != "" && $_POST['search_query'] != null) {

if(!htmlentities(strip_tags($_POST['search_query']))) {
    echo 'search input format not accepted, use only alphanumerics';
    exit();
}

if(preg_match("/^[a-zA-Z 0-9]*$/", $_POST['search_query'])) {
    
    $search = $_POST['search_query'];

    $stmt = $con -> prepare("SELECT * FROM empower_table WHERE MATCH(empowerTitle,empowerType,uname) AGAINST(?) ");
    $stmt -> bindParam(1,$search,PDO::PARAM_STR);


    if($stmt -> execute() && $stmt -> rowCount() > 0) {
        $i = 0;
        $rows = $stmt-> fetchALL(PDO::FETCH_ASSOC);
        sort($rows);
        
        echo "<div class='my-parent'>";
            echo "<table class='artists-table'>";
            echo "<tr>";
            echo "<th class='thead-l'>Empower Title</th><div style='clear:left'></div>";
            echo "<th class='thead-r'>Empower Type box</th><div style='clear:right'></div>";
            echo "<th class='thead-r'>Posted By </th><div style='clear:right'></div>";
            echo "</tr>";
            foreach($rows as $row) {
                $empowerTitle = $row['empowerTitle'];
                $empowerType = $row['empowerType'];
                $uname = $row['uname'];
                  ob_start();
                  echo "<tr>";
                  echo "<td>";
                  echo "<div name=".$empowerTitle." value=".$empowerTitle." class='artist-name'>".strtoupper($empowerTitle)."</div><div style='clear:left;'></div>";
                  echo "<div name=".$empowerType." value=".$empowerType." class='artist-name'>".strtoupper($empowerType)."</div><div style='clear:left;'></div>";
                  echo "<div name=".$uname." value=".$uname." class='artist-name'>".strtoupper($uname)."</div><div style='clear:left;'></div>";
                  echo "</td>";
                  
                  echo "<td>";
                  echo "<div class='pseudoAlert'></div>";
                  echo "<input type='checkbox' class='checkbox' name='$empowerType' value='$empowerType' readonly /><div style='clear:right;'></div>";
                  echo "</td>";
                  echo "</tr>";
                 
                  }
                  echo "</table>";
                  echo "</div>";     
                                       
              }else {
                exit();
            }
    }else {
        echo 'invalid data entry';
        exit();
    }


}
?>