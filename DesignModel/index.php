<?php
/*自动加载  */
define('BASEDIR', __DIR__);
require BASEDIR.'/Common/Loader.php';
spl_autoload_register('\\Common\\Loader::autoload');

/*使用注册树模式需要先注册，没有注册就使用get方法就会为Null数组  */
// \DesignModel\FactoryModel::createDatabase();
// var_dump(DesignModel\RegisterTree::get('db'));

/*调用数据库适配器  */
// $db= new Common\Database\Mysqli();
// $db->connect('127.0.0.1', 'root', '','db');
// $res=$db->query('select * from admin');
// $db->close();

/*调用策略模式  */
// $type=null;
// if(isset($_GET['type'])&& $_GET['type']=='man'){
//     $obj=new \Common\User\Man();        //根据上下文情况调用不同的策略
//     $type=$obj->name();
// }elseif (isset($_GET['type'])&& $_GET['type']=='woman'){
//     $obj=new \Common\User\Woman();
//     $type=$obj->name();
// }
// echo $type;

/*数据对象映射模式  */
// $user=new \Common\User\User(44);
// echo $user->username='PHPerJiang';

/*观察者模式  */
/*事件类继承观察者产生者抽象类并调用通知其方法  */
class Event extends Abstracts\EventGenerator{
    public function trigger(){
        echo 'this has happend an Event<br/>';
        $this->notify();//事件触发调用通知方法
    }
}
/*实现观察者接口完成修改逻辑  */
class Observer1 implements Interfaces\Observer{
    public function update(){
        echo '逻辑1----<br/>';
    }
}
class Observer2 implements Interfaces\Observer{
    public function update(){
        echo '逻辑2----<br/>';
    }
}
$obj = new Event();
//添加观察者
$obj->addObserver(new Observer1);
$obj->addObserver(new Observer2);
$obj->trigger();

