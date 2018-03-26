<?php
header('content-type:text/html;charset=gbk');

$string='PHPerJiang';
$sha1_value1=sha1($string);//返回一个 40 字符长度的十六进制数字密文
echo $sha1_value1.'<hr/>';
$sha1_value2=sha1($string,true);//返回一个 20 字符长度的原始密文
echo $sha1_value2.'<hr/>';
$sha1_value3=sha1(sha1($string,true));//使用sha1加密时常见的加密方式
echo $sha1_value3;

/**
*sha1加密算法已经不安全了，如果非要用此算法加密，一定要注意尽量增加加密算法的复杂度
*/