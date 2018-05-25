<?php
/*顺序查找算法，最常见的查找算法 
 *平均时间复杂度O(n)
 **/
$arr=[43,23,65,47,78,55,36,98,23,8];
function SeqSelect($arr,$search){
    $res=[];
    foreach ($arr as $key =>$value){
        if($search == $value){
            $res[]=$key;
        }
    }
    return empty($res)?"不存在$search":$res;
}
echo '存在，下标为<br/>';
var_dump(SeqSelect($arr, 23));