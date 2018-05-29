<?php
namespace Common\User;
use Interfaces\User;
/*实现策略模式的接口  */
class Man implements User{
    public function name(){
        echo 'My name is Man';
    }
    public function age(){
        echo 'I am 23';
    }
}