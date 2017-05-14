<?php
header("Content-Type: text/html; charset=utf-8");
include("connection.php");
$doctor_id = "17816869761";
$sql = "select * from doctor where doctor_id= '$doctor_id'";
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