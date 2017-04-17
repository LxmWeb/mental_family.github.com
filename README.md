# mental_family.github.com
2017.04.17 需求（某明记得加）<br />
1、查询请求函数：<br />
//查询病人对医生发起的请求<br />
function select_relation($doctorId){<br />
	$sql = "select * from relationship where doctor_id=$doctorId";<br />
	$result = get_datas($sql);<br />
	return $result;<br />
}<br />
2、展示库内test<br />
function show_mental_tests($doctor_id,$tag){<br />
 	 if($tag == ""){<br />
 		 $sql = "select * from questionnaire where questionnaireOwnerId='$doctor_id' and is_avaid=1";<br />
 	 }<br />
 	 else {<br />
 		 $sql = "select * from questionnaire where questionnaireOwnerId='$doctor_id' and questionnaireTag like '%$tag%' and is_avaid=1";<br />
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
