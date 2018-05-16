<?php
/*连接数据库  */
$redis=new Redis();
$redis->connect('127.0.0.1',6379);

$redis->delete('list');                     
$redis->lPush('list','PHPerJiang');         //向list中从左推入变量
$redis->lPush('list','CoderJiang');
$redis->lPush('list','SuperJaing');
$val=$redis->rPop('list');                  //从右边弹出变量
var_dump($val);