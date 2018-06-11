<?php
class MyRedis{
    //句柄
    private static $handler;
    //私有构造方法，防止使用new来实例化
    private function __construct(){
        
    }
    //单例模式获取实例
    public static function getInstance(){
        if(!self::$handler){
            self::$handler = new Redis();
            self::$handler -> connect('127.0.0.1','6379');
        }
        return self::$handler;
    }
    //获得redis值
    public static function get($key){
        $value = self::$handler -> get($key);
        //反序列化值，是用来存储数组对象的数据
        $value_serl = @unserialize($value);
        if(is_object($value_serl)||is_array($value_serl)){
            return $value_serl;
        }
        return $value;
    }
    //向redis存数据 key-value-time，其中time为过期时间
    public static function set($key ,$value ,$time=0){
        if(is_object($value)||is_array($value)){
            $value = serialize($value);
        }
        if($time>0){
            return self::$handler -> setex($key,$time,$value);
        }else {
            return self::$handler -> set($key,$value);
        }
        
    }
    //防止对象被clone
    private function __clone(){
        return false;
    }
}