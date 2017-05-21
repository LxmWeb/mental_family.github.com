# mental_family.github.com
2017.05.21<br />
1、量表数据库<br />
量表id和拥有者的id作为双主键（test_id+test_source）；<br />
添加量表部分：<br />
医生在添加系统量表时将原系统量表的id+自己的id进行添加记录；<br />
修改upload_test函数：<br />
```
function upload_test($doctorId,$json){
    $testInfo = json_decode($json,true);
    //添加到系统库
    $sql = "insert into system_test (test_id,test_type,test_title,test_source,create_time,question_index,question_amount,content_before,content_after)
    values({$testInfo['test_id']},{$testInfo['test_type']},'{$testInfo['test_title']}','$doctorId',
    now(),{$testInfo['question_index']},{$testInfo['question_amount']},
    '{$testInfo['content_before']}','{$testInfo['content_after']}')";
    return insert_datas($sql);
}
```
医生添加过的系统量表不能重复添加，到时候需要提醒；<br />
2、需要能查看某个患者的某一套题的做题情况<br />
//这是原来的查询患者所有套题的内容<br />
```
function patient_test($patientId){
    $sql = "select send_id,patient_id,patient_name,user_grade,doctor_id,doctor_name,test_id,test_title,finish_time from test_send where patient_id='$patientId'";
    //参数2表示从数据库中取出多条数据，1表示一条
    return get_datas($sql,2);
}
```
//某套题做题情况<br />
2017.05.15<br />
昨天晚上写的都没了，我也不写了；<br />
1、show什么东西，id是最重要的，就算不显示出来也是要select出来的，放在元素的id里方便访问（如show_patients($doctorId)）；<br />
2、patient_test($patientId) 显示所得分数；<br />
----------------------向上更新mentalTest.func.php---------------------------------<br />
<br />
2017.5.1<br />
1.重大修改finish_test方法<br />
2.增加用户登录，注册，修改密码的方法<br />
3.增加聊天收发消息（包括发送测试题信息的消息）的功能<br />
<br />

2017.04.17 <br />
实现功能：<br />
1.根据关键词搜索医生<br />
2.建立随访关系<br />
3.病人查看所有测试题<br />
4.病人完成测试题<br />
5.医生查询随访请求<br />
6.医生对随访请求进行应答<br />
7.医生查看自己随访的病人<br />
8.医生向病人发送测试题<br />
9.医生查询自己的推送记录，即发送的测试题<br />
10.医生从库中上传测试题<br />
11.显示库内已有的测试题<br />

2017.04.17 需求（某明记得加）<br />
1、查询请求函数：<br />
//查询病人对医生发起的请求<br />
function select_relation($doctorId,$op){<br />
	//查看是否有新的请求<br />
	if($op == 0){<br />
		$sql = "select * from relationship where doctor_id=$doctorId and is_valid=0";<br />
	}<br />
	else{<br />
		$sql = "select * from relationship where doctor_id=$doctorId";<br />
	}<br />
	$result = get_datas($sql);<br />
	return $result;<br />
}<br />
2、展示库内/医生test<br />
function show_mental_tests($doctor_id,$tag){<br />
 	 if($tag == ""){<br />
 		 $sql = "select * from test_info where test_source='$doctor_id'";<br />
 	 }<br />
 	 else {<br />
 		 $sql = "select * from test_info where test_source='$doctor_id' and test_title like '%$tag%'";<br />
 	 }<br />
     $data = get_datas($sql);<br />
	 return $data;<br />
 }<br />
 3、upload量表的参数问题<br />
 参数为套题编号<br />
 //查询量表信息<br />
function select_testInfo($qnid){<br />
	$sql = "select * from test_info where test_id = '$qnid'";<br />
    return get_datas($sql);<br />
}<br />
function upload_test($doctorId,$qnid){<br />
	//查询量表信息<br />
    $testInfo = json_decode(select_testInfo($qnid),true);<br />
    $type = $testInfo[0]['test_type'];<br />
    $title = $testInfo[0]['test_title'];<br />
    $index = $testInfo[0]['question_index'];<br />
    $amount = $testInfo[0]['question_amount'];<br />
    $before = $testInfo[0]['content_before'];<br />
    $after = $testInfo[0]['content_after'];<br />
    $sql = "insert into test_info (test_type,test_title,test_source,create_time,question_index,question_amount,content_before,content_after) 
        values('$type','$title','$doctorId',now(),'$index','$amount','$before','$after')";<br />
    return insert_datas($sql);<br />
}<br />
 
 <br />
2017.04.17<br />
1.对于以下几个函数增加了是否在数据库修改（包括插入，更新等）成功的返回值boolean，成功返回true，否则返回false
build_relationship，doctor_agree，upload_test<br />
2.增加跨域访问头<br />

2017.03.18<br />
修改部分php，可以查询多条记录；<br />
