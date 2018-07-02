<?php
/**
 * 使用curl向webserver发送post请求,获取某地区天气
 */
header('content-type:text/html;charset=utf-8');
$place='乳山';
//初始化curl
$ch=curl_init();
//请求地址
curl_setopt($ch, CURLOPT_URL, 'www.webxml.com.cn/WebServices/WeatherWS.asmx/getWeather');
//不现实header头
curl_setopt($ch, CURLOPT_HEADER, 0);
//将结果存入字符串而不是输出
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//POST数据
curl_setopt($ch, CURLOPT_POST, 1);
//请求数据
curl_setopt($ch, CURLOPT_POSTFIELDS, 'theCityCode='.$place.'&theUserID=');
//获取用户信息
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
//执行curl
$output=curl_exec($ch);
//关闭curl释放资源
curl_close($ch);
echo $output;