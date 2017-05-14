<?php  
//页面重定向
// session_start();

function page_redirect($back,$path,$info)
{
	$str="<script>";
	//输出提示信息，为空不输出
	if (!empty($info))
		$str .= "alert('".$info."');";
	//根据页面重定向类型，执行不同跳转
	if ($back)
		//回退
		$str .= "window.history.back();";
	else
	{
		//重定向到指定页面
		if (!empty($path))
			$str .= "window.location='" .$path. "';";
			// ..\html\firstSearch.html
			// $str .= "window.location='..\html\firstSearch.html';";
	}
	$str .= "</script>";
	echo $str;
}

function php_self(){

    $php_self = substr($_SERVER['PHP_SELF'],strrpos($_SERVER['PHP_SELF'],'/')+1);
    return $php_self;
}

?>
