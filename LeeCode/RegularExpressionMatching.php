<?php
/**
 * Created by PhpStorm.
 * User: jiangyu01
 * Date: 2018/10/1
 * Time: 15:27
 * Title :
 * 给定一个字符串 (s) 和一个字符模式 (p)。实现支持 '.' 和 '*' 的正则表达式匹配。
 * '.' 匹配任意单个字符。
 * '*' 匹配零个或多个前面的元素。
 * s 可能为空，且只包含从 a-z 的小写字母。
 * p 可能为空，且只包含从 a-z 的小写字母，以及字符 . 和 *。
 */

$s = 'asdasd';     //被搜索字符串
$p = 'sd.';                  //搜索串

function RegularExpressionMatching(string $s, string $p) {
    $sign = $p[strlen($p)-1];   //获取匹配规则
    if (strlen($s) == 0) {      //判断被搜索字符串是否为空
        $result = FALSE;
        GOTO END;
    }
    if ($sign == '*'){          //*匹配
        $search = substr($p,0,strlen($p)-1);        //获取搜索字符串
        if (strlen($search) <= 0){                              //判断搜索字符串是否为空
            $result = FALSE;
            GOTO END;
        }
        if (strpos($s, $search) !== FALSE){                         //搜索匹配
            $result = TRUE;
        }else{
            $result = FALSE;
        }
    }elseif ($sign == '.'){     //.匹配
        $search = substr($p,0,strlen($p)-1);        //获取搜索字符串
        if (strlen($search) <= 0){
            $result = FALSE;
            GOTO END;
        }
        $position = stripos($s,$search);                            //获取搜索字符串的第一个字符在被搜索字符串出现的位置
        if (isset($s[$position+strlen($search)]) && !empty($s[$position+strlen($search)])){     //判断匹配到的匹配到的搜索字符串之后一个字符是否存在
            $result = TRUE;
        }else{
            $result = FALSE;
        }
    }else{                      //普通匹配
        if ($p == $s){
            $result = TRUE;
        }else{
            $result = FALSE;
        }
    }
    END:
    var_dump($result);
}
RegularExpressionMatching($s, $p);