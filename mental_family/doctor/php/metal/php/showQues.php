<?php
header("Content-Type: text/html; charset=utf-8");
include("connection.php");
//$push_id = $_POST['push_id'];
$push_id = 62;
$sql = "select questionnaireId from docPush where push_id= '$push_id'";
$result = mysqli_query($conn,$sql);
if (!$result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
while($rows = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $reply = $rows;
}
$questionnaireId = $reply['questionnaireId'];
$sql1 = "select * from question where QuestionnaireId= $questionnaireId";
$result1 = mysqli_query($conn,$sql1);
if (!$result1){
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
$reply1 = array();
while($rows = mysqli_fetch_array($result1,MYSQLI_ASSOC)){
    $reply1[] = $rows;
}
echo json_encode($reply1);
?>