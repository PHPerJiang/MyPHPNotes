<?php
header('content-type:text/html;charset=gbk');
if (!empty($_GET['code'])){
    echo urldecode($_GET['code']).'<hr/><br/>';
}elseif(!empty($_GET['code1'])){
    echo urldecode($_GET['code1']).'<hr/><br>';
}
$url='& #';
$test=urlencode($url);      //urlencode��ѿ���ת��Ϊ+
echo urlencode($url).'<hr/>';
echo urldecode($url).'<hr/>';
echo "<a href='UrlDateSafe.php?code={$test}'>����</a><hr/><br/><br/>";

$url1='& #';
$test=urlencode($url1);
echo $url.'<hr/>';
echo rawurlencode($url).'<hr/>';//rawurlencode��ѿո�ת��Ϊ%20��������urlencode��������Ķ�һ��
echo rawurldecode($url).'<hr/>';
echo "<a href='UrlDateSafe.php?code1={$test}'>����</a><hr/>";

/**
*  ��            =>  %3F
*  =    =>  %3d
*  �ո�       =>  +(urlencode) / %20(rawurlencode)
*  %    =>  %25
*  &    =>  %26
*  \    =>  %5C
*  +    =>  %2B
**/