<?php
class MyRedis{
    //私有句柄
    private static $handler;
    //私有构造方法防止通过new 方法实例化
    private function __construct(){
        
    }
    //静态方法获取实例
    public static function getInstance(){
        if(!self::$handler){
            self::$handler = new Redis();
            self::$handler -> connect('127.0.0.1','6379');
        }
        return self::$handler;
    }
    //按键名获取redis值ֵ
    public static function get($key){
        $value = self::$handler -> get($key);
        //获取值后反序列化
        $value_serl = @unserialize($value);
        //判断反序列化后是否是数组或者对象，如果是则返回反序列化后的结果
        if(is_object($value_serl)||is_array($value_serl)){
            return $value_serl;
        }
        //如果不是则直接返回值
        return $value;
    }
    //按键值的方式向redis中存数据，并设置过期时间
    public static function set($key ,$value ,$time=0){
        //判断值是否是对象或数组，如果是则序列化后再存入redis
        if(is_object($value)||is_array($value)){
            $value = serialize($value);
        }
        if($time>0){
            return self::$handler -> setex($key,$time,$value);
        }else {
            return self::$handler -> set($key,$value);
        }
        
    }
    //私有方法，防止clone对象
    private function __clone(){
        return false;
    }
}