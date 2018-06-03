<?php 
//连接数据库
$dsn='mysql:host=127.0.0.1;dbname=db';
$pdo=new PDO($dsn,'root','123456');
$pdo->exec('set names utf8');
//开启事务
$pdo->beginTransaction();
$sql1='insert into admin value(null,"test1","test1",0)';    //正确sql
$sql2='insert into admin value("test2","test2",1)';         //错误sql
$res1=$pdo->exec($sql1);
$res2=$pdo->exec($sql2);
//判断两次执行是否成功
if($res1 && $res2){
    echo '插入成功';
    $pdo->commit();     //提交事务
}else {
    $pdo->rollBack();
    echo '插入失败';      //事务回滚
}
