<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/16
 * Time: 16:09
 */
/**
 * 入口文件  定义常量  加载函数库 启动框架
 */
//realpath('./');获得当前文件所在的目录
//dirname(__FILE__);获得当前文件所在的目录
header("Content-type:text/html;charset=utf-8");
define('XIAO',dirname(__FILE__));//定义项目所在目录路径
define('CORE',XIAO.'/core');//定义核心文件所在路径
define('APP',XIAO.'/app');//项目文件所在目录
define('MODULE','app');;
define('DEBUG',true);//是否开启debug调试模式
if(DEBUG){
    ini_set('display_errors','On');
}else{
    ini_set('display_errors','Off');
}
//加载函数库
include CORE.'/common/function.php';
include CORE.'/xiao.php';
//加载路由
spl_autoload_register('\core\xiao::load');//当实例的类不存在的时候触发这个方法加载这个load方法
//运行框架
\core\xiao::run();