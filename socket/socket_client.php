<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/9
 * Time: 10:14
 */
error_reporting(E_ALL);
set_time_limit(0);
$address = "127.0.0.1";
$port = 2046;
$sock=socket_create(AF_INET,SOCK_STREAM,SOL_TCP) or die("socket_create()失败的原因：".socket_strerror(socket_last_error())."\n");
//连接
socket_connect($sock,$address,$port) or die("socket_create()失败的原因：".socket_strerror(socket_last_error())."\n");
echo "connect ok \n";
//向服务端写入数据
$msg="hello server,my name is client.\n";
socket_write($sock,$msg,strlen($msg));
//读取服务端发送的数据
$buf=socket_read($sock,8129);
echo "server info:".$buf;