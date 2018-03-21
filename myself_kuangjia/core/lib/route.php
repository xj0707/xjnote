<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/16
 * Time: 16:29
 */
namespace core\lib;
use core\lib\conf;
class route{
    public $ctr;
    public $action;
    public function __construct()
    {
        /*
         * 1.隐藏index.php（在根目录下建一个.htaccess文件）
         *2.获取URL参数部分
         *3.返回对应的控制器和方法
         */
        if(isset($_SERVER['PATH_INFO'])){
            //获取控制器名和方法名
            $urlarr=explode('/',trim($_SERVER['PATH_INFO'],'/'));
            if(isset($urlarr[0])){
                $this->ctr=$urlarr[0];
            }
            unset($urlarr[0]);
            if(isset($urlarr[1])){
                $this->action=$urlarr[1];
                unset($urlarr[1]);
            }else{
                $this->action=conf::get('ACTION','route');
            }
            //将URL多余的部位转换成get参数  获取参数
            $count=count($urlarr)+2;
            $i=2;
            while($i<$count){
                if(isset($urlarr[$i+1])){
                    $_GET[$urlarr[$i]]=$urlarr[$i+1];
                }
                $i+=2;
            }
        }else{//默认控制器和方法
            $this->ctr=conf::get('CONTROLLER','route');
            $this->action=conf::get('ACTION','route');
        }
    }

}