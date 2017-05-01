<?php
/*TestGuest Version 1.0
*==============================
*Copy 2016 
*Web:http://www.com
*==============================
*Author: LXM
*Date: 2017年4月24日
*/
if (! defined('IN_TG')) {
    exit('非法调用');
}
//跨域访问
header('Access-Control-Allow-Origin:*');

/**
 * 功能：发送普通消息
 * 说明：json需要传入发送者id，姓名，以及接受者id，姓名，内容
 * @param json $json
 * @return boolean 是否发送成功
 */
function send_message($json){
   $message = json_decode($json,true);
   $sql = "insert into send_message 
               (from_id,from_name,to_id,to_name,content,send_time,test_id,test_title)
           values 
               ('{$message['from_id']}','{$message['from_name']}','{$message['to_id']}',
                '{$message['to_name']}','{$message['content']}',now(),null,null)";
   return insert_datas($sql);
}

/**
 * 功能：发送测试题消息
 * 说明：json需要传入发送者id，姓名，以及接受者id，姓名，内容（系统默认），测试题id、标题
 * @param String $json
 * @return boolean
 */
function send_test_message($json){
    $message = json_decode($json,true);
    $sql = "insert into send_message
                (from_id,from_name,to_id,to_name,content,send_time,test_id,test_title)
            values
                ('{$message['from_id']}','{$message['from_name']}','{$message['to_id']}',
                '{$message['to_name']}','{$message['content']}',now(),'{$message['test_id']}','{$message['test_title']}')";
    return insert_datas($sql);
}

/**
 * 功能：显示聊天记录
 * @param String $fromId
 * @param String $toId
 * @return Ambigous <NULL, string, multitype:>
 */
function show_message($fromId,$toId){
    $sql = "select *
            from send_message
            where (from_id=$fromId and to_id=$toId) or (from_id=$toId and to_id=$fromId)
            order by index";
    return get_datas($sql,2);
}

//暂无此功能

function delete_message(){
    
}
?>