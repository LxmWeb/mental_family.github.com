<?php
header("Content-Type: text/html; charset=utf-8");
include("connection.php");
$sql = "set names 'utf8'";
mysqli_query($conn,$sql);
//$owner = $_POST['ownerId'];
$sql = "select * from docPush where patient_id='17816869781'";
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