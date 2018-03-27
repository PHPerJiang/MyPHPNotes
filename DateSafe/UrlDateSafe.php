<?php
header('content-type:text/html;charset=gbk');
if (!empty($_GET['code'])){
    echo urldecode($_GET['code']).'<hr/><br/>';
}elseif(!empty($_GET['code1'])){
    echo urldecode($_GET['code1']).'<hr/><br>';
}
$url='& #';
$test=urlencode($url);      //urlencode会把空着转换为+
echo urlencode($url).'<hr/>';
echo urldecode($url).'<hr/>';
echo "<a href='UrlDateSafe.php?code={$test}'>测试</a><hr/><br/><br/>";

$url1='& #';
$test=urlencode($url1);
echo $url.'<hr/>';
echo rawurlencode($url).'<hr/>';//rawurlencode会把空格转换为%20，这是与urlencode区别，其余的都一样
echo rawurldecode($url).'<hr/>';
echo "<a href='UrlDateSafe.php?code1={$test}'>测试</a><hr/>";

/**
*  ？            =>  %3F
*  =    =>  %3d
*  空格       =>  +(urlencode) / %20(rawurlencode)
*  %    =>  %25
*  &    =>  %26
*  \    =>  %5C
*  +    =>  %2B
**/