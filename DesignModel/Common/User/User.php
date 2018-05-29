<?php
/*数据映射模式的类  */
namespace Common\User;
class User {
    public $id;
    public $username;
    public $password;
    public $status;
    private $conn;
    /**
     * 类构造方法来获取数据信息
     * @param unknown $id
     */
    public function __construct($id){
        $this->conn=new \Common\Database\Mysqli();
        $this->conn->connect('127.0.0.1', 'root', '', 'db');
        $res=$this->conn->query('select * from admin where id='.$id);
        $row=mysqli_fetch_assoc($res);
        $this->id=$row['id'];
        $this->username=$row['username'];
        $this->password=$row['password'];
        $this->status=$row['status'];
    }
    /**
     *类析构方法来释放资源并更新数据
     */
    public function  __destruct(){
        $this->conn->query("update admin set username='$this->username',password='$this->password',status='$this->status' where id=$this->id" );
        $this->conn->close();
    }
}