<?php
header("Content-type: text/html; charset=utf-8"); 
/*
 * TestGuest Version 1.0
 * ==============================
 * Copy 2016
 * Web:http://www.com
 * ==============================
 * Author: LXM
 * Date: 2017年3月5日
 */

/**
 * 根据医生ID，病人ID判断是否能够查看病人的信息，若能，则返回病人的信息，否则返回空
 * 通过在html页面判断返回值
 * 
 * @param string $id            
 */
// function show_patient_info($doctorId, $patientId)
// {
//     if (is_relative($doctorId, $patientId)) {
//         $sql = "select * from patient patient_id=$patientId";
//         $result = get_datas($sql);
//     } else {
//         $result = null;
//     }
//     return json_encode($result);
// }

/**
 * 根据医生ID显示医生的信息
 * 
 * @param string $id            
 */
// function show_doctor_info($id)
// {
//     $sql = "select * from doctor where doctor_id=$id";
//     $result = get_datas($sql);
//     return json_encode($result);
// }

/**
 * 判断医生和病人间是否是随访关系
 * 
 * @param string $doctorId            
 * @param string $patientId            
 */
function is_relative($doctorId, $patientId)
{
    $sql = "select * from relationship where patient_id=$patientId and doctor_id=$doctorId and is_valid=1 limit 1";
    $result = get_datas($sql);
    if ($result == null) {
        return false;
    } else {
        return true;
    }
}

/**
 * 判断医生和病人间能否建立随访关系，一个病人同时只能与一位医生建立关系，结束后可重新建立
 * 一个医生可以同时与多个病人建立关系，无论医生是否同意，先将请求记录写入数据库
 * 
 * @param string $doctorId            
 * @param string $patientId            
 */
function build_relationship($doctorId, $patientId)
{
    if (is_relative($doctorId, $patientId)) {
        echo "已有随访医生，无法建立关系";
    } else {
        $valid = 1;
        $array = get_array("select patient_name,sex,birthday,main_suit 
            from patient where patient_id='$patientId'");
        $patientName = $array['patient_name'];
        $sql = "insert into relationship 
                (patient_id,doctor_id,patient_name,sex,birthday,main_suit,build_time,is_valid) 
                values ('$patientId','$doctorId',
                '{$array['patient_name']}','{$array['sex']}','{$array['birthday']}',
                '{$array['main_suit']}',now(),'$valid')";
        query($sql) or die('执行失败');
    }
}

/**
 * 医生对病人请求的应答，如果拒绝，则将之前写入数据库的记录is_valid设为0
 * 
 * @param String $doctorId医生id
 * @param String $patientId病人ID
 * @param bool $is_agree是否同意
 */
function doctor_agree($doctorId, $patientId, $is_agree)
{
    if (! $is_agree) {
        $sql = "update relationship set is_valid=0 where patient_id='$patientId' and doctor_id='$doctorId' limit 1";
        query($sql) or die('执行失败');
    }
}

/**
 * 根据医生id显示与医生是随访关系的病人的姓名，性别，年龄，所属疾病
 * 
 * @param String $doctorId            
 */
function show_patients($doctorId)
{
    $sql = "select patient_id,patient_name,sex,birthday,main_suit from relationship where doctor_id='$doctorId'";
//  echo get_datas($sql);
    return get_datas($sql);
}

/**
 * 医生选择病人，向其发送试题
 * @param unknown $doctorId
 * @param unknown $patientId
 */
//send_test('17816869761','17816869781','4','2017-03-19 12:23');
function send_test($doctorId,$patientId,$testId,$time){
    $sql = "insert into docPush (doctor_id, patient_id, questionnaireId, pushTime) values('$doctorId', '$patientId', '$testId', '$time')";
//  return get_datas($sql);
//	echo $sql;
	insert_datas($sql);
}
/*查询推送记录*/
function test_result($doc, $id){
	$sql = "select * from docPush where doctor_id='$doc' and patient_id='$id'";
	return get_datas($sql);
}
?>