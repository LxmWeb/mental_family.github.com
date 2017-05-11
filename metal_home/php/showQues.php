<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2017/4/24
 * Time: 15:44
 */
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/includes/common.inc.php';
require ROOT_PATH.'includes/mentalTest.func.php';

//$push_id = $_POST['push_id'];
$push_id = 1;
$sql = "select test_id from test_send where send_id= '$push_id'";
$result = mysqli_query($conn,$sql);
if (!$result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
while($rows = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $reply = $rows;
}
$test_id = $reply['test_id'];
$sql1 = "select * from test_content where test_id= $test_id";
$result1 = mysqli_query($conn,$sql1);
if (!$result1){
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
$reply1 = array();
while($rows = mysqli_fetch_array($result1,MYSQLI_ASSOC)){
    $reply1[] = $rows;
}
echo json_encode($reply1);
?>