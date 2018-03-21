<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/16
 * Time: 18:11
 */
namespace app\controller;
use core\lib\conf;
use core\xiao;
use app\model\userModel;

class IndexController extends xiao{
    public function index(){
        $model=new \core\lib\model();
        $sql="select * from admin_user ";
        $query=$model->query($sql);
        $res= $query->fetchAll();
        $this->assign('res',$res);
        $this->display('index.php');
    }
}