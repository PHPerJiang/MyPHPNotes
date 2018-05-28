<?php
header('content-type:text/html;charset=utf-8');
/*堆  */

$heap= new SplMinHeap();
$heap->insert('PHPerJiang');
$heap->insert('23');

echo $heap->extract().'<br/>';
echo $heap->extract().'<br/>';