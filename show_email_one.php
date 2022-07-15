<?php 
session_start();
include "autoload.php";
$gobj = new Database();


$trval = $_POST["id"];
$sql = "SELECT * FROM All_emails WHERE id='$trval'";

$result = $gobj->mysqli->query($sql);

if($result->num_rows > 0){


 $row = $result->fetch_all(MYSQLI_ASSOC);

//  print_r($row);
//  die();

 echo json_encode($row);
 
}else{
    echo json_encode(['msg'=>'0 Result Found', 'status'=> false]);
}



?>
