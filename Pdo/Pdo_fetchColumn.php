<?php
header('content-type:text/html;charset-utf-8');
$dbms='mysql';          //设置数据库类型
$dbName='db';           //设置数据库名
$dbUser='root';         //账号
$dbPassword='';         //密码
$host='localhost';      //使用的主机名
$dns="$dbms:host=$host;dbname=$dbName";     //设置dns
$pdo=new PDO($dns,$dbUser,$dbPassword);     //连接数据库
$sql='select * from admin';                 //定义sql
$result=$pdo->prepare($sql);                //查询预定义
$result->execute();                         //执行查询
echo '用户名：'.$result->fetchColumn(1).'<br/>';    //查询结果集中下一行指定列得到值
echo '用户密码：'.$result->fetchColumn(2).'<br/>';