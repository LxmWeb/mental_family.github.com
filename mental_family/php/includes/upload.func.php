<?php
/*TestGuest Version 1.0
*==============================
*Copy 2016 
*Web:http://www.com
*==============================
*Author: LXM
*Date: 2017年5月4日
*/
if(!defined('IN_TG')){
    exit('非法调用');
}

require("FileUpload.class.php");
//这里实例化后赋值为数组，数组的下标要对应类中属性的值，否则不能传递值，可以不分先后但是必须一致
$up = new FileUpload(array('israndname'=>'true',"filepath"=>"./upload/",'allowtype'=>array('txt','doc','jpg','gif'),"maxsize"=>1000000));
   echo '<pre>';
 
   if($up -> uploadFile("pic")){
     print_r($up -> getNewFileName());
   } else{
     print_r($up -> getErrorMsg());
   }
   echo '<pre>';
?>