<?php
header('content-type:text/html;charset=gbk');

$string='PHPerJiang';
$sha1_value1=sha1($string);//����һ�� 40 �ַ����ȵ�ʮ��������������
echo $sha1_value1.'<hr/>';
$sha1_value2=sha1($string,true);//����һ�� 20 �ַ����ȵ�ԭʼ����
echo $sha1_value2.'<hr/>';
$sha1_value3=sha1(sha1($string,true));//ʹ��sha1����ʱ�����ļ��ܷ�ʽ
echo $sha1_value3;

/**
*sha1�����㷨�Ѿ�����ȫ�ˣ������Ҫ�ô��㷨���ܣ�һ��Ҫע�⾡�����Ӽ����㷨�ĸ��Ӷ�
*/