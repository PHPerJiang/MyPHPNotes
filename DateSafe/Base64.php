<?php 
header('content-type:text/html;charset=gbk');
$string='PHPerJiang';
echo $string.'<br/>';
echo base64_encode($string).'<br/>';//base64加密
echo base64_decode(base64_encode($string)).'<br/><hr/>';//base64解密


echo "<image src='PHPerJiang.jpg' alt=''></image>";
$filename="PHPerJiang.jpg";
$data=file_get_contents($filename);//获得图片的内容
$imgDate=base64_encode($data); //把任何二进制字符编码到可打印的64个字符之中
echo '<hr/>';
echo "<image src='data:;base64,$imgDate' alt=''></image>";//图片的的输出格式 ，直接用base64输出图片
echo '<hr/>';
echo "<image src='data:image/jpeg;base64,$imgDate' alt=''></image>";

/**
 * 信息加密技术：
 * 单项散列加密技术     单向不可逆
 * 对称加密技术             双向可逆需要密钥
 * 非对称加密技术         双向可逆需要公钥和私钥 
 */
