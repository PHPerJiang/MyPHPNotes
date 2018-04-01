<?php

class upload
{

    protected $fileName;

    protected $maxSize;

    protected $allowMime;

    protected $allowExt;

    protected $imgFlag;

    protected $uploadPath;

    protected $fileInfo;

    protected $error;

    protected $ext;

    protected $destination;

    protected $uniName;

    /**
     *
     * @param string $fileName            
     * @param string $imgFlag            
     * @param string $uploadPath            
     * @param number $maxSize            
     * @param array $allowExt            
     * @param array $allowMime            
     */
    public function __construct($fileName = 'myFile', $imgFlag = true, $uploadPath = "./uploads", $maxSize = 5242880, $allowExt = array('jpg','jpeg','png','gif'), $allowMime = array('image/jpg','image/jpeg','image/png','image/gif'))
    {
        $this->fileName = $fileName;
        $this->maxSize = $maxSize;
        $this->allowExt = $allowExt;
        $this->allowMime = $allowMime;
        $this->uploadPath = $uploadPath;
        $this->imgFlag = $imgFlag;
        $this->fileInfo = isset($_FILES[$this->fileName])?$_FILES[$this->fileName]:null;
    }

    /**
     * 判断错误号
     * 
     * @return boolean
     */
    protected function checkError()
    {
        // var_dump($this->fileInfo);exit();
        if (! empty($this->fileInfo)) {
            if ($this->fileInfo['error'] > 0) {
                switch ($this->fileInfo['error']) {
                    case 1:
                        $this->error = '超过了PHP配置中upload_max_filesize选项中的值！';
                        break;
                    case 2:
                        $this->error = '超过了表单中MAX_FILE_SIZE中的值！';
                        break;
                    case 3:
                        $this->error = '文件部分上传';
                        break;
                    case 4:
                        $this->error = '没有选择上传文件';
                        break;
                    case 6:
                        $this->error = '没有找到临时目录';
                        break;
                    case 7:
                        $this->error = '文件不可写';
                        break;
                    case 8:
                        $this->error = '由于PHP拓展程序中断文件上传！';
                        break;
                }
                return false;
            } else
                return true;
        }else {
            $this->error='上传文件错误';
            return false;
        }
    }

    /**
     * 检测文件大小是否超过规定
     * 
     * @return boolean
     */
    protected function checkSize()
    {
        if ($this->fileInfo['size'] > $this->maxSize) {
            $this->error = '文件大小过大，请上传规定大小文件！';
            return false;
        }
        return true;
    }

    /**
     * 判断文件拓展名是否符合规范
     * 
     * @return boolean
     */
    protected function checkExt()
    {
        $this->ext = pathinfo($this->fileInfo['name'], PATHINFO_EXTENSION);
        if (! in_array($this->ext, $this->allowExt)) {
            $this->error = '请上传规定格式文件！';
            return false;
        }
        return true;
    }

    /**
     * 判断是否是通过HTTP POTST方式上传文件
     * 
     * @return boolean
     */
    protected function checkHTTPPost()
    {
        if (! is_uploaded_file($this->fileInfo['tmp_name'])) {
            $this->error = '不是通过HTTP POST方式上传！';
            return false;
        }
        return true;
    }

    /**
     * 判断文件类型是否符合规定
     * 
     * @return boolean
     */
    protected function checkMime()
    {
        if (! in_array($this->fileInfo['type'], $this->allowMime)) {
            $this->error = '不允许的文件类型！';
            return false;
        }
        return true;
    }

    /**
     * 判断图片文件是否有效
     * 
     * @return boolean
     */
    protected function checkTrueImg()
    {
        if ($this->imgFlag) {
            if (! @getimagesize($this->fileInfo['tmp_name'])) {
                $this->error = '不是真实有效的图片类型！';
                return false;
            }
            return true;
        }
    }

    /**
     * 检测保存目录不存在则创建
     */
    protected function checkUploadPath()
    {
        if (! file_exists($this->uploadPath)) {
            mkdir($this->uploadPath, 0777, true);
            chmod($this->uploadPath, 0777);
        }
    }

    /**
     * 得到一个唯一的名字
     * 
     * @return string
     */
    protected function getUniName()
    {
        return md5(uniqid(microtime(true), true));
    }

    /**
     * 错误提示
     */
    protected function showError()
    {
        exit('<span style="color:red">' . $this->error . '</span>');
    }

    /**
     * 上传文件
     * 
     * @return string
     */
    public function uploadFile()
    {
        if ($this->checkError() && $this->checkSize() && $this->checkExt() && $this->checkHTTPPost() && $this->checkMime() && $this->checkTrueImg()) {
            $this->checkUploadPath();
            $this->uniName = $this->getUniName();
            $this->destination = $this->uploadPath . "/" . $this->uniName . "." . $this->ext;
            if (@move_uploaded_file($this->fileInfo['tmp_name'], $this->destination)) {
                return $this->destination;
            } else {
                $this->error = '上传失败！';
                $this->showError();
            }
        } else {
            $this->showError();
        }
    }
}