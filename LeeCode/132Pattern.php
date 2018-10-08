<?php
/**
 * Created by PhpStorm.
 * User: jiangyu01
 * Date: 2018/10/8
 * Time: 14:43
 * Title:给定一个整数序列：a1, a2, ..., an，一个132模式的子序列 ai, aj, ak 被定义为：当 i < j < k 时，ai < ak < aj。
 * 设计一个算法，当给定有 n 个数字的序列时，验证这个序列中是否含有132模式的子序列。
 * 注意：n 的值小于15000
 */

//$numbs = [1, 2, 3, 4];
$numbs = [3, 1, 4, 2];
//$numbs = [-1, 3, 2, 0];

function Pattern132(array $numbs){
    $size = count($numbs);
    $res = FALSE;
    if ($size < 3){
        $res = '数组元素不能小于三个！';
        GOTO END;
    }
    for ($i = 1; $i < $size-1; $i ++){                  //外层循环空值轮询次数及中值位置从第二个元素开始止于倒数第二个元素
        for ($j = 0; $j < $size; $j++){                 //内层循环进行比较
            if ($j < $i){                               //中值之前的元素与中值进行比较
                if ($numbs[$j] < $numbs[$i]){
                    $numbs_1[] = $numbs[$j];
                }
            }
            if ($i < $j){                                  //中值之后的元素与中值进行比较
                if ($numbs[$i] > $numbs[$j]){
                    $numbs_2[] =$numbs[$j];
                }
            }
        }
    }
    //2中最小的元素大于1中的最小元素即满足132
    if (isset($numbs_1) && !empty($numbs_1) && isset($numbs_2) && !empty($numbs_2)){
        if (min($numbs_1) < min($numbs_2)){
            $res = TRUE;
        }
    }
    END:
    var_dump($res);
}

Pattern132($numbs);
