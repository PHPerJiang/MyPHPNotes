<?php
header('content-type:text/html;charset=gbk');
/*  crypt加密         */
$string='PHPerJiang';
$crypt_value1=crypt($string,'JY');//基于标准 DES 算法的散列使用 "./0-9A-Za-z" 字符中的两个字符作为盐值
echo $crypt_value1.'<hr/>';
$crypt_value2=crypt($string,'$1$PHPerJiang$');//MD5 散列使用一个以 $1$ 开始的 12 字符的字符串盐值
echo $crypt_value2.'<hr/>';

/**
 * 为了防止时序攻击 通常再用crypt加密的时候会用
 * bool hash_equals ( string $known_string , string $user_string )
 * 函数来进行密码比较，有效的防止时序攻击
 * 
 * 
 * crypt加密由很多种，这里例举两种常见方式，可以去php手册查询
 */
