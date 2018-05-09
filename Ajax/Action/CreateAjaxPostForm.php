<?php
$data=$_POST;  //接收post数据
if(!empty($data['name'])){  //如果data['name']不存在说明不是ajax请求
    if($data['name']=='PHPerJiang'){
        echo 0;
    }else{
        echo 1;
    }
}
var_dump($data);