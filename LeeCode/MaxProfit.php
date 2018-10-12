<?php
/**
 * Created by PhpStorm.
 * User: jiangyu01
 * Date: 2018/10/8
 * Time: 15:54
 * Title:给定一个数组，它的第 i 个元素是一支给定股票第 i 天的价格。
 * 如果你最多只允许完成一笔交易（即买入和卖出一支股票），设计一个算法来计算你所能获取的最大利润。
 * 注意你不能在买入股票前卖出股票。
 */

$prices = [7,1,5,3,1,6,4];
$prices = [7,6,4,3,1];
function maxProfit(array $prices){
    $res = '';
    $size = count($prices);
    if ($size < 2){
        $res = '数组内元素不能小于2个';
        GOTO END;
    }
    $arr = [];
    $max = 0;
    for ($i = 0; $i < $size-1; $i++){
        for ($j= $i+1; $j < $size-1; $j++){
            $price = $prices[$j] - $prices[$i];
            if ($price > 0) {
                 $max = $max < $price ? $price : $max;
                }
        }
    }
    if (is_numeric($max)){
        $res = '最大利润为：'.$max;
    }
    END:
    var_dump($res);
}

maxProfit($prices);