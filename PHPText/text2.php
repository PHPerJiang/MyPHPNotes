<?php
/*用三种方式遍历数组  */
$arr1=['PHPerJiang',23,'男'];
$arr2=[
    'name'=>'PHPerJiang',
    'age'=>23,
    'sex'=>'男',
];
print_r($arr1);
echo '<hr>';
print_r($arr2);
echo '<hr>';
/*for循环遍历   只能遍历索引数组*/
for($i=0;$i<count($arr1);$i++){
    echo $arr1[$i]."<br/>";
}
echo "<hr/>";
/*foreach遍历   可以便利索引数组和关联数组*/
foreach ($arr2 as $key => $value){
    echo "$key : $value <br/>";
}
echo '<hr>';
/*while list each 组合遍历数组  */
// var_dump(each($arr2));
while(list($key,$value) = each($arr2)){
    echo "$key : $value <br/>";
}

/*list不是真正的函数，只是语言结构 只能遍历索从0开始的引数组  */
/* each返回数组中当前的键／值对并将数组指针向前移动一步  
 * 在执行 each() 之后，数组指针将停留在数组中的下一个单元或者当碰到数组结尾时停留在最后一个单元。如果要再用 each 遍历数组，必须使用 reset()。 
 * */