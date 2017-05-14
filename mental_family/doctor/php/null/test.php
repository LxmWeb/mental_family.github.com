<?php 
header("Content-type: text/html; charset=utf-8"); 
//$testJSON=array(('name'=>'中文字符串','value'=>'test'),('eee':'谔谔','ee':'企鹅的我的'));
$testJSON = array('name'=>'中文字符串','value'=>'test');
echo $testJSON['name'];
echo json_encode($testJSON)."<br />"; 
//foreach ( $testJSON as $key => $value ) { 
//$testJSON[$key] = urlencode ( $value ); 
//} 
//echo urldecode ( json_encode ( $testJSON ) ); 
echo _encode($testJSON);
function _encode($arr)
{
  $na = array();
  foreach ( $arr as $k => $value ) {   
    $na[_urlencode($k)] = _urlencode ($value);   
  }
  return addcslashes(urldecode(json_encode($na)),"\r\n");
}
 
function _urlencode($elem)
{
  if(is_array($elem)){
    foreach($elem as $k=>$v){
      $na[_urlencode($k)] = _urlencode($v);
    }
    return $na;
  }
  return urlencode($elem);
}
?> 