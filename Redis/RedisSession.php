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

//注销session的方式和将session存入服务器文件的方式一样的
//session_destory();//销毁当前会话的所有数据包括当前会话
//unset($_SESSION['data']);//注销会话指定内容，不销毁当前会话
//$_SESSION['data']=null;//将指定数据设置为空，不推荐使用，不销毁当前会话
/*当然php中也有配置设置的会话的过期时间session.gc_maxlifetime = 1440默认24分钟，
 * redis默认过期时间未2147483647,一定要报正php.ini中的session的过期时间小于redis
 * 中的过期时间不然会报错
 */

//打印sessionid
echo 'session_id:'.session_id().'<br/>';
//打印redis中session的值，注意session在reids的存储是以session_id的形式将session存入redis的
//打印出来的格式为session存储的格式
echo 'redisSession:'.$redis->get('PHPREDIS_SESSION:'.session_id()).'<br/>';