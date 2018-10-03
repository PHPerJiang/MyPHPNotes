<?php
/**
 * Created by PhpStorm.
 * User: jiangyu01
 * Date: 2018/10/2
 * Time: 17:11
 * Title:
 * 给定 n 个非负整数 a1，a2，...，an，每个数代表坐标中的一个点 (i, ai) 。
 * 在坐标内画 n 条垂直线，垂直线 i 的两个端点分别为 (i, ai) 和 (i, 0)。
 * 找出其中的两条线，使得它们与 x 轴共同构成的容器可以容纳最多的水。
 *
 * 你不能倾斜容器，且 n 的值至少为 2
 */

$w = 1;                 //线段间隔
$n= [1,8,6,2,5,4,8,3,7];        //线段数组
//函数
function ContainerWithMostWater($n, $w) {
    $result = '';               //结果集
    $size = count($n);          //数组大小
    $max = 0;                   //最大面积
    if ($size <2){              //判断数组容量
        $result = '数组容量不可以小于2';
        GOTO END;
    }
    if ($w <= 0){               //判断线段间隔
        $result = '线段间隔不能小于1';
        GOTO END;
    }
    asort($n);          //键值关联模式下进行排序
    $key = array_keys($n);      //获取键
    $value = array_values($n);  //获取值
    $max = 0;                   //预定义最大值
    //冒泡算法比较最大值
    for ($i = 0; $i < $size; $i++){
        for ($j = $i+1; $j < $size; $j++){
            $high = $value[$i]>=$value[$j] ? $value[$j] : $value[$i];
            $width = abs($key[$j] - $key[$i]) * $w;
            if ($max < $high*$width){
                $max = $high*$width;
                echo $high.'*'.$width.'='.$max.PHP_EOL;
            }
        }
    }
    END:
    echo empty($result) ? '最大值为'.$max :$result;
}

ContainerWithMostWater($n, $w);