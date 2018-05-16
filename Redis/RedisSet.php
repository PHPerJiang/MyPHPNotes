<?php
/*连接redis  */
$redis=new Redis();
$redis->connect('127.0.0.1',6379);

$redis->delete('set');
$redis->sAdd('set','A');          //向set中添加元素
$redis->sAdd('set','B');
$redis->sAdd('set','C');
$redis->sAdd('set','A');
                                    //set中的元素不允许出现重复值
$count=$redis->scard('set');        //统计set中元素个数
var_dump($count);

$values=$redis->sMembers('set');        //以数组的形式列出set中的元素
var_dump($values);