<?php
header("Content-Type: text/html; charset=utf-8");
 include("connection.php");
 //$owner = $_POST['ownerId'];
 // echo $owner;
 //$sql = "select * from questionnaire where questionnaireOwnerId='$owner'";
$sql = "set names 'utf8'";
mysqli_query($conn,$sql);
$sql = "select * from questionnaire where questionnaireOwnerId='17816869761'";
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