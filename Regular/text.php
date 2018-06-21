<?php 
require_once 'Regular.class.php';

//验证Regular类
$email='PHPerJiang@126.com';
//开启结果集
// $regular=new Regular(true);
// var_dump($regular->isEmail($email));

//不开启结果集
$regular=new Regular();
echo $regular->isEmail($email);