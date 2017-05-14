<?php
header("Content-type: text/html; charset=utf-8"); 
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
 * 从数据库中读取测试题信息
 */
 function show_mental_tests($doctor_id,$tag){
 	 if($tag == ""){
 		 $sql = "select * from questionnaire where questionnaireOwnerId='$doctor_id' and is_avaid=1";
 	 }
 	 else {
 		 $sql = "select * from questionnaire where questionnaireOwnerId='$doctor_id' and questionnaireTag like '%$tag%' and is_avaid=1";
 	 }
//   $sql = "select * from questionnaire where questionnaireOwnerId='$doctor_id'";
     $data = get_datas($sql);
//   return json_encode($data);
	 return $data;
 }
 
/** 
 * 根据传入的试题编号找到并返回该试题的内容，通过一个数组记录试题的标题，病人ID，时间
 * @param string $test_id 
 * @param array $record
 */
function show_test_details($test_id,$record){
//  $sql = "select * from question  where QuestionnaireId = $test_id limit 1";
	$sql = "select * from question  where QuestionnaireId = $test_id";
    $data = get_datas($sql);
    $record['patient_id'] = $data[''];
    $record['test_date'] = date();
    $record['test_title'] = $data[''];
    return $data;
}

/**
 * 根据用户的选择对应数据库中每题对应的分数计算出总分，以及最终的评价 
 * @param unknown $choice 
 */
// function show_test_result($choice){
    
// }

/**
 * 将最后所得的结果存入数据库，包括病人ID，时间，试题标题，最后分数及评价
 * @param array $result
 * @param array $record
 */
function save_test_result($result,$record){
    $sql = "insert into medical_record values('{$record['patient_id']}',
    '{$record['test_date']}','{$record['test_title']}','{$result['']}',
    '{$result['']}')";
    query($sql); 
}


?>