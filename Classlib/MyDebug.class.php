<?php
class MyDebug{
    /**
     * 调试输出类
     * @param mix $var  调试源数据
     * @param bool $dump  是否开启var_dump模式
     * @param bool $exit  是否开启断点模式
     */
    public static function debug($var, $dump=false, $exit=true){
        if($dump){
            $func='var_dump';
        }else {
            $func=(is_array($var) || is_object($var))?'print_r':'printf';
        }
        header('content-type:text/html;charset=utf-8');
        echo '<pre>调试结果为：<hr/>';
        $func($var);
        echo '</pre>';
        if($exit)
        exit;
    }
}