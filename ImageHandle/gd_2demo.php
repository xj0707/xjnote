<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/7
 * Time: 18:31
 */
//验证码制作
//创建画布
$image=imagecreatetruecolor(80,30);
//设置背景颜色
$bgcolor=imagecolorallocate($image,255,255,255);
//填充图像
imagefill($image,0,0,$bgcolor);
//设置验证码数字
for($i=0;$i<4;$i++){
    $fontsize=20;
    $x=$i*(80/4)+rand(5,10);
    $y=rand(5,15);
    $code=mt_rand(0,9);
    //字体的颜色
    $fontcolor=imagecolorallocate($image,rand(0,120),rand(0,120),rand(0,120));//深一点的颜色
    imagestring($image,$fontsize,$x,$y,$code,$fontcolor);
}
//设置干扰元素点
for($i=0;$i<400;$i++){
    $pixcolor=imagecolorallocate($image,rand(120,200),rand(120,200),rand(120,200));
    imagesetpixel($image,rand(1,79),rand(1,29),$pixcolor);
}
//设置干扰元素线
for($i=0;$i<10;$i++){
    $linecolor=imagecolorallocate($image,rand(80,220),rand(80,220),rand(80,220));
    imageline($image,rand(1,79),rand(1,29),rand(1,79),rand(1,29),$linecolor);
}
//图片验证实现逻辑
//首先准备素材库，每个素材库对应一个验证码，随机出现输出图片，用户输入验证吗校验成功即合格。
//汉字验证
//

header('content-type:image/png');
imagepng($image);