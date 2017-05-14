<?php
header("Content-Type: text/html; charset=utf-8");
include("connection.php");
//$push_id = $_POST['push_id'];
//$score = $_POST['score'];
$push_id = 62;
$score = 100;
$sql = "update docPush set ifFinish=1 where push_id= $push_id";
$result=mysqli_query($conn,$sql);
$sql = "update docPush set testscore=$score where push_id= $push_id";
$result=mysqli_query($conn,$sql);

$t = date('Y-m-d H:i:s',time());
$sql = "INSERT INTO medical_record(patient_id,test_time,test_title,test_score,test_result) VALUES ('17816869781','$t', 'xljk','$score','')";
$result=mysqli_query($conn,$sql);
?>