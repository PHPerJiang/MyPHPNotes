<?php
/**
 * @Author: jiangyu01
 * @Time: 2019/6/4 17:07
 */
class Http {
	private static $is_multi = false;  //是否并发请求
	private static $callstack = [];    // 并发调用的准备栈
	private static $raw_params = [];   // 并发调用的原始请求

	/**
	 *
	 * curl_multi调用例子:
	$this->load->library("http");
	Http::multi_prepare();
	$response = Http::request("http://127.0.0.2:8080/test/r", "hello", 'POST', false, [
	]);
	$response = Http::request("http://127.0.0.1:8080/test/r", "hello1", 'POST', false, [
	]);
	$ret = Http::multi_perform(false, 3);
	 */

	/**
	 * 准备并发
	 * @Author: jiangyu01
	 * @Time: 2019/6/6 16:30
	 */
	public static function multi_prepare(){
		self::multi_cancel();  //取消未发送的任务
		self::$is_multi = true; //设置并发
	}

	public static function multi_perform($with_detail = 0, $retry_times = 0){
		if (!self::$is_multi || empty(self::$raw_params)){
			self::$is_multi = false;
			return [];
		}
		$cur_times = 0;  //当前次数
		$result_arr = array_fill(0, count(self::$raw_params), false); //预留结果集 默认false
		do {
			//收集本轮要发起的请求下标
			$params_indexes = [];
			foreach ($result_arr as $i => $value){
				//如果还没其请求 || 上次请求有错 || 状态码 != 200,则记录请求下标
				if (empty($value) || $value['error'] != 0 || $value['response_header']['http_code'] != 200){
					$params_indexes[] = $i;
				}
			}
			//如果没有需要发起的请求，则退出
			if (empty($params_indexes)){
				break;
			}
			//发起记录下标的这一批请求
			$result_once = self::multi_perform_once($params_indexes);
			//将结果回填至result_arr中
			foreach ($result_once as $i => $result_item){
				$result_arr[$params_indexes[$i]] = $result_item;
			}
		} while($cur_times++ < $retry_times);

		// 执行到这里, 至少每个请求都发起过一次curl调用, 只需要整理一次结果即可
		if (!$with_detail){
			foreach ($result_arr as $i => $result_item){
				$result_arr[$i] = $result_item['errno'] ? false : $result_item['content'];
			}
		}

		//结束并发
		self::multi_cancel();
		return $result_arr;
	}

	/**
	 * 取消并发，清理未发出去的任务
	 * @Author: jiangyu01
	 * @Time: 2019/6/6 16:32
	 */
	public static function multi_cancel(){
		if (!self::$is_multi){
			return;
		}
		self::$raw_params = []; //清空缓存的请求
		self::$is_multi = false; //关闭并发
	}

	/**
	 * 发起一个http/https请求
	 * @param $url
	 * @param array $params
	 * @param string $method
	 * @param bool $multi
	 * @param array $extheaders
	 * @param array $args
	 * @return bool|mixed
	 * @Author: jiangyu01
	 * @Time: 2019/6/6 16:27
	 */
	public static function request($url,$params = array(), $method = "GET", $multi = false, $extheaders = array(), $args = array()){
		if (!function_exists('curl_init')){
			exit('Must need to open the curl extension!');
		}
		//并发调用，拦截原始请求
		if (self::$is_multi){
			self::$raw_params[] = [ $url, $params, $method, $multi, $extheaders, $args];
			return true;
		}
		//非并发，则直接发起请求
		return self::do_request($url, $params, $method, $multi, $extheaders, $args);
	}

	/**
	 * 发起一批并发请求
	 * @param $params_indexes
	 * @return array
	 * @Author: jiangyu01
	 * @Time: 2019/6/6 17:32
	 */
	private static function multi_perform_once($params_indexes){
		//准备并发调用栈，先进后出
		foreach ($params_indexes as $index){
			$params = self::$raw_params[$index];
			self::do_request($params[0],$params[1],$params[2],$params[3],$params[4],$params[5]);
		}

		//初始化并发句柄
		$multi_handle = curl_multi_init();

		//单个请求信息添加到并发请求信息
		foreach (self::$callstack as $item){
			//item => [url, header, ch]
			$headers = self::remove_repeat_headers($item[1]);  //单个请求的http header
			curl_setopt($item[2],CURLOPT_URL,$item[0]);  //设置请求地址
			if (!empty($headers)){
				curl_setopt($item[2],CURLOPT_HTTPHEADER, $headers); //设置请求头
			}
			curl_multi_add_handle($multi_handle,$item[2]);  //单个句柄添加到并发句柄
		}

		//开始并发 -- 开发手册上有这一段
		$active = NULL;
		do {
			$mrc = curl_multi_exec($multi_handle, $active);
		} while ($mrc == CURLM_CALL_MULTI_PERFORM);

		while ($active && $mrc == CURLM_OK) {
			while (curl_multi_exec($multi_handle, $active) === CURLM_CALL_MULTI_PERFORM);
			if (curl_multi_select($multi_handle) != -1) {
				do {
					$mrc = curl_multi_exec($multi_handle, $active);
				} while ($mrc == CURLM_CALL_MULTI_PERFORM);
			}
		}

		//整理结果
		$res = [];
		while (!empty(self::$callstack)){
			$item = array_pop(self::$callstack);
			$handle = $item[2];

			$errno = curl_errno($handle); //错误码
			$error = curl_error($handle); //错误描述
			$content = $errno ? false : curl_multi_getcontent($handle);  //获取应答
			$response_header = $errno ? ['http_code' => $errno] : curl_getinfo($handle);

			$res[] = [
				'errno' => $errno,
				'error' => $error,
				'content' => $content,
				'response_header' => $response_header
			];
			//移除并发中的单个句柄
			curl_multi_remove_handle($multi_handle, $handle);
			//关闭单个句柄
			curl_close($handle);
		}
		//关闭并发句柄
		curl_multi_close($multi_handle);
		return array_reverse($res); //因为是栈，先进后出，所以返回结果时要倒序一下
	}

