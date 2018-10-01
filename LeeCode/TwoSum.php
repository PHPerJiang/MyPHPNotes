<?php
/**
 * Created by PhpStorm.
 * User: jiangyu01
 * Date: 2018/10/1
 * Time: 10:06
 * Title:
 * 给定一个整数数组和一个目标值，找出数组中和为目标值的两个数。
 * 你可以假设每个输入只对应一种答案，且同样的元素不能被重复利用。
 */

$arr = [2, 7, 11, 15 ,3, 6];          //定义数组
shuffle($arr);          //打乱数组
//定义函数
function two_sum($array, $target){
    $size = count($array);
    $result = [];
    if (!empty($array) && is_array($array)) {
        for($i = 0; $i < $size ; $i++ ){
            for ($j = $i+1; $j < $size ; $j++){
                if ($array[$i] + $array[$j] == $target){
                    $result[] = [$array[$i],$array[$j]];
                }
            }
        }
        if (!empty($result)){
            foreach ($result as $key => $value){
                echo '匹配到数据，第'.($key+1).'组数据为：'.$value['0'].' '.$value['1'].PHP_EOL;
            }
        }else{
            echo '数组中没有匹配的数据!';
        }
    }
}
//调用函数
two_sum($arr,9);

/**
 * 此题中心思想为冒泡算法，循环遍历找到匹配到的数然后返回
 */
