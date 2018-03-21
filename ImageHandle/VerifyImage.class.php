<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/7
 * Time: 18:29
 */
header('content-type:text/html;charset=utf-8');
//封装验证码
class VerifyImage{
    private static $image;//保存资源
    private static $width;//图片的宽
    private static $height;//图片的高
    public static $truecode;//验证吗
    public function __construct($width=80,$height=30){
        session_start();
        self::$width=$width;
        self::$height=$height;
        //创建画布
        self::$image=imagecreatetruecolor($width,$height);
        //设置背景颜色
        $bgcolor=imagecolorallocate(self::$image,255,255,255);
        //填充图像
        imagefill(self::$image,0,0,$bgcolor);
    }
    //设置验证
    /**
     * @param int $length 验证码长度
     * @param int $verifytype 验证码类型 1位数字，2位字母，3为数字字母，
     * @param int $fontsize
     * @param int $pixel
     * @param int $line
     */
    public function VerifyCode($length=4,$verifytype=1,$fontsize=20,$pixel=100,$line=5){
        $content='';
        switch($verifytype){
            case 1:
                $str='0123456789';
                break;
            case 2:
                $str='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVXWYZ';
                break;
            case 3:
                $str='abcdefghijkmnpqrstuvxwyzABCDEFGHJKMNPQRSTUVXWYZ123456789';
                break;
        }
        for($i=0;$i<$length;$i++){
            $x=$i*(self::$width/$length)+rand(5,10);
            $y=rand(5,self::$height/2);
            $code=substr($str,rand(0,strlen($str)-1),1);
            $content.=$code;
            //字体的颜色
            $fontcolor=imagecolorallocate(self::$image,rand(0,100),rand(0,100),rand(0,100));//深一点的颜色
            imagestring(self::$image,$fontsize,$x,$y,$code,$fontcolor);
        }
        self::setPixel($pixel);
        self::setLine($line);
        self::$truecode=$content;
        $_SESSION['truecode']=$content;
    }

    //图片验证实现逻辑
    //首先准备素材库，每个素材库对应一个验证码，随机出现输出图片，用户输入验证吗校验成功即合格。

    //汉字验证

    //设置干扰元素点
    private static function setPixel($pixel=400){
        for($i=0;$i<$pixel;$i++){
            $pixcolor=imagecolorallocate(self::$image,rand(120,200),rand(120,200),rand(120,200));
            imagesetpixel(self::$image,rand(1,self::$width-1),rand(1,self::$height-1),$pixcolor);
        }
    }
    //设置干扰元素线
    private static function setLine($line=10){
        for($i=0;$i<$line;$i++){
            $linecolor=imagecolorallocate(self::$image,rand(80,220),rand(80,220),rand(80,220));
            imageline(self::$image,rand(1,self::$width-1),rand(1,self::$height-1),rand(1,self::$width-1),rand(1,self::$height-1),$linecolor);
        }
    }
    //输出
    public function show($type='png'){
        header('content-type:image/'.$type);
        imagepng(self::$image);
    }
}
$verifyImage=new VerifyImage(80,30);
$verifyImage->VerifyCode(4,3);
$verifyImage->show();

