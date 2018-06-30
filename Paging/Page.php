<?php 
/**
 * 分页类
 * @author 姜宇
 *在写完这个类之后，应用的时候，使用pdo预编译sql语句的时候发现limit ?,?必须使用bindValue()来绑定参数否则执行execute()后结果为空
 */
class Page{
    private $rowCount;          //记录总数
    private $pageList;          //显示的页数
    private $currentPage;       //当前页
    private $totalPage;         //总页数
    private $pageSize;          //每页显示条数
    private $href;              //页码连接
    private $page_arr=array();  //保存生成的页码，键为页码，值为连接
    /**
     * 
     * @param int $rowCount 记录总数
     * @param int $pageList 分页显示数
     * @param int $pageSize 页面大小
     * @param int $currentPage 当前页面
     * @param string $href  连接
     */
    public function __construct($rowCount ,$currentPage ,$pageSize=2 ,$pageList=5 ,$href=''){
      $this->rowCount = $rowCount;
      $this->pageSize = $pageSize;
      $this->pageList = $pageList;
      $this->currentPage = $currentPage;
      if ($href==''){
          $this->href = $_SERVER['PHP_SELF'];   //获取当前 php 文件相对于网站根目录的位置地址
      }else {
          $this->href = $href;
      }
      $this->calculatePage();
    }
    /**
     * 显示分页条，设置分页样式，可以通过添加pageStyleNum来添加样式
     * @param int $style
     * @return string
     */
    public function showPage($style=1){
         $func='pageStyle'.$style;
         return $this->$func();
     }
     /**
      * 分页条样式1
      * @return string
      */
     private function pageStyle1(){
         $pageStr='共'.$this->rowCount.'条记录，每页显示'.$this->pageSize.'条 ';
         $pageStr.='当前第'.$this->currentPage.'/'.$this->totalPage.'页 ';
         $_GET['page'] = 1;
         $pageStr.='<span>[<a href="'.$this->href.'?'.http_build_query($_GET).'">首页</a>] </span>';
         //如果当前页不是第一页就显示上页
         if($this->currentPage>1){
             $_GET['page'] = $this->currentPage-1;
             $pageStr.='<span>[<a href="'.$this->href.'?'.http_build_query($_GET).'">上页</a>] </span>';
         }
         foreach ($this->page_arr as $k => $v) {
             $_GET['page'] = $k;
             $pageStr.='<span>[<a href="'.$v.'">'.$k.'</a>] </span>';
         }
         //如果当前页小于总页数就显示下一页
         if($this->currentPage<$this->totalPage){
             $_GET['page'] = $this->currentPage+1;
             $pageStr.='<span>[<a href="'.$this->href.'?'.http_build_query($_GET).'">下页</a>] </span>';
         }
         
         $_GET['page'] = $this->totalPage;
         $pageStr.='<span>[<a href="'.$this->href.'?'.http_build_query($_GET).'">尾页</a>] </span>';
         
         return $pageStr;
     }
    /**
     * 计算分页数据
     */
    private function calculatePage(){
        //计算总页数
        $this->totalPage = ceil($this->rowCount / $this->pageSize);
        //根据显示页计算页页面偏移量
        $pageOffset = floor($this->pageList / 2);
        //计算分页列表的起始
        //根据当前页和页面偏移量计算左起点
        $left = max($this->currentPage-$pageOffset ,1);
        //根据当前页和偏移量的和与总页数比较计算右结束点
        $right = min($this->currentPage+$pageOffset ,$this->totalPage);
        //根据右结束点重新确立左起点，实现右边不足左边补
        $left = max($right-$this->pageList+1 ,1);
        //循环给分页列表赋值
        for ($i=$left ; $i<=$right ; $i++){
            $_GET['page']=$i;
            $this->page_arr[$i]=$this->href.'?'.http_build_query($_GET);
        }
        
    }
}