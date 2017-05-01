<?php
/*TestGuest Version 1.0
*==============================
*Copy 2016 
*Web:http://www.com
*==============================
*Author: LXM
*Date: 2017年3月1日
*/
if (! defined('IN_TG')) {
    exit('非法调用');
}
//跨域访问
header('Access-Control-Allow-Origin:*');

// 转换硬路径
define('ROOT_PATH', substr(dirname(__FILE__), 0, -8));

//引入数据库
require ROOT_PATH.'includes/database.func.php';
//引入全局功能
require ROOT_PATH.'includes/global.func.php';

//定义数据库相关内容
define('DB_HOST', '139.224.133.40');
define('DB_USER', 'root');
define('DB_PWD', '19911116');
define('DB_NAME', 'mf');

//定义是否自动转义变量
define('GPC', get_magic_quotes_gpc());

//连接数据库
connect_DB();

?>