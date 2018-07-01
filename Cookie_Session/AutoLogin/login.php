<?php
header('content-type:text/html;charset=utf-8');
session_start();
$username=empty($_POST['username'])?'':trim($_POST['username']);
$password=md5(empty($_POST['password'])?'':trim($_POST['password']));
$remember=empty($_POST['remember'])?'':$_POST['remember'];

$pdo= new PDO('mysql:host=localhost;dbname=db','root','');
$sql='select id,username from user where username=? and password=?';
$stmt=$pdo->prepare($sql);
if (!$username || !$password){
    die('用户名或者密码不能为空');
}else {
    $stmt->execute(array($username,$password));
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    if($stmt->rowCount()==1){
        $_SESSION['userInfo']=$row;
        if($remember=='on'){
            $userToken=md5($row['username'].mt_rand(1000,9999));
            setcookie('userToken',serialize(array($row['id'],$userToken)),3600*24);
            $pdo->exec('UPDATE user SET usertoken=\''.$userToken.'\' WHERE id='.$row['id']);
        }
        header("location:index.html");
    }else {
        die('用户名或密码错误');
    }
}