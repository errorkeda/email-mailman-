<?php
session_start();
include "autoload.php";
$gobj = new Database();  
$page ="";
$limit_per_page = 10;
$login_user = $_SESSION['login_user_Email'];
if(isset($_POST['page_no'])){
    $page = $_POST['page_no'];
}else
{
    $page = 1;
}
    $offset = ($page -1)* $limit_per_page;
 $search_value = $_POST["search"];
$sql = "SELECT * FROM All_emails WHERE subject like '%{$search_value}%' ORDER BY id DESC LIMIT {$offset},{$limit_per_page} ";//OR age Like '%{$search_value}%'
  $result = $gobj->mysqli->query($sql) or die("sql query failed");
$output = "";

if(mysqli_num_rows($result) > 0){
    $output .= '<table border="1" width="100px" cellspacing="0" cellpadding="10px">';
            while($row = mysqli_fetch_assoc($result)){
                
                $output .="<tr>
                <td><input type='checkbox'></td>
                <td>{$row["reciver_email"]}</td>
                <td>{$row["subject"]}</td>
                <td>{$row["datetime"]}</td>
                </tr>";
                $output.="</table>";
            }
            $sql = "SELECT * FROM All_emails  WHERE sender_email='$login_user' AND sender_status=1";
    $result = $gobj->mysqli->query($sql)or die("Query failed");
    $total_record = mysqli_num_rows($result);
    $total_pages = ceil($total_record/$limit_per_page);
    $output .='<div id="pagination" class="d-flex">';
        for($i=1; $i <= $total_pages; $i++){
            $output.="<a class='page-link' id='{$i}' href='#'>{$i}</a>";
        }
  $output .='</div>';
            echo $output;

}else{ echo "result not Found"; }



?>
