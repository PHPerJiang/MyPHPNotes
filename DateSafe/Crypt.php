<?php
header('content-type:text/html;charset=utf-8');
/*  crypt机密技术         */
$string='PHPerJiang';
$crypt_value1=crypt($string,'JY');//基于标准des算法的散列值加密“.0-9A-Za-z”字符中的两个字符作为盐值
echo $crypt_value1.'<hr/>';
$crypt_value2=crypt($string,'$1$PHPerJiang$');//基于md5的散列用$1 $开始的12字符的盐值串
echo $crypt_value2.'<hr/>';

