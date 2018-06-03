<?php
//连接数据库
$pdo= new PDO('mysql:host=localhost;dbname=db','root','');
@$pdo->query('set names utf8');
$sql='insert into userorder value(null,?,?,?)';

//连接redis
$redis=new Redis();
$redis->connect('127.0.0.1',6379);
$redis_name='userlist';

// $redisData=$redis->rPop($redis_name);
// echo $redisData;
// $arr=explode('%', $redisData);
// var_dump($arr);
// $redis->rPush($redis_name,$redisData);

//设置循环不断扫描userlist队列,当队列不为空时反复扫描
while($redis->lLen($redis_name)){
    $redisData=$redis->rPop($redis_name);
    //将拼装好的字符串分解成数组
    $arr=explode('%', $redisData);
    //两秒入库一次，减缓myql压力
    sleep(2);
    //预编译、执行数据
    $stmt=$pdo->prepare($sql);
    $stmt->execute($arr);
    $rows=$stmt->rowCount();
    if($rows>0){
        echo '数据入库成功<br/>';
    }else {
        $redis->lPush($redis_name,$redisData);
        echo '入库失败<br/>';
    }
}
//释放资源
$redis->close();
unset($pdo);