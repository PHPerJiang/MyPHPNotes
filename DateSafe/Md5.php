<?php
header('content-type:text/html;charset=gbk');
/* <meta http-equiv="refresh" content="3;URL=res.html">
 *echo '<meta http-equiv="refresh" content="3;URL=res.html">'
 * 可以实现页面3s后自动跳转
 */

/*  md5加密    */
$string='PHPerJiang';
$md5_value1=md5($string);//返回32字符16进制数字形式密文
echo $md5_value1.'<hr/>';
$md5_value2=md5($string,true);//返回16字节长度的原始二进制格式密文
echo $md5_value2.'<hr/>';
$md5_value3=md5(md5($string,true));//常用MD5高安全性加密形式
echo $md5_value3;
 