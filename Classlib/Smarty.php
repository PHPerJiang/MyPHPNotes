<?php 
require_once 'Smarty.class.php';
/**
 * smarty配置类
 * 做了smarty的基础配置并写了变量注册方法（可批量注册）及模板展示方法
 * @author 姜宇
 *
 */
class View {
    //句柄
    public static $obj;
    //私有构造方法防止通过new方法实例化
    private function __construct(){
       
    }
    //通过静态方法获取实例化对象
    public static function  getInstance(){
        if(self::$obj){
            return self::$obj;
        }else {
            self::$obj=new Smarty();
            self::$obj->left_delimiter='{';
            self::$obj->right_delimiter='}';
            self::$obj->template_dir='html';    //配置模板文件存放位置
            self::$obj->compile_dir='data/template_c';  //配置编译文件存放位置
            //self::$obj->caching=false;
            return self::$obj;
        }
    }
    //批量变量注册方法
    public static function assign($arr){
        self::getInstance();
        foreach ($arr as $key =>$value){
            self::$obj->assign($key,$value);
        }
    }
    //模板变量展示方法
    public static function display($tpl){
        self::getInstance();
        self::$obj->display($tpl);
    }
}
