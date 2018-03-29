<?php
header('conten-type:text/html;charset=utf-8');
$string='%I "am PHPer Jiang , I am a better man!oh! I am really a better man!%';
$string1='really';
echo $string.'<br/>'.$string1.'<hr/><br/>';

//过滤首位空格和或指定特殊字符
echo '过滤首位空格和或指定特殊字符'.trim($string,'%').'<hr/>';
//过滤左边空格或者指定特殊字符
echo '过滤左边空格或者指定特殊字符'.ltrim($string,'%').'<hr/>';
//过滤右边空格或者指定特殊字符
echo '过滤右边空格或者指定特殊字符'.rtrim($string,'%').'<hr/>';
//自动转义特殊符号,所有数据在插入数据库前都应该使用addslashes()函数进行转义，防止特殊字符在插入数据库前出错，出数据库时再进行还原
echo '自动转义特殊符号'.addslashes($string).'<hr/>';
//还原转义，可以用于数据加密
echo '还原转义'.stripcslashes(addslashes($string)).'<hr/><br/><br/>';
//获取字符串长度
echo  '获取字符串长度:'.strlen($string).'<hr/>';
//截取字符串,web显示超长文本的部分内容使用substr($string,0,30).'...'
echo '截取定长字符串：'.substr($string,0,10).'<hr/>';
//比较字符串大小  相等返回0 大于返回值大于0 小于返回值小于0
echo '比较字符串大小  相等返回0 大于返回值大于0 小于返回值小于0:'.strcmp($string, $string1).'<hr/>';
//字符串检索，获取一个指定字符串在另一个字符串中首次出现的位置到后者末尾的字符串，若执行成功，则返回剩余字符串，没找打返回false
echo '字符串检索:'.strstr($string, $string1).'<hr/>';
//字符串检索,于strstr相反，strrchr是从字符串后面开始检索的
echo '字符串检索：'.strrchr($string, $string1).'<hr/>';
//获取指定字符在字符串中出现的次数
echo '获取指定字符在字串中出现的次数：'.substr_count($string,'rea').'<hr/>';
//字符串替换
echo '字符串替换区分大小写'.str_replace('rea', 'REA', $string).'<hr/>';
echo '字符串替换不区分大小写'.str_ireplace('REA', 'rea', $string).'<hr/>';
echo '常用在关键字描红'.str_ireplace('really', '<font color="#FF0000">really</font>', $string).'<hr/>';
//字符串替换，在指定位置替换
echo '字符串替换，在指定位置替换:'.substr_replace($string1, $string,6).'<hr/>';
//格式化字符串
$string2=12345.678;
echo '保留整数:'.number_format($string2).'<hr/>';
echo '保留两位小数:'.number_format($string2,2).'<hr/><br/><br/>';

//分割字符串
$string3='h@a@##@ahakd@adnk%';
echo '分割字符串成为一个数组';
$str=explode('@', $string3);
print_r($str);
echo '<hr/><br/>';
echo '把数组合成字符串'.implode('-', $str).'<hr/><br/>';

