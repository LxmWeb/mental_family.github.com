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
 * 输入医生的名字或疾病类型搜索医生
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


/*
 * 查看信息
 */
/**
 * 判断医生和病人间是否是随访关系
 * @param string $doctorId
 * @param string $patientId
 * @return boolean
 */
function is_relative($doctorId, $patientId)
{
    $sql = "select * from relationship where patient_id=$patientId and doctor_id=$doctorId and is_valid=1 limit 1";
    $result = get_datas($sql);
    if ($result == null) {
        return false;
    } else {
        return true;
    }
}

/**
 * 功能：查看病人信息
 * 说明：仅允许与病人建立随访关系的医生才能查看病人信息
 * @param string $doctorId
 * @param string $patientId
 */
function show_patient_info($doctorId,$patientId){
    if(is_relative($doctorId, $patientId)){
        $sql = "select * from patient";
        return get_datas($sql);
    }else {
        return '对不起，您无权查看该用户信息';
    }

}

/**
 * 功能：查看医生信息
 * 说明：医生信息为公开信息
 * @param string $doctorId
 */
function show_doctor_info($doctorId){
    $sql = "select * from doctor";
    return get_datas($sql);
}


/*
 * 检查
 */
/**
 * 功能：检查用户名是否符合要求
 * @param string $username
 * @param int $minLength
 * @param int $maxLength
 * @return string|Ambigous <string, string>
 */
function check_username($username,$minLength,$maxLength){
    //去除两边空格
    $username = trim($username);
    //用户名长度检测
    if(mb_strlen($username) < $minLength || mb_strlen($username) > $maxLength){
        return '用户名长度不得小于'.$minLength.'位或者大于'.$maxLength.'位';
    }
    //敏感字符检测
    $pattern = '/[<>\'\"\ \ ]/';
    if(preg_match($pattern, $username)){
        return '用户名不得包含敏感字符';
    }
    return mysql_string($username);
}

/**
 * 检查密码是否符合要求
 * @param unknown $pwd
 * @param unknown $minLength
 * @return string
 */
function check_password($pwd,$minLength){
    //密码长度检测
    if(mb_strlen($pwd) < $minLength){
        return '密码长度不得小于'.$minLength.'位';
    }
    //加密
    return sha1($pwd);
}


/*
 * 转化
 */
/**
 * 功能：将数组转化为字符串
 * @param int[] $array
 * @return String
 */
function array_to_string($array){
    $string ="";
    foreach ($array as $value){
        $string .= $value;
    }
    return $string;
}

/**
 * 功能：将数组转化为字符串
 * @param int[] $array
 * @return String
 */
function string_to_array($string){
    $array = array();
    for ($i=0;$i<strlen($string);++$i){
        $array[$i] = $string[$i];
    }
    return $array;
}

/**
 *
 * @param unknown $string
 * @return string
 */
function html($string) {
    if (is_array($string)) {
        foreach ($string as $key => $value) {
            $string[$key] = html($value);   //这里采用了递归，如果不理解，那么还是用htmlspecialchars
        }
    } else {
        $string = htmlspecialchars($string);
    }
    return $string;
}



/**
 * 对内容进行加密
 * @param unknown $string
 * @return string
 */
function encryption($string){
    return sha1($string);
}
?>