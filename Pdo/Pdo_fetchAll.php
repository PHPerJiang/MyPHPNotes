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
$res=$result->fetchAll(PDO::FETCH_ASSOC);   //查询结果集中的所有行，是个二维数组
print_r($res);
echo '<hr/>';
foreach ($res as $key =>$value){            //循环输出
   echo '用户id:'.$res[$key]['id'].'<br/>';
   echo '用户账号:'.$res[$key]['username'].'<br/>';
   echo '用户密码:'.$res[$key]['password'].'<br/>';
}
echo '<hr/>';
for ($i=0;$i<count($res);$i++){             //循环输出
    echo '用户id:'.$res[$i]['id'].'<br/>';
    echo '用户账号:'.$res[$i]['username'].'<br/>';
    echo '用户密码:'.$res[$i]['password'].'<br/>';
}