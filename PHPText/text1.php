<?php
/*写一个函数有效率的获取当前url的后缀 例如：php .php  */

$url='https://www.2345.com/index.php/index/index?m=2';
echo $url.'<br/>';
$b=parse_url($url);
print_r($b);
echo '<br/>'.substr($b['path'], strpos($b['path'], '.'),4);
echo '<br/>'.@substr(end(explode('.',$b['path'])),0,3);