<?php
/**
 * Created by PhpStorm.
 * User: jiangyu01
 * Date: 2018/10/1
 * Time: 14:09
 * Title:
 * 给定一个 32 位有符号整数，将整数中的数字进行反转。
 * 假设我们的环境只能存储 32 位有符号整数，其数值范围是 [−231,  231 − 1]。根据这个假设，如果反转后的整数溢出，则返回 0
 */

$integer = -1200300000;         //定义有符号整数
/**
 * @param int $integer
 * 反转函数
 */
 function ReverseInteger(int $integer) {
    $up_limit = pow(2,31)-1;        //上限
    $down_limt = -pow(2,31);        //下限
     //范围判断
    if (($integer > $down_limt ) && ($integer < $up_limit)) {
        $string = strval($integer);                 //类型转换
        $string = rtrim($string,'0');       //去除最右边的0
        $sign = '';                                 //定义符号变量
        if ($string[0] == '-'){
            $sign = '-';
            $string = substr($string,1);        //如果存在符号则记录并且截取除符号外的字符
        }elseif ($string[0] == '+'){
            $sign = '+';
            $string = substr($string,1);
        }
        $result = strrev($string);                   //反转字符串
        $result = $sign.$result;                       //添加符号
        $integer = intval($result);                    //转换为整形
        //反转后范围判断
        if (($integer < $down_limt) || ($integer > $up_limit)){
            echo '0';
        }else{
            echo $integer;
        }
    }else{
        echo '只能处理32 位有符号整数!';
    }
 }

ReverseInteger($integer);
