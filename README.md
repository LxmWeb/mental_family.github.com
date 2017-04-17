# mental_family.github.com
2017.4.17
1.对于以下几个函数增加了是否在数据库修改（包括插入，更新等）成功的返回值boolean，成功返回true，否则返回false
build_relationship，doctor_agree，upload_test<br />
2.增加跨域访问头<br />
3.记得添加查询请求函数：<br />
//查询病人对医生发起的请求<br />
function select_relation($doctorId){<br />
	$sql = "select * from relationship where doctor_id=$doctorId";<br />
	$result = get_datas($sql);<br />
	return $result;<br />
}<br />



2017.03.18 修改部分php，可以查询多条记录；
