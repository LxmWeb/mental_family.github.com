<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2017/4/17
 * Time: 13:27
 */
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/includes/common.inc.php';
require ROOT_PATH.'includes/mentalTest.func.php';

//$searchType = $_POST['searchType'];
//$str = $_POST['str'];
$str = "医生";
$searchType = 1;
echo search_doctor($searchType,$str);
?>