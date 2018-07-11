<?php
//将指定内容写入文件，如果文件不存在则创建文件，没有第三个参数则会取代之前文件内容，加上第三个参数会将新内容追加进文件
file_put_contents('test.txt', 'I am PHPerJiang'.PHP_EOL,FILE_APPEND);

//返回path中的文件名，第二个参数可以过滤后缀或指定字符串，如果路径是文件夹，则显示最末文件夹
echo basename('fileFunction/fileFucntion.php','.php');
echo '<hr />';

//复制文件，第一个参数为源文件路径，第二个参数为复制后文件路径
copy('./test.txt', './test.txt.back');

//删除文件，两个参数，第一个参数为文件路径
unlink('./test.txt.back');

//一个参数，返回去掉文件名后的目录文件名
echo dirname('File/fileFunction/fileFunction.php');
echo '<hr />';

//以字节数的形式返回目录中的可用空间
echo disk_free_space('D:\WAMPServer\Demo\MyPHPNotes');
echo '<hr />';

//以字节数的形式返回磁盘或者分区的总大小
echo disk_total_space('D:\WAMPServer\Demo\MyPHPNotes');
echo '<hr />';

//feof查看文件指针是否到文件末尾，如果指到EOF或者出错则返回true,其余返回false
$fp=fopen('./test.txt', 'r');
while (!feof($fp)){
    //echo fgetc($fp).'<br />';     //返回文件句柄中的一个字符
    echo fgetss($fp).'<br />';      //返回文件句柄中的一行并去除html表稽
    // echo fgets($fp).'<br />';    //返回文件句柄中的一行
}
echo '<hr />';

//读取文件内容到一个字符串,第4，5个参数是从指定位置截取文件内容
echo file_get_contents('./test.txt');
echo '<br/>'.file_get_contents('./test.txt',null,null,3,9);
echo '<hr />';

//将文件读入数组
var_dump(file('./test.txt'));

//获取文件创建访问和修改时间
echo '上次访问文件时间：'.fileatime('./test.txt');
echo '<br />文件创建时间：'.filectime('./test.txt');
echo '<br />文件修改时间：'.filemtime('./test.txt');
echo '<hr />';








