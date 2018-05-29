<?php 
namespace Common;
/**
 * 自动加载类
 * @author 姜宇
 *
 */
class Loader {
    static function autoload($class){
//         var_dump($class);exit;
        require_once BASEDIR.'/'.str_replace('\\', '/', $class).'.php';  
    }
}