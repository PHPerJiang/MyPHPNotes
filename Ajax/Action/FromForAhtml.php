<?php 
//连接数据库取值并释放资源
$pdo=new PDO('mysql:host=localhost;dbname=db','root','');
$pdo->query('set names utf8');
$sql='select * from page';
$stmt=$pdo->prepare($sql);
$stmt->execute();
$res=$stmt->fetchAll(PDO::FETCH_ASSOC);
$activePage='';
foreach ($res as $key =>$value){
    $activePage.=$value['activepage'];
}
unset($pdo);
//拼接返回数组
$mes=[
    'code'=>1,
    'message'=>'success',
    'data'=>$activePage
];
//返回json字符串
echo json_encode($mes,JSON_UNESCAPED_UNICODE);
