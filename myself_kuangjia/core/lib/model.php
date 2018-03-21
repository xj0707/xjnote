<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/19
 * Time: 17:02
 */
namespace core\lib;
use core\lib\conf;
class model extends \PDO{
    public function __construct()
    {
        $conf=conf::all('database');
        try{
            parent::__construct($conf['DSN'], $conf['USERNAME'], $conf['PWD']);
        }catch(\PDOException $e){
            echo $e->getMessage();
        }

    }
}