<?php
$province['sd']='青岛,威海,烟台';
$province['bj']='北京';
$data=$_POST;
foreach ($province as $key =>$value){
    if($key==$data['province']){
        echo $value;
    }
}
