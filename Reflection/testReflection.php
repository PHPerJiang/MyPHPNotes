<?php 
/*php的反射机制
 * 它是指在PHP运行状态中，扩展分析PHP程序，导出或提取出关于类、方法、属性、参数等的详细信息，包括注释。这种动态获取的信息以及动态调用对象的方法的功能称为反射API。反射是操纵面向对象范型中元模型的API，其功能十分强大，可帮助我们构建复杂，可扩展的应用。
 *其用途如：自动加载插件，自动生成文档，甚至可用来扩充PHP语言。
 * php反射api由若干类组成，可帮助我们用来访问程序的元数据或者同相关的注释交互。借助反射我们可以获取诸如类实现了那些方法，创建一个类的实例（不同于用new创建），调用一个方法（也不同于常规调用），传递参数，动态调用类的静态方法。
 *反射api是php内建的oop技术扩展，包括一些类，异常和接口，综合使用他们可用来帮助我们分析其它类，接口，方法，属性，方法和扩展。这些oop扩展被称为反射。
 *通过ReflectionClass，我们可以得到Person类的以下信息：
 *    1）常量 Contants
 *    2）属性 Property Names
 *    3）方法 Method Names静态
 *    4）属性 Static Properties
 *    5）命名空间 Namespace
 *    6)Person类是否为final或者abstract  
 */
require_once 'Person.php';
$obj=new ReflectionClass('Person');
/*获取制定内部属性  */
$data=$obj->getProperties(ReflectionProperty::IS_PROTECTED | ReflectionProperty::IS_STATIC);
var_dump($data);
echo '<hr/>';
