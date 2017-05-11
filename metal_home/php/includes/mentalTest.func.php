<?php
/*TestGuest Version 1.0
*==============================
*Copy 2016 
*Web:http://www.com
*==============================
*Author: LXM
*Date: 2017年2月27日
*/

/*
 * 1.首先个数据库总读取所有题信息（不分类）
 * 2.用户点击一个试题后，网页将用户选取的试题编号（名字）传回，在数据库中找到该试题信息，将题目显示出来
 * 3.
 * 有安全隐患
 */


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
                send_id,patient_id,patient_name,doctor_id,doctor_name,test_id,test_title,finish_time,is_read 
            from test_send 
            where patient_id='$patientId'";
    //参数2表示从数据库中取出多条数据，1表示一条
    return get_datas($sql,2);
}

/**
 * 医生对病人请求的应答，如果拒绝，则将之前写入数据库的记录is_valid设为0
 *
 * @param String $doctorId医生id
 * @param String $patientId病人ID
 * @param bool $is_agree是否同意
 */
function doctor_agree($doctorId, $patientId, $isAgree)
{
    if ($isAgree) {
        $sql = "update relationship set is_valid=1 where patient_id='$patientId' and doctor_id='$doctorId' limit 1";
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
    $sql = "select patient_name,sex,birthday,main_suit from relationship where doctor_id='$doctorId'";
    return get_datas($sql);
}

/**
 * 医生选择病人，向其发送试题
 * 医生姓名应是在登录时就获取，保存在客户端，直接获取
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
        $sql = "insert into medical_record (patient_id,patient_name,doctor_id,doctor_name,condition_summary,diagnosis_advice,test_id,test_title,test_grade,test_analysis
        ) values('$value','$patientName[$key]','$doctorId','$doctorName','','',$testId,'$testTitle',null,'')";
        query($sql);
        $sql = "insert into user_analysis (patient_id,patient_name,doctor_name,test_id,test_name,test_time,user_grade,user_analysis,send_time,finish_time)
        values('$value','$patientName[$key]','$doctorName',$testId,'$testTitle','',null,'',now(),''";
        query($sql);
    }
}


/**
 * 查询推送记录
 * @param String $doctorId
 * @param String $patientId
 */
function test_result($doctorId, $patientId){
    $sql = "select * from medical_record where doctor_id='$doctorId' and patient_id='$patientId'";
    return get_datas($sql);
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
            set user_grade=$totalScore,user_analysis='$analysis',finish_time=now(),score='$string'
            where send_id='$sendId'";
    query($sql);
    echo $row['doctor_id'];
    //插入到病人病历
    $sql = "insert into medical_record
                (patient_id,patient_name,doctor_id,doctor_name,condition_summary,diagnosis_advice,test_id,test_title,test_grade,test_analysis)
            values
                ('$patientId','{$row['patient_name']}','{$row['doctor_id']}','{$row['doctor_name']}','','','$sendId','{$row['test_title']}',$totalScore,'$analysis')";
    query($sql);
}


/**
 * 病人查看测试题后，修改test_send表中
 * @param int $send_id这条记录的编号
 */
function modify_read_status($send_id){
    $sql = "update test_send set is_read = 1 where send_id = '$send_id'";
    query($sql);
}

/**
 * 医生上传试题
 * @param string $doctorId
 * @param json $testInfo 储存套题有关信息json
 * 包括测试题所属分类编号（如忧郁症是1），测试题标题，题数，每小题的题目，选项及选项对应的分值，前言，最终分值的结果 
 */
function upload_test($doctorId,$json){
    $testInfo = json_decode($json,true);
    $sql = "insert into test_info (test_type,test_title,test_source,create_time,question_index,question_amount,content_before,content_after) 
        values({$testInfo['testType']},'{$testInfo['testTitle']}','{$testInfo['testSource']}',
                now(),{$testInfo['questionIndex']},{$testInfo['questionAmount']},
                '{$testInfo['contentBefore']}','{$testInfo['ContentAfter']}')";
    query($sql);
}


function delete(){
    "delete from 你的表名
    dbcc checkident(你的表名,reseed,0)";
}
?>