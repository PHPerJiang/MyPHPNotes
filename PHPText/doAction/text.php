<?php
$title=$_POST['title'];
$content=$_POST['content'];
$username=$_POST['username'];
if(empty($title) && empty($content) && empty($username)){
    exit('信息填写错误');
}
try {
    $dbtype='mysql';
    $host='localhost';
    $dbname='db';
    $dbuser='root';
    $password='';
    $dsn="$dbtype:host=$host;dbname=$dbname";
    $sql="insert into message_text (title,content,date,username) values(:title,:content,:date,:username)";
   if(!$pdo=new PDO($dsn,$dbuser,$password)){
    exit('连接失败');
   }else {
       $pres=$pdo->prepare($sql);
       $data=[
           ':title'=>$title,
           ':content'=>$content,
           ':date'=>time(),
           ':username'=>$username
       ];
       $pres->execute($data);
       $res=$pres->rowCount();
       if($res>0){
           echo '发表成功';
       }else {
           echo '发表失败';
       }
   }
    
}catch (PDOException $e){
    exit($e->getMessage());
}