<?php
/*不适用php内置函数实现strrev()函数的功能  */
function stringReversal($str){
    $res='';
    for ($i=1;true;$i++){
        if(!isset($str[$i])){
            break;
        }
    }
    for ($j=$i-1;$j>=0;$j--){
        $res .= $str[$j];
    }
    return $res;
}
echo '输入字符串：PHPerJiang<br/>';
echo '返回字符串：'.stringReversal('PHPerJiang');