<?php
header("Content-Type: text/html; charset=utf-8");
 include("connection.php");
 $owner = $_POST['ownerId'];
 $tag = $_POST['Tag'];
 // $tag = "4";
 // echo $tag;
 if($tag == ""){
 	$sql = "select * from questionnaire where questionnaireOwnerId='$owner'";
 }
 else {
 	$sql = "select * from questionnaire where questionnaireOwnerId='$owner' and questionnaireTag like '%$tag%'";
 }
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