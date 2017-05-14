<?php
// 防止恶意调用
define('IN_TG', true);
header('Access-Control-Allow-Origin:*');
header("Content-type: text/html; charset=utf-8"); 
//引入
require dirname(__FILE__).'/includes/common.inc.php';

require ROOT_PATH.'includes/mentalTest.func.php';

$doctor_id = $_POST['doctor_id'];
$op = $_POST['op'];
$p = $_POST['p'];
//$doctor_id = '17816869761';
//$op = 1;
if($op == 1){
	echo select_relation($doctor_id, $p);
}
else{
	$patient_id = $_POST['patient_id'];
	echo doctor_agree($doctor_id, $patient_id, 0);
}
?>