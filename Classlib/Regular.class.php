<?php
/**
 * 正则验证类
 * 1.验证值是否存在
 * 2.验证是否是合法email
 * 3.验证是否是合法url
 * 4.验证是否是合法手机号
 * @author 姜宇
 *
 */
class Regular {
    //私有数组按键名定义匹配模式
    private $validate = array(
        'require'   =>  '/.+/',
        'email'     =>  '/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/',
        'url'       =>  '/^http(s?):\/\/(?:[A-za-z0-9-]+\.)+[A-za-z]{2,4}(?:[\/\?#][\/=\?%\-&~`@[\]\':+!\.#\w]*)?$/',
        'mobile'	=>	'/^1(3|4|5|7|8)\d{9}$/',
        //'number'    =>  '/^\d+$/',
        //'integer'   =>  '/^[-\+]?\d+$/',
        //'double'    =>  '/^[-\+]?\d+(\.\d+)?$/',
        //'english'   =>  '/^[A-Za-z]+$/',
        //'qq'		=>	'/^\d{5,11}$/',
    );
    //是否返回结果集
    private $returnMatchResult = false;
    //修正模式
    private $fixMode = null;
    //结果集
    private $matches = array();
    //结果标识
    private $isMatch = false;
    /**
     * 构造函数，默认不返回结果集不使用修正模式
     * @param string $returnMatchResult
     * @param unknown $fixMode
     */
    public function __construct($returnMatchResult = false, $fixMode = null) {
        $this->returnMatchResult = $returnMatchResult;
        $this->fixMode = $fixMode;
    }
    /**
     * 私有模式验证核心
     * @param unknown $pattern
     * @param unknown $subject
     * @return array|boolean
     */
    private function regex($pattern, $subject) {
        //验证预定义数组中是否存在pattern
        if(array_key_exists(strtolower($pattern), $this->validate)){
            //将匹配规则和修正模式连接起来
            $pattern = $this->validate[$pattern].$this->fixMode;
        }
        //使用三目运算符，如果开启了返回结果集则将结果及存入matches中，反之则将判断结果存入isMatch
            $this->returnMatchResult ?
            preg_match_all($pattern, $subject, $this->matches) :
            $this->isMatch = preg_match($pattern, $subject) === 1;
            return $this->getRegexResult();
    }
    /**
     * 返回验证结果
     * @return array|boolean
     */
    private function getRegexResult() {
        if($this->returnMatchResult) {
            return $this->matches;
        } else {
            return $this->isMatch;
        }
    }
    /**
     * 切换验证模式
     * @param unknown $bool
     */
    public function toggleReturnType($bool = null) {
        if(empty($bool)) {
            $this->returnMatchResult = !$this->returnMatchResult;
        } else {
            $this->returnMatchResult = is_bool($bool) ? $bool : (bool)$bool;
        }
    }
    /**
     * 设值修正模式
     * @param unknown $fixMode
     */
    public function setFixMode($fixMode) {
        $this->fixMode = $fixMode;
    }
    /**
     * 验证非空
     * @param unknown $str
     * @return array|boolean
     */
    public function noEmpty($str) {
        return $this->regex('require', $str);
    }
    /**
     * 验证是否是合法Email
     * @param unknown $email
     * @return array|boolean
     */
    public function isEmail($email) {
        return $this->regex('email', $email);
    }
    /**
     * 验证是否是合法Url
     * @param unknown $url
     * @return array|boolean
     */
    public function isUrl($url){
        return $this->regex('url', $url);
    }
    /**
     * 验证是否是合法Mobile
     * @param unknown $mobile
     * @return array|boolean
     */
    public function isMobile($mobile) {
        return $this->regex('mobile', $mobile);
    }
    /**
     * 调用核心验证的方法
     * @param unknown $pattern
     * @param unknown $subject
     * @return array|boolean
     */
    public function check($pattern, $subject) {
        return $this->regex($pattern, $subject);
    }
    
}