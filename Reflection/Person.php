<?php 
/*检测Reflection的样例类  */
class Person {
    const SEX=1;
    protected $name=null;
    protected static $alias=null;
    protected $age=0;
    public function setName($_name){
        $this->name=$_name;
    }
    public function getName(){
        return $this->name;
    }
    public function setAlias($_alias){
        self::$alias=$_alias;
    }
    public function getAlias(){
        return self::$alias;
    }
    public static function setAge($_age){
        $this->age=$_age;
    }
    public static function getAge(){
        return $this->age;
    }
}