<?php
/*TestGuest Version 1.0
*==============================
*Copy 2016 
*Web:http://www.com
*==============================
*Author: LXM
*Date: 2017年3月1日
*/
// 转换硬路径
define('ROOT_PATH', substr(dirname(__FILE__), 0, -8));

//引入数据库
require ROOT_PATH.'includes/database.func.php';
//引入用户功能，医患关系
require ROOT_PATH.'includes/user.func.php';
//引入用户功能，医患关系
require ROOT_PATH.'includes/global.func.php';

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PWD', 'lxm123456');
define('DB_NAME', 'mental_family');

//连接数据库
connect_DB();
?>