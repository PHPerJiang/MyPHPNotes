<?php
/**
 * Created by PhpStorm.
 * User: jiangyu01
 * Date: 2018/10/1
 * Time: 14:51
 * Title:
 * 实现 atoi，将字符串转为整数
 * 当字符串中的第一个非空字符序列不是个有效的整数；或字符串为空；或字符串仅包含空白字符时，则不进行转换。
 */

$string = '  -42030  ';         //定义字符串变量
/**
 * @param string $string
 * 定义转换函数
 */
function StringtoInteger(string $string) {
    $up_limit = pow(2,31)-1;        //上限
    $down_limt = -pow(2,31);        //下限
    $string = trim($string);                    //去除字符前后空白字符
    $sign = '';                                 //定义符号变量
    if ($string[0] == '-'){
        $sign = '-';
        $string = substr($string,1);        //如果存在符号则记录并且截取除符号外的字符
    }elseif ($string[0] == '+'){
        $sign = '+';
        $string = substr($string,1);
    }
    //判断去除符号后的字符串首位是否是数字
    if (is_numeric(intval($string[0]))){
        $integer =  $sign.intval($string);
        //反转后范围判断
        if (($integer < $down_limt) || ($integer > $up_limit)){
            echo '0';
        }else{
            echo $integer;
        }
    }else{
        echo 0;
    }
}

StringtoInteger($string);
