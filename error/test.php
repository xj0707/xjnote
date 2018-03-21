<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/21
 * Time: 16:36
 */
header("content-type:text/html;charset=utf-8");
//显示所有错误
error_reporting(-1);//error_reporting(E_ALL);
//不显示所有错误
error_reporting(0);
//通过ini_set设置
ini_set('error_reporting',0);//不显示所有错误
ini_set('display_errors',0);//关闭错误显示
//设置错误用户自己的错误级别
trigger_error('这是自定义错误',E_USER_WARNING);
//记录错误，跟踪错误
ini_set('log_errors','on');//开启错误日志
ini_set('error_log','D:\wamp\www\xiaojun\error\error.log');//设置错误日志存放位置
$username="admin";
$password='admin';
$data=date("Y-m-d H:i:s");
$ip=$_SERVER['REMOTE_ADDR'];
$message="用户：{$username}在{$data}用密码：{$password}尝试登陆系统！IP地址为{$ip}";;
error_log($message);//写入日志
//error_log()；还可以发送邮件给管理员 报告系统发送错误了 可以了解




//自定义错误提示
function myError($errno,$errmsg,$file,$line){
    echo "错误代码号：{$errno} 错误信息：{$errmsg}".PHP_EOL;
    echo "错误的行号：在{$file}文件中的第{$line}行".PHP_EOL;
}
echo $test;
set_error_handler('myError');//这是个回调函数
restore_error_handler();//这个关闭自己定义的错误提示 采用系统默认的