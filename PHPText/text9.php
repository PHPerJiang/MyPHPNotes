<?php
/*不使用php内置函数实现array_merge函数的功能  */
function mergeArray(){
    $res=[];
    $arr=func_get_args();
    foreach($arr as $key){
        if(is_array($key)){
            foreach ($key as $keys){
                $res[]=$keys;
            }
        }
    }
    return $res;
}

var_dump(mergeArray([1,1],['PHPer','Jiang']));