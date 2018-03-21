<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/16
 * Time: 16:25
 */
namespace core;
use core\lib\log;
class xiao{
    public  static  $classMap=array();//存放已经实例的类
    public $assign;//保存传的值
    static public function run(){
        //实例路由类，会触发sql_autoload_register()方法加载 load方法 加载这个类库
        $route=new \core\lib\route();
        //启动日志
        log::init();
        $controller=$route->ctr;
        $action=$route->action;
        //判断控制器的文件是否存在
        $file=APP.'/controller/'.$controller.'Controller.php';
        $ctrClass='\\'.MODULE.'\controller\\'.$controller.'Controller';
        if(is_file($file)){
            include $file;
            $ctr=new $ctrClass();
            $ctr->$action();
            log::log('controller:'.$controller.'  '.'action:'.$action);
        }else{
            throw new \Exception('找不到控制器：'.$controller);
        }
    }
    //自动加载类库
    static public function load($class){
        if(isset(self::$classMap[$class])){
            return true;
        }
        str_replace('\\','/',$class);
        $class_file=XIAO.'\\'.$class.'.php';
        echo $class_file;
        if(is_file($class_file)){
            include $class_file;
            self::$classMap[$class]=$class;//保存类库下次自己调用
        }else{
            return false;
        }
    }
    //视图传参
    public function assign($name,$value){
        $this->assign[$name]=$value;
    }
    //调用视图文件
    public function display($file){
        $file=APP.'/views/'.$file;
        if(is_file($file)){
            extract($this->assign);
            include $file;
        }
    }

}



















