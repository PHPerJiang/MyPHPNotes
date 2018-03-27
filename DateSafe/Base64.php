<?php 
header('content-type:text/html;charset=utf-8');
$string='PHPerJiang';
echo $string.'<br/>';
echo base64_encode($string).'<br/>';//base64加密
echo base64_decode(base64_encode($string)).'<br/><hr/>';//base64解密


echo "<image src='PHPerJiang.jpg' alt=''></image>";
$filename="PHPerJiang.jpg";
$data=file_get_contents($filename);//获取图片内容
$imgDate=base64_encode($data); //将所有二进制字符转换为可打印的64个字符
echo '<hr/>';
echo "<image src='data:;base64,$imgDate' alt=''></image>";//通过base码显示图片
echo '<hr/>';
echo "<image src='data:image/jpeg;base64,$imgDate' alt=''></image>";

/**
 * 信息加密技术
 * 单项散列加密技术
 * 对称加密技术
 * 非对称加密技术
 */
