<?php
/**
 * Created by PhpStorm.
 * User: jiangyu01
 * Date: 2018/10/3
 * Time: 14:53
 * Title:给定一个包含 n 个整数的数组 nums，判断 nums 中是否存在三个元素 a，b，c ，
 * 使得 a + b + c = 0 ？找出所有满足条件且不重复的三元组。
 */

$nums = [-1, 0, 1, 2, -1, -4];

function threeSum(array $num) {
    sort($num);     //排序
    $size = sizeof($num);
    if ($size <3){
        $res = '数组内元素个数不能小于3';
    }
    //三个循环实现判断，规则为a+b=-c
    for ($i = 0; $i < $size-2; $i++){
        for ($j = $i+1; $j<$size-1; $j++){
            $k = $j+1;
            while ($k < $size){
                if ($num[$i] + $num[$j] == -$num[$k]){
                    $res[] = [$num[$i] ,$num[$j], $num[$k]];
                    $k++;
                }else{
                    $k++;
                    continue;
                }
            }
        }
    }
    //数组去重方法
    if (is_array($res)){
        $res_count = count($res);
        if ($res_count > 2){
            for($i = 0; $i < $res_count; $i++){
                for ($j = $i+1; $j < $res_count; $j++){
                    if (isset($res[$j]) && isset($res[$i])){
                        if (array_diff($res[$i],$res[$j])){
                            array_splice($res,$j,1);
                        }
                    }
                }
            }
        }
    }
    var_dump(empty($res) ? '没有匹配到数据' : $res);
}

threeSum($nums);