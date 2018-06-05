<?php
//定义生成静态页面路径
$file_url='../staticHtml/FormForShtml.shtml';
//判断如果静态页面存在或未过期则先访问静态文件否则从库中查询并生成缓存
if(is_file($file_url) && (time()-filemtime($file_url)<20)){
    require_once $file_url;
}else{
    //连接数据库读取数据并释放资源
    $pdo=new PDO('mysql:host=localhost;dbname=db','root','');
    $pdo->query('set names utf8');
    $sql='select * from page limit 2';
    $stmt=$pdo->prepare($sql);
    $stmt->execute();
    $res=$stmt->fetchAll(PDO::FETCH_ASSOC);
    $staticPage='';
    foreach ($res as $key =>$value){
        $staticPage.=$value['staticpage'];
    }
    unset($pdo);
    //开启一个新的buffer缓存
    ob_start();
    //引入模板文件
    require_once '../templates/FormForShtml.php';
    //将将缓存区内容添添加到静态页面中
    file_put_contents($file_url, ob_get_contents());
}
