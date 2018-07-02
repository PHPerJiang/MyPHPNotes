<?php 
//入口文件判断
//如果cookie存在，反序列化出数组
if ($user=unserialize($_COOKIE['userToken'])){
    //连接数据库验证令牌
    $pdo=new PDO('mysql:host=localhost;dbname=db','root','');
    $stmt=$pdo->prepare('select usertoken from user where id=?');
    $stmt->execute(array($user[0]));
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    //验证成功绕过登录跳转值首页
    if ($row['usertoken']==$user[1]){
        header('location:index.html');
    }else {
        //验证失败直接跳转至登录
        header('location:login.html');
    }
}else {
    //没有cookie则现取登录
    header('location:login.html');
}