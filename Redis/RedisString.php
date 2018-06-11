<?php
$redis= new Redis();        //实例化redis类
$redis->connect('127.0.0.1',6379);      //连接redis 端口号为6379

$redis->delete('var');     //确保reids中没有var
$redis->set('var','PHPerJiang');    //存值
$val=$redis->get('var');            //读值
var_dump($val);
echo '<br/>';

$redis->set('var',4);               //存值
$redis->incr('var',2);              //自增2
$val=$redis->get('var');            //读值
var_dump($val);

