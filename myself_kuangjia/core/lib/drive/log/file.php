<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/19
 * Time: 18:32
 */
//文件驱动
namespace core\lib\drive\log;
use core\lib\conf;

class file{
    public $path;//文件日志存储路径
    public function __construct()
    {
        $conf=conf::get('OPTION','log');
        $this->path=$conf['PATH'];
    }
    public function log($message,$file='log'){
        /**
         * 1.确定文件存储位置是否存在
         * 2.写入日志
         */
        if(!is_dir($this->path.date('Ymd'))){
            mkdir($this->path.date('Ymd'),'0777',true);
        }
        return file_put_contents($this->path.date('Ymd').'/'.$file.'.html',date('Y-m-d H:i:s').':'.json_encode($message).PHP_EOL,FILE_APPEND);
    }
}