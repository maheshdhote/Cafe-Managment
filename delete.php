<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


$conn = mysqli_connect("localhost","root","") ;
if (mysqli_connect_errno())
{echo "Failed to connect to MySQL: " . mysqli_connect_error();}
mysqli_select_db($conn,"d1");

$json = file_get_contents('php://input');
$data = json_decode($json);

$name = $conn->real_escape_string($data->Item_Name);
$sqlQuery = "delete from rm_mastertable where Item_Name='".$name."';";
$conn->query($sqlQuery);

 $jsonData= "Deleted record Inserted successfully";
 echo json_encode($jsonData);


mysqli_close($conn);
?>