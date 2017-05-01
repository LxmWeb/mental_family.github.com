<?php
/*TestGuest Version 1.0
*==============================
*Copy 2016 
*Web:http://www.com
*==============================
*Author: LXM
*Date: 2017年2月27日
*/
if (! defined('IN_TG')) {
    exit('非法调用');
}
//跨域访问
header('Access-Control-Allow-Origin:*');

/*
 * 病人端功能
 */
/**
 * 功能：病人向医生发起随访请求
 * 说明：判断医生和病人间能否建立随访关系，一个病人同时只能与一位医生建立关系，结束后可重新建立
 * 一个医生可以同时与多个病人建立关系，无论医生是否同意，先将请求记录写入数据库
 * @param string $doctorId医生id
 * @param string $patientId病人id
 * @return boolean 是否能够建立关系
 */
function build_relationship($doctorId, $patientId)
{
    if (is_relative($doctorId, $patientId)) {
        return false;
    } else {
        $valid = 0;
        $array = get_row("select patient_name,sex,birthday,main_suit
            from patient where patient_id='$patientId'");
        $patientName = $array['patient_name'];
        $sql = "insert into relationship
        (patient_id,doctor_id,patient_name,sex,birthday,main_suit,build_time,is_valid)
        values ('$patientId','$doctorId',
        '{$array['patient_name']}','{$array['sex']}','{$array['birthday']}',
        '{$array['main_suit']}',now(),'$valid')";
        return insert_datas($sql);
    }
}

/**
 * 功能：查看病人的所有测试题
 * 说明：显示测试题名称，医生姓名，病人姓名，是否完成，若完成则显示完成时间
 * @param String $patientId 病人id
 * @return Ambigous <NULL, string, multitype:>
 */
function patient_test($patientId){
    $sql = "select 
                send_id,patient_id,patient_name,doctor_id,doctor_name,test_id,test_title,finish_time 
            from test_send 
            where patient_id='$patientId'";
    //参数2表示从数据库中取出多条数据，1表示一条
    return get_datas($sql,2);
}

/**
 * 功能：病人完成测试题后，修改数据库中的内容
 * @param String $patientId 病人id
 * @param int $sendId 发送测试题的编号
 * @param int $totalScore 总分数
 * @param String $analysis 测试后的分析
 * @param int[] $score 每小题的分数
 */
function finish_test($patientId,$sendId,$totalScore,$analysis,$score){
    //数组转字符串
    $string = array_to_string($score);
    //获得数据
    $sql = "select 
                patient_name,doctor_id,doctor_name,test_title 
            from test_send
            where send_id='$sendId'
            limit 1";
    $row = get_row($sql);
    //更新数据
    $sql = "update test_send 
            set test_time=now(),user_grade=$totalScore,user_analysis='$analysis',finish_time=now(),score=''
            where send_id='$sendId'";
    query($sql);
    //插入到病人病历
    $sql = "insert into medical_record
                (patient_id,patient_name,doctor_id,doctor_name,condition_summary,diagnosis_advice,test_id,test_title,test_grade,test_analysis)
            values
                ('$patientId','{$row['patient_name']}','{$row['doctor_id']}','{$row['doctor_name']}','','',$sendId,'{$row['test_title']}',$totalScore,'$analysis')";
    query($sql);
}



/*
 * 医生端功能
 */
/**
 * 功能：查询病人对医生发起的请求
 * @param $doctorId
 */
function select_relation($doctorId){
    $sql = "select * from relationship where doctor_id=$doctorId";
    $result = get_datas($sql);
    return $result;
}

/**
 * 功能：医生对病人请求的应答
 * 说明：如果同意，则将之前写入数据库的记录is_valid设为1
 * @param String $doctorId医生id
 * @param String $patientId病人ID
 * @param bool $is_agree是否同意
 * @return boolean
 */
function doctor_agree($doctorId, $patientId, $isAgree)
{
    if ($isAgree) {
        $sql = "update relationship set is_valid=1 where patient_id='$patientId' and doctor_id='$doctorId' limit 1";
        return insert_datas($sql);
    }
}

/**
 * 功能：显示随访病人
 * 说明：根据医生id显示与医生是随访关系的病人的姓名，性别，年龄，所属疾病
 * @param String $doctorId
 * @return json
 */
function show_patients($doctorId)
{
    $sql = "select patient_name,sex,birthday,main_suit from relationship where doctor_id='$doctorId'";
    return get_datas($sql,2);
}

/**
 * 功能：医生选择病人，向其发送试题
 * 说明：医生姓名应是在登录时就获取，保存在客户端，直接获取
 * 病人id数组与病人姓名数组一一对应
 * @param string $doctorId
 * @param string $doctorName
 * @param json $patientId可能多个病人，传入一个json数据
 * @param json $patientName
 * @param int $testId
 */
function send_test($doctorId,$doctorName,$jsonId,$jsontName,$testId){
    //加了true才会返回数组，否则返回对象
    $patientId = json_decode($jsonId,true);
    $patientName = json_decode($jsontName,true);
    $sql = "select test_title from test_info where test_id = $testId";
    $row = get_row($sql);
    $testTitle = $row['test_title'];
    foreach($patientId as $key => $value){
        $sql = "insert into test_send 
                (patient_id,patient_name,doctor_name,test_id,test_name,test_time,user_grade,user_analysis,send_time,finish_time)
                values('$value','$patientName[$key]','$doctorName',$testId,'$testTitle','',null,'',now(),''";
        query($sql);
    }
    /*需要对每一个病人是否发送成功进行判断？*/
}

/**
 * 功能：医生向库中上传试题
 * @param string $doctorId
 * @param json $testInfo 储存套题有关信息json
 * 包括测试题所属分类编号（如忧郁症是1），测试题标题，题数，每小题的题目，选项及选项对应的分值，前言，最终分值的结果
 * @return boolean
 */
function upload_test($doctorId,$json){
    $testInfo = json_decode($json,true);
    //添加到系统库
    $sql = "insert into system_test (test_type,test_title,test_source,create_time,question_index,question_amount,content_before,content_after)
    values({$testInfo['test_type']},'{$testInfo['test_title']}','{$testInfo['test_source']}',
    now(),{$testInfo['question_index']},{$testInfo['question_amount']},
    '{$testInfo['content_before']}','{$testInfo['content_after']}')";
    query($sql);
    return insert_datas($sql);
}

/**
 * 功能：根据测试题id查找测试题
 * @param String $testId
 */
function query_test($testId){
    $sql = "select * from system_test where test_id='$testId'";
    return get_row($sql);
}

/**
 * 功能：医生将系统库中的某个试题添加到自己的试题库中
 * @param String $doctorId
 * @param String $testId
 * @return boolean 是否插入成功
 */
function add_test($doctorId,$testId){
    $row = query_test($testId);
    //添加到系统库
    $sql = "insert into doctor_test 
                (test_id,test_type,test_title,test_source,create_time,question_index,question_amount,content_before,content_after)
            values({$row['test_id']},{$row['test_type']},'{$row['test_title']}','{$row['test_source']}',
                '{$row['create_time']}',{$row['question_index']},{$row['question_amount']},
                '{$row['content_before']}','{$row['Content_after']}')";
    return insert_datas($sql);
}

/**
 * 功能：查询推送记录
 * @param String $doctorId
 * @param String $patientId
 * @return json
 */
function test_result($doctorId, $patientId){
    $sql = "select * from medical_record where doctor_id='$doctorId' and patient_id='$patientId'";
    return get_datas($sql,2);
}

/**
 * 功能：显示医生自己库内已有的测试题
 * @param String $doctor_id
 * @param String $tag
 * @return json
 */
function show_mental_tests($doctor_id,$tag){
 	 if($tag == ""){
 		 $sql = "select * from test_info where test_source='$doctor_id'";
 	 }
 	 else {
 		 $sql = "select * from test_info where test_source='$doctor_id' and test_title like '%$tag%'";
 	 }
     $data = get_datas($sql);
	 return $data;
 }

function delete(){
    "delete from 你的表名
    dbcc checkident(你的表名,reseed,0)";
}
?>