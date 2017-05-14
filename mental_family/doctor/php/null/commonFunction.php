<?php
 header("Content-Type: text/html; charset=utf-8");
 include("connection.php");
// 查询
function runSelectSql($s){
	$r = array();
	$result = mysqli_query($conn,$s);
	while($rows = mysqli_fetch_array($result,MYSQLI_ASSOC)){
		// $r[] = $rows;
	}
		return $rows;
	// return $r;
}

$sql = "select * from doctorlist";
$result = runSelectSql($sql);
print_r($result);
?>