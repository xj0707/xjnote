<?php
require_once './function.php';
require_once '../../pdo/PDOMysql.class.php';
/**
 * 激活用户
 */
if($_SERVER['REQUEST_METHOD']=='GET'){
    $token=isset($_GET['token'])?$_GET['token']:'';
    if($token){
        $info=encry_code($token,'DECODE');
        $info=unserialize($info);
        $pdomysql=new PdoMySQL();
        if($info['time']+60*60-time()<0){
            $sql='DELETE FROM x_member WHERE id='.$info['id'];
            $pdomysql->execute($sql);
            echo "<script>alert('激活时间已经过期！')</script>";
            exit;
        }
        $sql='UPDATE x_member SET active=1 WHERE id='.$info['id'];
        $res=$pdomysql->execute($sql);
        if($res){
            echo "<script>alert('激活成功！跳转登录页面！！');window.location.href='login.html'</script>";
            //如果需求是直接进入成功页面 那么这里保存session类操作
        }else{
            echo "<script>alert('激活失败！！')</script>";
        }
    }
}