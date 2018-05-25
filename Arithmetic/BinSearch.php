<?php
/*二分查找算法（折中查找算法）
 *被查找的数组必须是有序数组 
 * 时间复杂度为O（logn）
 * */
$arr=[33,23,56,78,45,43,89,63,65,76];
sort($arr);
var_dump($arr);
function BinSearch($arr,$search){
    $len=count($arr)-1;         //定义数组长度
    $low=0;                     //循环起始点
    while ($low<=$len){             //注意要小于等于 不然会丢失开头与结尾元素的比较
        $bin=floor(($low+$len)/2);
        if($search == $arr[$bin]){
            return "查找到元素$search,元素下标为,$bin";       //找到查找元素则返回
        }elseif ($search >$arr[$bin]){
            $low= $bin+1;
        }elseif($search< $arr[$bin]){
            $len=$bin-1;
        }
    }
    return '未找到';
}
var_dump(BinSearch($arr,23));
