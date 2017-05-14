<?php
header('Access-Control-Allow-Origin:*');
header("Content-type: text/html; charset=utf-8"); 
define('IN_TG', true);
//引入
require dirname(__FILE__).'/includes/common.inc.php';

require ROOT_PATH.'includes/mentalTest.func.php';

$doctorId = $_POST['ownerId'];
$tag = $_POST['Tag'];
//$doctorId = "17816869761";
echo show_mental_tests($doctorId, $tag);
//echo show_mental_tests('admin', "ss");
?>