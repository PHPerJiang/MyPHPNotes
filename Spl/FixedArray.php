<?php
/*固定长度数组，当实例化出来时，就分配好了内存  */
header('content-type:text/html;charset=utf-8');

$arr= new SplFixedArray(5);
$arr[0]='PHPerJiang';
$arr[2]=23;

var_dump($arr);