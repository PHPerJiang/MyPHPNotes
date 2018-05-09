<?php
$data=$_POST;
if($data['username']=='PHPerJiang' && $data['password']== '123'){
    //通过head方式进行页面跳转，location:后不能有空格
    /* header('location:../CreateAjax.html'); */
    //通过meta标签实现页面跳转
    echo '<meta http-equiv="refresh" content="0;url=../CreateAjax.html">';
}else {
    //通过js来实现跳转
    echo "<script>window.location.href='../FormExample.html';</script>";
}