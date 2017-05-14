<?php
/*TestGuest Version 1.0
*==============================
*Copy 2016 
*Web:http://www.com
*==============================
*Author: LXM
*Date: 2017年3月8日
*/

/*
 * 搜索
 */
/**
 * 输入医生的名字,疾病类型搜索医生
 * @param $keyword 
 * @param $type
 */
function search_doctor($type,$keyword){
    if($type==0){
        $sql = "select * from doctor";
    }else if($type==1){
        $sql = "select * from doctor where doctor_name like '%$keyword%' " or die("sql语句执行失败");
    }else {
        $sql = "select * from doctor where treatment like '%$keyword%' " or die("sql语句执行失败");
    }
    return get_datas($sql);
}

?>