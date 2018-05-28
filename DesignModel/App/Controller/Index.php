<?php 
namespace App\Controller;
class Index {
    static function Index(){
        echo 'Hello Word';
        $sql= new \Common\Database();
        $sql->where('id =1')->order('id desc')->limit(5);//自定义链式操作
    }
}