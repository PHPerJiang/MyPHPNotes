<?php
namespace Common\Database;
use Interfaces\Database;
//实现数据库适配器接口
class Mysqli implements Database{
    protected static $conn;
    public function connect($host, $user, $password, $dbname){
        self::$conn=mysqli_connect($host,$user,$password,$dbname);
    }
    public function query($sql){
        return mysqli_query(self::$conn, $sql);
    }
    public function close(){
        mysqli_close(self::$conn);
    }
    
}