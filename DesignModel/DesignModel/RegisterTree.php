<?php
namespace DesignModel;
/*注册树模式，一般与工厂模式连用 ，需要先使用一次工厂模式启用注册数中的set方法注册
 * 才可以在其他地方使用注册数模式的获取类方法 */
class RegisterTree{
    protected static $object;
    static function set($alias,$obj){
        self::$object[$alias]=$obj;
    }
    static function get($alias){
        return self::$object[$alias];
    }
    static function _unset($alias){
        unset(self::$object[$alias]);
    }
}