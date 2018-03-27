<?php
header('content-type:text/html;charset=gbk');

$string='PHPerJiang';
$sha1_value1=sha1($string);//返回40字符的十六进制密文
echo $sha1_value1.'<hr/>';
$sha1_value2=sha1($string,true);//返回20字符的原始密文
echo $sha1_value2.'<hr/>';
$sha1_value3=sha1(sha1($string,true));//Sha1也不安全常用 sha1(sha1($string,true))加密
echo $sha1_value3;