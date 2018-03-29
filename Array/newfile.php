<?php
header('content-ttype:text/html;charset=utf-8');
$string='中国@美国@法国@澳大利亚@俄罗斯';
$str=explode('@', $string);
foreach($str as $key){
    echo $key.' ';
}
$str1=array(1=>$str,2=>$str);
echo '<hr/>';
foreach ($str1 as $key=>$value){
    foreach ($str1[$key] as $key1=>$value){
        echo $value.' ';
    }
    echo '<br/>';
}