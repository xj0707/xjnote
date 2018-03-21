<?php
//GD库图像处理
//创建图像画布
$image = imagecreatetruecolor(300, 300);
//设置颜色
$gray = imagecolorallocate($image, 180, 180, 180);
$red = imagecolorallocate($image, 255, 0, 0);
//画纵坐标和横坐标
imageline($image, 10, 20, 10, 290, $red);
imageline($image, 10, 290, 290, 290, $red);
imagefill($image, 0, 0, $gray);
//画横纵坐标箭头箭头
imageline($image, 10, 20, 5, 27, $red);
imageline($image, 10, 20, 15, 27, $red);
//下箭头
imageline($image, 290, 290, 283, 285, $red);
imageline($image, 290, 290, 283, 295, $red);

//画刻度
for($i=1;$i<=5;$i++){
    imageline($image, 10, 290-$i*50, 15, 290-$i*50, $red);
    imageline($image, 10+$i*50, 290, 10+$i*50, 285, $red);
}
//画折线
imageline($image, 10, 290, 60, 240, $red);
imageline($image, 60, 240, 110, 210, $red);
imageline($image, 110, 210, 160, 90, $red);
imageline($image, 160, 90, 210, 150, $red);
imageline($image, 210, 150, 260, 170, $red);
//画圆点
imagefilledellipse($image, 60, 240, 5, 5, $red);
imagefilledellipse($image, 110, 210, 5, 5, $red);
imagefilledellipse($image, 160, 90, 5, 5, $red);
imagefilledellipse($image, 210, 150, 5, 5, $red);
imagefilledellipse($image, 260, 170, 5, 5, $red);

// imagefilledellipse($image, cx, cy, width, height, color);
//设置header
header('Content-Type:image/png');
//输出图片格式
imagepng($image);
//清理内存
imagedestroy($image);