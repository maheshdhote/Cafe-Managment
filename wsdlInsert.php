<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


$conn = mysqli_connect("localhost","root","") ;
if (mysqli_connect_errno())
{echo "Failed to connect to MySQL: " . mysqli_connect_error();}
mysqli_select_db($conn,"d1");

$json = file_get_contents('php://input');
$data = json_decode($json);


$ItemName = $conn->real_escape_string($data->ItemName);
$ItemWeight = $conn->real_escape_string($data->ItemWeight);
$Tax=$conn->real_escape_string($data->Tax);
$Rate=$conn->real_escape_string($data->Rate);
$Price=$conn->real_escape_string($data->Price);
$Vendor=$conn->real_escape_string($data->Vendor);
$WA_PR=$conn->real_escape_string($data->WA_PR);
$WA_CR=$conn->real_escape_string($data->WA_CR);
$button_value=$conn->real_escape_string($data->button_value);
$Old_Item =$conn->real_escape_string($data->Old_Item);

$s1 = $data->Dept;
$dept="$s1->value1,$s1->value2,$s1->value3,$s1->value4,$s1->value5,$s1->value6,$s1->value7,";


if($button_value=='Insert')
{
$sqlQuery = "insert into RM_MasterTable values('','".$ItemName."','".$ItemWeight."',$Tax,$Rate,$Price,
'".$Vendor."',$WA_PR,$WA_CR,'".$dept."',now())";


if ($conn->query($sqlQuery) === TRUE) {
    $jsonData="New record Inserted successfully";
    echo json_encode($jsonData);
  
} else {
    $jsonData="Error: " ;
    echo json_encode($jsonData);
}

}

if($button_value=='Update')
{
    $sqlQuery ="update rm_mastertable set
    Item_Name='".$ItemName."',
    Item_Weight='".$ItemWeight."',
    tax=$Tax,
    Primary_Rate=$Rate,
    Price=$Price,
    Primary_Vendor='".$Vendor."',
    WA_Purchase_Rate=$WA_PR,
    WA_Consume_Rate=$WA_CR,
    Dept_of_usage='".$dept."',
    Item_date=now()
    where Item_Name='".$Old_Item."';
    ";
    $conn->query($sqlQuery) ;
        $jsonData="New record Update successfully";
        echo json_encode($jsonData);
      
   
  
}

mysqli_close($conn);

?>