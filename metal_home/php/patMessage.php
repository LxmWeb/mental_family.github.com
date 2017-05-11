<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2017/4/17
 * Time: 15:56
 */
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/includes/common.inc.php';
require ROOT_PATH.'includes/mentalTest.func.php';

//$ownerId = $_POST['ownerId'];
$ownerId = "17816869781";
echo patient_test($ownerId);
?>