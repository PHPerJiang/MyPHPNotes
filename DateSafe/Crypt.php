<?php
header('content-type:text/html;charset=gbk');
/*  crypt����         */
$string='PHPerJiang';
$crypt_value1=crypt($string,'JY');//���ڱ�׼ DES �㷨��ɢ��ʹ�� "./0-9A-Za-z" �ַ��е������ַ���Ϊ��ֵ
echo $crypt_value1.'<hr/>';
$crypt_value2=crypt($string,'$1$PHPerJiang$');//MD5 ɢ��ʹ��һ���� $1$ ��ʼ�� 12 �ַ����ַ�����ֵ
echo $crypt_value2.'<hr/>';

/**
 * Ϊ�˷�ֹʱ�򹥻� ͨ������crypt���ܵ�ʱ�����
 * bool hash_equals ( string $known_string , string $user_string )
 * ��������������Ƚϣ���Ч�ķ�ֹʱ�򹥻�
 * 
 * 
 * crypt�����ɺܶ��֣������������ֳ�����ʽ������ȥphp�ֲ��ѯ
 */
