<?php 
header('content-type:text/html;charset=utf-8');
date_default_timezone_set("PRC");
session_save_path('./tmp/');//将session保存在临时文件中，提高服务器安全性和效率，注意*session_save_path()要在session_start()前定义。
session_cache_limiter('private');//设置页面缓存为private(public)
$cache_limit=session_cache_limiter();
session_cache_expire(30);//设置页面缓存时间为30分钟
$session_expire=session_cache_expire();
session_start();        //开启session
setcookie(session_name(),session_id(),time()+30,"/");  //以Cookie方式设置session失效时间
$_SESSION['username']="PHPer Jiang";    //存session
$_SESSION['usersex']='男';
echo $_SESSION['username'];             //读取session
echo '<br/>'.$_SESSION['usersex'];
echo '<br/>'.session_name().'<br/>'.session_id().'<br/>';
print_r($_SESSION);
echo '<hr/>';
echo '设置页面缓存限制为:'.$cache_limit.'<br/>';
echo '页面缓存时间为:'.$session_expire;
// unset($_SESSION['username']);        //注销session某一个变量
// echo $_SESSION['username'];
// session_destroy(); //注销当前session
// session_set_save_handler($open, $close, $read, $write, $destroy, $gc);//将session存储在数据库中的函数，需要实现参数中的六个方法