<?php
namespace DesignModel;
/*注册树模式，一般与工厂模式连用 ，需要先使用一次工厂模式启用注册数中的set方法注册
 * 其实就是现先实例化一次，然后将其注册在注册树上，之后通过注册树来调用，不用原始的调用方式
 * 才可以在其他地方使用注册数模式的获取类方法 */
class RegisterTree{
    protected static $object;
    /*
     * 注册对象，可以起别名
     */
    static function set($alias,$obj){
        self::$object[$alias]=$obj;
    }
    /**
     * 通过别名来从注册树上获取对象
     * @param unknown $alias
     * @return unknown
     */
    static function get($alias){
        return self::$object[$alias];
    }
    /**
     * 销毁注册树上的对象
     * @param unknown $alias
     */
    static function _unset($alias){
        unset(self::$object[$alias]);
    }
}