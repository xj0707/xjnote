<?php
/**
 * ajax 验证验证码是否正确
 */
session_start();
$truecode=$_SESSION['truecode'];
if($_SERVER['REQUEST_METHOD']=='POST'){
    $code=isset($_POST['chk'])?$_POST['chk']:'';
    if($code){
        if(strtolower($code)==strtolower($truecode)){
            echo json_encode(['code'=>1,'msg'=>'success']);
            exit;
        }
    }
}
echo json_encode(['code'=>2,'msg'=>'fail']);
