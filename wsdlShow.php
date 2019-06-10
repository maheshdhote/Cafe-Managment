
	
<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if($_GET['method'] == "load_items")
{
	$conn = mysqli_connect("localhost","root","") ;
	//check connection
	if (mysqli_connect_errno())
		{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
	//Select database
		mysqli_select_db($conn,"d1");
	


	  $sql = "SELECT * from RM_MasterTable";
	  $result = $conn->query($sql);
	  $data=array();

	while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
		$row=array();
	   $row['Item_ID']=addslashes($rs["Item_ID"]);
	   $row['Item_Name']=addslashes($rs["Item_Name"]);
	   $row['Item_Weight']=addslashes($rs["Item_Weight"]);
	   $row['tax']=addslashes($rs["tax"]);
	   $row['Primary_Rate']=addslashes($rs["Primary_Rate"]);
	   $row['Price']=addslashes($rs["Price"]);
	   $row['Primary_Vendor']=addslashes($rs["Primary_Vendor"]);
	   $row['WA_Purchase_Rate']=addslashes($rs["WA_Purchase_Rate"]);
	   $row['WA_Consume_Rate']=addslashes($rs["WA_Consume_Rate"]);
	   $row['Dept_of_usage']=addslashes($rs["Dept_of_usage"]);
		
	   $data[]=$row;
		
	}
	$jsonData=array();
	$jsonData['records']=$data;
 
	$conn->close();
	echo json_encode($jsonData);
 
}
?>