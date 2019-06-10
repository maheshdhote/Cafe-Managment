<?php 
include 'connect.php';

//get values
$ItemName = $_POST['ItemName'];
$ItemId = $_POST['ItemId'];
$ItemWeight =$_POST['ItemWeight'];
echo "ItemName is $ItemName<br> ItemID is $ItemId<br>Weight is: $ItemWeight";

//insert Item
$sqlQuery = "insert into itemlist values($ItemId,'$ItemName','$ItemWeight',now())";
if ($conn->query($sqlQuery) === TRUE) {
    echo "New record created successfully<br>";
} else {
    echo "Error: " . $sqlQuery . "<br>" . $conn->error;
}

//Display
$sql = "SELECT * from itemlist";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo " id: " . $row["Item_ID"].   " - Name: " . $row["Item_Name"]. "  " . $row["Item_Weight"]."  Time -".$row["Item_date"]."<br>";
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?>