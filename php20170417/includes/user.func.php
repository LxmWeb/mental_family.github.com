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
//跨域访问
header('Access-Control-Allow-Origin:*');
// $userId = "";
// $userPassword = "";
// $userName = "";
// $userStatus = "";
// $uniqid = "";
// $registerTime = "";
// $lastLoginTime = "";
// $lastLoginIp  = "";
// $userInfo = array(8);
// $conn = new PDO("mysql:host=DB_HOST;dbname=DB_NAME", DB_USER, DB_PWD);
// // 设置 PDO 错误模式为异常
// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// 预处理及绑定
// $userRegister = $GLOBALS['conn']->prepare(
//     "insert into user 
//     (user_id, user_password, user_name,user_status,uniqid,register_time,last_login_time,last_login_ip)
//     values (?, ?, ?, ?, ?, ?, ?, ?)"
//     );
// $userRegister->bind_param("sssissss", $userId, $userPassword, $userName,$userStatus,$uniqid,$registerTime,$lastLoginTime,$lastLoginIp);
// $userRegister->bind_param("sssissss", $userInfo[0], $userInfo[1], $userInfo[2],intval($userInfo[3]),$userInfo[4],$userInfo[5],$userInfo[6],$userInfo[7]);
// 设置参数并执行
// $firstname = "John";
// $lastname = "Doe";
// $email = "john@example.com";
// $stmt->execute();

/**
 * 用户注册
 * @param json $json
 * @return boolean
 */
function user_register($json){
    $userInfo = json_decode($json,true);
    $sql = "insert into user 
        (user_id,user_password,user_name,user_status,register_time,last_login_time,last_login_ip)
        values('{$userInfo['']}','{$userInfo['']}','{$userInfo['']}','{$userInfo['']}',now(),'','')";
    return insert_datas($sql);
}

function user_login(){
    
}

function check_username($username){
    //去除两边空格
    $username = trim($username);
    //用户名长度检测
    if(mb_strlen($username) < 6 || mb_strlen($username) > 16){
        
    }
    
}
?>