<?php
/*二分查找算法（折中查找算法）递归实现  
 * 被查找数组一定是有序数组
 * 时间复杂度O（logn)
 **/

$arr=[33,23,56,78,45,43,89,63,65,76];
sort($arr);
var_dump($arr);

function BinSearch2($arr,$low,$len, $search){
    if($low<=$len){
        $bin=floor(($low+$len)/2);
        if($search == $arr[$bin]){
            return "查找到元素$search,元素下标为,$bin";
        }elseif ($search > $arr[$bin]){
            return  BinSearch2($arr, $bin+1, $len, $search);
        }elseif ($search < $arr[$bin]){
            return  BinSearch2($arr, $low, $bin-1, $search);
        }
    }
    return '未查询到';
}
var_dump(BinSearch2($arr,0,9,23));