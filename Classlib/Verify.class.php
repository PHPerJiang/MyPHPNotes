<?php
class verify{
    private $fontfile='';//字体文件
    private $width=200;//画布宽度
    private $height=50;//画布高度
    private $fontsize=20;//字体大小
    private $length=4;//验证码长度
    private $image=null;//画布标识符
    private $snow_num=0;//雪花的个数
    private $pixel_num=0;//像素点的个数
    private $line_num=0;//线段的个数
    /**
     * 初始化数据
     * @param array $config
     * @return boolean|resource
     */
    public function __construct($config=array()){
        //检测字体文件是否存在并且是否可读
        if(is_array($config)&&count($config)>0){
           //检测是否有字体文件
            if(isset($config['fontfile'])&&is_file($config['fontfile'])&&is_readable($config['fontfile'])){
               $this->fontfile=$config['fontfile']; 
            }else{
                return false;
            }
            //检测画布宽和高
            if(isset($config['width'])&&$config['width']>0){
                $this->width=$config['width'];
            }
            if(isset($config['height'])&&$config['height']>0){
                $this->height=$config['height'];
            }
            
            //检测字体大小
            if(isset($config['fontsize'])&&$config['fontsize']>0){
                $this->fontsize=$config['fontsize'];
            } 
            //检测验证码长度
            if(isset($config['length'])&&$config['length']>0){
                if($config['length']>30){
                    return false;
                }else {
                    $this->length=$config['length'];
                }
            }
            //配置干扰元素
            if(isset($config['snow'])&&$config['snow']>0){
                $this->snow_num=$config['snow'];
            }
            if(isset($config['pixel'])&&$config['pixel']>0){
                $this->pixel_num=$config['pixel'];
            }
            if(isset($config['line'])&&$config['line']>0){
                $this->line_num=$config['line'];
            }
            //创建画布
            $this->image=imagecreatetruecolor($this->width, $this->height);
            return $this->image;

        }else {
            return false;
        }   
    }
        /**
         * 得到验证码
         * @return boolean|string
         */
        public function getVerify(){
        //填充矩形为白色    
        $white=imagecolorallocate($this->image, 255, 255, 255);
        imagefilledrectangle($this->image, 0, 0, $this->width, $this->height, $white);
        //生成验证码
        $str=$this->getString();
        if($str==false){
            return false;
        }
        //绘制验证码
        for ($i=0;$i<$this->length;$i++){
            $image=$this->image;
            $size=$this->fontsize;
            $angle=mt_rand(-15,15);
            $x=ceil(20+$i*40);
            $y=ceil($this->height/1.5);
            $color=$this->getRandColor();
            $fontfile=$this->fontfile;
            $text=$str[$i]; 
            imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);
        }
        //设置干扰元素雪花
        if($this->snow_num){
            $this->getSnow();
        }else {
            if($this->pixel_num){
                $this->getPixel();
            }
            if($this->length){
                $this->getLine();
            }
        }
        
        //输出图像
        header('content-type:image/png');
        imagepng($this->image);
        imagedestroy($this->image);
        return strtolower($str);
        
    }
    /**
     * 得到干扰元素雪花
     * @param unknown $snow_num
     */
    private function getSnow(){
        for ($i=0;$i<$this->snow_num;$i++){
            imagechar($this->image, mt_rand(1,5), mt_rand(0,$this->width), mt_rand(0,$this->height), '*', $this->getRandColor());
        }
    }
    /**
     * 得到像素点
     */
    private function getPixel(){
        for ($i=0;$i<$this->pixel_num;$i++){
            imagesetpixel($this->image, mt_rand(0,255), mt_rand(0,255), $this->getRandColor());
        }
    }
    /**
     * 得到线段
     */
    private function getLine(){
        for($i=0;$i<$this->line_num;$i++){
            imageline($this->image, mt_rand(0,$this->width), mt_rand(0,$this->height), mt_rand(0,$this->width), mt_rand(0,$this->height), $this->getRandColor());
        }
    }
    /**
     * 返回一个随机颜色
     * @return number
     */
    private function getRandColor(){
        return imagecolorallocate($this->image, mt_rand(0,255),  mt_rand(0,255),  mt_rand(0,255));
    }
   /**
    * 得到验证码字符
    * @param number $length
    * @return boolean|string
    */
    private function  getString(){
        $string=join('', array_merge(range(0, 9),range('a', 'z'),range('A', 'Z')));
        return substr(str_shuffle($string),1,4); 
    }
}