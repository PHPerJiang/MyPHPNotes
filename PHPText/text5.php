<?php
/*通过php函数的方式对目录进行遍历，写出程序  */
$dir='./static';
function loopDir($dir){
    $pd=opendir($dir);
    while (false!==($file=readdir($pd))){       //读取的文件名为空则停止循环
        if($file != '.' && $file != '..'){      
            if(!is_dir($dir.'/'.$file)){
                echo $file.'<br/>';
            }else {
                loopDir($dir.'/'.$file);
            }
        }
    }
    closedir($pd);
}

loopDir($dir);