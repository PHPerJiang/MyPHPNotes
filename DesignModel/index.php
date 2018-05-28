<?php
use DesignModel\RegisterTree;

define('BASEDIR', __DIR__);
require BASEDIR.'/Common/Loader.php';
spl_autoload_register('\\Common\\Loader::autoload');
/*使用注册树模式需要先注册，没有注册就使用get方法就会为Null数组  */
\DesignModel\FactoryModel::createDatabase();
var_dump(RegisterTree::get('db'));