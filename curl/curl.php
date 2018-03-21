<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/8
 * Time: 11:31
 */
/*php curl
 * *
//四个步骤
//1.初始化curl_init();
//2.设置变量curl_setopt();
/*三个重要的选项：
    CURLOPT_URL 指定请求的URL；
    CURLOPT_RETURNTRANSFER 设置为1表示稍后执行的curl_exec函数的返回是URL的返回字符串，而不是把返回字符串定向到标准输出并返回TRUE；
    CURLLOPT_HEADER设置为0表示不返回HTTP头部信息。
*/
//3.执行并获取结果curl_exec();如果没有错误发生，该函数的返回是对应URL返回的数据，以字符串表示满意；如果发生错误，该函数返回 FALSE。需要注意的是，判断输出是否为FALSE用的是全等号，这是为了区分返回空串和出错的情况
//4.释放curl句柄curl_close();
//curl_exec()执行之后，可以使用$info=crul_getinfo($ch);var_dump($info);
//PHP为我们提供一个函数http_build_query();p拼接成URL的兴衰

//example
//get 方式
$url='http://a.cn/';
//$ch=curl_init();
//curl_setopt($ch,CURLOPT_URL,$url);
//curl_setopt($ch,CURLOPT_HEADER,0);
//curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
//$res=curl_exec($ch);
//var_dump(curl_getinfo($ch));

//post方式
$data=['name'=>'supadminxj','password'=>'admin'];
$datastr=http_build_query($data);
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_HEADER,0);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_POST,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$datastr);
curl_setopt($ch,CURLOPT_HTTPHEADER,array(
    'application/x-www-form-urlencoded;charset=utf-8',
    'Content-length: '.strlen($datastr)
));
$res=curl_exec($ch);
var_dump($res);
curl_close($ch);

//curl 可以模拟登陆。。。。
