<?php
header("Content-Type: text/html; charset=utf-8");
 include("connection.php");
 $owner = $_POST['ownerId'];
 $qn = $_POST['QN'];
 $qnCnt = count($qn);
 for($i = 0; $i < $qnCnt; $i++){
 	$sql = "Insert into questionnaire (questionnaireId, questionnaireOwnerId) values('$qn[$i]', '$owner')";
 	echo $sql;
	$result=mysqli_query($conn,$sql);
 }
?>