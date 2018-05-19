<?php
/*PHP内置函数考察  */

/*数据序列化和反序列化 ，  序列化只能序列除resource之外的类型 */
$arr=['PHPerJiang','man',23];
var_dump(serialize($arr));          //序列化数据
var_dump(unserialize(serialize($arr)));     //反序列化

/*反转字符串函数  */
$string='PHPerJiang';
echo strrev($string);

