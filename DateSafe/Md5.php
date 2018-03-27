<?php
header('content-type:text/html;charset=gbk');
/* <meta http-equiv="refresh" content="3;URL=res.html">
 *echo '<meta http-equiv="refresh" content="3;URL=res.html">'
 * 通过html头实现页面在三秒钟后跳转
 */

/*  md5加密   */
$string='PHPerJiang';
$md5_value1=md5($string);//MD5（$string）返回32位字符16进制整数的密文
echo $md5_value1.'<hr/>';
$md5_value2=md5($string,true);//Md5($string,true)返回16字节的原始二进制密文
echo $md5_value2.'<hr/>';
$md5_value3=md5(md5($string,true));//单纯使用Md5（）加密已经不安全了，可以使用MD5(md5($string,true))方式来加密
echo $md5_value3;
 