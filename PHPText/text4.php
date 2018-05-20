<?php
/* 不断的再hello.txt文件头部写入 hello world 字符串，要求代码完整 */

$file='./static/hello.txt';
$fp=fopen($file,'r');
$content=fread($fp, filesize($file));
$newContent = 'Hello World '.$content;
fclose($fp);

$fp=fopen($file,'w');
fwrite($fp, $newContent);
fclose($fp);

var_dump(file_get_contents($file));

