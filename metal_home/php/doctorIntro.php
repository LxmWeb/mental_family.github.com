<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2017/4/17
 * Time: 14:02
 */
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/includes/common.inc.php';
require ROOT_PATH.'includes/mentalTest.func.php';

$doctor_id = $_POST['doctor_id'];
//$doctor_id = "17816869761";
$result = show_doctor_Info($doctor_id);
$result = json_decode($result,true);
$hospital_id = $result[0]['working_place'];
$result1 = show_hospital_Info($hospital_id);
$result1 = json_decode($result1,true);
$result2 = Array();
$result2[0] = $result;
$result2[1] = $result1;
$result2 = json_encode($result2);
echo $result2;
?>