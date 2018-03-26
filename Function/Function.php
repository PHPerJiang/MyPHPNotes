<?php 

/**
 * C函数,用来实例化控制器，并调用控制器内方法
 * @param 控制器名 $name
 * @param 控制器内方法$method
 * @return Obj
 */
function C($name,$method){
    require_once 'libs/Controller/'.$name.'Controller.class.php';
    $controller=$name.'Controller';
    $obj=new $controller();
    $obj->$method();
    return $obj;
}

/**
 * M函数 ，用来实例化模型
 * @param 模型名 $name
 * @return obj
 */
function M($name){
    require_once 'libs/Model/'.$name.'Model.class.php';
    $model=$name.'Model';
    $obj=new $model();
    return $obj;
}

/**
 * V函数，用来实例化视图
 * @param 视图名 $name
 * @return obj
 */
function V($name){
    require_once 'libs/View/'.$name.'View.class.php';
    $view=$name.'View';
    $obj=new $view();
    return  $obj;
}


function checkStr($str){
    return (get_magic_quotes_gpc()?$str:addslashes($str));
}