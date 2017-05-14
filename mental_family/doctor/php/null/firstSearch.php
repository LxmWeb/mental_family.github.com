<?php
 include("page_switching.php");
 header("Content-Type: text/html; charset=utf-8");
 include("connection.php");
 // $disease = $_GET["disease"];
 $disease = $_REQUEST['dis'];
 // echo $disease;
 $sql = "select * from disease where diseaseName = '" . $disease . "'";
 $result = mysqli_query($conn,$sql);
 $rows = mysqli_fetch_array($result,MYSQLI_ASSOC);
 $intro = "";
    if($rows){
        echo $rows["diseaseIntro"];
    }
    else{
    	echo "搜无结果";
    }
?>