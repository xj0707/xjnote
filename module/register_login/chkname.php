<?php
/**
 * 用户名的ajax验证是否存在
 */
require_once './function.php';
require_once '../../pdo/PDOMysql.class.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['name'])){
        $name=filterStr($_POST['name']);
        if($name){
            $pdomysql=new PDOMysql();
            $sql="select * from x_member where name='$name'";
            $userinfo=$pdomysql->getRow($sql);
            if($userinfo){
                echo  json_encode(['code'=>2,'message'=>'名称已存在']);
            }else{
                echo  json_encode(['code'=>1,'message'=>'名称合法']);
            }
        }else{
            echo  json_encode(['code'=>3,'message'=>'没有任何信息']);
        }
    }
}



