<?php
 header("Content-Type: text/html; charset=utf-8");
 include("connection.php");
 $sql = "select * from posts";
 $result = mysqli_query($conn,$sql);
 $rows = mysqli_fetch_array($result,MYSQLI_ASSOC);
    whilw($rows){
        echo $rows["diseaseIntro"];
    }
    else{
    	echo "搜无结果";
    }
?>