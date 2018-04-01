<?php
header('content-type:text/html;charset-utf-8');
$dbms='mysql';          //设置数据库类型
$dbName='db';           //设置数据库名
$dbUser='root';         //账号
$dbPassword='';         //密码
$host='localhost';      //使用的主机名
$dns="$dbms:host=$host;dbname=$dbName";     //设置dns
$pdo=new PDO($dns,$dbUser,$dbPassword);     //连接数据库
$sql="insert into admin(username,password)values('PHPer','Jiang')";                 //定义sql
$result=$pdo->prepare($sql);                //查询预定义
$result->execute();                         //执行查询
$code=$result->errorCode();                 //获取错误信息
if($code=='00000'){                         //如果返回00000则执行过程没有发生错误，其他5位字母或数字则表示出错
   echo '添加数据成功！';
}else {
    echo '数据库错误！<br/>';
    var_dump($result->errorInfo());         //$result->errorInfo()返回的是一个一维数组
}