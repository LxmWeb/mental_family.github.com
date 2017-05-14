<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2017/4/25
 * Time: 18:28
 */
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/includes/common.inc.php';
require ROOT_PATH.'includes/mentalTest.func.php';

//$send_id = $_POST['send_id'];
//$total_score = $_POST['score'];
//$scores = $_POST['scores'];
$recordId = "20170511231";
$patient_id = "17816869781";
$send_id = 1;
$total_score = 112;
$analysis = "111111";
$scores = array(4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4);
finish_test($recordId,$patient_id,$send_id,$total_score,$analysis,$scores);
?>