<?php
header('Access-Control-Allow-Origin:*');
header("Content-Type: text/html; charset=utf-8");
//include("connection.php");
//引入
require dirname(__FILE__).'/includes/common.inc.php';

require ROOT_PATH.'includes/mentalTest.func.php';

$id = $_POST['id'];
// echo $id;
$qn = $_POST['QN'];
$pa = $_POST['PA'];
$qnr = $_POST['QNR'];
$paCnt = count($pa);
$qnCnt = count($qn);
// echo $paCnt;
$time = date('Y-m-d H:i:s',time());
//send_test('17816869761','17816869739','1','2017-03-19 15:12');
for($i = 0; $i < $paCnt; $i++) {
	for ($j = 0; $j < $qnCnt; $j++) { 
//		$sql = "insert into docPush (doctor_id, patient_id, questionnaireId, pushTime) values('$id', '$pa[$i]', '$qn[$j]', '$time')";
        // echo $sql;
        // $sql = "insert into docPush (doctor_id, patient_id, questionnaireId, pushTime) values('17816869761', '17816869781', '$qn[$j]', '$time')"
//		$result=mysqli_query($conn,$sql);
		send_test($id, $pa[$i], $qn[$j], $qnr[$j],$time);
	}
}

?>