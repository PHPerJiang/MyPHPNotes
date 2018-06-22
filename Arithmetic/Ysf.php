<?php
/* 约瑟夫环算法。 
 * 猴王问题：
 *  一群猴子排成一圈，按1,2,...,n依次编号。然后从第1只开始数，数到第m只,把它踢出圈，
 *  从它后面再开始数， 再数到第m只，在把它踢出去...，如此不停的进行下去， 直到最后只剩下
 *  一只猴子为止，那只猴子就叫做大王。要求编程模拟此过程，输入m、n, 输出最后那个大王的编号。
 * */

//函数
function getMonkeyKing($monkeys ,$m ,$current=0){
    //获取数组大小
    $size = sizeof($monkeys);
    //设置计数器
    $num = 1;
    //如果数组大小为1，则只剩下一个猴，此猴为王
    if($size==1){
        echo '<font color="red">编号为:'.$monkeys[0].'的猴子成为了大王</font>';
    }else {
        //判断循环次数
        while ($num++ < $m){
            $current++;
            //获取当前被踢出去的猴子的编号
            $current=$current%$size;
        }
        echo '编号为： '.$monkeys[$current].' 的猴子被踢出去了！<br/>';
        //使用此内置函数移除数组中从当前位置长度唯一的元素
        array_splice($monkeys, $current,1);
        //递归
        getMonkeyKing($monkeys, $m,$current);
    }
}

//算法验证
$monkeys = range(1, 20);
$m = 4;
getMonkeyKing($monkeys, $m);