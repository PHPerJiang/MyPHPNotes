<?php
header('content-type:text/html;charset=utf-8');
date_default_timezone_set("PRC");//设置默认时区为中国
$userName='PHPerJiang';
$date=date("Y-m-d H:i:s",time());//设置时间格式
$userSex='男';
setcookie("userName",$userName);//存cookie为会话级
setcookie("userSex",$userSex,time()+60);//存cookie60s后过期
setcookie("date",$date,time()+60);
echo $_COOKIE["userName"];//读取cookie
echo '<br/>'.$_COOKIE["userSex"];
echo '<br/>'.$_COOKIE['date'];
/**
 *每个浏览器上可以储存300个cookie ，cookie为明文存储，不可以存储私密信息，
 *每个cookie可以存4kb数据，每个域名可以存20个cookie 
 */