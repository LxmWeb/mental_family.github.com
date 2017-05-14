<?php
header('Access-Control-Allow-Origin:*');	
header("Content-type: text/html; charset=utf-8"); 
//引入
require dirname(__FILE__).'/includes/common.inc.php';

require ROOT_PATH.'includes/mentalTest.func.php';

$doc = $_POST['doc'];
$id = $_POST['id'];

echo test_result($doc, $id);
?>