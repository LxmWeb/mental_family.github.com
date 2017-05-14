<?php
header("Content-Type: text/html; charset=utf-8");
include("connection.php");
$push_id = $_POST['push_id'];
//$push_id = 62;
$sql = "update docPush set ifRead=1 where push_id= '$push_id'";
$result=mysqli_query($conn,$sql);
?>