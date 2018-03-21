<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/8
 * Time: 16:56
 */
//即时通讯
//workman(框架 了解)
//服务端
set_time_limit(0);//确保在连接客服端时不会超时
//设置IP和端口号
$address = "127.0.0.1";
$port = 2046; //调试的时候，可以多换端口来测试程序！
//创建一个socket;AF_INET=是ipv4 如果用ipv6，则参数为 AF_INET6
//SOCK_STREAM为socket的tcp类型，如果是UDP则使用SOCK_DGRAM
$sock=socket_create(AF_INET,SOCK_STREAM,SOL_TCP) or die("socket_create()失败的原因：".socket_strerror(socket_last_error())."\n");
//阻塞模式
socket_set_block($sock) or die("socket_set_block()失败的原因：".socket_strerror(socket_last_error())."\n");
//绑定到socket
socket_bind($sock,$address,$port) or die("socket_bind()失败的原因：".socket_strerror(socket_last_error())."\n");
//开始监听
socket_listen($sock,4) or die("socket_listen()失败的原因：".socket_strerror(socket_last_error())."\n");
echo "ok\n Now ready to accept connections\n";
do{
    //接收连接请求并调用一个socket来处理客户端和服务器间的信息；
    $msgsock=socket_accept($sock) or die("socket_accept()失败的原因：".socket_strerror(socket_last_error())."\n");
    //向客服端写入信息
    $msg="my name is server,hello! \n";
    socket_write($msgsock,$msg,strlen($msg));
    //读取客服端传来的信息
    $buf=socket_read($msgsock,8192);
    echo 'client info:'.$buf;
}while(true);
//关闭socket;
//socket_close($sock);