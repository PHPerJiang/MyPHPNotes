<?php
header('content-type:text/html;charset=utf-8');
//开启session
session_start();
//接收post数据
$username=empty($_POST['username'])?'':trim($_POST['username']);
$password=md5(empty($_POST['password'])?'':trim($_POST['password']));
$remember=empty($_POST['remember'])?'':$_POST['remember'];
//数据库连接
$pdo= new PDO('mysql:host=localhost;dbname=db','root','');
$sql='select id,username from user where username=? and password=?';
$stmt=$pdo->prepare($sql);
//简单验证用户名密码是否为空
if (!$username || !$password){
    die('用户名或者密码不能为空');
}else {
    //用户登录验证
    $stmt->execute(array($username,$password));
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    if($stmt->rowCount()==1){           //登录成功
        //存一份session
        $_SESSION['userInfo']=$row;
        //勾选一周内存储
        if($remember=='on'){
            //使用用户名加4为随机数经过md5组成32位密文
            $userToken=md5($row['username'].mt_rand(1000,9999));
            //将序列化后的密文存入cookie
            setcookie('userToken',serialize(array($row['id'],$userToken)),time()+3600*24*7);
            $pdo->exec('UPDATE user SET usertoken=\''.$userToken.'\' WHERE id='.$row['id']);
        }
        header("location:index.html");
    }else {             //登录失败
        echo '<script>alert("用户名或者密码错误！");window.location.href="login.html";</script>';
    }
}