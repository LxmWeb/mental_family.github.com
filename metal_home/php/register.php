<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2017/5/10
 * Time: 13:38
 */
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/includes/common.inc.php';
$userid = $_POST['userid'];
$username = $_POST['username'];
$password = $_POST['password'];
$usertype = $_POST['usertype'];
//$userid = "17816869007";
//$username = "mm";
//$password = "123456";
//$usertype = 2;
$json = '{"user_id":"'.$userid.'","user_name":"'.$username.'","user_password":"'.$password.'","user_status":"'.$usertype.'"}';
echo user_register($json);
?>