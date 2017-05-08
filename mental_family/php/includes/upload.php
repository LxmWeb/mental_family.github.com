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

class FileUpload{
    private $filepath;   //指定上传文件保存的路径
    private $allowtype=array("gif","jpg","jpeg","png");//允许上传文件的类型
    private $maxsize=1000000;//允许上传文件的最大值
    private $israndname=true;//是否随机重命名，
    private $originName;//源文件名字
    private $tmpFileName;//临时文件名字
    private $fileType;//上传后的文件类型，主要是文件后缀名
    private $fileSize;//文件尺寸
    private $newFileName;//新文件名字
    private $errorName=0;//错误号
    private $errorMess="";//用来提供错误报告
    //用于对上传文件初始化
    //指定上传路径  2·允许的类型  3·限制大小  4·是否使用随机文件名称
    //让用户可以不用换位置传参数，后面参数给值不用按照位置或者必须有值
    function __construct($options=array()){
        foreach($options as $key=>$val){
            $key = strtolower($key);
            //查看用户参数中的数组下标是否和成员属性名相同
            //get_class_vars(get_class($this))得到类属性的数组
            //如果$key下标不在这个类属性的数组中，则退出for循环
            if (!in_array($key,get_class_vars(get_class($this)))){
                continue;
            }
            $this -> setOption($key,$val);
        }
    }
    private function setOption($key,$val){
        //让实例化后获取过来的数组下标 = 数组下标的值，这里即为构造函数初始化
        //构造函数中调用，等于把所有属性初始化，将来可以直接访问
        $this -> $key=$val;
    }

    private function getError(){
        $str="上传文件{$this->originName}时出错";
        switch($this -> errorNum){
            case 4: $str.="没有文件被上传";
            break;
            case 3: $str.="文件只有部分上传";
            break;
            case 2: $str.="上传文件超过了表单的值";
            break;
            case 1: $str.="上传文件超过phpini的值";
            break;
            case -1: $str.="未允许的类型";
            break;
            case -2: $str.="文件过大上传文件不能超过{$this->maxsize}字节";
            break;
            case -3: $str.="上传文件失败";
            break;
            case -4: $str.="建立存放上传文件目录失效，请重新上传指定目录";
            break;
            case -5: $str.="必须指定上传文件的路径";
            break;
            default: $str.="未知错误";
        }
        return $str.'';
    }
    //用来检查文件上传路径
    private function checkFilePath(){
        if(empty($this -> filepath)){
            $this -> setOption("errorNum",-5);
            return false;
        }
        if(!file_exists($this -> filepath) || !is_writable($this -> filepath)){
            if(!@mkdir($this -> filepath,0755)){
                $this -> setOption("errorNum",-4);
                return false;
            }
        }
        return true;
    }
    //用来检查上传文件尺寸大小

    private function checkFileSize(){
        if($this -> fileSize > $this ->maxsize){
            $this -> setOption("errorNum",-2);
            return false;
        }else{
            return true;
        }
    }

    //用来检查文件上传类型
    private function checkFileType(){
        if(in_array(strtolower($this->fileType),$this -> allowtype)){
            return true;
        }else{
            //如果$this->fileType这个类型 不在$this -> allowtype这个数组中，则把错误号变成-1
            $this -> setOption("errorNum",-1);
            return false;
        }
    }
    private function setNewFileName(){
        if($this -> israndname){
            $this -> setOption("newFileName",$this->preRandName());
        }else{
            $this -> setOption("newFileName",$this -> originName);
        }
    }
    //用于检查文件随机文件名
    private function preRandName(){
        $fileName=date("Ymdhis").rand(100,999);
        return $fileName.".".$this -> fileType;
    }
    //用来上传一个文件

    function uploadFile($fileField){
        //检查文件路径
        $return = true;
        if(!$this -> checkFilePath()){
            $this -> errorMess=$this -> getError();
            return false;
        }//获取文件信息
        $name     = $_FILES[$fileField]['name'];
        $tmp_name = $_FILES[$fileField]['tmp_name'];
        $size     = $_FILES[$fileField]['size'];
        $error    = $_FILES[$fileField]['error'];
        if(is_array($name)){//判断获取过来的文件名字是否为数组
            $errors=array();//如果为数组则设置为一个数组错误号
            for($i=0;$i<count($name);$i++){
                //循环每个文件即每个类属性赋值或者说初始化属性值 或者初始化构造函数
                if($this->setFiles($name[$i],$tmp_name[$i],$size[$i],$error[$i])){
                    if(!$this->checkFileSize() || !$this->checkFileType()){
                        //如果上面尺寸或者类型不对，则调用这个错误信息
                        $errors[$i]=$this->getError();
                        $return=false;
                    }
                }else{
                    //这里是
                    $error[]=$this->getError();
                    $return=false;
                }
                if(!$return)
                    $this->setFiles();
            }

            if($return){
                $fileNames=array();
                for($i=0;$i<count($name);$i++){
                    if($this->setFiles($name[$i],$tmp_name[$i],$size[$i],$error[$i])){
                        $this->setNewFileName();
                        if(!$this->copyFile()){
                            $errors=$this->getError();
                            $return=false;
                        }else{
                            $fileNames[$i]=$this->newFileName;
                        }
                    }

                }
                $this->newFileName=$fileNames;
            }

            $this->errorMess=$errors;
            return $return;


        }else{

            //看看$name,$tmp_name,$size,$error这些是否赋值成功 否则返回FALSE
            if($this -> setFiles($name,$tmp_name,$size,$error)){
                //看看文件大小尺寸是否匹配，不匹配返回FALSE
                if($this -> checkFileSize() && $this -> checkFileType()){
                    //获取新文件名
                    $this->setNewFileName();
                    if($this->copyFile()){
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    $return=false;
                }
            }else{
                $return=false;
            }
            if(!$return){
                $this -> errorMess = $this ->getError();
                return $return;
            }
        }

    }

    function copyFile(){//将文件从临时目录拷贝到目标文件夹
        if(!$this->errorNum){
            //如果传递来的路径有斜杠，则删除斜杠再加上斜杠
            //./upload+./
            $filepath=rtrim($this->filepath,'/').'/';
            //./upload+./+加上随机后的新文件名和后缀
            //这里指创建一个新的$filepath.这个文件 像占位符但是为空的
            $filepath.=$this->newFileName;
            //尝试着把临时文件$this->tmpFileName移动到$filepath下哪里覆盖原来的这个文件
            if(@move_uploaded_file($this->tmpFileName,$filepath)){
                return true;
            }else{
                $this->setOption('errorNum',-3);
                return false;
            }
        }else{
            return false;
        }
    }
    //这里是为了其他剩余的属性进行初始化操作！
    private function setFiles($name="",$tmp_name="",$size=0,$error=0){
        //这里给错误号赋值
        $this -> setOption("errorNum",$error);
        //如果这里有错误，直接返回错误
        if ($error){
            return false;
        }
        $this -> setOption("originName",$name);//复制名字为源文件名
        $this -> setOption("tmpFileName",$tmp_name);
        $arrstr = explode(".",$name);//按点分割文件名，
        //取分割后的字符串数组最后一个 并转换为小写，赋值为文件类型
        $this -> setOption("fileType",strtolower($arrstr[count($arrstr)-1]));
        $this -> setOption("fileSize",$size);
        return true;
    }
    //用来获取上传后的文件名
    function getNewFileName(){
        return $this -> newFileName;
    }

    //上传失败，后则返回这个方法，就可以产看报告
    function getErrorMsg(){
        return $this -> errorMess;
    }
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