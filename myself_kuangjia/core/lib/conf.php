<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/19
 * Time: 17:50
 */
namespace core\lib;
class conf{
    public static $conf=array();//缓存，加载后直接返回防止多加载
    //加载单个配置
    public static function get($name,$file){
        /**
         * 1.判断配置文件是否存在
         * 2.判断配置的变量是否存在
         * 3.缓存配置
         */
        //var_dump(self::$conf);
        if(isset(self::$conf[$file])){
            return self::$conf[$file][$name];
        }else{
            $path=XIAO.'\core\config\\'.$file.'.php';
            if(is_file($path)){
                $conf=include $path;
                if(isset($conf[$name])){
                    self::$conf[$file]=$conf;
                    return $conf[$name];
                }else{
                    throw new \Exception('没有这个配置项'.$name);
                }
            }else{
                throw new \Exception('没有找到该配置文件'.$file);
            }
        }

    }
    //加载整个配置
    public static function all($file){
        if(isset(self::$conf[$file])){
            return self::$conf[$file];
        }else{
            $path=XIAO.'\core\config\\'.$file.'.php';
            if(is_file($path)){
                $conf=include $path;
                self::$conf[$file]=$conf;
                return $conf;
            }else{
                throw new \Exception('没有找到该配置文件'.$file);
            }
        }
    }

}