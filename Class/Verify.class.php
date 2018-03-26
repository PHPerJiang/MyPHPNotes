<?php
class verify{
    private $fontfile='';//�����ļ�
    private $width=200;//�������
    private $height=50;//�����߶�
    private $fontsize=20;//�����С
    private $length=4;//��֤�볤��
    private $image=null;//������ʶ��
    private $snow_num=0;//ѩ���ĸ���
    private $pixel_num=0;//���ص�ĸ���
    private $line_num=0;//�߶εĸ���
    /**
     * ��ʼ������
     * @param array $config
     * @return boolean|resource
     */
    public function __construct($config=array()){
        //��������ļ��Ƿ���ڲ����Ƿ�ɶ�
        if(is_array($config)&&count($config)>0){
           //����Ƿ��������ļ�
            if(isset($config['fontfile'])&&is_file($config['fontfile'])&&is_readable($config['fontfile'])){
               $this->fontfile=$config['fontfile']; 
            }else{
                return false;
            }
            //��⻭����͸�
            if(isset($config['width'])&&$config['width']>0){
                $this->width=$config['width'];
            }
            if(isset($config['height'])&&$config['height']>0){
                $this->height=$config['height'];
            }
            
            //��������С
            if(isset($config['fontsize'])&&$config['fontsize']>0){
                $this->fontsize=$config['fontsize'];
            } 
            //�����֤�볤��
            if(isset($config['length'])&&$config['length']>0){
                if($config['length']>30){
                    return false;
                }else {
                    $this->length=$config['length'];
                }
            }
            //���ø���Ԫ��
            if(isset($config['snow'])&&$config['snow']>0){
                $this->snow_num=$config['snow'];
            }
            if(isset($config['pixel'])&&$config['pixel']>0){
                $this->pixel_num=$config['pixel'];
            }
            if(isset($config['line'])&&$config['line']>0){
                $this->line_num=$config['line'];
            }
            //��������
            $this->image=imagecreatetruecolor($this->width, $this->height);
            return $this->image;

        }else {
            return false;
        }   
    }
        /**
         * �õ���֤��
         * @return boolean|string
         */
        public function getVerify(){
        //������Ϊ��ɫ    
        $white=imagecolorallocate($this->image, 255, 255, 255);
        imagefilledrectangle($this->image, 0, 0, $this->width, $this->height, $white);
        //������֤��
        $str=$this->getString();
        if($str==false){
            return false;
        }
        //������֤��
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
        //���ø���Ԫ��ѩ��
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
        
        //���ͼ��
        header('content-type:image/png');
        imagepng($this->image);
        imagedestroy($this->image);
        return strtolower($str);
        
    }
    /**
     * �õ�����Ԫ��ѩ��
     * @param unknown $snow_num
     */
    private function getSnow(){
        for ($i=0;$i<$this->snow_num;$i++){
            imagechar($this->image, mt_rand(1,5), mt_rand(0,$this->width), mt_rand(0,$this->height), '*', $this->getRandColor());
        }
    }
    /**
     * �õ����ص�
     */
    private function getPixel(){
        for ($i=0;$i<$this->pixel_num;$i++){
            imagesetpixel($this->image, mt_rand(0,255), mt_rand(0,255), $this->getRandColor());
        }
    }
    /**
     * �õ��߶�
     */
    private function getLine(){
        for($i=0;$i<$this->line_num;$i++){
            imageline($this->image, mt_rand(0,$this->width), mt_rand(0,$this->height), mt_rand(0,$this->width), mt_rand(0,$this->height), $this->getRandColor());
        }
    }
    /**
     * ����һ�������ɫ
     * @return number
     */
    private function getRandColor(){
        return imagecolorallocate($this->image, mt_rand(0,255),  mt_rand(0,255),  mt_rand(0,255));
    }
   /**
    * �õ���֤���ַ�
    * @param number $length
    * @return boolean|string
    */
    private function  getString(){
        $string=join('', array_merge(range(0, 9),range('a', 'z'),range('A', 'Z')));
        return substr(str_shuffle($string),1,4); 
    }
}