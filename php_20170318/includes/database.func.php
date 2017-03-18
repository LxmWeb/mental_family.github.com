<?php
error_reporting(0);
header("Content-type: text/html; charset=utf-8"); 
/*TestGuest Version 1.0
*==============================
*Copy 2016 
*Web:http://www.com
*==============================
*Author: LXM
*Date: 2017年2月27日
*/

/**
 * 连接数据库
 */
$GLOBALS["conn"];
function connect(){
    //全局变量
    if(!($GLOBALS["conn"] = @mysql_connect(DB_HOST,DB_USER,DB_PWD))){
        exit("数据库连接失败");
    }
}

/**
 * 选择数据库
 */
function select_DB(){
    if(!mysql_select_db(DB_NAME)){
        exit("数据库不存在");
    }
}

/**
 * 选择字符集
 */
function select_name(){
    if(!mysql_query("set names utf8")){
        exit("字符集失败");
    }
}

/**
 * 执行语句，得到结果集
 * @param unknown $sql
 */
function query($sql){
    if(!($result = mysql_query($sql))){
        exit("sql语句执行失败".mysql_error());
    }
    return $result;
}

/**
 * 得到数据数组
 * @param unknown $sql
 * @return multitype:
 */
function get_array($sql){
	$arr = Array();
    $result = query($sql,$GLOBALS["conn"]);
    //得到指定结果集的所有数据
    while($array = mysql_fetch_array($result,MYSQL_ASSOC)){
    	$arr[] = $array;
    }
//  echo $array;
    //释放
    mysql_free_result($result);
//  return $array;
	return $arr;
}

/**
 * 关闭数据库
 */
 function close(){
 if(!mysql_close($GLOBALS["conn"])){
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
    //得到指定结果集的所有数据
    $datas = get_array($sql);
    //无数据返回null
//  if(!$datas){//若无数据，mysql_fetch_array返回false
//      return null;
//  }
////    对data数组进行处理，防止出现中文乱码
//  foreach ( $datas as $key => $value ) {
//      $datas[$key] = urlencode($value);
//  }
//  return urldecode(json_encode($datas));
	return json_encode($datas);
}
?>