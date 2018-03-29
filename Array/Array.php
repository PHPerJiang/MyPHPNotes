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