<?php
/*TestGuest Version 1.0
*==============================
*Copy 2016 
*Web:http://www.com
*==============================
*Author: LXM
*Date: 2017年3月1日
*/

// 防止恶意调用
define('IN_TG', true);

//引入
require dirname(__FILE__).'/includes/common.inc.php';

require ROOT_PATH.'includes/mentalTest.func.php';

// $sql = "select user_id,user_name,user_password from users";
// echo $sql;
// $data = get_datas($sql);
// echo $data['user_id'];
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
// $patientId = '17816869729';
// build_relationship($doctorId,$patientId);

//测试向病人发测试题
// $doctorId = '17816869761';
// $doctorName = '医生';
// $patientId = Array('17816869781');
// $patientName = Array('病人姓名');
// $testId = 1;
// echo show_patients($doctorId);
// send_test($doctorId,$doctorName,$patientId,$patientName,$testId);

//病人收到试题
// $patientId = '17816869781';
// echo patient_test($patientId);

//病人完成测试题
/**
 * 遇到问题，当测试题标号相同，做一份其他都会修改，传递应该给记录编号
 * @var unknown
 */
// $patientId = '17816869781';
// $recordId = '201703311111';
// $score = 90;
// $analysis = "你很正常";
// finish_test($patientId,$recordId,$score,$analysis);

//医生上传试题
$json = '{"a":1,"b":2,"c":3,"d":4,"e":5}';
$a = json_decode($json,true) ;
echo $a['a'];
?>