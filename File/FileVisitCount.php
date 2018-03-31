<?php
header('content-type:text/html;charset=utf-8');
$file='VisitCount.txt';         //设置储存文件
$count=empty(file_get_contents($file))?0:file_get_contents($file);//设置访问数量初始值
++$count;//访问页面一次数量加1
$fp=fopen($file, 'r+');//只读方式打开文件，写入时覆盖之前文件
fwrite($fp, $count);//写入文本
fclose($fp);//关闭文件
readfile($file);//读取文件内容