<?php
 header("Content-Type: text/html; charset=utf-8");
 include("connection.php");
 $sql = "select * from doctorlist";
 $result = mysqli_query($conn,$sql);
 if (!$result) {
 printf("Error: %s\n", mysqli_error($conn));
 exit();
}
 while($rows = mysqli_fetch_array($result,MYSQLI_ASSOC)){
 		echo "<li id='doctor".$rows['doctorId']."'>";
		echo	"<div class='img'>".$rows['doctorId'].".jpg";
		echo	"</div>";
		echo	"<div class='content'>";
		echo		"<span>".$rows['doctorName']."</span>";
		echo	"<div>".$rows['doctorIntro']."</div>";
		echo	"</div>";
		echo	"</li>";
 }
// if($rows){
//   //       echo "<li>";
// 		// echo	"<div class='img'>".$rows[doctorId].".jpg";
// 		// echo	"</div>";
// 		// echo	"<div class='content'>";
// 		// echo		"<span>".$row[doctorName]."</span>";
// 		// echo	"<div>".$row[doctorIntro]."</div>";
// 		// echo	"</div>";
// 		// echo	"</li>";
// }
?>