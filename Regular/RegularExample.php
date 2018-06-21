<?php
//正则验证邮箱
// $pattern='/^\w+([-+.]\w+)*@\w+\.\w+$/'; 
// $subject='PHPerJiang@126.com';

//正则验证手机号码
$pattern='/^1[3578]\d{9}$/';
$subject='15232468491';

//返回结果数组
$matchs=array();
//preg_match()以数组的形式返回第一个匹配到的结果
preg_match($pattern, $subject, $matchs);
//preg_match_all()以多维数组的形式返回所有匹配到的数据
//preg_match_all($pattern, $subject, $matchs);

show($matchs);
/*打印函数  */
function show($matchs){
    if(is_array($matchs) || is_object($matchs)){
        print_r($matchs);
    }else {
        echo $matchs;
    }
}