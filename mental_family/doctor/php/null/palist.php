<?php
header("Content-Type: text/html; charset=utf-8");
 include("connection.php");
 $owner = $_POST['ownerId'];
 // echo $owner;
 $sql = "select * from patient where doctor_id=".$owner;
 $result = mysqli_query($conn,$sql);
 if (!$result) {
 printf("Error: %s\n", mysqli_error($conn));
 exit();
}
$reply = array();
while($rows = mysqli_fetch_array($result,MYSQLI_ASSOC)){
	$reply[] = $rows;
}
echo json_encode($reply);
?>