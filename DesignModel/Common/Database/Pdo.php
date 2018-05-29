<?php
namespace Common\Database;
use Interfaces\Database;
/*使用PDO实现数据库适配器接口 */
class Pdo implements Database{
    protected static $conn;
    public function connect($host, $user, $password, $dbname){
        self::$conn=new \PDO("mysql:host=$host;dbname=$dbname",$user,$password);
        
    }
    public function  query($sql){
        return self::$conn->query($sql);
    }
    public function close(){
        unset(self::$conn);
    }
}