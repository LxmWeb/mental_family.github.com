<?php
header("Content-Type: text/html; charset=utf-8");
include("connection.php");
$t = date('Y-m-d',time());
//$doctor_id = $_POST['doctor_id'];
//$patient_id = $_POST['patient_id'];
$doctor_id = "17816869761";
$patient_id = "17816869729";
$sql = "select patient_name,sex,birthday,main_suit from patient where patient_id= '$patient_id'";
$result = mysqli_query($conn,$sql);
if (!$result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
while($rows = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $reply = $rows;
}
$patient_name = $reply['patient_name'];
$sex = $reply['sex'];
$birthday = $reply['birthday'];
$main_suit = $reply['main_suit'];
echo $patient_id." ".$doctor_id." ".$patient_name." ".$sex." ".$birthday;
$sql = "INSERT INTO relationship(patient_id,doctor_id,patient_name,sex,birthday,main_suit,build_time,is_valid) VALUES ('$patient_id','$doctor_id','$patient_name', '$sex','$birthday','$main_suit','$t',0)";
$result=mysqli_query($conn,$sql);
?>