	/**
	 * 发起请求
	 * @param $url
	 * @param array $params
	 * @param string $method
	 * @param bool $multi
	 * @param array $extheaders
	 * @param array $args
	 * @return bool|mixed
	 * @Author: jiangyu01
	 * @Time: 2019/6/6 15:58
	 */
	private static function do_request($url,$params = array(), $method = "POST", $multi = false, $extheaders = array(), $args = array()){
		$timeout = isset($args['timeout']) ? intval($args['timeout']) : 3;
		$method  = strtoupper($method);  //将请求方法设置为大写
		$ch      = curl_init();   //初始化curl
		curl_setopt($ch,CURLOPT_USERAGENT,"CoderJiang PHP CURL 2019.06.04");   //设置请求头字符串
		curl_setopt($ch,CURLOPT_URL,$url);      //设置请求地址
		curl_setopt($ch,CURLINFO_CONNECT_TIME,$timeout); //设置连接时间
		curl_setopt($ch,CURLOPT_TIMEOUT,$timeout);   //设置请求超时时间
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);   //返回原生输出
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);  //禁止 CURL 验证对等证书
		curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false); //禁止检查服务器SSL证书中是否存在一个公用名。
		curl_setopt($ch,CURLOPT_HEADER,false);   //禁止启动时启用时会将头文件的信息作为数据流输出。

		$extheaders = (array)$extheaders;  //强制将头信息转为数组
		$default_headers = [];             //默认header头

		switch($method){
			case "POST":
				curl_setopt($ch,CURLOPT_POST,true);    //设置发送post请求
				if (!empty($params)){
					if ($multi){        //是否批量
						curl_setopt($ch, CURLOPT_POST,$params);
						$default_headers = "Expect: ";
					}else{
						if (is_array($params)){
							$params = http_build_query($params);
						}else{
							// 支持raw data POST
							$default_headers[] = "Content-Type: application/octet-stream";
						}
						curl_setopt($ch,CURLOPT_POST,$params);  //设置请求体
					}
				}
				break;
			case "GET":
				if (!empty($params)){
					$url = $url.(strpos($url, '?') ? '&' : '?').(is_array($params) ? http_build_query($params) : $params);
				}
				break;
		}

		curl_setopt($ch, CURLINFO_HEADER_OUT, TRUE);   //追踪句柄的请求字符串
		curl_setopt($ch, CURLOPT_URL, $url);    //设置请求地址

		//优先级  default_headers < extheaders
		$headers = array_merge($default_headers, $extheaders);
		//按照key来进行请求头去重，优先级高有优先级低的
		$headers = self::remove_repeat_headers($headers);
		//设置请求头
		if ($headers && !self::$is_multi){
			curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
		}
		//如果是并发请求则将请求缓存起来，等之后一起发送
		if (self::$is_multi){
			self::$callstack [] = [$url, $headers, $ch];
			return true;
		}

		//串行操作则立刻发起请求获取相应
		$response = curl_exec($ch);
//		//返回错误代码 没有错误返回0 一共88种错误代码
//		$curl_errno = curl_errno($ch);
//		if ($curl_errno != 0){
//			$response_header['http_code'] = $curl_errno;
//		}else{
//			//获取最后一次传输的相关信息
//			$response_header = curl_getinfo($ch);
//		}
		//关闭资源
		curl_close($ch);
		return $response;
	}

	/**
	 * 去除headers中重复的header头
	 * @param $headers
	 * @return array
	 * @Author: jiangyu01
	 * @Time: 2019/6/6 15:19
	 */
	private static function remove_repeat_headers($headers){
		$header_maps = [];
		foreach ($headers as $header){
			list($key, $value) = explode(':',$header);
			$header_maps[$key] = $value;
		}
		$headers = [];
		foreach ($header_maps as $key => $value){
			$headers[] = "{$key}:{$value}";
		}
		return $headers;
	}
}