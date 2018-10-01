<?php
/**
 * Created by PhpStorm.
 * User: jiangyu01
 * Date: 2018/10/1
 * Time: 11:13
 * Title:
 * 给定两个大小为 m 和 n 的有序数组 nums1 和 nums2。
 */

$arr1 = range(3,9);     //构建有序数组
$arr2 = range(4,12);

/*
 * 中位数函数
 */
function MedianofTwoSortedArrays($arrA = [], $arrB = []) {
    //空值判断
    if (empty($arrA) && empty($arrB)) {
        echo '参数数组不能同时为空！'.PHP_EOL;
    }
    $arrC = array_merge($arrA,$arrB);       //数组合并
    sort($arrC);                    // 数组升序排序
    foreach ($arrC as $key){                //打印数组
        echo $key.' ';
    }
    $arr_size = count($arrC);               //计算数组大小
    if ($arr_size <= 1){                    //当数组容量为一的时候直接返回
        echo '中位数为：'.$arrC[$arr_size].PHP_EOL;
    }else{
        $bin = count($arrC) / 2;            //取中值下标
        if (is_int($bin)){
            echo  '中位数为：'.(($arrC[$bin]+$arrC[$bin+1])/2).PHP_EOL;
        }else{
            $bin = ceil($bin);              //取中值下标
            echo '中位数为：'.$arrC[$bin].PHP_EOL;
        }
    }
}

MedianofTwoSortedArrays($arr1, $arr2);
