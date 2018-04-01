<?php
/**
 * cookie的设置、获取、删除、修改
 * @author 姜宇
 *
 */
class Cookie{
   static private $_instance=null;
   private $expire=0;
   private $path='';
   private $domain='';
   private $secure=false;
   private $httponly=false;
   
   /**
    * 构造函数完成cookie初始化工作
    * @param array $options
    */
   private function __construct(array $options=[]){
       $this->setOptions($options);
   }
   /**
    * 设置相关选项
    * @param array $options
    */
   private function setOptions($options=[]){
       if(isset($options['expire'])){
            $this->expire=$options['expire'];
       }
       if(isset($options['path'])){
           $this->path=$options['path'];
       }
       if(isset($options['domain'])){
           $this->domain=$options['domain'];
       }
       if(isset($options['secure'])){
           $this->secure=$options['secure'];
       }
       if(isset($options['httponly'])){
           $this->httponly=$options['httponly'];
       }
   }
   /**
    * 单利模式得到对象
    * @param array $options cookie相关选项
    * @return object        对象实例
    */
   public static function getInstance(array $options=[]){
       if (is_null(self::$_instance)){
           $class=__CLASS__;
           self::$_instance=new $class($options);
       }return self::$_instance;
   }
   /**
    * 设置cookie
    * @param string $name
    * @param mixed $value
    * @param array $options
    */
   public function  set($name,$value,array $options=[]){
       if(is_array($options)&&count($options)>0){
           $this->setOptions($options);
       }
       if(is_array($value)||is_object($value)){
           $value=json_encode($value,JSON_FORCE_OBJECT);//全都当作对象转换结果为 object{content}
       }
       setcookie($name,$value,$this->expire,$this->path,$this->domain,$this->secure,$this->httponly);
   }
   /**
    * 的到指定cookie
    * @param string $name
    * @return mixed|NULL
    */
   public function get($name){
       if(isset($_COOKIE[$name])){
          return substr($_COOKIE[$name],0,1)=='{'?json_decode($_COOKIE[$name]):$_COOKIE[$name]; 
       }else {
           return null;
       }
   }
   /**
    * 删除指定cookie
    * @param string $name
    * @param array $options
    */
   public function delete($name,array $options=[]){
       if(isset($options)&&count($options)>0){
           $this->setOptions($options);
       }
       if(isset($_COOKIE[$name])){
           setcookie($name,'',time()-1,$this->path,$this->domain,$this->secure,$this->httponly);
           unset($_COOKIE[$name]);
       }
   }
   /**
    * 删除所有cookie
    * @param array $options
    */
   public function deleteAll(array $options=[]){
       if(isset($options)&&count($options)>0){
           $this->setOptions($options);
       }
       if(!empty($_COOKIE)){
           foreach ($_COOKIE as $name=>$value){
               setcookie($name,'',time()-1,$this->path,$this->domain,$this->secure,$this->httponly);
               unset($_COOKIE[$name]);
           }
       }
   }
}

$cookie=Cookie::getInstance();
// var_dump($cookie);
// $cookie->set('aaa','111'); 
// $cookie->set('bbb','222',['expire'=>time()+3600]);
// $cookie->set('userInfo',['name'=>'jiang','age'=>23],['ecpire'=>time()+3600]);
// var_dump($cookie->get('userInfo'));
// // echo $cookie->get('aaa');
// $cookie->delete('aaa');
$cookie->deleteAll();