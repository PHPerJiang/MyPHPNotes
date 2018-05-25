<?php
/*归并排序算法，类似于快排但是稳定性更高，主要思想就是分治法
 *将指定的两个有序数组合并成一个有序数组
 *时间复杂度O（n）
 *空间复杂度O（n）
 **/

$arr=[33,23,56,78,45,43,89,63,65,76];
//归并函数
function arrSort($arrA,$arrB){     //合并两个有序数组为一个有序数组
while (count($arrA) && count($arrB)){
        //使用array_shift函数来取出头元素
        $arrC[]=$arrA['0']<$arrB['0']?array_shift($arrA):array_shift($arrB);
    }
    //当A B其中一个的元素取完时为空数组，另一个中的元素全部啊都大于C中的元素，合并这三个数组
    return array_merge($arrC,$arrA,$arrB);
}

function MergeSort($arr){
    $len =count($arr);
    if($len<=1){
        return $arr;
    }
    $bin =floor($len/2);
    $left_arr=array_slice($arr, 0,$bin);        //将bin左边的元素赋给left_arr
    $right_arr=array_slice($arr, $bin);         //将bin及bin右边的元素赋给right_arr
    $left_arr=MergeSort($left_arr);             //递归将数组划分为单一元素的数组
    $right_arr=MergeSort($right_arr);
    return arrSort($left_arr, $right_arr);;     //调用归并函数
}
var_dump($arr);
var_dump(MergeSort($arr));