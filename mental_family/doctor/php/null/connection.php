<?php
global $conn;
// echo $conn;
// $conn = new mysqli ("139.224.133.40", "root","19911116","doctor");
$conn = new mysqli ("139.224.133.40", "root","19911116","xinlijia");
	if (mysqli_connect_error())
	{
	  printf("Connect faile: %s\n",mysqli_connect_error());
	  exit;
	}
	$sql = "set names 'utf8'";
    mysqli_query($conn,$sql);

?>