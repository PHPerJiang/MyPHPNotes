<?php
namespace Common\User;
use Interfaces\User;
/*实现策略模式的接口  */
class Woman implements User{
    public function name(){
        echo 'My name is Woman';
    }
    public function age(){
        echo 'I am 23';
    }
}