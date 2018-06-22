<?php
//设置session的存储位置和方式
ini_set("session.save_handler", "redis");
ini_set("session.save_path", "tcp://127.0.0.1:6379");
//开启session
session_start();
//存入session
$_SESSION['data']=array('name'=>'PHPerJiang','age'=>23);
//实例化reids
$redis=new Redis();
$redis->connect('127.0.0.1',6379);

//取出session
echo json_encode($_SESSION['data']).'<br/>';

//打印sessionid
echo 'session_id:'.session_id().'<br/>';
//打印redis中session的值，注意session在reids的存储是以session_id的形式将session存入redis的
//打印出来的格式为session存储的格式
echo 'redisSession:'.$redis->get('PHPREDIS_SESSION:'.session_id()).'<br/>';