<?php
$data=[
    'name'=>'PHPerJiang',
    'sex'=>'男',
    'age'=>'23',
];
/*自己拼接jsons格式数据时血药把拼接的数据看成一个字符串  */
$json='{"name":"PHPerJiang","sex":"男","age":"23"}';

/*  '{"name":"PHPerJiang","sex":"\u7537","age":"23"}' 
 * 为了防止中文json转换后乱码问题，需要将数组转换成json格式前把每个值都urlencode一下
 * 转换后用urldecode一下就可以，这样前台ajax接收数据后不会发生中文乱码
 * */
foreach ($data as $key=>$value){
    $data[$key]=urlencode($value);
}

var_dump(urldecode(json_encode($data)));
/* json_decode($data,true)是吧json数据转换成数组，不加true则转换成Object */
var_dump(json_decode($json,true));
var_dump(json_decode(urldecode(json_encode($data)),true));