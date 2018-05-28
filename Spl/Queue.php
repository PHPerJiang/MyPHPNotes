<?php
header('content-type:text/html;charset=utf-8');
/*队列，先进先出，后进后出  */
$queue = new SplQueue();                //实例化spl队列
$queue->enqueue('PHPerJiang');          //入队
$queue->enqueue('男');
$queue->enqueue('23');

echo $queue->dequeue().'<br/>';         //出队
echo $queue->dequeue().'<br/>';
echo $queue->dequeue().'<br/>';