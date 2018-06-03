<?php
//接收请求并校验
$code=$_GET['code'];
if($code!=1) return false;

//实例化reids类并连接
$redis = new Redis();
$redis->connect('127.0.0.1',6379);
$redis_name='userlist';
//模拟100人抢购,只能模拟高压力，不能模拟高并发
$mes='';
for ($i=1;$i<=100;$i++){
    //模拟userid、orderid并拼装
    $userid=mt_rand(1000,9999);
    $orderid=mt_rand(10000,99999);
    $data=$userid.'%'.$orderid.'%'.time();
    //限制队列长度，超过长度抢购失败
    if($redis->lLen($redis_name)>=10){
       $mes.=$i.'抢购失败';
    }else {
        $redis->lPush($redis_name,$data);
        $mes.=$i.'抢购成功';
    }
}
//关闭redis释放资源
$redis->close();
//返回数据
echo json_encode(array('mes'=>$mes),JSON_UNESCAPED_UNICODE);

