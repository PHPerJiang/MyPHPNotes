<?php
/*快速排序算法
 *选择一个基准元素，通常选择第一个元素或者最后一个元素。通过一趟扫描，将待排序列分成两部分，一部分比基准元素小，一部分大于等于基准元素。此时基准元素在其排好序后的正确位置，然后再用同样的方法递归地排序划分的两部分。
 *时间复杂度O(n^2)
 *空间复杂度O(log2n)~O(n)
 *此排序不稳定
 **/
$arr=[43,23,65,47,78,55,36,98,23,8];
function QuickSort($arr){
    $len=count($arr);       //获取数组长度
    if($len<=1){            //判断是否继续执行
        return $arr;    
    }
    $base=$arr[0];          //设置每组最左边元素为基准元素
    $left_arry=array();     //小于基准元素的数组
    $right_arry=array();    //大于基准元素的数组
    for ($i=1 ; $i<$len ; $i++){    //循环遍历数组从第二个元素开始
        if($base>$arr[$i]){
            $left_arry[]=$arr[$i];
        }else {
            $right_arry[]=$arr[$i];
        }
    }
    $left_arry=QuickSort($left_arry);   //递归执行小于基准元素的数组
    $right_arry=QuickSort($right_arry); //递归执行昂与基准元素的数组
    return array_merge($left_arry,array($base),$right_arry);    //合并数组，注意要转换基准元素类型，因为array_merge只能合并数组
}

echo '原数组<br/>'.var_dump($arr);
echo '快速排序后数组'.var_dump(QuickSort($arr));

