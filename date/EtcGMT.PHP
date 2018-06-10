<?php
/*将 03:23:32 格式的时间转换为秒 */
date_default_timezone_set('Etc/GMT');
$time='03:23:32';
echo strtotime('1970-1-1 '.$time);
date_default_timezone_set('PRC');

//原理是格林威治时间是从1970-1-1开始计算时间的