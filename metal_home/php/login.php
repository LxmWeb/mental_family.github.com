<?php
header('Access-Control-Allow-Origin:*');
// 防止恶意调用
define('IN_TG', true);
//引入
require dirname(__FILE__).'/includes/common.inc.php';
require ROOT_PATH.'includes/mentalTest.func.php';
//require ROOT_PATH.'includes/user.func.php';

//$username = $_POST['username'];
//$password = $_POST['password'];
//$status = $_POST['usertype'];
$username = "17816869761";
$password = "123456";
$status = 2;
$res = user_login($username, $password, $status);
if($res==false){
    $url =  "../login.html" ;
    echo " <script language = 'javascript' type = 'text/javascript'> ";
    echo "alert('fail');";
    echo "window.location.href = '$url';";
    echo " </script > ";
}else{
    $url =  "../docSearch.html" ;
    echo " <script language = 'javascript' type = 'text/javascript'>";
    echo "localStorage.setItem(\"username\",'$username'); ";
//    echo "alert(localStorage.getItem('username'));";
    echo "window.location.href = '$url';";
    echo " </script > ";
}
?>

