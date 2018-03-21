<?php

$kuan=30;//色柱宽
$jiange=20;//色柱间间隔
$zuo=20;//左侧留空
$you=20;//右侧留空
$shang=20;//上留空
$xia=10;//下留空
$zuidashujuzhi=1;//初始化纵轴最大数据值
if ($_GET["a"]=="") die("error id:0");
$shuju=split(",",$_GET["a"]);
//得到最大值
for($i=0;$i<count($shuju);$i++){
if(!is_numeric($shuju[$i])) die("error id:1");
if($shuju[$i]>$zuidashujuzhi) $zuidashujuzhi=$shuju[$i];
}
//计算图像宽度
$img_kuan=$zuo+$you+$jiange+count($shuju)*($kuan+$jiange);
//图像高
$img_gao=170;
//存储色柱高度的数组
$zhugaodu = array();
$image = imagecreate($img_kuan,$img_gao);
$white = imagecolorallocate($image, 0xEE, 0xEE, 0xEE);
//色柱颜色
$shuju_yanse =array(
imagecolorallocate($image, 0x97, 0xbd, 0x00),
imagecolorallocate($image, 0x00, 0x99, 0x00),
imagecolorallocate($image, 0xcc, 0x33, 0x00),
imagecolorallocate($image, 0xff, 0xcc, 0x00),
imagecolorallocate($image, 0x33, 0x66, 0xcc),
imagecolorallocate($image, 0x33, 0xcc, 0x33),
imagecolorallocate($image, 0xff, 0x99, 0x33),
imagecolorallocate($image, 0xcc, 0xcc, 0x99),
imagecolorallocate($image, 0x99, 0xcc, 0x66),
imagecolorallocate($image, 0x66, 0xff, 0x99)
);

//坐标轴颜色
$zuobiao_yanse = imagecolorallocate($image, 0x00, 0x00, 0x00);
//横轴
imageline ( $image, $zuo, $img_gao-$xia, $img_kuan-$you/2, $img_gao-$xia, $zuobiao_yanse);
//纵轴
imageline ( $image, $zuo, $shang/2, $zuo, $img_gao-$xia, $zuobiao_yanse);

//纵轴刻度，纵轴上共标注4个点，所以这里分别计算即可
imageline ( $image, $zuo, $shang, $zuo+6, $shang, $zuobiao_yanse);
imagestring ( $image, 3, $zuo/4, $shang,round($zuidashujuzhi), $zuobiao_yanse);
imageline ( $image, $zuo, $shang+($img_gao-$shang-$xia)*1/4, $zuo+6, round($shang+($img_gao-$shang-$xia)*1/4), $zuobiao_yanse);
imagestring ( $image, 3, $zuo/4, $shang+($img_gao-$shang-$xia)*1/4,round($zuidashujuzhi*3/4), $zuobiao_yanse);
imageline ( $image, $zuo, $shang+($img_gao-$shang-$xia)*2/4, $zuo+6, $shang+($img_gao-$shang-$xia)*2/4, $zuobiao_yanse);
imagestring ( $image, 3, $zuo/4, $shang+($img_gao-$shang-$xia)*2/4,round($zuidashujuzhi*2/4), $zuobiao_yanse);
imageline ( $image, $zuo, $shang+($img_gao-$shang-$xia)*3/4, $zuo+6, $shang+($img_gao-$shang-$xia)*3/4, $zuobiao_yanse);
imagestring ( $image, 3, $zuo/4, $shang+($img_gao-$shang-$xia)*3/4,round($zuidashujuzhi*1/4), $zuobiao_yanse);

//得到每个柱的高度
for($i=0;$i<count($shuju);$i++){
array_push ($zhugaodu, round(($img_gao-$shang-$xia)*$shuju[$i]/$zuidashujuzhi));
}
//画数据柱
$shuju_yanse_int=0;
for($i=0;$i<count($shuju);$i++){
imagefilledrectangle( $image,$zuo+$jiange+$i*($kuan+$jiange),$shang+($img_gao-$shang-$xia)-$zhugaodu[$i],$zuo+$jiange+$i*($kuan+$jiange)+$kuan,($img_gao-$xia)-1 ,$shuju_yanse[$shuju_yanse_int]);
//因为只定义了10种颜色，所以这里做一个循环　　
if($shuju_yanse_int==9){
$shuju_yanse_int=0;
}else{
$shuju_yanse_int++;
}
}
//标注数据柱上方数据值
for($i=0;$i<count($shuju);$i++){
imagestring ( $image, 1, $zuo+$jiange+$i*($kuan+$jiange)+2,$shang+($img_gao-$shang-$xia)-$zhugaodu[$i]-10,$shuju[$i], $zuobiao_yanse);
}
header('Content-type: image/png');
imagepng($image);
imagedestroy($image);