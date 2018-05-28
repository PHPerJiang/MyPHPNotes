<?php
namespace DesignModel;
/*工厂模式，通过在工厂类里的静态方法实例化对象，并返回对象  */
class FactoryModel {
    static function createDatabase(){
        $obj=\Common\Database::getInstance();
        RegisterTree::set('db', $obj);
        return $obj;
    }
}