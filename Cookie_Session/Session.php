<?php 
header('content-type:text/html;charset=utf-8');
date_default_timezone_set("PRC");
session_start();        //开启session
setcookie(session_name(),session_id(),time()+30,"/");  //以Cookie方式设置session失效时间
$_SESSION['username']="PHPer Jiang";    //存session
$_SESSION['usersex']='男';
echo $_SESSION['username'];             //读取session
echo '<br/>'.$_SESSION['usersex'];
echo '<br/>'.session_name().'<br/>'.session_id().'<br/>';
print_r($_SESSION);
echo '<hr/>';
// unset($_SESSION['username']);        //注销session某一个变量
// echo $_SESSION['username'];
// session_destroy();                   //注销当前session