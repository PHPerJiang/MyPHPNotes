<?php
/**
 * 使用curl抓取页面到当前文件的两种方式
 */
header('content-type:text/html;charset=utf-8');
/*第一种方式使用curl_setopt配置  */

//初始化curl
$ch=curl_init();
//选项设置
//设置抓取页面
curl_setopt($ch, CURLOPT_URL, 'http://www.baidu.com/');
//抓取结果直接返回（如果设置0，则直接输出内容到页面）
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//设置不需要页面的http头
curl_setopt($ch, CURLOPT_HEADER, 0);
//执行并获取html文档内容，可用echo 输出
$output= curl_exec($ch);
//关闭curl
curl_close($ch);
echo $output;

/*第二种方式使用配置写入文件  */
// $ch=curl_init('http://www.baidu.com/');
// $fp=fopen('CurlExample01.html', 'w');
// curl_setopt($ch, CURLOPT_FILE, $fp);
// curl_setopt($ch, CURLOPT_HEADER, 0);
// curl_exec($ch);
// curl_close($ch);
// fclose($fp);


