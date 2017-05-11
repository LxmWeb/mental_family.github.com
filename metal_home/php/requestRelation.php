<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2017/4/17
 * Time: 15:11
 */
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/includes/common.inc.php';
require ROOT_PATH.'includes/mentalTest.func.php';

$doctor_id = $_POST['doctor_id'];
$patient_id = $_POST['patient_id'];
//$doctor_id = "17816869711";
//$patient_id = "17816869712";
build_relationship($doctor_id, $patient_id);
?>