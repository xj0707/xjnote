<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/19
 * Time: 18:28
 */
namespace core\lib;
use core\lib\conf;
class log{
    public static $class;
    public static function init(){
        //确定存储方式
        $drive=conf::get('DRIVE','log');
        $class='\core\lib\drive\log\\'.$drive;
        self::$class=new $class;
    }
    public static function log($name,$file='log'){
        self::$class->log($name,$file);
    }
}