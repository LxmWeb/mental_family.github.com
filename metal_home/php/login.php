<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/includes/common.inc.php';
require ROOT_PATH.'includes/mentalTest.func.php';
//$username = $_POST['username'];
//$password = $_POST['password'];

$username = "17816869761";
$password = "123456";
if($username.equals("")){
    echo "the username can't be empty";
}else if($password==""){
    echo "the password can't be empty";
}
?>