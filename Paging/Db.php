<?php
/**
 * PDO类
 * 目前有单例实例化方法和统计总数的方法
 * @author 姜宇
 *
 */
class Db{
    //配置
    private static $dsn='mysql:host=localhost;dbname=db';
    private static $user='root';
    private static $password='';
    //句柄
    private static $pdo;
    //防止通过new方法实例化
    private function __construct(){
        
    }
    //获取实例
    public static function getInstance(){
        return self::connect();
    }
    //获取数据条数
    public static function getRowCount($table){
        self::connect();
        $stmt=self::$pdo->query('select count(*) as count from '.$table);
        $res=$stmt->fetch(PDO::FETCH_ASSOC);
        return $res['count'];
    }
    //连接方法（单例模式）
    private static function connect(){
        if (self::$pdo){
            return self::$pdo;
        }else {
            self::$pdo=new \PDO(self::$dsn,self::$user,self::$password);
            self::$pdo->query('set names utf8');
            return self::$pdo;
        }
        
    }
    //防止克隆对象
    private function __clone(){
        return false;
    }
}