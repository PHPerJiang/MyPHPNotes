<?php
namespace Interfaces;
/**
 *定义数据库适配器接口
 */
interface Database{
    public function connect($host,$user,$password,$dbname);
    public function query($sql);
    public function close();
}
