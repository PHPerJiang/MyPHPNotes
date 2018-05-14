<?php
//判断发来的请求类型用$_SERVER['REQUEST_METHOD'] && strtoupper($_SERVER['REQUEST_METHOD'])=='GET'
if($_SERVER['REQUEST_METHOD'] && strtoupper($_SERVER['REQUEST_METHOD'])=='GET'){
    $data=$_GET;
    echo $data['name'];
}elseif ($_SERVER['REQUEST_METHOD'] && strtoupper($_SERVER['REQUEST_METHOD'])=='POST'){
    $data=$_POST;
    echo $data['age'];
}
