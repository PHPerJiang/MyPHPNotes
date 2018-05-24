<?php 
/*插入算法  
 * 在要排序的一组数中，假设前面的数已经是排好顺序的，现在要把第n个数插到前面的有序数中，使得这n个数也是排好顺序的。如此反复循环，直到全部排好顺序。
 * 时间复杂度为O(n^2)
 * 空间复杂度为O(1)
 **/

$arr=[43,23,65,47,78,55,36,98,23,8];

function InsertSort($arr,$inser){
    array_push($arr, $inser);       //将要插入的元素给压入数组尾部
    $len=count($arr);               //获取长度
    for($i=1 ; $i<$len ; $i++){     //该层循环控制循环轮数
       $temp=$arr[$i];              //假设第i个元素为要插入元素
       for ($j=$i-1 ; $j>=0 ; $j--){    //该层循环控制比较次数
         if($temp < $arr[$j]){          //如果插入元素大于前一个元素则交换值
             $arr[$j+1] = $arr[$j];
             $arr[$j] = $temp;
         }else {
             break;
         }
       }
    }
    return $arr;
}

echo '原数组<br/>'.var_dump($arr);
echo '插入排序后数组，插入数值为：12'.var_dump(InsertSort($arr,12));