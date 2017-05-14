<?php
/*TestGuest Version 1.0
*==============================
*Copy 2016 
*Web:http://www.com
*==============================
*Author: LXM
*Date: 2017年2月27日
*/
if (! defined('IN_TG')) {
    exit('非法调用');
}
error_reporting(0);
//跨域访问
header('Access-Control-Allow-Origin:*');
header("Content-type: text/html; charset=utf-8"); 
/**
 * 连接数据库
 */
$GLOBALS['conn'];
function connect(){
    //全局变量
    if(!($GLOBALS['conn'] = mysqli_connect(DB_HOST,DB_USER,DB_PWD))){
        exit("数据库连接失败");
    }
}

/**
 * 选择数据库
 */
function select_DB(){
    if(!mysqli_select_db($GLOBALS['conn'],DB_NAME)){
        exit("数据库不存在");
    }
}

/**
 * 选择字符集
 */
function select_name(){
    if(!mysqli_query($GLOBALS['conn'],"set names utf8")){
        exit("字符集失败");
    }
}

/**
 * 执行语句，得到结果集
 * @param unknown $sql
 */
function query($sql){
    if(!($result = mysqli_query($GLOBALS['conn'],$sql))){
        exit("sql语句执行失败".mysqli_error($GLOBALS['conn']));
    }
    return $result;
}

/**
 * 关闭数据库
 */
 function close(){
 if(!mysqli_close($GLOBALS['conn'])){
        exit("数据库关闭失败");
    }
 }
 
 /**
  * 连接数据库，准备读取数据
  */
 function connect_DB(){
     connect();
     select_DB();
     select_name();
 }
 
/**
 * 根据查询语句获取结果集并返回json数据
 * @param string $sql
 */
function get_datas($sql){
    $datas = get_array($sql);
    //无数据返回null
    if(!$datas){//若无数据，mysqli_fetch_all返回false
        return null;
    }
    //获取二维数组行数，即记录条数
    $rows = count($datas,COUNT_NORMAL);
    //对data数组进行处理，防止出现中文乱码
    for ($i=0;$i<$rows;$i++) {
        foreach ( $datas[$i] as $key => $value ) {
            $datas[$i][$key] = urlencode($value);
        }
    }
    return urldecode(json_encode($datas));
}

/**
 * 得到数据数组，获取多条记录
 * @param unknown $sql
 * @return multitype:
 */
function get_array($sql){
    $result = query($sql);
    //得到指定结果集的所有数据
    $array = mysqli_fetch_all($result,MYSQL_ASSOC);
    //释放
    mysqli_free_result($result);
    return $array;
}

/**
 * 获取一条记录
 * @param unknown $sql
 * @return multitype:
 */
function get_row($sql){
    $result = query($sql);
    //得到指定结果集的所有数据
    $array = mysqli_fetch_array($result,MYSQL_ASSOC);
    //释放
    mysqli_free_result($result);
    return $array;
}

/**
 * 防止字符串存入数据库中出错
 * @param string $string
 */
// function mysqlString($string){
//     //默认是开启的
//     if(GPC){
//         return $string;
//     }
//     return mysql_real_escape_string($string);
// }

/**
 * 防止字符串存入数据库中出错
 * @param string $string
 */
// function mysqlArray($string){
//     //默认是开启的
//     if(GPC){
//         return $string;
//     }
//     return mysql_real_escape_string($string);
// }

/**
 * 检查sql语句是否成功插入数据库
 * @return boolean
 */
function sql_success(){
    if(mysqli_affected_rows($GLOBALS['conn']) == 1){
        return true;
    }
    return false;
}

/**
 * 向数据库内插入、更新数据
 * @param string $sql
 * @return boolean
 */
function insert_datas($sql){
    query($sql,$GLOBALS["conn"]) or die('向数据库内插入、更新数据'.mysql_error($GLOBALS['conn']));
    return sql_success();
}
?>