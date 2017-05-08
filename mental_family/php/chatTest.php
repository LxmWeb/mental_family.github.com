<?php
/*TestGuest Version 1.0
*==============================
*Copy 2016 
*Web:http://www.com
*==============================
*Author: LXM
*Date: 2017年5月1日
*/
define('IN_TG', true);
require dirname(__FILE__).'/includes/common.inc.php';
require ROOT_PATH.'includes/user.func.php';

$userId = "17816869711";
$img = show_headImg($userId);
echo $img;
echo $img["head_img"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
		<img src="<?php echo $img ?>" alt="" />
</body>
</html>
