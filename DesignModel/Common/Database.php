<?php
namespace Common;
/*链式操作  */
class Database {
    protected static $db;           //声明静态属性，用作存储实例化后的对象
    /**
     * 定义私有初始化方法为空，让该类无法通过new方法实例化
     */
    private function __construct(){     
        
    }
    /**使用getinstance方法来判断该类是否已经被实例化，如果已经被实例化则返回实例化结果否则
     *否则先实例化对象再返回 
     * @return \Common\Database
     */
    static function getInstance(){      
        if(self::$db){
            return self::$db;
        }else {
            self::$db=new self();
            return self::$db;
        }
    }
    function where($where){
        /*操作  */
        return $this;   //函数加上return $this 会成为链式操作
    }
    function order($order){
        /*操作  */
        return $this;
    }
    function limit($limit){
        /*操作  */
        return $this;
    }
}
