<?php
/*连接数据库  */
$redis=new Redis();
$redis->connect('127.0.0.1',6379);

$redis->delete('sort');  
$redis->zAdd('sort',58,'D');
$redis->zAdd('sort',99,'A');            //向sort中存储元素
$redis->zAdd('sort',78,'B');
$redis->zAdd('sort',100,'C');

$asc=$redis->zRange('sort',0,-1);       //正序获取元素排序
var_dump($asc);

$desc=$redis->zrevrange('sort',0,-1);       //倒叙获取元素排序
var_dump($desc);

/* zRange('sort',0,-1);  其中0,-1代表从第一个元素到最后一个元素 */