<?php
/*写一个函数，实现以下功能
 *字符串 'open_door' 转换成 'OpenDoor'
 *字符串'make_by_id'转换成'MakeById'
 **/

function stringTransition($str){
    $res='';
    $arr=explode('_', $str);
    foreach ($arr as $key){
        $res .= ucfirst($key);
    }
    return $res;
}

echo stringTransition('jiang_yu');