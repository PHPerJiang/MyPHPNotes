<?php
header('content-type:text/html;charset=gbk');
/* <meta http-equiv="refresh" content="3;URL=res.html">
 *echo '<meta http-equiv="refresh" content="3;URL=res.html">'
 * ����ʵ��ҳ��3s���Զ���ת
 */

/*  md5����    */
$string='PHPerJiang';
$md5_value1=md5($string);//����32�ַ�16����������ʽ����
echo $md5_value1.'<hr/>';
$md5_value2=md5($string,true);//����16�ֽڳ��ȵ�ԭʼ�����Ƹ�ʽ����
echo $md5_value2.'<hr/>';
$md5_value3=md5(md5($string,true));//����MD5�߰�ȫ�Լ�����ʽ
echo $md5_value3;
 