<?php
//判断发来的请求类型用$_SERVER['REQUEST_METHOD'] && strtoupper($_SERVER['REQUEST_METHOD'])=='GET'
if($_SERVER['REQUEST_METHOD'] && strtoupper($_SERVER['REQUEST_METHOD'])=='GET'){
    //sleep(5);//5s后继续执行，模仿网络延迟
    $data=$_GET;
    echo $data['name'];
}elseif ($_SERVER['REQUEST_METHOD'] && strtoupper($_SERVER['REQUEST_METHOD'])=='POST'){
    $data=$_POST;
    echo $data['age'];
}
