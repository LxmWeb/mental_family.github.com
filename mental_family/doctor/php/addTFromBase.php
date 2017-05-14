<?php
header('Access-Control-Allow-Origin:*');
header("Content-type: text/html; charset=utf-8"); 
define('IN_TG', true);
//引入
require dirname(__FILE__).'/includes/common.inc.php';

require ROOT_PATH.'includes/mentalTest.func.php';
 $owner = $_POST['ownerId'];
 $qn = $_POST['QN'];
 $qnCnt = count($qn);
 for($i = 0; $i < $qnCnt; $i++){
	upload_test($owner, $qn[$i]);
 }
 
?>