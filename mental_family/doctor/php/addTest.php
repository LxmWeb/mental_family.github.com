<?php
header('Access-Control-Allow-Origin:*');
include("connection.php");
$count = 1;
$data = $_POST['q'];
$info = $_POST['n'];
// 插入问卷信息
$t = $info['title'];
$tag = $info['tag'];
$sql = "INSERT INTO questionnaire(questionnaireName, questionnaireTag) VALUE('$t','$tag')";
$result = mysqli_query($conn,$sql);
// 插入问卷题目信息
$test = json_decode($data);
foreach( $test as $t){
	$title = $t->title;
	$option1 = $t->option1;
	$s1 = $t->s1;
	$option2 = $t->option2;
	$s2 = $t->s2;
	$option3 = $t->option3;
	$s3 = $t->s3;
	$option4 = $t->option4;
	$s4 = $t->s4;
	$cnt = "SELECT count(*) from questionnaire";
	$r = mysqli_query($conn,$cnt);
	$row = mysqli_fetch_array($r,MYSQLI_ASSOC);
	$id = $row['count(*)'];
	// echo $r;
	$sql = "INSERT INTO question(QuestionnaireId, QuestionId, Question, option1, score1, option2, score2, option3, score3, option4, score4) VALUE ('$id','$count','$title','$option1','$s1','$option2','$s2','$option3','$s3','$option4','$s4')";
	$result = mysqli_query($conn,$sql);
	$count++;
}
?>