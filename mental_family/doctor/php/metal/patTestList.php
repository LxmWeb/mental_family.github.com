<?php

header("Content-type: text/html; charset=utf-8"); 
//引入
require dirname(__FILE__).'/includes/common.inc.php';

require ROOT_PATH.'includes/mentalTest.func.php';

$id = $_POST['id'];
//$doctorId = "17816869761";
echo show_mental_tests($doctorId, $tag);
?>