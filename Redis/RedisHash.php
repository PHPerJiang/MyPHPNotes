<?php
/*连接数据库  */
$redis=new Redis();
$redis->connect('127.0.0.1',6379);

$redis->delete('hash');
$redis->hSet('hash','name','PHPerJiang');       //向hash中存储元素
$redis->hSet('hash','set','男');

$count=$redis->hLen('hash');                //统计hash中元素的个数
var_dump($count);

$allData=$redis->hGetAll('hash');               //以数组的形式获取hash中所有元素
var_dump($allData);
echo '<hr>';
$partData=$redis->hMget('hash',array('name','set'));    //获取hash中指定元素
var_dump($partData);