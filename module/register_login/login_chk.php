<?php
/**
 * 登陆验证
 */
require_once './function.php';
require_once '../../pdo/PDOMysql.class.php';
session_start();
if($_SERVER['REQUEST_METHOD']=='POST'){
    $name=isset($_POST['name'])?filterStr($_POST['name']):'';
    $pwd=isset($_POST['pwd'])?filterStr($_POST['pwd']):'';
    $chk=isset($_POST['chk'])?filterStr($_POST['chk']):'';
    $reback=1;
    if(!$name || !$pwd || !$chk){//参数不完整
       echo $reback=2;exit;
    }
    $truecode=$_SESSION['truecode'];
    if(strtolower($chk)!=strtolower($truecode)){//验证码不正确
        echo $reback=3;exit;
    }
    $password=md5($pwd);
    $pdomysql=new PdoMySQL();
    $sql="select * from x_member WHERE name='{$name}' and password='$password'";
    $info=$pdomysql->getRow($sql);
    if($info){
        if($info['active']==0){
            echo $reback=5;exit;//该用户还没有激活
        }else{
            $_SESSION['id']=$info['id'];
            $_SESSION['username']=$info['name'];
           echo  $reback=1;exit;//成功
        }
    }else{
        echo $reback=4;exit;//用户名或者密码错误
    }
}