<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2017/3/13
 * Time: 13:20
 */
header("Content-Type: text/html; charset=utf-8");
global $conn;
$conn = new mysqli ("localhost", "root","","student");
if (mysqli_connect_error())
{
    printf("Connect faile: %s\n",mysqli_connect_error());
    exit;
}
$sql = "set names 'utf8'";
mysqli_query($conn,$sql);
//$patientId = $_POST['patientId'];
$sql = "select * from caseOfIllness where patientId='17816869761'" ;
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