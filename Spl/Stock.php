<?php
header('content-type:text/html;charset=utf-8');
/*栈，具有先进后出的特点  */
$stack = new SplStack();        //实例化sql栈
$stack->push('PHPerJiang');     //入栈
$stack->push('男');  
$stack->push('23');

echo $stack->pop().'<br/>';             //出栈
echo $stack->pop().'<br/>';
echo $stack->pop().'<br/>';