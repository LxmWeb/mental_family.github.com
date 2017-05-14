<?php
header('Access-Control-Allow-Origin:*');
header("Content-type: text/html; charset=utf-8"); 
//引入
require dirname(__FILE__).'/includes/common.inc.php';

require ROOT_PATH.'includes/mentalTest.func.php';

$id = $_POST['id'];
//echo $id;
//$id = "17816869739";
$sql = "select * from docPush where patient_id='$id'";
$data = get_datas($sql);
echo $data;
?>