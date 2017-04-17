# mental_family.github.com
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
 <br />
2017.04.17<br />
1.对于以下几个函数增加了是否在数据库修改（包括插入，更新等）成功的返回值boolean，成功返回true，否则返回false
build_relationship，doctor_agree，upload_test<br />
2.增加跨域访问头<br />

2017.03.18<br />
修改部分php，可以查询多条记录；<br />
