<?php
header('content-type:text/html;charset=utf-8');
$string='hello world';
print($string);
echo '<hr/>';

$str=array(             //声明一维数组
    1=>'hello',
    2=>'world！',
    3=>'I',
    4=>'am',
    5=>'PHPerJiang'
);
echo '遍历一维数组:';
foreach ($str as $key){         //循环遍历以为数组
    echo $key.' ';  
}

echo '<hr/>';
//计算数组中元素的个数
echo '统计一维数组内元素个数'.count($str).'<hr/><br/>';

$str1=array(             //声明二维数组
    'PHP'=>array(1=>'hello',2=>'world'),
    'ASP'=>array(1=>'HELLO',2=>'WORLD')
);
echo '遍历二维数组：';
foreach ($str1 as $key=>$value){        //遍历二维数组
    foreach ($str1[$key] as $key1=>$value1){
        echo $value1.' ';
    }
}
echo '<br/>统计二维数组内元素个数：'.count($str1,COUNT_RECURSIVE).'<hr/><br/>';

//array_search用于在数组中搜索指定的值，找到后返回键名，否则返回false,常用于购物车中商品数量的修改
echo 'str中值为am的键名为：'.array_search('am', $str).'<hr/><br/>';

//获取数组中的最后一个元素，并且将数组长度减一
print_r($str);
$str_pop=array_pop($str);
echo '<br/>';
echo '获取的数组最后一个元素为:'.$str_pop;
echo '<br/>'.'数组长度减一';
print_r($str);
echo '<br/><hr/><br/>';

//向数组中添加元素
print_r($str);
echo '<br/>象数组中添加元素';
array_push($str, 'i','love','PHP','PHP','PHP');
print_r($str);
echo '<br/>删除数组中重复部分：';

//删除数组中重复元素
print_r(array_unique($str));
echo '<br/>';

/*获取数组中所有的键名  */
echo '获取数组中所有的键名';
var_dump(array_keys($str));
echo '<hr/>';

/*获取数组中所有的值  */
echo '获取数组中所有的值';
var_dump(array_values($str));
echo '<hr/>';

/*  array 的第一个单元移出并作为结果返回，将 array 的长度减一并将所有其它单元向前移动一位。所有的数字键名将改为从零开始计数，文字键名将不变。 */
echo ' array 的第一个单元移出并作为结果返回，将 array 的长度减一并将所有其它单元向前移动一位。所有的数字键名将改为从零开始计数，文字键名将不变。';
echo '<br/>左出栈';
var_dump(array_shift($str));
echo '<hr/>';

/*将传入的单元插入到 array 数组的开头。注意单元是作为整体被插入的，因此传入单元将保持同样的顺序。所有的数值键名将修改为从零开始重新计数，所有的文字键名保持不变  */
echo '将传入的单元插入到 array 数组的开头。注意单元是作为整体被插入的，因此传入单元将保持同样的顺序。所有的数值键名将修改为从零开始重新计数，所有的文字键名保持不变';
echo '<br/>左入栈';
var_dump(array_unshift($str,'hello'));
echo '<hr/>';

/*  将一个或多个单元压入数组的末尾（入栈）  */
echo ' 将一个或多个单元压入数组的末尾（入栈） ';
echo '<br/>右入栈';
var_dump(array_push($str, 'PHPerJiang'));
echo '<hr/>';

/*   弹出数组最后一个单元（出栈）*/
echo ' 弹出数组最后一个单元（出栈）';
echo '<br/>右出栈';
var_dump(array_pop($str));
echo '<hr/>';

/*  对数组排序*/
echo '对数组排序';
var_dump(sort($str,SORT_STRING ));
echo '<hr/>';