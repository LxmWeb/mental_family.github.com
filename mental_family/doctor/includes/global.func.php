<?php
/*TestGuest Version 1.0
*==============================
*Copy 2016 
*Web:http://www.com
*==============================
*Author: LXM
*Date: 2017年3月8日
*/
if (! defined('IN_TG')) {
    exit('非法调用');
}
//跨域访问
header('Access-Control-Allow-Origin:*');
/*
 * 搜索
 */
/**
 * 输入医生的名字,疾病类型搜索医生
 * @param $keyword 
 * @param $type
 */
function search_doctor($type,$keyword){
    //搜索所有医生
    if($type==0){
        $sql = "select * from doctor";
    }else if($type==1){//通过医生名字搜索
        $sql = "select * from doctor where doctor_name like '%$keyword%' " or die("sql语句执行失败");
    }else if($type==2){//通过疾病名字搜索
        $sql = "select * from doctor where treatment like '%$keyword%' " or die("sql语句执行失败");
    }
    return get_datas($sql);
}

?>