<?php 
header('content-type:text/html;charset=gbk');
$string='PHPerJiang';
echo $string.'<br/>';
echo base64_encode($string).'<br/>';//base64����
echo base64_decode(base64_encode($string)).'<br/><hr/>';//base64����


echo "<image src='PHPerJiang.jpg' alt=''></image>";
$filename="PHPerJiang.jpg";
$data=file_get_contents($filename);//���ͼƬ������
$imgDate=base64_encode($data); //���κζ������ַ����뵽�ɴ�ӡ��64���ַ�֮��
echo '<hr/>';
echo "<image src='data:;base64,$imgDate' alt=''></image>";//ͼƬ�ĵ������ʽ ��ֱ����base64���ͼƬ
echo '<hr/>';
echo "<image src='data:image/jpeg;base64,$imgDate' alt=''></image>";

/**
 * ��Ϣ���ܼ�����
 * ����ɢ�м��ܼ���     ���򲻿���
 * �ԳƼ��ܼ���             ˫�������Ҫ��Կ
 * �ǶԳƼ��ܼ���         ˫�������Ҫ��Կ��˽Կ 
 */
