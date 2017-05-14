<?php
/*
 * TestGuest Version 1.0
 * ==============================
 * Copy 2016
 * Web:http://www.com
 * ==============================
 * Author: LXM
 * Date: 2017年3月5日
 */
if (! defined('IN_TG')) {
    exit('非法调用');
}
// 跨域访问
header('Access-Control-Allow-Origin:*');
// $userId = "";
// $userPassword = "";
// $userName = "";
// $userStatus = "";
// $uniqid = "";
// $registerTime = "";
// $lastLoginTime = "";
// $lastLoginIp = "";
// $userInfo = array(8);
// $conn = new PDO("mysql:host=DB_HOST;dbname=DB_NAME", DB_USER, DB_PWD);
// // 设置 PDO 错误模式为异常
// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// 预处理及绑定
// $userRegister = $GLOBALS['conn']->prepare(
// "insert into user
// (user_id, user_password, user_name,user_status,uniqid,register_time,last_login_time,last_login_ip)
// values (?, ?, ?, ?, ?, ?, ?, ?)"
// );
// $userRegister->bind_param("sssissss", $userId, $userPassword, $userName,$userStatus,$uniqid,$registerTime,$lastLoginTime,$lastLoginIp);
// $userRegister->bind_param("sssissss", $userInfo[0], $userInfo[1], $userInfo[2],intval($userInfo[3]),$userInfo[4],$userInfo[5],$userInfo[6],$userInfo[7]);
// 设置参数并执行
// $firstname = "John";
// $lastname = "Doe";
// $email = "john@example.com";
// $stmt->execute();

/**
 * 用户注册
 * 
 * @param json $json            
 * @return boolean 是否插入成功
 */
function user_register($json)
{
    $userInfo = json_decode($json, true);
//     $username = check_username($userInfo['user_name'], 8, 16);
//     $pwd = check_password($userInfo['user_password'], 6);
    $sql = "insert into user 
                (user_id,user_password,user_name,user_status,register_time,last_login_time,last_login_ip)
            values('{$userInfo['user_id']}','{$userInfo['user_password']}','{$userInfo['user_name']}',
                   '{$userInfo['user_status']}',now(),now(),'')";
    $flag = insert_datas($sql);
    // 病人
    if ($userInfo['user_status'] == 1) {
        insert_to_patient($userInfo);
    }
    // 医生
    else if ($userInfo['user_status'] == 2) {
        insert_to_doctor($userInfo);
    }
    return $flag;
}

/**
 * 将病人信息插入到病人表中
 * @param Array $userInfo
 * @return boolean 是否插入成功
 */
function insert_to_patient($userInfo)
{
//     $username = check_username($userInfo['user_name'], 8, 16);
    $sql = "insert into patient
                (patient_id,patient_name,sex,birthday,identity,main_suit,email)
            values('{$userInfo['user_id']}','{$userInfo['user_name']}','{$userInfo['sex']}',
                '{$userInfo['birthday']}','{$userInfo['identify']}',
                '{$userInfo['main_suit']}','{$userInfo['email']}'
            )";
    return insert_datas($sql);
}

/**
 * 将医生信息插入到医生表中
 * @param Array $userInfo
 * @return boolean 是否插入成功
 */
function insert_to_doctor($userInfo)
{
//     $username = check_username($userInfo['user_name'], 8, 16);
    $sql = "insert into doctor
                (doctor_id,doctor_name,sex,birthday,identity,education,work_place,department,treatment,positional_title,email)
            values('{$userInfo['user_id']}','{$userInfo['user_name']}','{$userInfo['sex']}',
                '{$userInfo['birthday']}','{$userInfo['identity']}','{$userInfo['education']}',
                '{$userInfo['work_place']}','{$userInfo['department']}','{$userInfo['treatment']}',
                '{$userInfo['positional_title']}','{$userInfo['email']}'
            )";
}

/**
 * 功能：用户登录检查
 * 
 * @param String $username            
 * @param String $pwd            
 * @param String $status            
 * @return boolean 是否允许登录
 */
function user_login($userId, $pwd, $status)
{
    $sql = "select * from user 
            where user_id='$userId' and user_password='$pwd' and user_status=$status
            limit 1";
    if (get_row($sql) == null) {
        return false;
    }
    return true;
}

/**
 * 功能：重置用户密码
 * 
 * @param String $userId            
 * @param String $newPwd            
 * @return boolean 是否重置成功
 */
function reset_pwd($userId, $newPwd)
{
    $sql = "update user 
            set user_password='$newPwd' 
            where user_id='$userId'";
    return insert_datas($sql);
}

/**
 * 功能：检查用户是否存在
 * @param String $id
 * @return boolean 返回是否存在，true为已存在
 */
function exist_user($id){
    $sql = "select * from user where user_id='$id' limit 1";
    if (get_row($sql) == null) {
        return false;
    }
    return true;
}

/**
 * 功能：获取头像路径
 * @return String 返回路径
 */
function show_headImg($userId)
{
    $sql = "select head_img from user where user_id=$userId";
    $url = get_datas($sql, 1);
    return $url;
}
?>