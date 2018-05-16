<?php
/*使用redis时需要在本机上开启reids服务  */
$redis= new Redis();        //实例化redis类
$redis->connect('127.0.0.1',6379);      //连接redis 端口号为6379