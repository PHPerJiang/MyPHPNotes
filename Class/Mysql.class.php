<?php
class mysql{
    
   private static $con=null;
  /**
   * 报错函数
   * @param String $error
   */
    function err($error){
      die('数据库操作有误，原因为：'.$error);
  }
  /**
   * 连接数据库函数
   * @param 数据库地址 $dbHost
   * @param 数据库账号 $dbUser
   * @param 数据库密码 $dbPassword
   * @param 数据库名称 $dbName
   * @param 设置字符集 $charset
   * @return 连接成功返回标识符/失败报错
   */
  function connect($config){
      extract($config);//把传入的参数数组转换为变量
      if(!(self::$con=mysqli_connect($dbHost,$dbUser,$dbPwd,$dbName))){
          $this->err('数据库连接失败！');
      }
      if(!$this->query("set names $charset")){
          $this->err(mysqli_error(self::$con));
      }
    }
    /**
     * 执行sql语句返回
     * @param string $sql
     * @return 执行成功返回结果集，失败报错
     */
    function query($sql){
        if(!$result=mysqli_query(self::$con, $sql)){
            $this->err(mysqli_error(self::$con));
        }else {
            return $result;
        }
    }
    
   /**
    * 查询结果集中的所有内容
    * @param 结果集 $result
    * @return 成功返回数组，失败报错
    */
    function findAll($result){
        if($result&&mysqli_num_rows($result)){
            while ($row=mysqli_fetch_assoc($result)){
                $list[]=$row;
            }
            return isset($list)?$list:"";
        }else {
            $this->err(mysqli_error(self::$con));
        }
    }
    /**
     * 查询结果集中的一条结果
     * @param 结果集 $result
     * @return 成功返回一条数据，失败报错
     */
    function findOne($result){
        if($result&&mysqli_num_rows($result)){
            $rs=mysqli_fetch_assoc($result);
            return $rs;
        }else {
            $this->err(mysqli_error(self::$con));
        }
    }
    
  /**
   * 插入函数
   * @param 数据表 $table
   * @param 修改参数 $arr
   * @return 失败报错，成功返回插入行id
   */
   function insert($table,$arr){
       if(isset($arr)){
           foreach ($arr as $key=>$value){
               $value=mysqli_escape_string(self::$con, $value);
               $keyArr[]='`'.$key.'`';
               $valueArr[]="'".$value."'";
           }
           $keys=implode(',', $keyArr);
           $values=implode(',', $valueArr);
       }
       $sql="insert into ".$table."($keys) values(".$values.")";
       if($this->query($sql)){
           return mysqli_insert_id(self::$con);
       }else {
           $this->err(mysqli_error(self::$con));
       }
   }
   
   /**
    * 根据条件修改数据
    * @param 数据表 $table
    * @param 修改参数 $arr
    * @param 条件 $where
    */
   function  update($table,$arr,$where){
       if(isset($arr)){
           foreach ($arr as $key =>$value){
               $value=mysqli_escape_string(self::$con, $value);
               $keyAndvalue[]='`'.$key."`='".$value."'";
           }
           $arrs=implode(',', $keyAndvalue);
       }
       $sql="update $table set ".$arrs." where ".$where;
       if(!$this->query($sql)){
           $this->err(mysqli_error(self::$con));
       }
   }
  /**
   * 删除数据
   * @param 数据表 $table
   * @param 条件 $where
   */
   function delete($table,$where){
       $sql="delete from ".$table." where ".$where;
       if(!$this->query($sql)){
           $this->err(mysqli_error(self::$con));
       }
   }
    
}