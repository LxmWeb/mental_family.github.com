<?php
header('Access-Control-Allow-Origin:*');
header("Content-type: text/html; charset=utf-8"); 
/*TestGuest Version 1.0
*==============================
*Copy 2016 
*Web:http://www.com
*==============================
*Author: LXM
*Date: 2017年3月1日
*/

//引入
require dirname(__FILE__).'/includes/common.inc.php';

require ROOT_PATH.'includes/mentalTest.func.php';

// $sql = "select user_id,user_name,user_password from users";
// echo $sql;
// $data = get_datas($sql);
// echo json_encode($data);

//搜索测试
// $name = "医生";
// echo search_doctor(0,$name)."</br>";
// echo search_doctor(1,"sg")."</br>";
// echo search_doctor(1,$name)."</br>";
// echo search_doctor(2,"忧郁")."</br>";
// echo search_doctor(2,"为")."</br>";

//测试建立随访关系
// $doctorId = '17816869761';
// $patientId = '17816869781';
// build_relationship($doctorId,$patientId);

//测试向病人发测试题
//$doctorId = '17816869761';
$doctorId = $_POST['ownerId'];
echo show_patients($doctorId);
?>