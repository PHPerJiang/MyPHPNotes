<?php
namespace Abstracts;
/*观察者模式
 * 声明一个抽象类，作为时间产生者  */
abstract class EventGenerator{
    private $Observers= [];
    /**
     * 添加观察者
     * @param \Observer $Observer
     */
    public function addObserver(\Interfaces\Observer $Observer){
        $this->Observers[]=$Observer;
    }
    /**
     *事件触发后，观察者需要做出的响应 
     */
    public function notify(){
        foreach ($this->Observers as $observer){
            $observer->update();
        }
    }
}