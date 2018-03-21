<?php
/**
 * 注册页面验证 并发送邮件
 */
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
require_once './function.php';
require_once '../../pdo/PDOMysql.class.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
    $data=[];
    $data['name']=isset($_POST['name'])?filterStr($_POST['name']):'';
    $pwd1=isset($_POST['pwd1'])?filterStr($_POST['pwd1']):'';
    $pwd2=isset($_POST['pwd2'])?filterStr($_POST['pwd2']):'';
    $data['email']=isset($_POST['email'])?filterStr($_POST['email']):'';
    $data['question']=isset($_POST['question'])?filterStr($_POST['question']):'';
    $data['answer']=isset($_POST['answer'])?filterStr($_POST['answer']):'';
    if(!$data['name'] || !$pwd1 || !$data['email']){
        echo  json_encode(['code'=>3,'message'=>'参数不完整']);
        exit;
    }
    if($pwd1 != $pwd2){
        echo  json_encode(['code'=>4,'message'=>'两次密码不一致']);
        exit;
    }
    $data['password']=md5($pwd1);
    $data['createtime']=time();
    $data['updatetime']=time();
    $pdomysql=new PDOMysql();
    $sql="select * from x_member where name='".$data['name']."'";
    $infos=$pdomysql->getRow($sql);
    if($infos){
        echo  json_encode(['code'=>7,'message'=>'用户名已经存在']);
        exit;
    }
    $res=$pdomysql->add($data,'x_member');
    if($res){
        $id=$pdomysql->getLastInsertId();
        $info=[
            'id'=>$id,
            'time'=>time()
        ];
        $token=encry_code(serialize($info));//加密
        $url='http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['SCRIPT_NAME']).'/active.php?token='.$token;
        //发送邮件
       $mail=new PHPMailer(true);
        try {
            //服务器设置
            //$mail->SMTPDebug = 2;                                 // 开启调试输出,测试成功就要关闭
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.163.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->CharSet='UTF-8';//邮件内容编码
            $mail->Username = '13076050636@163.com';                 // SMTP username
            $mail->Password = 'xiaojun123456789';                           // SMTP password
            //$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            //$mail->Port = 587;                                    // TCP port to connect to

            //收件人设置
            $mail->setFrom('13076050636@163.com', '网易邮件');
            $mail->addAddress( $data['email'], $data['name']);     // Add a recipient
           // $mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo('13076050636@163.com', 'wangyi');
           // $mail->addCC('cc@example.com');
           // $mail->addBCC('bcc@example.com');

            //Attachments附件
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //邮件内容
            $mail->isHTML(true);                                  // Set email format to HTML 如果邮件内容有标签 者就需要设置true
            $mail->Subject = '小小军的日常'; //邮件主题
            $mail->Body    = '注册成功，点击以下链接激活你的用户 <a href='."$url".' target="_blank">激活</a>';
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->send();
            echo  json_encode(['code'=>1,'message'=>'操作成功']);
        } catch (Exception $e) {
            echo  json_encode(['code'=>6,'message'=>"$mail->ErrorInfo"]);
        }

    }else{
        echo  json_encode(['code'=>5,'message'=>'操作失败']);
    }
}else{
    echo  json_encode(['code'=>2,'message'=>'请求错误']);
}
